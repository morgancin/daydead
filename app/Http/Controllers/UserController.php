<?php

namespace App\Http\Controllers;

//use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
        /*
        $oCategorias = Categoria::get();
        $cSearch = request('Subcategoria_txtSearch');
        $nIdCategoria_search = request('Subcategoria_cmbSearch');

		$oSubcategorias = Subcategoria::with('categoria')
                                    ->searchlistado(request('Subcategoria_txtSearch'))
                                    ->searchcategoria(request('Subcategoria_cmbSearch'))
                                    ->paginate();

		return view('administrador.subcategorias.listado', compact('oSubcategorias', 'oCategorias', 'cSearch', 'nIdCategoria_search'));
        */
        return view('users.index');
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('users.form');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            //'leader_user_id' => ['required', 'numeric'],
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:100'],
            'place' => ['required', 'string', 'max:100'],
            'manager' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

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
    }
}
