<?php

namespace App\Http\Controllers;

use App\Events\Poruka;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use App\Mail\SendMail;
use App\Http\Controllers\ScreenIXController;
use GuzzleHttp\Psr7\Response;

class PatientController extends Controller
{
    public function getPoruke(Request $request)
    {
        if ($request->ajax()) {
            $poruke = DB::select(
                "SELECT r.id AS id, p.poruka AS poruka, p.id_slao AS id_slao, p.id_primio AS id_primio, DATE_FORMAT(p.vreme_poruke, '%H:%i:%s') AS vreme, CONCAT(u1.name, ' ', u1.surname) AS ime
                FROM razgovori AS r
                LEFT JOIN poruke AS p ON (p.id_chat = r.id)
                LEFT JOIN users AS u1 ON (p.id_slao = u1.id)
                LEFT JOIN users AS u2 ON (p.id_primio = u2.id)
                WHERE r.id = {$request->id}"
            );
            DB::table('poruke')->where('id_chat', '=', $request->id, 'and')->where('id_primio', '=', Session::get("ID"))->update([
                'seen' => 1
            ]);
            return response()->json([
                'poruke' => $poruke
            ]);
        } else {
            return redirect()->route('home.patient')->with('fail', "Zabranjen pristup!");
        }
    }
    public function patientHome()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $termini = array();

