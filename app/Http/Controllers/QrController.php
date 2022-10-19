<?php

namespace App\Http\Controllers;

use App\Models\Qr;
use App\Models\User;
use App\Models\Place;
use File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\QrRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Support\Renderable;

class QrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Renderable
    {
        $cSearch = request('txtSearch');

        $oQrs = Qr::with('user', 'place');

        if (auth()->check())
        {
            if(auth()->user()->role == 'user')
            {
                $oQrs->where('user_id', auth()->user()->id);
            }
        }

        $oQrs = $oQrs->orderBy('created_at', 'DESC')
                    ->searchlist($cSearch)
                    ->paginate();

        return view('qrs.index', compact('oQrs', 'cSearch'));
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $oQr = new Qr;

        $oPlaces = Place::whereStatus(1)
                        ->get();

        //$oUsers = User::where('role', 'user')->get();
        $oUsers = User::where('role', 'user')
                        ->doesntHave('qrs')->get();

		return view('qrs.form', compact('oQr', 'oUsers', 'oPlaces'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\QrRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(QrRequest $request)
    {
        $success = true;
        DB::beginTransaction();

        try	{
            $cHash = Str::uuid();
            $cSrc = $cHash.'.png';

            $nIdPlace = ($request->place_id) ? $request->place_id : null;
            $cBusinessLine = ($request->business_line) ? $request->business_line : null;
            $nIdUser = (auth()->user()->role == 'admin') ? $request->user_id : auth()->user()->id;

            $oQr = Qr::where([
                ['user_id', $nIdUser],
                ['place_id', $nIdPlace],
                ['business_line', $cBusinessLine],
            ])->first();

            if(!$oQr)
            {
                //@var \App\Models\Qr
                Qr::create([
                    'src' => $cSrc,
                    'hash' => $cHash,
                    'user_id' => $nIdUser,
                    'place_id' => ($request->place_id) ? $request->place_id : null,
                    'business_line' => ($request->business_line) ? $request->business_line : null,
                ]);

            }else{
                $success = false;
                $message =  'El usuario ya tiene generado un Qr con la información seleccionada';
            }

        } catch (\Exception $e) {
            DB::rollBack();
            $success = false;
            $message = $e->getMessage();
        }

        if ($success === true) {
            DB::commit();
            $message =  'Registro insertado correctamente';
        }

        return redirect()->route('qrs')->with(['success' => $success, 'message' => $message]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $success = true;
        DB::beginTransaction();

        try {
            $oQr = Qr::findOrFail($request->input("hidQr"));
            $cSrc = $oQr->src;
            $oQr->delete();

            if(File::exists(storage_path("app/public/qrcodes/$cSrc")))
            {
                Storage::delete("public/qrcodes/$cSrc");
            }

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
