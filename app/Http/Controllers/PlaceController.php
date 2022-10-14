<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PlaceRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\Support\Renderable;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Renderable
    {
        $cSearch = request('txtSearch');

        $oPlaces = Place::orderBy('created_at', 'DESC')
                        ->searchlist($cSearch)
                        ->paginate();

        return view('places.index', compact('oPlaces', 'cSearch'));
    }

    /**
     * Display the registration view.
     */
    public function create()
    {
        $oPlace = new Place;
		return view('places.form', compact('oPlace'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Place $place
     * @return Renderable
     */
    public function edit($place = FALSE): Renderable
    {
        try {
            $oPlace = Place::findOrFail($place);
			return view('places.form', compact('oPlace'));

		} catch (\Exception $exception) {
			return redirect()->route('places')->with(['message' => $exception->getMessage(), 'success' => false]);
		}
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
            $message = $e->getMessage();
        }

        if ($success === true) {
            DB::commit();
            $message =  'Registro insertado correctamente';
        }

        //return back()->with(['success' => $success, 'message' => $message]);
        return redirect()->route('places')->with(['success' => $success, 'message' => $message]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PlaceRequest $request
     * @param Place $place
     * @return RedirectResponse
     */
    public function update(PlaceRequest $request): RedirectResponse
    {
        $success = true;
        DB::beginTransaction();

        try {
            $oPlace = Place::findOrFail($request->input("hidPlace"));

            $oPlace->name = $request->input("name");
            $oPlace->code = $request->input("code");

            $oPlace->save();

        } catch (\Exception $e) {
            DB::rollBack();
            $success = false;
            $message = $e->getMessage();
        }

        if($success === true) {
            DB::commit();
            $message = 'Registro editado con éxito';
        }

        return redirect()->route('places')->with(['message' => $message, 'success' => $success]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $success = true;
        DB::beginTransaction();

        try {
            $oPlace = Place::findOrFail($request->input("hidPlace"));

            $oPlace->delete();

        } catch (\Exception $e) {
            DB::rollBack();
            $success = false;
            $message = $e->getMessage();
        }

        if ($success === true) {
            DB::commit();
            $message = 'Registro eliminado correctamente';
        }

        return back()->with(['success' => $success, 'message' => $message]);
    }
}
