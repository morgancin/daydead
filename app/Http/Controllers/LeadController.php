<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Qr;
use App\Models\Lead;

use App\Models\Place;
use App\Http\Requests\LeadRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Support\Renderable;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Renderable
    {
        $cSearch = request('txtSearch');
        $cSearchFchI = request('txtSearchFchI');
        $cSearchFchF = request('txtSearchFchF');
        $cSearchBusiness = request('cmbSearch');
        $cSearchPlace = request('txtSearchPlace');

        $oLeads = Lead::with(['place', 'qr' => function($q){
                            $q->with('user', 'place');
                        }]);

        if (auth()->check())
        {
            if(auth()->user()->role !== 'admin')
            {
                $oLeads->whereHas('qr', function($q) {
                    $q->where('user_id', auth()->user()->id);
                });
            }
        }

        $oLeads = $oLeads->searchlist($cSearch)
                        ->searchlistplace($cSearchPlace)
                        ->searchlistbusiness($cSearchBusiness)
                        ->searchdates($cSearchFchI, $cSearchFchF)
                        ->orderBy('created_at', 'DESC')
                        ->paginate();

        return view('leads.index', compact('oLeads', 'cSearch', 'cSearchPlace', 'cSearchFchI', 'cSearchFchF', 'cSearchBusiness'));
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create($cHash = false)
    {
        if($cHash)
        {
            $oQr = Qr::where('hash', $cHash)->first();

            if($oQr)
            {
                if(empty($oQr->place_id))
                {
                    $cSelectPlace = true;
                    $oPlaces = Place::whereStatus(1)
                                    ->get();
                }else
                {
                    $oPlaces = array();
                    $cSelectPlace = false;
                }

                $cSelectBusiness = (empty($oQr->business_line)) ? true : false;

                return view('website.register', compact('oQr', 'cHash', 'cSelectPlace', 'cSelectBusiness', 'oPlaces'));

            }else
            {
                abort(404);
            }

        }else
        {
            abort(404);
        }
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\LeadRequest  $request
     * @return \Illuminate\View\View
     *
     */
    public function store(LeadRequest $request)
    {
        $success = true;
        DB::beginTransaction();

        try	{
            $oQr = Qr::where('hash', $request->hidHash)->first();

            if($oQr)
            {
                //@var \App\Models\Lead
                $oLead = Lead::create([
                                        'qr_id' => $oQr->id,
                                        'name' => $request->name,
                                        'phone' => $request->phone,
                                        'email' => $request->email,
                                        'time_capture' => '00:00',
                                        'place_id' => ($request->has('cmbPlace')) ? $request->cmbPlace : $oQr->place_id,
                                        'business_line' => ($request->has('cmbBusiness')) ? $request->cmbBusiness : $oQr->business_line,
                                    ]);
            }else
            {
                return back()->with(['success' => FALSE, 'message' => 'Hash inválido']);
            }

        } catch (\Exception $e) {
            DB::rollBack();
            $success = false;
            echo $e->getMessage();
        }

        if ($success === true) {
            DB::commit();
            //event(new Registered($user));

            return view('website.message', compact('oLead'));
        }

        //event(new Registered($user));
        //Auth::login($user);
        //return redirect(RouteServiceProvider::HOME);
    }
}
