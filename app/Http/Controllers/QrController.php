<?php

namespace App\Http\Controllers;

use App\Models\Qr;
use App\Models\Place;
use Illuminate\Http\Request;
use App\Http\Requests\QrRequest;
use Illuminate\Support\Facades\DB;

class QrController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $oQr = new Qr;
        $oPlaces = Place::get();
		return view('qrs.form', compact('oQr', 'oPlaces'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(QrRequest $request)
    {
        $success = true;
        DB::beginTransaction();

        try	{
            //@var \App\Models\Qr
            Qr::create([
                'place_id' => $request->place_id,
                'businessline' => $request->businessline,
                'src' => 'example',
                'hash' => 'example',
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            $success = false;
            echo $e->getMessage();
        }

        if ($success === true) {
            DB::commit();
            //return view('website.message');
        }
    }
}
