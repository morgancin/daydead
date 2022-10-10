<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PlaceRequest;

class PlaceController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('places.form');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\PlaceRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(PlaceRequest $request)
    {
        $success = true;
        DB::beginTransaction();

        try	{
            //@var \App\Models\Place
            Place::create([
                'name' => $request->name,
                'code' => $request->code,
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
