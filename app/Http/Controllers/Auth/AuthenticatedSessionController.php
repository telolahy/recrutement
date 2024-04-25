<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\Administrateur;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     *
     * @param  \App\Http\Requests\Auth\LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();
        $idAdmin= Auth::user()->id;
         $val= Administrateur::getRoleAdmin($idAdmin);
        if($val[0]->status=="Active"){
        Session::put('nomrole', $val[0]->nomrole);
        Session::put('nomposte', $val[0]->nomposte);
        Session::put('idDirection', $val[0]->direction_id);
        return redirect()->intended(RouteServiceProvider::HOME);
        }
        else{
            $notif="Votre compte a été désactivé";
             $request->session()->invalidate();
             $request->session()->regenerateToken();
            return view('auth/login',compact("notif"));
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/Recruteur');
    }
}