        $date = date('Y-m-d');
        $id = Session::get("ID");
        $termini = DB::select(
            "SELECT t.id_termin, u.name AS ime, u.surname AS prezime, t.vreme_datum AS vreme 
            FROM termini AS t
            LEFT JOIN users AS u ON (u.id = t.id_lekar)
            WHERE vreme_datum >= {$date} AND t.id_pacijent={$id}"
        );
        return view('patient.home', compact('data', 'termini'));
    }
    public function userProfile()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }
        return view('patient.mojprofil', compact('data'));
    }
    public function promeniSifru(Request $request)
    {
        $user = DB::table('users')->where('id', '=', Session::get('ID'))->first();

        $sifra = $user->password;

        $stara_sifra = $request->sifra;

        if (Hash::check($stara_sifra, $sifra)) {
            if ($request->nova != $stara_sifra) {
                DB::table('users')->where('id', '=', Session::get('ID'))->update([
                    'password' => Hash::make($request->nova),
                ]);
                redirect()->route('vasi-profil.patient')->with('sifra_success', 'Uspešno ste promenili šifru!');
            } else {
                return redirect()->route('vasi-profil.patient')->with('sifra_fail', 'Nova šifra ne može biti ista kao stara!');
            }
        } else {
            return redirect()->route('vasi-profil.patient')->with('sifra_fail', 'Stara šifra je pogrešna!');
        }
    }
    public function patientProfile()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $id_pacijent = Session::get("ID");

        $pacijent = array();
        $pacijent = DB::select(
            "SELECT p.ime AS ime, p.prezime AS prezime, p.email AS email, p.datum_rodjenja AS datum_rodjenja, p.jmbg AS jmbg,
            p.pol AS pol, p.zanimanje AS zanimanje, p.mesto AS mesto, p.opstina AS opstina, p.adresa AS adresa, 
            p.telefon AS telefon, p.krvna_grupa AS krvna_grupa, p.alergije AS alergije, p.id AS id
            FROM users AS u 
            LEFT JOIN pacijenti AS p ON (p.id_user = u.id)
            WHERE u.id = {$id_pacijent} LIMIT 1"
        );
        $rizici = DB::table('srceenIXSrce')->leftJoin('srceRizici', 'srceenIXSrce.id', '=', 'srceRizici.id_test')
            ->where('srceenIXSrce.id_pacijent', '=', $pacijent[0]->id, 'and')->where('srceenIXSrce.status', '>', 0)->first();

        if (!empty($rizici)) {
            if (empty($rizici->korak1) && empty($rizici->korak2) && empty($rizici->korak3_1) && empty($rizici->korak3_2) && empty($rizici->korak3_3) && empty($rizici->korak3_4)) {
                $rizik = 0;
            } else if (empty($rizici->korak4_1) && empty($rizici->korak4_2) && empty($rizici->korak4_3) && empty($rizici->korak4_4) && empty($rizici->korak4_5) && empty($rizici->korak4_6) && empty($rizici->korak4_7) && empty($rizici->korak4_8) && empty($rizici->korak5)) {
                $rizik = (int) (((3.5 * $rizici->korak1 +
                    2.5 * $rizici->korak2 +
                    2 * $rizici->korak3_1 +
                    2 * $rizici->korak3_2 +
                    2.5 * $rizici->korak3_3 +
                    3 * $rizici->korak3_4) / 15.5));
            } else {
                $rizik = ($rizici->korak4_1 * 15.0 + $rizici->korak4_2 * 16.0 + $rizici->korak4_3 * 13.0 + $rizici->korak4_4 * 12.0 + $rizici->korak4_5 * 15.0 + $rizici->korak4_6 * 15.0 + $rizici->korak4_7 * 14.0 + $rizici->korak4_8 * 18.0 + $rizici->korak2 * 17.0 + $rizici->korak5 * 20) / 168;

                $rizik = (int) ((7.5 * $rizik + 1.5 * $rizici->korak1) / 9.0);
            }
        } else {
            $rizik = 0;
        }

        return view('patient.profile', compact('data', 'pacijent', 'rizik'));
    }
    public function patientCalendar()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $lekari = array();
        $lekari = DB::table('users')->where('role_id', '=', 2, 'or')->get();

        return view('patient.zakazivanje', compact('data', 'lekari'));
    }
    public function patientLiveChat()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $id = Session::get("ID");
        $razgovor = DB::select(
            "SELECT r.id, u1.name AS ime, u1.surname AS prezime, u1.id AS id_lekar, u2.id AS id_pacijent, u1.online AS online
            FROM razgovori AS r
            LEFT JOIN users AS u1 ON (u1.id = r.korisnik1)
            LEFT JOIN users AS u2 ON (u2.id = r.korisnik2)
            WHERE r.korisnik2 = {$id}"
        );
        $razgovori = array();
        foreach ($razgovor as $r) {
            $idR = $r->id;
            $brojNovihPoruka = DB::select(
                "SELECT COUNT(id) AS broj
                FROM poruke
                WHERE seen = 0 AND id_chat = {$idR} AND id_primio = {$id}"
            );

            $razgovori[] = [
                'id' => $r->id,
                'ime' => $r->ime,
                'prezime' => $r->prezime,
                'id_lekar' => $r->id_lekar,
                'id_pacijent' => $r->id_pacijent,
                'online' => $r->online,
                'brojPoruka' => $brojNovihPoruka[0]->broj
            ];
        }

        $razgovori = json_decode(json_encode($razgovori), FALSE);
        return view('patient.support', compact('data', 'razgovori'));
    }

    public function getRazgovor(Request $request)
    {
        $id_lekar = $request->id_lekar;
        $id_pacijent = $request->id_pacijent;
        // KORISNIK1 - LEKAR
        // KORISNIK2 - PACIJENT
        $razgovor = DB::select(
            "SELECT CONCAT(u1.name, ' ', u1.surname) AS ime_lekar, r.id AS id, CONCAT(u2.name, ' ', u2.surname) AS ime_pacijent
            FROM razgovori AS r
            LEFT JOIN users AS u1 ON (r.korisnik1 = u1.id)
            LEFT JOIN users AS u2 ON (r.korisnik2 = u2.id)
            WHERE (korisnik1 = {$id_lekar} AND korisnik2 = {$id_pacijent}) 
            LIMIT 1"
        );

        return response()->json([
            'razgovor' => $razgovor,
        ]);
    }

    public function patientTermini()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $termini = array();

        $id = Session::get('ID');

        $termini = DB::select("SELECT t.vreme_datum AS vreme_datum, u.name as ime, u.surname as prezime, t.id_termin AS id_termin
        FROM termini t LEFT JOIN
        users u ON (u.id = t.id_lekar) 
        WHERE t.id_pacijent = {$id}");

        return view('patient.termini', compact('data', 'termini'));
    }
    // POST
    public function unesiTermin(Request $request)
    {
        if (DB::table('termini')->insert([
            'vreme_datum' => $request->datum,
            'id_pacijent' => Session::get("ID"),
            'id_lekar' => $request->id_lekar,
            'id_termin' => $request->id,
            'k' => $request->k,
        ])) {
            return redirect()->route('home.patient')->with('success', 'Uspešno ste zakazali termin!');
        } else {
            return redirect()->route('home.patient')->with('fail', 'Niste zakazali termin!');
        }
    }
    // AJAX
    public function termini(Request $request)
    {
        if ($request->ajax()) {
            $termini = DB::table('termini')->where('id_lekar', '=', $request->id_lekara)->get();

            return response()->json([
                'termini' => $termini,
            ]);
        } else {
            return redirect()->route('home.patient')->with('fail', 'Zabranjen pristup!');
        }
    }
    public function imeLekara(Request $request)
    {
        if ($request->ajax()) {
            $lekar = DB::table('users')->where('id', '=', $request->id_lekara)->first();
            return response()->json([
                'lekar' => $lekar,
            ]);
        } else {
            return redirect()->route('home.patient')->with('fail', 'Zabranjen pristup!');
        }
    }
    public function lastTerminId(Request $request)
    {
        if ($request->ajax()) {
            $termin = DB::table('termini')->orderBy('id', 'desc')->first();
            return response()->json([
                'termin' => $termin,
            ]);
        } else {
            return redirect()->route('home.patient')->with('fail', 'Zabranjen pristup!');
        }
    }

    public function terapije()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $id_pacijent = Session::get("ID");

        $pacijent = array();
        $pacijent = DB::select(
            "SELECT p.ime AS ime, p.prezime AS prezime, p.email AS email, p.datum_rodjenja AS datum_rodjenja, p.jmbg AS jmbg,
            p.pol AS pol, p.zanimanje AS zanimanje, p.mesto AS mesto, p.opstina AS opstina, p.adresa AS adresa, 
            p.telefon AS telefon, p.krvna_grupa AS krvna_grupa, p.alergije AS alergije, p.id AS id
            FROM users AS u 
            LEFT JOIN pacijenti AS p ON (p.id_user = u.id)
            WHERE u.id = {$id_pacijent} LIMIT 1"
        );

        $terapije = array();
        $terapije = DB::select(
            "SELECT t.vreme AS vreme, t.id AS id, l.naziv AS naziv, l.oblik_doza as oblik_doza, l.nosilac_dozvole AS nosilac_dozvole, t.kolicina AS kolicina, t.period AS period, t.komentar AS komentar
            FROM terapije AS t 
            LEFT JOIN lekovi AS l ON (l.id = t.sifra_lek)
            WHERE t.id_pacijent = {$pacijent[0]->id}"
        );

        return view('patient.terapije', compact('data', 'terapije'));
    }
    public function istorijaPregleda()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $id_pacijent = Session::get("ID");

        $pacijent = array();
        $pacijent = DB::select(
            "SELECT p.ime AS ime, p.prezime AS prezime, p.email AS email, p.datum_rodjenja AS datum_rodjenja, p.jmbg AS jmbg,
            p.pol AS pol, p.zanimanje AS zanimanje, p.mesto AS mesto, p.opstina AS opstina, p.adresa AS adresa, 
            p.telefon AS telefon, p.krvna_grupa AS krvna_grupa, p.alergije AS alergije, p.id AS id
            FROM users AS u 
            LEFT JOIN pacijenti AS p ON (p.id_user = u.id)
            WHERE u.id = {$id_pacijent} LIMIT 1"
        );

        $mere = DB::select(
            "SELECT *
            FROM mere AS m 
            LEFT JOIN anamneza AS a ON (m.id_pregled = a.id_pregled)
            WHERE m.id_pacijent = {$pacijent[0]->id}"
        );

        return view('patient.parametri', compact('data', 'mere'));
    }
    public function radioloskeSlike()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $id_pacijent = Session::get("ID");

        $pacijent = array();
        $pacijent = DB::select(
            "SELECT p.ime AS ime, p.prezime AS prezime, p.email AS email, p.datum_rodjenja AS datum_rodjenja, p.jmbg AS jmbg,
            p.pol AS pol, p.zanimanje AS zanimanje, p.mesto AS mesto, p.opstina AS opstina, p.adresa AS adresa, 
            p.telefon AS telefon, p.krvna_grupa AS krvna_grupa, p.alergije AS alergije, p.id AS id
            FROM users AS u 
            LEFT JOIN pacijenti AS p ON (p.id_user = u.id)
            WHERE u.id = {$id_pacijent} LIMIT 1"
        );

        $slike = array();
        $slike = DB::table('radiologija')->where('id_pacijent', '=', $pacijent[0]->id)->get();

        return view('patient.radioloskeslike', compact('data', 'slike'));
    }

    public function nalaziLaboratorija()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $id_pacijent = Session::get("ID");

        $pacijent = array();
        $pacijent = DB::select(
            "SELECT p.ime AS ime, p.prezime AS prezime, p.email AS email, p.datum_rodjenja AS datum_rodjenja, p.jmbg AS jmbg,
            p.pol AS pol, p.zanimanje AS zanimanje, p.mesto AS mesto, p.opstina AS opstina, p.adresa AS adresa, 
            p.telefon AS telefon, p.krvna_grupa AS krvna_grupa, p.alergije AS alergije, p.id AS id
            FROM users AS u 
            LEFT JOIN pacijenti AS p ON (p.id_user = u.id)
            WHERE u.id = {$id_pacijent} LIMIT 1"
        );

        $slike = array();
        $slike = DB::table('nalazi')->where('id_pacijent', '=', $pacijent[0]->id)->get();

        return view('patient.nalazi', compact('data', 'slike'));
    }
}
