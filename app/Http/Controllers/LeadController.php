<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use App\Http\Requests\LeadRequest;
use Illuminate\Support\Facades\DB;

use App\Models\Lead;

class LeadController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('website.register');
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
            Lead::create([
                'qr_id' => 2,
                'time_capture' => '00:00',
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            $success = false;
            echo $e->getMessage();
        }

        if ($success === true) {
            DB::commit();
            //event(new Registered($user));

            return view('website.message');
        }

        //event(new Registered($user));
        //Auth::login($user);
        //return redirect(RouteServiceProvider::HOME);
    }
}
