<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Models\Qr;
use App\Models\Lead;

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

        $oLeads = Lead::with(['qr' => function($q){
                            $q->with('user', 'place');
                        }]);

        if (auth()->check())
        {
            if(auth()->user()->role == 'user')
            {
                $oLeads->whereHas('qr', function($q) {
                    $q->where('user_id', auth()->user()->id);
                });
            }
        }

        $oLeads = $oLeads->orderBy('created_at', 'DESC')
                        ->paginate();

        return view('leads.index', compact('oLeads', 'cSearch'));
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
                return view('website.register', compact('cHash'));

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
            //@var \App\Models\Lead
            $oQr = Qr::where('hash', $request->hidHash)->first();

            if($oQr)
            {
                $oLead = Lead::create([
                    'qr_id' => $oQr->id,
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'time_capture' => '00:00',
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
