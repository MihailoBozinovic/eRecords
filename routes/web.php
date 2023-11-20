<?php

use App\Events\Poruka;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [LoginController::class, 'redirect_login'])->name('login')->middleware('isLoggedIn');
Route::post('/login', [LoginController::class, 'login'])->name('form.login');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::post('/posalji-poruku', function (Request $request) {
    $vreme = date('H:i:s');

    DB::table('poruke')->insert([
        'id_chat' => $request->id_chat,
        'id_slao' => $request->id_posiljalac,
        'id_primio' => $request->id_primalac,
        'seen' => 0,
        'poruka' => $request->poruka,
    ]);

    event(new Poruka($request->ime, $request->poruka, $vreme, $request->id_posiljalac, $request->id_primalac, $request->id_chat));
    return ['success' => true];
})->middleware('authCheck', 'isLoggedIn');

// ADMIN 
Route::group(['middleware' => ['authCheck', 'isLoggedIn', 'isAdmin']], function () {
    Route::get('/admin/početna', [AdminController::class, 'adminHome'])->name('home.admin');
    Route::get('/admin/lekari', [AdminController::class, 'adminLekar'])->name('lekari.admin');
    Route::get('/admin/pacijenti', [AdminController::class, 'adminPacijent'])->name('pacijenti.admin');
    Route::get('/admin/novi-lekar', [AdminController::class, 'adminDodajLekara'])->name('dodaj_lekara.admin');
    Route::get('/admin/profil-lekara/{id}', [AdminController::class, 'profilLekar'])->name('profil_lekara.admin');
    Route::get('/admin/kalendar', [AdminController::class, 'adminKalendar'])->name('kalendar.admin');

    Route::get('admin/termini-lekara', [AdminController::class, 'terminiLekara']);
    // PACIJENTI DODAVANJE
    Route::get('/admin/novi-pacijent', [AdminController::class, 'adminDodajPacijenta'])->name('dodaj_pacijenta.admin');
    Route::get('/admin/novi-pregled/{id}', [AdminController::class, 'adminPregledPacijenta'])->name('pregled_pacijenta.admin');
    Route::get('/admin/amamneza/{id}/{id_pregled}', [AdminController::class, 'adminAnamnezaPacijenta'])->name('anamneza_pacijenta.admin');
    Route::get('/admin/terapija/{id}/{id_pregled}', [AdminController::class, 'adminTerapijaPacijenta'])->name('terapija_pacijenta.admin');
    // PACIJENTI DODAVANJE KRAJ
    Route::get('/admin/analitika', [AdminController::class, 'adminAnalitika'])->name('analitika.admin');
    Route::get('/admin/moja-klinika', [AdminController::class, 'adminMojaKlinika'])->name('klinika.admin');

    // POST REQUESTOVI
    Route::post('admin/unos-pacijenta', [AdminController::class, 'adminUnosPacijenta'])->name('unos_pacijenta.admin');
    Route::post('admin/unos-lekara', [AdminController::class, 'adminUnosLekara'])->name('unos_lekara.admin');
});

