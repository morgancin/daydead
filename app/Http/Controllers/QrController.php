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
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Contracts\Support\Renderable;

class QrController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Renderable
    {
        $cSearch = request('txtSearch');

        $oQrs = Qr::with('user', 'place')
                    ->orderBy('created_at', 'DESC')
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
        $oUsers = User::get();
        $oPlaces = Place::get();

		return view('qrs.form', compact('oQr', 'oUsers', 'oPlaces'));
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
            $cHash = Str::uuid();
            $cSrc = $cHash.'.png';

            //@var \App\Models\Qr
            Qr::create([
                'src' => $cSrc,
                'hash' => $cHash,
                'place_id' => $request->place_id,
                'businessline' => $request->businessline,
                'user_id' => (auth()->user()->role == 'admin') ? $request->user_id : auth()->user()->id,
            ]);

            QrCode::format('png')->size(150)->backgroundColor(255, 0, 0)->color(78, 3, 121)->merge('../public/imagenes/alcisQr.png', 0.3, true)->generate(route('leads.register', $cHash), storage_path("app/public/qrcodes/$cSrc"));

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
