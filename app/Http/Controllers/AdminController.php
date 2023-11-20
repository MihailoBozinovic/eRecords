<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function adminHome()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        return view('admin.home', compact('data'));
    }
    public function adminKalendar()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }
        $lekari = array();
        $lekari = DB::table('users')->where('id_klinika', '=', Session::get('ID_KLINIKA'), 'and')->where('role_id', '=', 2)->get();
        return view('admin.kalendar', compact('data', 'lekari'));
    }
    public function terminiLekara(Request $request)
    {
        if ($request->ajax()) {
            $id = $request->id_lekara;
            $termini = DB::select(
                "SELECT DATE_FORMAT(t.vreme_datum, '%d/%m/%Y - %H:%i:%s') AS vreme, CONCAT(u.name, ' ', u.surname) AS ime_lekara, CONCAT(p.ime, ' ', p.prezime) AS ime_pacijenta, u.identity_number as tag, t.id as id, t.id_termin as id_termin
                FROM termini AS t 
                LEFT JOIN users AS u ON (u.id = t.id_lekar)
                LEFT JOIN pacijenti AS p ON (p.id = t.id_pacijent)
                WHERE t.id_lekar = {$id}"
            );

            return response()->json([
                "termini" => $termini
            ]);
        } else {
            return redirect()->route('home.admin')->with('fail', 'Nemate pristup ovde!');
        }
    }
    public function adminPacijent()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $id_klinika = Session::get('ID_KLINIKA');

        $pacijenti = DB::select(
            "SELECT p.ime AS ime, p.prezime AS prezime, p.datum_rodjenja AS datum_rodjenja, p.jmbg AS jmbg, CONCAT(u.name, ' ', u.surname) AS ime_lekara
            FROM pacijenti AS p
            LEFT JOIN users AS u ON (u.id = p.id_lekar)
            WHERE p.id_klinika = {$id_klinika}"
        );

        $broj_pacijenata = DB::select(
            "SELECT COUNT(id) AS broj
            FROM pacijenti WHERE id_klinika = {$id_klinika}"
        );
        return view('admin.pacijenti', compact('data', 'pacijenti', 'broj_pacijenata'));
    }
    public function adminLekar()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $lekari = array();
        $lekari = DB::table('users')->where('role_id', '=', 2, 'and')->where('id_klinika', '=', Session::get("ID_KLINIKA"))->get();

        return view('admin.lekari', compact('data', 'lekari'));
    }
    public function adminDodajLekara()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        return view('admin.novi_lekar', compact('data'));
    }
    public function adminMojaKlinika()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        return view('admin.klinika', compact('data'));
    }
    public function adminAnalitika()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        return view('admin.analitika', compact('data'));
    }
    public function adminUnosLekara(Request $request)
    {
    }
    public function adminUnosAnamneze(Request $request)
    {
        $request->validate([
            'anamneza' => 'required'
        ], [
            'anamneza' => 'Obavezno polje!'
        ]);

        DB::table('anamneza')->insert([
            'id_pacijent' => $request->id,
            'id_pregled' => $request->id_pregled,
            'anamneza' => $request->anamneza
        ]);

        return redirect()->route('terapija_pacijenta.admin', [$request->id, $request->id_pregled]);
    }
    public function getPacijenti()
    {
        $dokumenti = array();
        $dokumenti = DB::table('pacijenti')->where('id_lekar', '=', Session::get("ID"))->get();
        return response()->json([
            "pacijenti" => $dokumenti,
        ]);
    }
    public function getLekari()
    {
        $dokumenti = array();
        $dokumenti = DB::table('users')->where('id', '!=', Session::get('ID'))->where('role_id', '=', 1)->orWhere('role_id', '=', 2)->get();
        return response()->json([
            "lekari" => $dokumenti,
        ]);
    }
    public function profilPacijent($id)
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $pacijent = array();
        $pacijent = DB::table('pacijenti')->where('id', '=', $id)->first();

        return view('admin.profil_pacijent', compact('data', 'pacijent'));
    }

    public function profilLekar($id)
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $lekar = array();
        $lekar = DB::table('users')->where('id', '=', $id)->first();

        return view('admin.profil_lekara', compact('data', 'id', 'lekar'));
    }

    public function adminScreenixSrce()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }
        return view('admin.screenix.srce.srce', compact('data'));
    }
}
