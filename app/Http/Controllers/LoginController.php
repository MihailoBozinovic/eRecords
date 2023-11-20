<?php

namespace App\Http\Controllers;

use App\Events\Poruka;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    function redirect_login()
    {
        return view('login');
    }

    function login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email' => 'Email je obavezan!',
            'password' => 'Šifra je obavezna!'
        ]);

        $user = DB::table('users')->where('email', '=', $request->email)->first();

        if ($user && $user->role_id == 1) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('ID', $user->id);
                $request->session()->put('ID_KLINIKA', $user->id_klinika);
                DB::table('users')->where('id', '=', $user->id)->update([
                    'online' => 1
                ]);
                return redirect()->route('home.admin')->with('success', 'Dobro došli ' . $user->name . ' ' . $user->surname);
            } else {
                return back()->with('fail', 'Pogrešno korisničko ime ili šifra!');
            }
        } else if ($user && $user->role_id == 2) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('ID', $user->id);
                $request->session()->put('ID_KLINIKA', $user->id_klinika);
                $request->session()->put('ScreenIX', 0);
                DB::table('users')->where('id', '=', $user->id)->update([
                    'online' => 1
                ]);
                $request->session()->put('ID_KLINIKA', $user->id_klinika);
                return redirect()->route('home.doctor')->with('success', 'Dobro došli ' . $user->name . ' ' . $user->surname);;
            } else {
                return back()->with('fail', 'Pogrešno korisničko ime ili šifra!');
            }
        } else if ($user && $user->role_id == 3) {
            if (Hash::check($request->password, $user->password)) {
                $request->session()->put('ID', $user->id);
                DB::table('users')->where('id', '=', $user->id)->update([
                    'online' => 1
                ]);
                return redirect()->route('home.patient')->with('success', 'Dobro došli ' . $user->name . ' ' . $user->surname);;
            } else {
                return back()->with('fail', 'Pogrešno korisničko ime ili šifra!');
            }
        } else {
            return back()->with('fail', 'Pogrešno korisničko ime ili šifra!');
        }
    }
    function logout()
    {
        if (Session::has('ID')) {
            DB::table('users')->where('id', '=', Session::get('ID'))->update([
                'online' => 0
            ]);
            Session::pull('ID');
            Session::pull("ID_KLINIKA");
            return redirect()->route('login');
        }
    }
}
