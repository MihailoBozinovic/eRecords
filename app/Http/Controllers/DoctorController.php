<?php

namespace App\Http\Controllers;

use App\Events\Poruka;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Mail\SendMail;
use App\Http\Controllers\ScreenIXController;
use App\Mail\sendEmail;
use Illuminate\Database\QueryException;

class DoctorController extends Controller
{
    public function kontaktPacijenta($id)
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }
        $pacijent = DB::table('pacijenti')->where('id', '=', $id)->first();
        return view('doctor.kontaktPacijenta', compact('data', 'id', 'pacijent'));
    }
    public function kontaktMail(Request $request)
    {
        $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();

        $mailData = [
            'title' => $request->subject,
            'body' => $request->tekst,
            'email' => $data->email,
            'ime' => $data->name . ' ' . $data->surname,
        ];

        Mail::to($request->email)->send(new sendEmail($mailData));

        return redirect()->route('home.doctor')->with('success', 'Uspešno ste poslali mejl pacijentu!');
    }
    public function doctorProfile()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        return view('doctor.profil', compact('data'));
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
                redirect()->route('vasProfil.doctor')->with('sifra_success', 'Uspešno ste promenili šifru!');
            } else {
                return redirect()->route('vasProfil.doctor')->with('sifra_fail', 'Nova šifra ne može biti ista kao stara!');
            }
        } else {
            return redirect()->route('vasProfil.doctor')->with('sifra_fail', 'Stara šifra je pogrešna!');
        }
    }
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
    public function poruke()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $id = Session::get("ID");

        $razgovor = DB::select(
            "SELECT r.id AS id, u2.name AS ime, u2.surname AS prezime, u1.id AS id_lekar, u2.id AS id_pacijent, u2.online AS online
            FROM razgovori AS r
            LEFT JOIN users AS u1 ON (u1.id = r.korisnik1)
            LEFT JOIN users AS u2 ON (u2.id = r.korisnik2)
            WHERE r.korisnik1 = {$id}"
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
        return view('doctor.chat', compact('data', 'razgovori'));
    }
    public function searchLekovi(Request $request)
    {
        if ($request->ajax()) {
            $lekovi = array();
            $lekovi = DB::table('lekovi')->where('naziv', 'LIKE', $request->search_lekovi . '%')->get();
            $output = "";

            $total_row = $lekovi->count();
            if ($total_row > 0) {
                foreach ($lekovi as $l) {
                    $output .= '
                        <tr id="' . $l->id . '">
                        <td>' . $l->naziv . '</td>
                        <td>' . $l->oblik_doza . '</td>
                        <td><strong>' . $l->nosilac_dozvole . '</strong></td>
                        <td><button data-naziv="' . $l->naziv . '" data-oblik="' . $l->oblik_doza . '" data-dozvola="' . $l->nosilac_dozvole . '" id="button' . $l->id . '" type="button" class="btn btn-primary" onclick="dodajLek(' . $l->id . ')">Dodaj terapiju</button></td>
                        </tr>
                    ';
                }
            } else {
                $output = '
                    <tr>
                        <td align="center" colspan="5">No Data Found</td>
                    </tr>
                ';
            }
            $data = array(
                'lekovi' => $output
            );
            echo json_encode($data);
        }
    }
    public function doctorHome()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        return view('doctor.home', compact('data'));
    }
    public function doctorNewPatient()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        return view('doctor.newPatient', compact('data'));
    }
    public function doctorInsertPatient(Request $request)
    {
        $request->validate([
            'ime' => 'required',
            'prezime' => 'required',
            'email' => 'required',
            'datum_rodjenja' => 'required',
            'jmbg' => 'required',
            'pol' => 'required',
            'zanimanje' => 'required',
            'mesto' => 'required',
            'opstina' => 'required',
            'adresa' => 'required',
            'telefon' => 'required',
            'krvna_grupa' => 'required',

        ], [
            'ime' => 'Obavezno polje!',
            'prezime' => 'Obavezno polje!',
            'email' => 'Obavezno polje!',
            'datum_rodjenja' => 'Obavezno polje!',
            'jmbg' => 'Obavezno polje!',
            'pol' => 'Obavezno polje!',
            'zanimanje' => 'Obavezno polje!',
            'mesto' => 'Obavezno polje!',
            'opstina' => 'Obavezno polje!',
            'adresa' => 'Obavezno polje!',
            'telefon' => 'Obavezno polje!',
            'krvna_grupa' => 'Obavezno polje!',

        ]);

        $password = Str::random(10);

        try {
            $id_user = DB::table('users')->insertGetId([
                'username' => $request->email,
                'email' => $request->email,
                'password' => Hash::make($password),
                'name' => $request->ime,
                'surname' => $request->prezime,
                'identity_number' => $request->jmbg,
                'role_id' => 3,
                'id_klinika' => Session::get('ID_KLINIKA'),
                'online' => 0,
            ]);
            DB::table('pacijenti')->insertGetId([
                'ime' => $request->ime,
                'prezime' => $request->prezime,
                'email' => $request->email,
                'datum_rodjenja' => $request->datum_rodjenja,
                'jmbg' => $request->jmbg,
                'pol' => $request->pol,
                'zanimanje' => $request->zanimanje,
                'mesto' => $request->mesto,
                'opstina' => $request->opstina,
                'adresa' => $request->adresa,
                'telefon' => $request->telefon,
                'krvna_grupa' => $request->krvna_grupa,
                'alergije' => $request->alergije,
                'id_lekar' => Session::get('ID'),
                'id_klinika' => Session::get('ID_KLINIKA'),
                'id_user' => $id_user,

            ]);
            DB::table('razgovori')->insert([
                'korisnik1' => Session::get("ID"),
                'korisnik2' => $id_user,
            ]);
            $mailData = [
                'title' => 'Novi nalog na E-Karton-u',
                'body' => 'Poštovani, obaveštavamo vas ovim putem da vam je otvoren nalog na E-Karton-u',
                'email' => $request->email,
                'password' => $password,
                'ime' => $request->ime,
                'prezime' => $request->prezime,
            ];

            Mail::to($request->email)->send(new SendMail($mailData));

            $directoryPath = public_path('slike/slikeZa' . $request->jmbg);

            if (!File::exists($directoryPath)) {
                File::makeDirectory($directoryPath, 0755, true);
            }

            $directoryPath1 = public_path('nalazi/nalaziZa' . $request->jmbg);

            if (!File::exists($directoryPath1)) {
                File::makeDirectory($directoryPath1, 0755, true);
            }



            return redirect()->route('home.doctor')->with('success', 'Uspešno ste uneli novog pacijenta!');
        } catch (QueryException $ex) {
            return redirect()->back()->with('fail', 'Pacijent sa ovim mailom već postoji! Email: ' . $request->email);
        }
    }
    public function patients()
    {
        $dokumenti = array();
        $dokumenti = DB::table('pacijenti')->where('id_lekar', '=', Session::get("ID"))->get();
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        return view('doctor.pacijenti', compact('data'), compact('dokumenti'));
    }
    public function doctorPregledPacijenta($id)
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $id_pregled = DB::table('pregledi')->insertGetId([
            'id_pacijent' => $id
        ]);

        return view('doctor.pregled_pacijenta', compact('data', 'id', 'id_pregled'));
    }
    public function dijagnoze($id)
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $pacijent = array();
        $pacijent = DB::table('pacijenti')->where('id', '=', $id)->first();

        $dijagnoze = array();
        $dijagnoze = DB::table('dijagnoze')->where('id_pacijent', '=', $id)->get();

        return view('doctor.dijagnoze', compact('data', 'pacijent', 'dijagnoze'));
    }
    public function profilPacijent($id)
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $pacijent = array();
        $pacijent = DB::table('pacijenti')->where('id', '=', $id)->first();

        $rizici = DB::table('srceenIXSrce')->leftJoin('srceRizici', 'srceenIXSrce.id', '=', 'srceRizici.id_test')
            ->where('srceenIXSrce.id_pacijent', '=', $id, 'and')->where('srceenIXSrce.status', '>', 0)->first();

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
        return view('doctor.profil_pacijenta', compact('data', 'pacijent', 'rizik'));
    }
    public function brisanjePacijenta($id)
    {
        $pacijent = DB::table('pacijenti')->where('id', '=', $id)->first();
        $id_user = $pacijent->id_user;
        $razgovor = DB::table('razgovori')->where('korisnik2', '=', $id_user)->first();
        $test = DB::table('srceenIXSrce')->where('id_pacijent', '=', $id)->get();
        foreach ($test as $t) {
            DB::table('srceenIXSrce')->where('id', '=', $t->id)->delete();

            DB::table('srceRizici')->where('id_test', '=', $t->id)->delete();
            DB::table('srceUpitnik')->where('id_test', '=', $t->id)->delete();
            DB::table('srcePosao')->where('id_test', '=', $t->id)->delete();
            DB::table('srceNavike')->where('id_test', '=', $t->id)->delete();
            DB::table('srceHrana')->where('id_test', '=', $t->id)->delete();

            DB::table('filter1')->where('id_test', '=', $t->id)->delete();
            DB::table('filter2')->where('id_test', '=', $t->id)->delete();
            DB::table('filter3')->where('id_test', '=', $t->id)->delete();
            DB::table('filter4')->where('id_test', '=', $t->id)->delete();
            DB::table('filter5')->where('id_test', '=', $t->id)->delete();
            DB::table('filter6')->where('id_test', '=', $t->id)->delete();
            DB::table('filter7')->where('id_test', '=', $t->id)->delete();
            DB::table('filter8')->where('id_test', '=', $t->id)->delete();
            DB::table('srceEkg')->where('id_test', '=', $t->id)->delete();
        }
        DB::table('pacijenti')->where('id', '=', $id)->delete();
        DB::table('mere')->where('id_pacijent', '=', $id)->delete();
        DB::table('pregledi')->where('id_pacijent', '=', $id)->delete();
        DB::table('srceenIXSrce')->where('id_pacijent', '=', $id)->delete();
        DB::table('users')->where('email', '=', $pacijent->email)->delete();
        DB::table('razgovori')->where('korisnik2', '=', $id_user)->delete();
        DB::table('poruke')->where('id_chat', '=', $razgovor->id)->delete();
        return redirect()->route('pacijenti.doctor');
    }

    public function doctorUpdatePatient($id)
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $pacijent = array();
        $pacijent = DB::table('pacijenti')->where('id', '=', $id)->first();

        return view('doctor.update_patient', compact('data', 'pacijent'));
    }

    public function doctorUnosMera(Request $request)
    {
        $request->validate([
            'temperatura' => 'required',
            's_pritisak' => 'required',
            'd_pritisak' => 'required',
            'saturacija' => 'required',
            'srcana_frekvenca' => 'required',
            'visina' => 'required',
            'tezina' => 'required',
            'bmi' => 'required',
        ], [
            'temperatura' => 'Obavezno polje!',
            's_pritisak' => 'Obavezno polje!',
            'd_pritisak' => 'Obavezno polje!',
            'saturacija' => 'Obavezno polje!',
            'srcana_frekvenca' => 'Obavezno polje!',
            'visina' => 'Obavezno polje!',
            'tezina' => 'Obavezno polje!',
            'bmi' => 'Obavezno polje!',
        ]);

        DB::table('mere')->insert([
            'id_pacijent' => $request->id,
            'id_pregled' => $request->id_pregled,
            'temperatura' => $request->temperatura,
            's_pritisak' => $request->s_pritisak,
            'd_pritisak' => $request->d_pritisak,
            'saturacija' => $request->saturacija,
            'srcana_frekvenca' => $request->srcana_frekvenca,
            'visina' => $request->visina,
            'tezina' => $request->tezina,
            'bmi' => $request->bmi,
        ]);

        return redirect()->route('anamneza_pacijenta.doctor', [$request->id, $request->id_pregled]);
    }

    //---------------------UNOSI FAJLOVA POCETAK---------------------

    public function radioloskeSlike($id)
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $slike = array();
        $slike = DB::table('radiologija')->where('id_pacijent', '=', $id)->get();

        return view('doctor.radioloskeSlike', compact('data', 'slike', 'id'));
    }
    public function unosRadioloskeSlike($id)
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }
        return view('doctor.unosRadioloskihSlika', compact('data', 'id'));
    }
    public function insertRadioloskeSlike($id, Request $request)
    {
        if ($request->hasFile('picture')) {
            $pac = DB::table('pacijenti')->where('id', '=', $id)->first();
            $file = $request->file('picture');
            $fileName = $file->getClientOriginalName();
            $putanja = 'slike/slikeZa' . $pac->jmbg . '/' . $fileName;
            // You can customize the file storage path and naming convention as per your requirements.
            // Here, we are storing the file in the public directory.
            $file->move('slike/slikeZa' . $pac->jmbg, $fileName);

            // Additional processing if needed, such as storing the file path in a database.
            DB::table('radiologija')->insert([
                'id_pacijent' => $id,
                'putanja' => $putanja,
            ]);
            return redirect()->route('radioloskeSlike.doctor', [$id])->with('success', 'Uspešno učitavanje fajla');
        }

        return redirect()->route('unosRadioloskihSlika.doctor', [$id])->with('fail', 'Neuspešno učitavanje fajla');
    }
    public function nalazi($id)
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $slike = array();
        $slike = DB::table('nalazi')->where('id_pacijent', '=', $id)->get();

        return view('doctor.nalazi', compact('data', 'slike', 'id'));
    }
    public function unosNalaza($id)
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }
        return view('doctor.unosNalaza', compact('data', 'id'));
    }
    public function insertNalazi($id, Request $request)
    {
        if ($request->hasFile('picture')) {
            $pac = DB::table('pacijenti')->where('id', '=', $id)->first();
            $file = $request->file('picture');
            $fileName = $file->getClientOriginalName();
            $putanja = 'nalazi/nalaziZa' . $pac->jmbg . '/' . $fileName;
            // You can customize the file storage path and naming convention as per your requirements.
            // Here, we are storing the file in the public directory.
            $file->move('nalazi/nalaziZa' . $pac->jmbg, $fileName);

            // Additional processing if needed, such as storing the file path in a database.
            DB::table('nalazi')->insert([
                'id_pacijent' => $id,
                'putanja' => $putanja,
            ]);
            return redirect()->route('nalazi.doctor', [$id])->with('success', 'Uspešno učitavanje fajla');
        }

        return redirect()->route('unosNalaza.doctor', [$id])->with('fail', 'Neuspešno učitavanje fajla');
    }

    //---------------------UNOSI FAJLOVA KRAJ---------------------

    public function porukeDoktor()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }
        $poruke = array();
        $id = Session::get("ID");
        $poruke = DB::select(
            "SELECT CONCAT(u.name, ' ', u.surname) AS ime_pacijenta, r.id AS id, r.vreme_pocetak AS vreme
                FROM razgovori AS r 
                LEFT JOIN users AS u ON (r.korisnik1 = u.id)
                WHERE r.korisnik2 = {$id}
                ORDER BY r.vreme_kraj DESC"
        );
        return view('doctor.poruke', compact('data', 'poruke'));
    }
    public function terapije($id)
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $terapije = array();
        $terapije = DB::select(
            "SELECT t.vreme AS vreme, t.id AS id, l.naziv AS naziv, l.oblik_doza as oblik_doza, l.nosilac_dozvole AS nosilac_dozvole, t.kolicina AS kolicina, t.period AS period, t.komentar AS komentar
            FROM terapije AS t 
            LEFT JOIN lekovi AS l ON (l.id = t.sifra_lek)
            WHERE t.id_pacijent = {$id}"
        );

        return view('doctor.terapije', compact('data', 'id', 'terapije'));
    }
    public function doctorAnamnezaPacijenta($id, $id_pregled)
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }
        return view('doctor.anamneza_pacijenta', compact('data', 'id', 'id_pregled'));
    }
    public function doctorUnosAnamneze(Request $request)
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

        return redirect()->route('profil_pacijenta.doctor', [$request->id]);
    }
    public function istorijaPregleda($id)
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }
        $mere = DB::select(
            "SELECT *
            FROM mere AS m 
            LEFT JOIN anamneza AS a ON (m.id_pregled = a.id_pregled)
            WHERE m.id_pacijent = {$id}"
        );

        return view('doctor.istorija_pregleda', compact('data', 'mere', 'id'));
    }
    public function doctorTerapijaPacijenta($id)
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }
        return view('doctor.terapija_pacijenta', compact('data', 'id'));
    }
    public function insertTerapija(Request $request)
    {
        foreach ($request->terapija as $t) {
            DB::table('terapije')->insert([
                'id_pacijent' => $request->id,
                'kolicina' => $t['kolicina'],
                'period' => $t['period'],
                'komentar' => $request->komentar,
                'sifra_lek' => $t['id_leka'],
            ]);
        }
        return redirect()->route('terapije.doctor', [$request->id])->with('success', "Uspešno ste dodali terapiju!");
    }
    // SCREENIX
    public function screenixPocetna()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        return view('doctor.screenix.pocetna', compact('data'));
    }
    public function srcePocetna()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        return view('doctor.screenix.srce.pocetna', compact('data'));
    }
    public function debeloCrevoPocetna()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        return view('doctor.screenix.debeloCrevo.pocetna', compact('data'));
    }
    public function noviTestSrce()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $pacijenti = array();
        $pacijenti = DB::table('pacijenti')->where('id_lekar', '=', Session::get('ID'))->get();

        return view('doctor.screenix.srce.noviTest', compact('data', 'pacijenti'));
    }
    public function izvestajiSrce()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $srceTest = DB::select(
            "SELECT ss.datum AS datum, ss.status AS status, CONCAT(p.ime, ' ',p.prezime) AS ime, p.jmbg AS jmbg, ss.id AS id_test, p.id AS id
            FROM srceenIXSrce as ss 
            LEFT JOIN pacijenti AS p ON (p.id = ss.id_pacijent)
            WHERE ss.status > 0
            ORDER BY ss.datum DESC"
        );

        return view('doctor.screenix.srce.izvestaji', compact('data', 'srceTest'));
    }
    public function korak1Srce($id)
    {
        $srce = new screenIXSrce();

        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $pacijent = array();
        $pacijent = DB::table('pacijenti')->where('id', '=', $id)->first();

        if (Session::get('ScreenIX') == 0) {
            $id_test = DB::table('srceenIXSrce')->insertGetId([
                "id_pacijent" => $id,
                "id_lekar" => Session::get("ID"),
                "status" => 0,
            ]);
            session()->put('ScreenIX', 1);
            session()->put('ScreenIXID', $id_test);
        }

        $parametri = DB::table('mere')->where('id_pacijent', '=', $id)->first();

        $dob = $pacijent->datum_rodjenja;
        $year = (date('Y') - date('Y', strtotime($dob)));
        $rizik = null;
        if (!empty($parametri)) {
            $rizik = $srce->riskKorak1($year, $pacijent->pol, $parametri->tezina, $parametri->visina);
        }

        $postoji = DB::table("srceRizici")->where('id_test', '=', Session::get('ScreenIXID'))->first();

        if (empty($postoji))
            DB::table('srceRizici')->insert(['id_test' => Session::get('ScreenIXID'), 'korak1' => $rizik]);

        return view('doctor.screenix.srce.korak1', compact('data', 'pacijent', 'id', 'parametri', 'year', 'rizik'));
    }
    public function korak1SrceForma(Request $request)
    {
        $request->validate(
            [
                'godine' => "required",
                'visina' => "required",
                'tezina' => "required",
                'pol' => "required"
            ],
            [
                'godine' => "Obavezno polje!",
                'visina' => "Obavezno polje!",
                'tezina' => "Obavezno polje!",
                'pol' => "Obavezno polje!"
            ]
        );

        DB::table('mere')->insert([
            'id_pacijent' => $request->id,
            'visina' => $request->visina,
            'tezina' => $request->tezina,
        ]);
        return redirect()->route('korak1Srce.doctor', [$request->id]);
    }
    public function korak2Srce($id)
    {
        $srce = new screenIXSrce();
        $pacijent = array();
        $pacijent = DB::table('pacijenti')->where('id', '=', $id)->first();
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $dob = $pacijent->datum_rodjenja;
        $year = (date('Y') - date('Y', strtotime($dob)));

        $parametri = DB::table('mere')->where('id_pacijent', '=', $id)->first();

        $posete = DB::table('srceUpitnik')->where('id_test', '=', Session::get("ScreenIXID"))->first();

        $risk = DB::table('srceRizici')->where('id_test', '=', Session::get("ScreenIXID"))->first();

        $rizik = $risk->korak2;

        if (!empty($posete)) {
            $rizik = $srce->riskPressure($year, $parametri->s_pritisak, $parametri->d_pritisak, $posete->poslednja_poseta, $posete->godisnja_poseta);
            DB::table('srceRizici')->where('id_test', '=', Session::get("ScreenIXID"))->update(['korak2' => $rizik]);
        }

        return view('doctor.screenix.srce.korak2', compact('data', 'pacijent', 'id', 'parametri', 'posete', 'rizik'));
    }
    public function korak2SrceForma(Request $request)
    {
        $request->validate(
            [
                'poslednja_poseta' => "required",
                'godisnja_poseta' => "required",
            ],
            [
                'poslednja_poseta' => "Obavezno polje!",
                'godisnja_poseta' => "Obavezno polje!",
            ]
        );

        DB::table('srceUpitnik')->insert([
            'id_test' => $request->id_test,
            'poslednja_poseta' => $request->last,
            'godisnja_poseta' => $request->frequency,
        ]);
        return redirect()->route('korak2Srce.doctor', [$request->id]);
    }
    public function korak3Srce($id)
    {
        $srce = new screenIXSrce();
        $pacijent = array();
        $pacijent = DB::table('pacijenti')->where('id', '=', $id)->first();
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $dob = $pacijent->datum_rodjenja;
        $year = (date('Y') - date('Y', strtotime($dob)));

        $pacijent = array();
        $pacijent = DB::table('pacijenti')->where('id', '=', $id)->first();

        $navike = array();
        $navike = DB::table('srceNavike')->where('id_test', '=', Session::get("ScreenIXID"))->first();

        $posao = array();
        $posao = DB::table('srcePosao')->where('id_test', '=', Session::get("ScreenIXID"))->first();

        $hrana = array();
        $hrana = DB::table('srceHrana')->where('id_test', '=', Session::get("ScreenIXID"))->first();

        $porodica = array();
        $porodica = DB::table('porodicaScreenIX')->where('id_pacijent', '=', $id)->first();

        if (!empty($navike)) {
            $rizik = $srce->qResult1($navike->cigarete, $navike->sedenje_lezanje, $navike->spavanje, $navike->fizicka_aktivnost, $navike->odmor);
            DB::table('srceRizici')->where('id_test', '=', Session::get("ScreenIXID"))->update([
                'korak3_1' => $rizik
            ]);
        }

        if (!empty($posao)) {
            $rizik1 = $srce->qRisk(
                $posao->tip_posla,
                $posao->stres_posao,
                $posao->iskustvo,
                $posao->radni_dani,
                $posao->radni_sati,
                $posao->vikend,
                $posao->umor,
                $posao->iscrpljenost,
                $posao->koncentracija,
                $posao->problemi,
                $posao->odvojeni
            );
            DB::table('srceRizici')->where('id_test', '=', Session::get("ScreenIXID"))->update([
                'korak3_2' => $rizik1
            ]);
        }

        if (!empty($hrana)) {
            $rizik2 = $srce->riskFood(
                $hrana->tecnost,
                $hrana->alkohol,
                $hrana->alkoholizam,
                $hrana->gazirana,
                $hrana->kolicina_gaziranih,
                $hrana->crveno_meso,
                $hrana->belo_meso,
                $hrana->riblje_meso,
                $hrana->vegan,
                $hrana->povrce,
                $hrana->citrusno_voce,
                $hrana->druga_voca,
                $hrana->slatkisi,
                $hrana->vitamini,
                $hrana->minerali,
                $hrana->dijetalne,
            );
            DB::table('srceRizici')->where('id_test', '=', Session::get("ScreenIXID"))->update([
                'korak3_4' => $rizik2
            ]);
        }

        $rizikNavike = DB::table('srceRizici')->where('id_test', '=', Session::get("ScreenIXID"))->first(['korak3_1']);
        $rizikPosao = DB::table('srceRizici')->where('id_test', '=', Session::get("ScreenIXID"))->first(['korak3_2']);
        $rizikPorodica = DB::table('srceRizici')->where('id_test', '=', Session::get("ScreenIXID"))->first(['korak3_3']);
        $rizikHrana = DB::table('srceRizici')->where('id_test', '=', Session::get("ScreenIXID"))->first(['korak3_4']);

        return view('doctor.screenix.srce.korak3', compact('data', 'pacijent', 'id', 'navike', 'posao', 'hrana', 'rizikNavike', 'rizikPosao', 'rizikPorodica', 'rizikHrana', 'porodica'));
    }
    public function navikeSrce(Request $request)
    {
        $request->validate(
            [
                'cigarete' => 'required',
                'sedenje_lezanje' => 'required',
                'spavanje' => 'required',
                'fizicka_aktivnost' => 'required',
                'odmor' => 'required',
            ],
            [
                'cigarete' => "Obavezno polje!",
                'sedenje_lezanje' => "Obavezno polje!",
                'spavanje' => "Obavezno polje!",
                'fizicka_aktivnost' => "Obavezno polje!",
                'odmor' => "Obavezno polje!",
            ]
        );
        DB::table('srceNavike')->insert([
            'id_test' => $request->id_test,
            'cigarete' => $request->cigarete,
            'sedenje_lezanje' => $request->lezanje,
            'spavanje' => $request->spavanje,
            'fizicka_aktivnost' => $request->aktivnost,
            'odmor' => $request->odmor,
        ]);
        return redirect()->route('korak3Srce.doctor', $request->id);
    }
    public function posaoSrce(Request $request)
    {
        $request->validate(
            [
                'tip_posla' => 'required',
                'stres_posao' => 'required',
                'iskustvo' => 'required',
                'radni_dani' => 'required',
                'radni_sati' => 'required',
                'vikend' => 'required',
                'umor' => 'required',
                'iscrpljenost' => 'required',
                'koncentracija' => 'required',
                'problemi' => 'required',
                'odvojeni' => 'required',
            ],
            [
                'tip_posla' => "Obavezno polje!",
                'stres_posao' => "Obavezno polje!",
                'iskustvo' => "Obavezno polje!",
                'radni_dani' => "Obavezno polje!",
                'radni_sati' => "Obavezno polje!",
                'vikend' => "Obavezno polje!",
                'umor' => "Obavezno polje!",
                'iscrpljenost' => "Obavezno polje!",
                'koncentracija' => "Obavezno polje!",
                'problemi' => "Obavezno polje!",
                'odvojeni' => "Obavezno polje!",
            ]
        );
        DB::table('srcePosao')->insert([
            'id_test' => $request->id_test,
            'tip_posla' => $request->posao,
            'stres_posao' => $request->stres,
            'iskustvo' => $request->iskustvo,
            'radni_dani' => $request->dani,
            'radni_sati' => $request->sati,
            'vikend' => $request->vikend,
            'umor' => $request->energija,
            'iscrpljenost' => $request->iscrpljenost,
            'koncentracija' => $request->razmisljanje,
            'problemi' => $request->problemi,
            'odvojeni' => $request->zahtevi,
        ]);
        return redirect()->route('korak3Srce.doctor', $request->id);
    }
    public function porodicaSrce(Request $request)
    {
        $srce = new screenIXSrce();

        $pacijent = DB::table('pacijenti')->where('id', '=', $request->id)->first();

        $rizik = $srce->totalHeritage(
            $pacijent->pol,
            $request->majka_srce,
            $request->otac_srce,
            $request->baba_srce,
            $request->deda_srce,
            $request->ujak_srce,
            $request->tetka_srce,
            $request->brat_srce,
            $request->sestra_srce,
            $request->majka_napad,
            $request->otac_napad,
            $request->baba_napad,
            $request->deda_napad,
            $request->ujak_napad,
            $request->tetka_napad,
            $request->brat_napad,
            $request->sestra_napad,
            $request->majka_infarkt,
            $request->otac_infarkt,
            $request->baba_infarkt,
            $request->deda_infarkt,
            $request->ujak_infarkt,
            $request->tetka_infarkt,
            $request->brat_infarkt,
            $request->sestra_infarkt,
            $request->majka_dijabetes,
            $request->otac_dijabetes,
            $request->baba_dijabetes,
            $request->deda_dijabetes,
            $request->ujak_dijabetes,
            $request->tetka_dijabetes,

            $request->brat_dijabetes,
            $request->sestra_dijabetes,
            $request->majka_jetra,
            $request->otac_jetra,
            $request->baba_jetra,
            $request->deda_jetra,
            $request->ujak_jetra,
            $request->tetka_jetra,
            $request->brat_jetra,
            $request->sestra_jetra,
            $request->majka_reuma,

            $request->otac_reuma,
            $request->baba_reuma,

            $request->deda_reuma,
            $request->ujak_reuma,
            $request->tetka_reuma,
            $request->brat_reuma,

            $request->sestra_reuma,

            $request->majka_pritisak,

            $request->otac_pritsak,
            $request->baba_pritisak,
            $request->deda_pritisak,
            $request->ujak_pritisak,
            $request->tetka_pritisak,

            $request->brat_pritisak,
            $request->sestra_pritisak,
            $request->majka_krv,
            $request->otac_krv,
            $request->baba_krv,
            $request->deda_krv,

            $request->ujak_krv,
            $request->tetka_krv,
            $request->brat_krv,
            $request->sestra_krv,

            $request->majka_bubreg,

            $request->otac_bubreg,

            $request->baba_bubreg,
            $request->deda_bubreg,
            $request->ujak_bubreg,
            $request->tetka_bubreg,
            $request->brat_bubreg,
            $request->sestra_bubreg,
            $request->majka_pluca,
            $request->otac_pluca,
            $request->baba_pluca,
            $request->deda_pluca,
            $request->ujak_pluca,
            $request->tetka_pluca,

            $request->brat_pluca,
            $request->sestra_pluca,
            $request->majka_stitna,
            $request->otac_stitna,
            $request->baba_stitna,

            $request->deda_stitna,
            $request->ujak_stitna,
            $request->tetka_stitna,
            $request->brat_stitna,
            $request->sestra_stitna,
        );

        DB::table('porodicaScreenIX')->insert([
            'id_pacijent' => $request->id,
            'majka_srce' => $request->majka_srce,
            'otac_srce' => $request->otac_srce,
            'baba_srce' => $request->baba_srce,
            'deda_srce' => $request->deda_srce,
            'ujak_srce' => $request->ujak_srce,
            'tetka_srce' => $request->tetka_srce,
            'brat_srce' => $request->brat_srce,
            'sestra_srce' => $request->sestra_srce,
            'majka_napad' => $request->majka_napad,
            'otac_napad' => $request->otac_napad,
            'baba_napad' => $request->baba_napad,
            'deda_napad' => $request->deda_napad,
            'ujak_napad' => $request->ujak_napad,
            'tetka_napad' => $request->tetka_napad,
            'brat_napad' => $request->brat_napad,
            'sestra_napad' => $request->sestra_napad,
            'majka_infarkt' => $request->majka_infarkt,
            'otac_infarkt' => $request->otac_infarkt,
            'baba_infarkt' => $request->baba_infarkt,
            'deda_infarkt' => $request->deda_infarkt,
            'ujak_infarkt' => $request->ujak_infarkt,
            'tetka_infarkt' => $request->tetka_infarkt,
            'brat_infarkt' => $request->brat_infarkt,
            'sestra_infarkt' => $request->sestra_infarkt,
            'majka_dijabetes' => $request->majka_dijabetes,
            'otac_dijabetes' => $request->otac_dijabetes,
            'baba_dijabetes' => $request->baba_dijabetes,
            'deda_dijabetes' => $request->deda_dijabetes,
            'ujak_dijabetes' => $request->ujak_dijabetes,
            'tetka_dijabetes' => $request->tetka_dijabetes,
            'brat_dijabetes' => $request->brat_dijabetes,
            'sestra_dijabetes' => $request->sestra_dijabetes,
            'majka_jetra' => $request->majka_jetra,
            'otac_jetra' => $request->otac_jetra,
            'baba_jetra' => $request->baba_jetra,
            'deda_jetra' => $request->deda_jetra,
            'ujak_jetra' => $request->ujak_jetra,
            'tetka_jetra' => $request->tetka_jetra,
            'brat_jetra' => $request->brat_jetra,
            'sestra_jetra' => $request->sestra_jetra,
            'majka_reuma' => $request->majka_reuma,
            'otac_reuma' => $request->otac_reuma,
            'baba_reuma' => $request->baba_reuma,
            'deda_reuma' => $request->deda_reuma,
            'ujak_reuma' => $request->ujak_reuma,
            'tetka_reuma' => $request->tetka_reuma,
            'brat_reuma' => $request->brat_reuma,
            'sestra_reuma' => $request->sestra_reuma,
            'majka_pritisak' => $request->majka_pritisak,
            'otac_pritsak' => $request->otac_pritsak,
            'baba_pritisak' => $request->baba_pritisak,
            'deda_pritisak' => $request->deda_pritisak,
            'ujak_pritisak' => $request->ujak_pritisak,
            'tetka_pritisak' => $request->tetka_pritisak,
            'brat_pritisak' => $request->brat_pritisak,
            'sestra_pritisak' => $request->sestra_pritisak,
            'majka_krv' => $request->majka_krv,
            'otac_krv' => $request->otac_krv,
            'baba_krv' => $request->baba_krv,
            'deda_krv' => $request->deda_krv,
            'ujak_krv' => $request->ujak_krv,
            'tetka_krv' => $request->tetka_krv,
            'brat_krv' => $request->brat_krv,
            'sestra_krv' => $request->sestra_krv,
            'majka_bubreg' => $request->majka_bubreg,
            'otac_bubreg' => $request->otac_bubreg,
            'baba_bubreg' => $request->baba_bubreg,
            'deda_bubreg' => $request->deda_bubreg,
            'ujak_bubreg' => $request->ujak_bubreg,
            'tetka_bubreg' => $request->tetka_bubreg,
            'brat_bubreg' => $request->brat_bubreg,
            'sestra_bubreg' => $request->sestra_bubreg,
            'majka_pluca' => $request->majka_pluca,
            'otac_pluca' => $request->otac_pluca,
            'baba_pluca' => $request->baba_pluca,
            'deda_pluca' => $request->deda_pluca,
            'ujak_pluca' => $request->ujak_pluca,
            'tetka_pluca' => $request->tetka_pluca,
            'brat_pluca' => $request->brat_pluca,
            'sestra_pluca' => $request->sestra_pluca,
            'majka_stitna' => $request->majka_stitna,
            'otac_stitna' => $request->otac_stitna,
            'baba_stitna' => $request->baba_stitna,
            'deda_stitna' => $request->deda_stitna,
            'ujak_stitna' => $request->ujak_stitna,
            'tetka_stitna' => $request->tetka_stitna,
            'brat_stitna' => $request->brat_stitna,
            'sestra_stitna' => $request->sestra_stitna,
        ]);

        DB::table('srceRizici')->where('id_test', '=', $request->id_test)->update(['korak3_3' => $rizik]);

        return redirect()->route('korak3Srce.doctor', [$request->id]);
    }
    public function hranaSrce(Request $request)
    {
        DB::table('srceHrana')->insert([
            'id_test' => $request->id_test,
            'tecnost' => $request->pice,
            'alkohol' => $request->alkohol_ned,
            'alkoholizam' => $request->alkoholizam,
            'gazirana' => $request->gazirana_ned,
            'kolicina_gaziranih' => $request->gazirana,
            'crveno_meso' => $request->crveno_meso,
            'belo_meso' => $request->belo_meso,
            'riblje_meso' => $request->riba,
            'vegan' => $request->vegan,
            'povrce' => $request->povrce,
            'citrusno_voce' => $request->citrusi,
            'druga_voca' => $request->voca,
            'slatkisi' => $request->secer,
            'vitamini' => $request->vitamini,
            'minerali' => $request->minerali,
            'dijetalne' => $request->dijetalni
        ]);

        return redirect()->route('korak3Srce.doctor', $request->id);
    }
    public function izvestajSrce($id)
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $pacijent = array();
        $pacijent = DB::table('pacijenti')->where('id', '=', $id)->first();

        $dob = $pacijent->datum_rodjenja;
        $year = (date('Y') - date('Y', strtotime($dob)));

        $parametri = DB::table('mere')->where('id_pacijent', '=', $id)->first();

        $rizici = DB::table('srceRizici')->where("id_test", '=', Session::get("ScreenIXID"))->first();

        $rizik = (int) (((3.5 * $rizici->korak1 +
            2.5 * $rizici->korak2 +
            2 * $rizici->korak3_1 +
            2 * $rizici->korak3_2 +
            2.5 * $rizici->korak3_3 +
            3 * $rizici->korak3_4) / 15.5));

        DB::table('srceenIXSrce')->where('id', '=', Session::get("ScreenIXID"))->update([
            'status' => 1
        ]);

        $test = DB::table('srceenIXSrce')->where('id', '=', Session::get("ScreenIXID"))->first();

        $rizikNavike = DB::table('srceRizici')->where('id_test', '=', Session::get("ScreenIXID"))->first(['korak3_1']);
        $rizikPosao = DB::table('srceRizici')->where('id_test', '=', Session::get("ScreenIXID"))->first(['korak3_2']);
        $rizikPorodica = DB::table('srceRizici')->where('id_test', '=', Session::get("ScreenIXID"))->first(['korak3_3']);
        $rizikHrana = DB::table('srceRizici')->where('id_test', '=', Session::get("ScreenIXID"))->first(['korak3_4']);

        $risks = json_encode(array("Rizik", "Rizik posle izmena"));
        $hrana = json_encode(array('Alkoholna pića', 'Slatkiši', 'Citrusna voća', 'Gazirana pića', 'Crveno meso', 'Belo meso', 'Riba'));

        $h = DB::table('srceHrana')->where('id_test', '=', Session::get("ScreenIXID"))->first();

        $hNiz = json_encode(array($h->gazirana, $h->alkohol, $h->crveno_meso, $h->belo_meso, $h->riblje_meso, $h->citrusno_voce, $h->slatkisi));

        $id_test = Session::get("ScreenIXID");

        return view('doctor.screenix.srce.izvestajSrednji', compact('data', 'pacijent', 'id', 'parametri', 'rizik', 'test', 'rizikNavike', 'rizikPosao', 'rizikPorodica', 'rizikHrana', 'risks', 'hrana', 'hNiz', 'id_test'));
    }
    public function izvestajSrceIzvestaji($id_test, $id)
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $pacijent = array();
        $pacijent = DB::table('pacijenti')->where('id', '=', $id)->first();

        $dob = $pacijent->datum_rodjenja;
        $year = (date('Y') - date('Y', strtotime($dob)));

        $parametri = DB::table('mere')->where('id_pacijent', '=', $id)->first();

        $rizici = DB::table('srceRizici')->where("id_test", '=', $id_test)->first();

        $rizik = (int) (((3.5 * $rizici->korak1 +
            2.5 * $rizici->korak2 +
            2 * $rizici->korak3_1 +
            2 * $rizici->korak3_2 +
            2.5 * $rizici->korak3_3 +
            3 * $rizici->korak3_4) / 15.5));
        $s = DB::table('srceenIXSrce')->where('id', '=', $id_test)->first();
        if ($s->status < 1) {
            DB::table('srceenIXSrce')->where('id', '=', $id_test)->update([
                'status' => 1
            ]);
        }

        $test = DB::table('srceenIXSrce')->where('id', '=', $id_test)->first();

        $rizikNavike = DB::table('srceRizici')->where('id_test', '=', $id_test)->first(['korak3_1']);
        $rizikPosao = DB::table('srceRizici')->where('id_test', '=', $id_test)->first(['korak3_2']);
        $rizikPorodica = DB::table('srceRizici')->where('id_test', '=', $id_test)->first(['korak3_3']);
        $rizikHrana = DB::table('srceRizici')->where('id_test', '=', $id_test)->first(['korak3_4']);

        $risks = json_encode(array("Rizik", "Rizik posle izmena"));
        $hrana = json_encode(array('Alkoholna pića', 'Slatkiši', 'Citrusna voća', 'Gazirana pića', 'Crveno meso', 'Belo meso', 'Riba'));

        $h = DB::table('srceHrana')->where('id_test', '=', $id_test)->first();

        $hNiz = json_encode(array($h->gazirana, $h->alkohol, $h->crveno_meso, $h->belo_meso, $h->riblje_meso, $h->citrusno_voce, $h->slatkisi));

        return view('doctor.screenix.srce.izvestajSrednji', compact('data', 'pacijent', 'id', 'parametri', 'rizik', 'test', 'rizikNavike', 'rizikPosao', 'rizikPorodica', 'rizikHrana', 'risks', 'hrana', 'hNiz', 'id_test'));
    }
    public function zavrsiTestSrce()
    {
        DB::table('srceenIXSrce')->where('id', '=', Session::get("ScreenIXID"))->update(['status' => 3]);
        Session::pull("ScreenIXID");
        return redirect()->route('home.doctor')->with('success', 'Uspešno ste završili ScreenIX test!');
    }
    public function korak4Srce($id_test, $id)
    {
        $srce = new screenIXSrce();
        $pacijent = array();
        $pacijent = DB::table('pacijenti')->where('id', '=', $id)->first();
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $dob = $pacijent->datum_rodjenja;
        $year = (date('Y') - date('Y', strtotime($dob)));

        $filter1 = DB::table('filter1')->where('id_test', '=', $id_test)->first();
        $filter2 = DB::table('filter2')->where('id_test', '=', $id_test)->first();
        $filter3 = DB::table('filter3')->where('id_test', '=', $id_test)->first();
        $filter4 = DB::table('filter4')->where('id_test', '=', $id_test)->first();
        $filter5 = DB::table('filter5')->where('id_test', '=', $id_test)->first();
        $filter6 = DB::table('filter6')->where('id_test', '=', $id_test)->first();
        $filter7 = DB::table('filter7')->where('id_test', '=', $id_test)->first();
        $filter8 = DB::table('filter8')->where('id_test', '=', $id_test)->first();

        $rizikF1 = 0;
        $rizikF2 = 0;
        $rizikF3 = 0;
        $rizikF4 = 0;
        $rizikF5 = 0;
        $rizikF6 = 0;
        $rizikF7 = 0;
        $rizikF8 = 0;

        if (!empty($filter1)) {
            $rizikF1 = $srce->rizikF1(
                $filter1->leukociti,
                $filter1->hemoglobin,
                1,
                $filter1->neutrofili,
                $filter1->limfociti,
                $filter1->peptidi,
                $pacijent->pol,
                $year
            );

            DB::table('srceRizici')->where('id_test', '=', $id_test)->update([
                'korak4_1' => $rizikF1,
            ]);
        }

        if (!empty($filter2)) {
            $rizikF2 = $srce->rizikF2($filter2->k, $filter2->na, $filter2->ca, $filter2->mg, $year);

            DB::table('srceRizici')->where('id_test', '=', $id_test)->update([
                'korak4_2' => $rizikF2,
            ]);
        }

        if (!empty($filter3)) {
            $rizikF3 = $srce->rizikF3($filter3->tryg, $filter3->hdl, $filter3->ldl, $pacijent->pol);

            DB::table('srceRizici')->where('id_test', '=', $id_test)->update([
                'korak4_3' => $rizikF3,
            ]);
        }

        if (!empty($filter4)) {
            $rizikF4 = $srce->rizikF4($filter4->kreatinin, $filter4->urea, $filter4->bun, $pacijent->pol, $year);
            DB::table('srceRizici')->where('id_test', '=', $id_test)->update([
                'korak4_4' => $rizikF4,
            ]);
        }

        if (!empty($filter5)) {
            $rizikF5 = $srce->rizikF5($filter5->ck, $filter5->ckmb, $filter5->mioglobin, $filter5->troponini, $filter5->troponint, $filter5->cprotein, $pacijent->pol, $year, $filter3->hdl);
            DB::table('srceRizici')->where('id_test', '=', $id_test)->update([
                'korak4_5' => $rizikF5,
            ]);
        }

        if (!empty($filter6)) {
            $rizikF6 = $srce->Glu($filter6->glukoza);
            DB::table('srceRizici')->where('id_test', '=', $id_test)->update([
                'korak4_6' => $rizikF6,
            ]);
        }

        if (!empty($filter7)) {
            $rizikF7 = $srce->rizikF7($filter7->aspartat, $filter7->alanin, $filter7->ggt, $filter7->alp, $filter7->ldh, $filter7->blr, $filter7->alb, $pacijent->pol);
            DB::table('srceRizici')->where('id_test', '=', $id_test)->update([
                'korak4_7' => $rizikF7,
            ]);
        }

        if (!empty($filter8)) {
            $rizikF8 = $srce->rizikF8($filter8->tsh, $filter8->freet3, $filter8->freet4, $pacijent->pol, $year);
            DB::table('srceRizici')->where('id_test', '=', $id_test)->update([
                'korak4_8' => $rizikF8,
            ]);
        }

        return view('doctor.screenix.srce.korak4', compact(
            'data',
            'pacijent',
            'id',
            'id_test',
            'filter1',
            'filter2',
            'filter3',
            'filter4',
            'filter5',
            'filter6',
            'filter7',
            'filter8',
            'rizikF1',
            'rizikF2',
            'rizikF3',
            'rizikF4',
            'rizikF5',
            'rizikF6',
            'rizikF7',
            'rizikF8',
        ));
    }
    public function filter1(Request $request)
    {
        DB::table('filter1')->insert([
            'id_test' => $request->id_test,
            'hemoglobin' => $request->hemoglobin,
            'leukociti' => $request->leukociti,
            'neutrofili' => $request->neutrofili,
            'limfociti' => $request->limfociti,
            'peptidi' => $request->peptidi
        ]);

        return redirect()->route('korak4Srce.doctor', [$request->id_test, $request->id]);
    }
    public function filter2(Request $request)
    {
        DB::table('filter2')->insert([
            'id_test' => $request->id_test,
            'k' => $request->k,
            'na' => $request->na,
            'ca' => $request->ca,
            'mg' => $request->mg
        ]);

        return redirect()->route('korak4Srce.doctor', [$request->id_test, $request->id]);
    }
    public function filter3(Request $request)
    {
        DB::table('filter3')->insert([
            'id_test' => $request->id_test,
            'tryg' => $request->tryg,
            'hdl' => $request->hdl,
            'ldl' => $request->ldl
        ]);

        return redirect()->route('korak4Srce.doctor', [$request->id_test, $request->id]);
    }
    public function filter4(Request $request)
    {
        DB::table('filter4')->insert([
            'id_test' => $request->id_test,
            'kreatinin' => $request->kreatinin,
            'urea' => $request->urea,
            'bun' => $request->bun
        ]);

        return redirect()->route('korak4Srce.doctor', [$request->id_test, $request->id]);
    }
    public function filter5(Request $request)
    {
        DB::table('filter5')->insert([
            'id_test' => $request->id_test,
            'ck' => $request->ck,
            'ckmb' => $request->ckmb,
            'mioglobin' => $request->mioglobin,
            'troponini' => $request->troponini,
            'troponint' => $request->troponint,
            'cprotein' => $request->cprotein
        ]);

        return redirect()->route('korak4Srce.doctor', [$request->id_test, $request->id]);
    }
    public function filter6(Request $request)
    {
        DB::table('filter6')->insert([
            'id_test' => $request->id_test,
            'glukoza' => $request->glukoza
        ]);

        return redirect()->route('korak4Srce.doctor', [$request->id_test, $request->id]);
    }
    public function filter7(Request $request)
    {
        DB::table('filter7')->insert([
            'id_test' => $request->id_test,
            'aspartat' => $request->aspartat,
            'alanin' => $request->alanin,
            'ggt' => $request->ggt,
            'alp' => $request->alp,
            'ldh' => $request->ldh,
            'blr' => $request->blr,
            'alb' => $request->alb
        ]);

        return redirect()->route('korak4Srce.doctor', [$request->id_test, $request->id]);
    }
    public function filter8(Request $request)
    {
        DB::table('filter8')->insert([
            'id_test' => $request->id_test,
            'tsh' => $request->tsh,
            'freet3' => $request->freet3,
            'freet4' => $request->freet4
        ]);

        return redirect()->route('korak4Srce.doctor', [$request->id_test, $request->id]);
    }
    public function korak5Srce($id_test, $id)
    {
        $srce = new screenIXSrce();
        $pacijent = array();
        $pacijent = DB::table('pacijenti')->where('id', '=', $id)->first();
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $dob = $pacijent->datum_rodjenja;
        $year = (date('Y') - date('Y', strtotime($dob)));

        $posete = DB::table('srceUpitnik')->where('id_test', '=', $id_test)->first();

        $ekg = DB::table('srceEkg')->where('id_test', '=', $id_test)->first();
        $rizikEkg = 0;
        if (!empty($ekg)) {
            $rizikEkg = $srce->rizikEKG(
                $ekg->rythm,
                $ekg->rhytm_value,
                $ekg->heart_rate,
                $ekg->heart_rate_value,
                $ekg->p_wave,
                $ekg->p_value,
                $ekg->pr_segment,
                $ekg->pr_value,
                $ekg->qrs_complex,
                $ekg->qrs_value,
                $ekg->t_wave,
                $ekg->t_value,
                $ekg->st_segment,
                $ekg->st_value,
                $ekg->u_wave,
                $ekg->u_value,
                $ekg->d_wave,
                $posete->poslednja_poseta,
                $posete->godisnja_poseta,
                $pacijent->pol,
                $year,
            );
            DB::table('srceRizici')->where('id_test', '=', $id_test)->update([
                'korak5' => $rizikEkg
            ]);
        }

        return view('doctor.screenix.srce.korak5', compact(
            'data',
            'pacijent',
            'id',
            'id_test',
            'rizikEkg',
            'ekg'
        ));
    }
    public function korak5SrceForma(Request $request)
    {
        DB::table('srceEkg')->insert([
            'id_test' => $request->id_test,
            'rythm' => $request->rhytm,
            'rhytm_value' => $request->rhytm_value,
            'heart_rate' => $request->heart_rate,
            'heart_rate_value' => $request->heart_rate_value,
            'p_wave' => $request->p_wave,
            'p_value' => $request->p_value,
            'pr_segment' => $request->pr_segment,
            'pr_value' => $request->pr_value,
            'qrs_complex' => $request->qrs_complex,
            'qrs_value' => $request->qrs_complex_value,
            't_wave' => $request->t_wave,
            't_value' => $request->t_value,
            'st_segment' => $request->st_segment,
            'st_value' => $request->st_value,
            'u_wave' => $request->u_wave,
            'u_value' => $request->u_value,
            'd_wave' => $request->d_wave
        ]);

        return redirect()->route('korak5Srce.doctor', [$request->id_test, $request->id]);
    }
    function finalniIzvestajSrce($id_test, $id)
    {
        $pacijent = array();
        $pacijent = DB::table('pacijenti')->where('id', '=', $id)->first();
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }
        DB::table('srceenIXSrce')->where('id', '=', $id_test)->update([
            'status' => 5,
        ]);
        $test = DB::table('srceenIXSrce')->where('id', '=', $id_test)->first();

        $parametri = DB::table('mere')->where('id_pacijent', '=', $id)->first();

        $rizici = DB::table('srceenIXSrce')->leftJoin('srceRizici', 'srceenIXSrce.id', '=', 'srceRizici.id_test')
            ->where('srceenIXSrce.id_pacijent', '=', $id, 'and')->where('srceenIXSrce.status', '>', 0)->first();

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
        $rizikNavike = DB::table('srceRizici')->where('id_test', '=', $id_test)->first(['korak3_1']);
        $rizikPosao = DB::table('srceRizici')->where('id_test', '=', $id_test)->first(['korak3_2']);
        $rizikPorodica = DB::table('srceRizici')->where('id_test', '=', $id_test)->first(['korak3_3']);
        $rizikHrana = DB::table('srceRizici')->where('id_test', '=', $id_test)->first(['korak3_4']);
        return view('doctor.screenix.srce.izvestajKraj', compact('data', 'pacijent', 'test', 'parametri', 'rizik', 'rizikNavike', 'rizikPosao', 'rizikPorodica', 'rizikHrana'));
    }
    // DEBELO CREVO FUNKCIJE
    public function debeloCrevoNoviTest()
    {
        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }
        $pacijenti = array();
        $pacijenti = DB::table('pacijenti')->where('id_lekar', '=', Session::get('ID'))->get();
        return view('doctor.screenix.debeloCrevo.noviTest', compact('data', 'pacijenti'));
    }
    public function korak1DebeloCrevo($id)
    {
        $debeloCrevo = new screenIXDebeloCrevo();

        $data = array();
        if (Session::has('ID')) {
            $data = DB::table('users')->join('roles', 'roles.id', '=', 'users.role_id')->where('users.id', '=', Session::get('ID'))->first();
        }

        $pacijent = array();
        $pacijent = DB::table('pacijenti')->where('id', '=', $id)->first();

        $rizik1DC = null;
        $id_test = null;
        if (Session::get('ScreenIX') == 0) {
            $id_test = DB::table('screenIXDebeloCrevo')->insertGetId([
                "id_pacijent" => $id,
                "id_lekar" => Session::get("ID"),
                "status" => 0,
            ]);

            DB::table('debeloCrevoRizici')->insert([
                'id_test' => $id_test,
                'korak1' => null,
                'korak2' => null,
            ]);

            session()->put('ScreenIX', 1);
            session()->put('ScreenIXID', $id_test);
        }

        $id_test = Session::get("ScreenIXID");
        $rizik1DC = DB::table('debeloCrevoRizici')->where('id_test', '=', $id_test)->first(['korak1']);
        $parametri = DB::select(
            "SELECT *
            FROM mere 
            WHERE id_pacijent = {$id}
            ORDER BY vreme DESC LIMIT 2"
        );

        $korak1 = DB::table('debeloCrevoKorak1')->where('id_test', '=', $id_test)->first();
        $dob = $pacijent->datum_rodjenja;
        $year = (date('Y') - date('Y', strtotime($dob)));
        return view('doctor.screenix.debeloCrevo.korak1', compact('data', 'pacijent', 'id', 'parametri', 'year', 'rizik1DC', 'korak1', 'id_test'));
    }
    public function korak1DebeloCrevoForma(Request $request)
    {
        $debeloCrevo = new screenIXDebeloCrevo();

        DB::table('debeloCrevoKorak1')->insert([
            'id_test' => $request->id_test,
            'tezina' => $request->tezina,
            'tezina_pre_merenja' => $request->tezina_pre_merenja,
            'tezina_pre_oba_merenja' => $request->tezina_pre_oba_merenja,
            'dijeta' => $request->dijeta,
        ]);

        $rizik = $debeloCrevo->rizikKorak1($request->bmi, $request->pol, $request->godine, $request->dijeta, $request->tezina, $request->tezina_pre_merenja, $request->tezina_pre_oba_merenja);

        DB::table('debeloCrevoRizici')->where('id_test', '=', $request->id_test)->update(['korak1' => $rizik]);
        return redirect()->route('korak1DebeloCrevo.doctor', [$request->id])->with('success', 'Uspešno ste uneli podatke!');
    }
}
