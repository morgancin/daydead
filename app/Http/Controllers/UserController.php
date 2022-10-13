<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
//use Illuminate\Validation\Rules;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Support\Renderable;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(): Renderable
    {
        $cSearch = request('txtSearch');

        $oUsers = User::with('qrs')
                    ->where('role', 'user')
                    ->searchlist($cSearch)
                    ->paginate();

        return view('users.index', compact('oUsers', 'cSearch'));
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $oUser = new User;
		return view('users.form', compact('oUser'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Place $place
     * @return Renderable
     */
    public function edit($user = FALSE): Renderable
    {
        try {
            $oUser = User::findOrFail($user);
			return view('users.form', compact('oUser'));

		} catch (\Exception $exception) {
			return redirect()->route('users')->with(['message' => $exception->getMessage(), 'success' => false]);
		}
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(UserRequest $request)
    {
        $success = true;
        DB::beginTransaction();

        try	{
            //@var \App\Models\User
            $user = User::create([
                'role' => 'user',
                'name' => $request->name,
                'code' => $request->code,
                'place' => $request->place,
                'email' => $request->email,
                'manager' => $request->manager,
                'password' => Hash::make($request->password),
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
        return redirect()->route('users')->with(['success' => $success, 'message' => $message]);

        /*
        $user = User::create([
            'role' => 'user',
            'name' => $request->name,
            'code' => $request->code,
            'place' => $request->place,
            'email' => $request->email,
            'manager' => $request->manager,
            'password' => Hash::make($request->password),
            //'leader_user_id' => $request->leader_user_id,
        ]);

        event(new Registered($user));

        //Auth::login($user);

        //return redirect(RouteServiceProvider::HOME);
        */
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $place
     * @return RedirectResponse
     */
    public function update(UserRequest $request): RedirectResponse
    {
        $success = true;
        DB::beginTransaction();

        try {
            $oUser = User::findOrFail($request->input("hidUser"));

            $oUser->update([
                'role' => 'user',
                'name' => $request->name,
                'code' => $request->code,
                'place' => $request->place,
                'email' => $request->email,
                'manager' => $request->manager,
                'password' => Hash::make($request->password),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();
            $success = false;
            $message = $e->getMessage();
        }

        if($success === true) {
            DB::commit();
            $message = 'Registro editado con éxito';
        }

        return redirect()->route('users')->with(['message' => $message, 'success' => $success]);
    }

     /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $success = true;
        DB::beginTransaction();

        try {
            $oUser = User::findOrFail($request->input("hidUser"));

            $oUser->delete();

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