// DOCTOR
Route::group(['middleware' => ['authCheck', 'isLoggedIn', 'isDoctor']], function () {
    Route::get('/doctor/početna', [DoctorController::class, 'doctorHome'])->name('home.doctor');
    Route::get('/doctor/noviPacijent', [DoctorController::class, 'doctorNewPatient'])->name('newPatient.doctor');
    Route::get('/doctor/ažuriranje-pacijenta/{id}', [DoctorController::class, 'doctorUpdatePatient'])->name('update_patient.doctor');
    Route::post('/doctor/unos-pacijenta', [DoctorController::class, 'doctorInsertPatient'])->name('unos_pacijenta.doctor');
    Route::get('/doctor/mojiPacijenti', [DoctorController::class, 'patients'])->name('pacijenti.doctor');
    Route::get('/doctor/pacijenti_tabela', [DoctorController::class, 'getPacijenti'])->name('get.pacijenti.doctor');

    Route::get('/doctor/dijagnoze/{id}', [DoctorController::class, 'dijagnoze'])->name('dijagnoze.doctor');


    //----------RAD SA FAJLOVIMA----------//
    Route::get('/doctor/radiološke-slike/{id}', [DoctorController::class, 'radioloskeSlike'])->name('radioloskeSlike.doctor');
    Route::get('/doctor/unos-slika/{id}', [DoctorController::class, 'unosRadioloskeSlike'])->name('unosRadioloskihSlika.doctor');
    Route::post('/doctor/unesi-sliku/{id}', [DoctorController::class, 'insertRadioloskeSlike'])->name('insertRadioloskihSlika.doctor');
    Route::get('/doctor/laboratorijski-nalazi/{id}', [DoctorController::class, 'nalazi'])->name('nalazi.doctor');
    Route::get('/doctor/unos-nalaza/{id}', [DoctorController::class, 'unosNalaza'])->name('unosNalaza.doctor');
    Route::post('/doctor/unesi-nalaz/{id}', [DoctorController::class, 'insertNalazi'])->name('insertNalazi.doctor');

    Route::get('/doctor/alergije/{id}', [DoctorController::class, 'alergije'])->name('alergije.doctor');
    Route::get('/doctor/dijagnoze/{id}', [DoctorController::class, 'dijagnoze'])->name('dijagnoze.doctor');

    Route::get('/doctor/kontakt-pacijenta/{id}', [DoctorController::class, 'kontaktPacijenta'])->name('kontaktPacijenta.doctor');
    Route::post('doctor/kontakt-mail', [DoctorController::class, 'kontaktMail'])->name('kontaktMail.doctor');

    Route::get('/doctor/novi-pregled/{id}', [DoctorController::class, 'doctorPregledPacijenta'])->name('pregled_pacijenta.doctor');
    Route::get('/doctor/profil-pacijenta/{id}', [DoctorController::class, 'profilPacijent'])->name('profil_pacijenta.doctor');
    Route::post('/doctor/brisanje-pacijenta/{id}', [DoctorController::class, 'brisanjePacijenta'])->name('brisanje_pacijenta.doctor');
    Route::get('/doctor/vaš-profil', [DoctorController::class, 'doctorProfile'])->name('vasProfil.doctor');
    Route::post('doctor/promeni-sifru', [DoctorController::class, 'promeniSifru'])->name('promeniSifru.doctor');
    Route::get('/doctor/terapije/{id}', [DoctorController::class, 'terapije'])->name('terapije.doctor');

    Route::post('doctor/unos-mera', [DoctorController::class, 'doctorUnosMera'])->name('unos_mera.doctor');
    Route::post('doctor/insert-terapija', [DoctorController::class, 'insertTerapija'])->name('insertTerapija.doctor');
    Route::get('/doctor/anamneza/{id}/{id_pregled}', [DoctorController::class, 'doctorAnamnezaPacijenta'])->name('anamneza_pacijenta.doctor');
    Route::post('doctor/unos-anamneze', [DoctorController::class, 'doctorUnosAnamneze'])->name('unos_anamneze.doctor');
    Route::get('/doctor/terapija/{id}', [DoctorController::class, 'doctorTerapijaPacijenta'])->name('terapija_pacijenta.doctor');
    Route::get('doctor/search_lekovi', [DoctorController::class, 'searchLekovi']);
    Route::get('doctor/profil_pacijenta/istorija-pregleda/{id}', [DoctorController::class, 'istorijaPregleda'])->name('istorija_pregleda.doctor');

    Route::get('doctor/ajax-poruke', [DoctorController::class, 'ajaxPoruke']);

    Route::get('/doctor/chat', [DoctorController::class, 'poruke'])->name('poruke.doctor'); // TEST CHAT
    Route::get('doctor/get-poruke', [DoctorController::class, 'getPoruke']);

    // SRCE 
    Route::get('/doctor/screenix/početna', [DoctorController::class, 'screenixPocetna'])->name('screenixPocetna.doctor');
    Route::get('/doctor/screenix/srce/početna', [DoctorController::class, 'srcePocetna'])->name('srcePocetna.doctor');

    Route::get('/doctor/screenix/srce/novi-test', [DoctorController::class, 'noviTestSrce'])->name('noviTestSrce.doctor');
    Route::get('/doctor/screenix/srce/izveštaji', [DoctorController::class, 'izvestajiSrce'])->name('izvestajiSrce.doctor');
    Route::get('/doctor/screenix/srce/korak-1/{id}', [DoctorController::class, 'korak1Srce'])->name('korak1Srce.doctor');
    Route::post('/doctor/screenix/srce/korak-1-forma', [DoctorController::class, 'korak1SrceForma'])->name('korak1Forma.doctor');
    Route::get('/doctor/screenix/srce/korak-2/{id}', [DoctorController::class, 'korak2Srce'])->name('korak2Srce.doctor');
    Route::post('/doctor/screenix/srce/korak-2-forma', [DoctorController::class, 'korak2SrceForma'])->name('korak2Forma.doctor');
    Route::get('/doctor/screenix/srce/korak-3/{id}', [DoctorController::class, 'korak3Srce'])->name('korak3Srce.doctor');
    Route::post('/doctor/screenix/srce/navike', [DoctorController::class, 'navikeSrce'])->name('navikeSrce.doctor');
    Route::post('/doctor/screenix/srce/posao', [DoctorController::class, 'posaoSrce'])->name('posaoSrce.doctor');
    Route::post('/doctor/screenix/srce/porodica', [DoctorController::class, 'porodicaSrce'])->name('porodicaSrce.doctor');
    Route::post('/doctor/screenix/srce/hrana', [DoctorController::class, 'hranaSrce'])->name('hranaSrce.doctor');
    Route::get('/doctor/screenix/srce/izvestaj/{id}', [DoctorController::class, 'izvestajSrce'])->name('izvestajSrce.doctor');

    Route::get('/doctor/screenix/srce/izvestaj/{id_test}/{id}', [DoctorController::class, 'izvestajSrceIzvestaji'])->name('izvestajSrceIzvestaji.doctor');

    Route::get('/doctor/screenix/srce/korak-4/{id_test}/{id}', [DoctorController::class, 'korak4Srce'])->name('korak4Srce.doctor');

    Route::post('doctor/screenix/srce/korak-4/filter1', [DoctorController::class, 'filter1'])->name('filter1.doctor');
    Route::post('doctor/screenix/srce/korak-4/filter2', [DoctorController::class, 'filter2'])->name('filter2.doctor');
    Route::post('doctor/screenix/srce/korak-4/filter3', [DoctorController::class, 'filter3'])->name('filter3.doctor');
    Route::post('doctor/screenix/srce/korak-4/filter4', [DoctorController::class, 'filter4'])->name('filter4.doctor');
    Route::post('doctor/screenix/srce/korak-4/filter5', [DoctorController::class, 'filter5'])->name('filter5.doctor');
    Route::post('doctor/screenix/srce/korak-4/filter6', [DoctorController::class, 'filter6'])->name('filter6.doctor');
    Route::post('doctor/screenix/srce/korak-4/filter7', [DoctorController::class, 'filter7'])->name('filter7.doctor');
    Route::post('doctor/screenix/srce/korak-4/filter8', [DoctorController::class, 'filter8'])->name('filter8.doctor');

    Route::get('/doctor/screenix/srce/korak-5/{id_test}/{id}', [DoctorController::class, 'korak5Srce'])->name('korak5Srce.doctor');

    Route::post('doctor/screenix/srce/korak-5/ekg', [DoctorController::class, 'korak5SrceForma'])->name('korak5SrceForma.doctor');

    Route::get('/doctor/screenix/srce/izvestaj-finalni/{id_test}/{id}', [DoctorController::class, 'finalniIzvestajSrce'])->name('finalniIzvestajSrce.doctor');

    Route::get('/doctor/screenix/srce/zavrsi-test', [DoctorController::class, 'zavrsiTestSrce'])->name('zavrsiTestSrce.doctor');

    // DEBELO CREVO 
    Route::get('/doctor/screenix/debelo-crevo/početna', [DoctorController::class, 'debeloCrevoPocetna'])->name('debeloCrevoPocetna.doctor');

    Route::get('/doctor/screenix/debelo-crevo/novi-test', [DoctorController::class, 'debeloCrevoNoviTest'])->name('debeloCrevoNoviTest.doctor');
    Route::get('/doctor/screenix/debelo-crevo/izveštaji', [DoctorController::class, 'debeloCrevoIzvestaji'])->name('debeloCrevoIzvestaji.doctor');

    Route::get('/doctor/screenix/debelo-crevo/korak-1/{id}', [DoctorController::class, 'korak1DebeloCrevo'])->name('korak1DebeloCrevo.doctor');
    Route::post('/doctor/screenix/debelo-crevo/korak-1-forma', [DoctorController::class, 'korak1DebeloCrevoForma'])->name('korak1DebeloCrevoForma.doctor');
});

