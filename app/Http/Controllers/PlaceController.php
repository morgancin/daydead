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
     *
     */
    public function index(): Renderable
    {
        $oPlaces = Place::paginate();

        return view('places.index', compact('oPlaces'));
    }

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
            $message = $e->getMessage();
        }

        if ($success === true) {
            DB::commit();
            $message =  'Registro insertado correctamente';
        }

        return back()->with(['success' => $success, 'message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $request->validate([
                    'hidPlace' => 'required'
                ],
                [
                    'hidPlace.required' => 'Se requiere seleccionar registro.'
                ]
            );

        $success = true;
        DB::beginTransaction();

        try {
            $oPlace = Place::findOrFail($request->input("hidPlace"));

            $oPlace->delete();

        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with(['success' => FALSE, 'message' => $exception->getMessage()]);
        }

        if ($success === true) {
            DB::commit();
            return back()->with(['success' => TRUE, 'message' => "Registro eliminado correctamente"]);
        }
    }
}