// USER
Route::group(['middleware' => ['authCheck', 'isLoggedIn', 'isUser']], function () {
    Route::get('/patient/početna', [PatientController::class, 'patientHome'])->name('home.patient');
    Route::get('/patient/profil', [PatientController::class, 'patientProfile'])->name('profile.patient');
    Route::get('/patient/zakazivanje', [PatientController::class, 'patientCalendar'])->name('calendar.patient');

    Route::get('/patient/razgovor-uživo', [PatientController::class, 'patientLiveChat'])->name('livechat.patient');

    Route::get('/patient/vaši-termini', [PatientController::class, 'patientTermini'])->name('vasi-termini.patient');
    Route::get('/patient/vaš-profil', [PatientController::class, 'userProfile'])->name('vasi-profil.patient');
    // POST
    Route::post('patient/unesi-termin', [PatientController::class, 'unesiTermin'])->name('unosTermina.patient');
    Route::post('patient/promeni-sifru', [PatientController::class, 'promeniSifru'])->name('promeniSifru.patient');
    // AJAX 
    Route::get('patient/termini', [PatientController::class, 'termini']);
    Route::get('patient/ime-lekara', [PatientController::class, 'imeLekara']);
    Route::get('patient/termin-id', [PatientController::class, 'lastTerminId']);

    Route::get('patient/get-poruke', [PatientController::class, 'getPoruke']);

    Route::get('/patient/pregledi', [PatientController::class, 'istorijaPregleda'])->name('istorijaPregleda.patient');
    Route::get('/patient/terapije', [PatientController::class, 'terapije'])->name('terapije.patient');
    Route::get('/patient/radiološke-slike', [PatientController::class, 'radioloskeSlike'])->name('radioloskeSlike.patient');
    Route::get('/patient/nalazi-laboratorija', [PatientController::class, 'nalaziLaboratorija'])->name('nalaziLaboratorija.patient');
});
