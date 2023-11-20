@extends('layout.doclayout')

@section('title', 'Srce | Korak 3')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <a href="#" style="pointer-events: none;"><button class="btn btn-success">1</button></a>
                    <a href="#" style="pointer-events: none;"><button class="btn btn-success">2</button></a>
                    @if (!empty($rizikNavike) && !empty($rizikPosao) && !empty($rizikPorodica) && !empty($rizikHrana))
                    <a href="#" style="pointer-events: none;"><button class="btn btn-success">3</button></a>
                    @else
                    <a href="#" style="pointer-events: none;"><button class="btn btn-primary">3</button></a>
                    @endif
                    <a href="#" style="pointer-events: none;"><button class="btn btn-secondary" disabled><i class="fa-regular fa-id-card"></i></button></a>
                    <a href="#" style="pointer-events: none;"><button class="btn btn-secondary" disabled>4</button></a>
                    <a href="#" style="pointer-events: none;"><button class="btn btn-secondary" disabled>5</button></a>
                    <a href="#" style="pointer-events: none;"><button class="btn btn-secondary" disabled><i class="fa-solid fa-file-medical"></i></button></a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3" id="navikeButton">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 hoverable aktivno" id="a">
                <i class="fa-solid fa-smoking fa-3x"></i>
                <div class="ms-3">
                    <h6>Navike</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3" id="posaoButton">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 hoverable" id="b">
                <i class="fa-solid fa-briefcase fa-3x"></i>
                <div class="ms-3">
                    <h6>Posao</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3" id="porodicaButton">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 hoverable" id="c">
                <i class="fa-solid fa-people-roof fa-3x"></i>
                <div class="ms-3">
                    <h6>Porodica</h6>
                </div>
            </div>
        </div>
        <div class="col-sm-6 col-xl-3" id="hranaButton">
            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4 hoverable" id="d">
                <i class="fa-solid fa-burger fa-3x"></i>
                <div class="ms-3">
                    <h6>Hrana</h6>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-sm-12" id="navike">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align:center">Navike</h6>
                <form action="{{ route('navikeSrce.doctor') }}" method="POST">
                    @csrf
                    @if (empty($navike))
                    <input type="text" class="form-control" id="floatingInput" name="id" value="{{$id}}" hidden="">
                    <input type="text" class="form-control" id="floatingInput" name="id_test" value="{{Session::get('ScreenIXID')}}" hidden="">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="cigarete">
                            <option selected="" disabled="">Izaberite</option>
                            <option value="0">0</option>
                            <option value="1">0, ali sam okružen pušačima koji puše &lt; 10 cigareta dnevno</option>
                            <option value="2">0, ali sam okružen pušačima koji puše &gt; 10 cigareta dnevno</option>
                            <option value="3">Pušim izmedju 0 i 10 cigareta dnevno i nisam okružen/a pušačima</option>
                            <option value="4">Pušim izmedju 10 i 20 cigareta dnevno i nisam okružen/a pušačima</option>
                            <option value="5">Pušim izmedju 20 i 30 cigareta dnevno i nisam okružen/a pušačima</option>
                            <option value="6">Pušim više od 30 cigareta dnevno i nisam okružen/a pušačima</option>
                            <option value="7">Pušim izmedju 0 i 10 cigareta dnevno i okružen/a pušačima</option>
                            <option value="8">Pušim izmedju 10 i 20 cigareta dnevno i okružen/a pušačima</option>
                            <option value="9">Pušim izmedju 20 i 30 cigareta dnevno i okružen/a pušačima</option>
                            <option value="10">Pušim više od 30 cigareta dnevno i okružen/a pušačima</option>
                        </select>
                        <label for="floatingSelect">Koliko cigareta pušite dnevno?</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="lezanje">
                            <option selected="" disabled="">Izaberite</option>
                            <option value="0">Manje od 2 sata</option>
                            <option value="1">Izmedju 2 i 4 sata</option>
                            <option value="2">Izmedju 4 i 7 sati</option>
                            <option value="3">Izmedju 7 i 12 sati</option>
                            <option value="4">Više od 12 sati</option>
                        </select>
                        <label for="floatingSelect">Koliko sati dnevno sedite ili ležite?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="spavanje">
                            <option selected="" disabled="">Izaberite</option>
                            <option value="0">Manje od 3 sata</option>
                            <option value="1">Izmedju 3 i 5 sati</option>
                            <option value="2">Izmedju 5 i 7 sati</option>
                            <option value="3">Izmedju 7 i 9 sati</option>
                            <option value="4">Više od 9 sati</option>
                        </select>
                        <label for="floatingSelect">Koliko sati dnevno spavate?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="aktivnost">
                            <option selected="" disabled="">Izaberite</option>
                            <option value="0">0</option>
                            <option value="1">Manje od 2 puta</option>
                            <option value="2">Izmedju 3 do 5 puta</option>
                            <option value="3">Više od 5 puta</option>
                        </select>
                        <label for="floatingSelect">Koliko se puta nedeljno bavite fizičkim aktivnostima?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="odmor">
                            <option selected="" disabled="">Izaberite</option>
                            <option value="0">0</option>
                            <option value="1">1 do 2 puta</option>
                            <option value="2">3 do 4 puta</option>
                            <option value="3">Preko 5 puta</option>
                        </select>
                        <label for="floatingSelect">Koliko puta tokom godine odlazite na odmor?</label>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-100 m-2" id="unesi">Unesi</button>
                    @else
                    <input type="text" class="form-control" id="floatingInput" name="id" value="{{$id}}" hidden="">
                    <input type="text" class="form-control" id="floatingInput" name="id_test" value="{{Session::get('ScreenIXID')}}" hidden="">
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="cigarete" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($navike->cigarete == 0)
                            <option value="0" selected="">0</option>
                            @elseif ($navike->cigarete == 1)
                            <option value="1" selected="">0, ali sam okružen pušačima koji puše &lt; 10 cigareta dnevno</option>
                            @elseif ($navike->cigarete == 2)
                            <option value="2" selected="">0, ali sam okružen pušačima koji puše &gt; 10 cigareta dnevno</option>
                            @elseif ($navike->cigarete == 3)
                            <option value="3" selected="">Pušim izmedju 0 i 10 cigareta dnevno i nisam okružen/a pušačima</option>
                            @elseif ($navike->cigarete == 4)
                            <option value="4" selected="">Pušim izmedju 10 i 20 cigareta dnevno i nisam okružen/a pušačima</option>
                            @elseif ($navike->cigarete == 5)
                            <option value="5" selected="">Pušim izmedju 20 i 30 cigareta dnevno i nisam okružen/a pušačima</option>
                            @elseif ($navike->cigarete == 6)
                            <option value="6" selected="">Pušim više od 30 cigareta dnevno i nisam okružen/a pušačima</option>
                            @elseif ($navike->cigarete == 7)
                            <option value="7" selected="">Pušim izmedju 0 i 10 cigareta dnevno i okružen/a pušačima</option>
                            @elseif ($navike->cigarete == 8)
                            <option value="8" selected="">Pušim izmedju 10 i 20 cigareta dnevno i okružen/a pušačima</option>
                            @elseif ($navike->cigarete == 9)
                            <option value="9" selected="">Pušim izmedju 20 i 30 cigareta dnevno i okružen/a pušačima</option>
                            @else
                            <option value="10" selected="">Pušim više od 30 cigareta dnevno i okružen/a pušačima</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Koliko cigareta pušite dnevno?</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="lezanje" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($navike->sedenje_lezanje == 0)
                            <option value="0" selected="">Manje od 2 sata</option>
                            @elseif ($navike->sedenje_lezanje == 1)
                            <option value="1" selected="">Izmedju 2 i 4 sata</option>
                            @elseif ($navike->sedenje_lezanje == 2)
                            <option value="2" selected="">Izmedju 4 i 7 sati</option>
                            @elseif ($navike->sedenje_lezanje == 3)
                            <option value="3" selected="">Izmedju 7 i 12 sati</option>
                            @else
                            <option value="4" selected="">Više od 12 sati</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Koliko sati dnevno sedite ili ležite?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="spavanje" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($navike->spavanje == 0)
                            <option value="0" selected="">Manje od 3 sata</option>
                            @elseif ($navike->spavanje == 1)
                            <option value="1" selected="">Izmedju 3 i 5 sati</option>
                            @elseif ($navike->spavanje == 2)
                            <option value="2" selected="">Izmedju 5 i 7 sati</option>
                            @elseif ($navike->spavanje == 3)
                            <option value="3" selected="">Izmedju 7 i 9 sati</option>
                            @else
                            <option value="4" selected="">Više od 9 sati</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Koliko sati dnevno spavate?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="aktivnost" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($navike->fizicka_aktivnost == 0)
                            <option value="0" selected="">0</option>
                            @elseif ($navike->fizicka_aktivnost == 1)
                            <option value="1" selected="">Manje od 2 puta</option>
                            @elseif ($navike->fizicka_aktivnost == 2)
                            <option value="2" selected="">Izmedju 3 do 5 puta</option>
                            @else
                            <option value="3" selected="">Više od 5 puta</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Koliko se puta nedeljno bavite fizičkim aktivnostima?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="odmor" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($navike->odmor == 0)
                            <option value="0" selected="">0</option>
                            @elseif ($navike->odmor == 1)
                            <option value="1" selected="">1 do 2 puta</option>
                            @elseif ($navike->odmor == 2)
                            <option value="2" selected="">3 do 4 puta</option>
                            @else
                            <option value="3" selected="">Preko 5 puta</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Koliko puta tokom godine odlazite na odmor?</label>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-100 m-2" id="unesi" disabled>Unesi</button>
                    @endif
                </form>
            </div>
        </div>

        <div class="col-xl-6 col-sm-12" id="posao" style="display:none;">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align:center">Posao</h6>
                <form action="{{ route('posaoSrce.doctor') }}" method="POST">
                    @csrf
                    <input type="text" class="form-control" id="floatingInput" name="id" value="{{$id}}" hidden="">
                    <input type="text" class="form-control" id="floatingInput" name="id_test" value="{{Session::get('ScreenIXID')}}" hidden="">
                    @if (empty($posao))
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="posao">
                            <option disabled="" selected="">Izaberite</option>
                            <option value="1">Finansije i osiguranja</option>
                            <option value="2">Informacije</option>
                            <option value="3">Obrazovne usluge</option>
                            <option value="4">Profesionalne, naučne ili tehničke usluge</option>
                            <option value="5">Umetnost, zabava ili rekreacija</option>
                            <option value="6">Usluge ishrane</option>
                            <option value="7">Trgovina na malo</option>
                            <option value="8">Zdravstvo i socijalna pomoć</option>
                            <option value="9">Građevinski radovi</option>
                            <option value="10">Javne usluge</option>
                            <option value="11">Poljoprivreda, šumarstvo, lov ili ribolov</option>
                            <option value="12">Proizvodnja</option>
                            <option value="13">Usluga nekretnina, iznajmljivanje ili lizing</option>
                            <option value="14">Uslužne usluge</option>
                            <option value="15">Usluge prevoza i skladištenja</option>
                            <option value="16">Administracija, podrška, upravljanje otpadom ili sanacija</option>
                            <option value="17">Javna uprava</option>
                            <option value="18">Trgovina na veliko</option>
                            <option value="19">Ostalo/Nije na spisku</option>
                        </select>
                        <label for="floatingSelect">Koji je tip posla koji obavljate?</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" name="stres" placeholder="stres" min="1" max="20">
                        <label for="floatingInput">Ocenite koliko je Vaš posao stresan na skali od 1 do 20</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" name="iskustvo" placeholder="iskustvo" min="1" max="80">
                        <label for="floatingInput">Koliko godina poslovnog iskustva imate(1 do 80 godina)?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" name="dani" placeholder="dani" min="1" max="7">
                        <label for="floatingInput">Koliki je broj radnih dana u nedelji u Vašem poslu?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" name="sati" placeholder="sati" min="1" max="300">
                        <label for="floatingInput">Koliko radnih sati nedeljno imate na poslu?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="vikend">
                            <option disabled="" selected="">Izaberite</option>
                            <option value="1">DA</option>
                            <option value="2">NE</option>
                            <option value="3">Ponekad</option>
                        </select>
                        <label for="floatingSelect">Da li radite vikendima?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="energija">
                            <option selected="" disabled="">Izaberite</option>
                            <option value="0">Nikad</option>
                            <option value="1">Retko</option>
                            <option value="2">Ponekad</option>
                            <option value="3">Često</option>
                            <option value="4">Vrlo često</option>
                            <option value="5">Uvek</option>
                        </select>
                        <label for="floatingSelect">Koliko često ste umorni i nedostaje Vam energije da odete na posao?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="iscrpljen">
                            <option selected="" disabled="">Izaberite</option>
                            <option value="0">Nikad</option>
                            <option value="1">Retko</option>
                            <option value="2">Ponekad</option>
                            <option value="3">Često</option>
                            <option value="4">Vrlo često</option>
                            <option value="5">Uvek</option>
                        </select>
                        <label for="floatingSelect">Koliko često se osećate iscrpljeno nakon radnog vremena?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="razmisljanje">
                            <option selected="" disabled="">Izaberite</option>
                            <option value="0">Nikad</option>
                            <option value="1">Retko</option>
                            <option value="2">Ponekad</option>
                            <option value="3">Često</option>
                            <option value="4">Vrlo često</option>
                            <option value="5">Uvek</option>
                        </select>
                        <label for="floatingSelect">Koliko često je Vaš proces razmišljanja spor ili koncentracija oslabljena?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="problemi">
                            <option selected="" disabled="">Izaberite</option>
                            <option value="0">Nikad</option>
                            <option value="1">Retko</option>
                            <option value="2">Ponekad</option>
                            <option value="3">Često</option>
                            <option value="4">Vrlo često</option>
                            <option value="5">Uvek</option>
                        </select>
                        <label for="floatingSelect">Koliko često razmišljate o složenim problemima na poslu?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="zahtevi">
                            <option selected="" disabled="">Izaberite</option>
                            <option value="0">Nikad</option>
                            <option value="1">Retko</option>
                            <option value="2">Ponekad</option>
                            <option value="3">Često</option>
                            <option value="4">Vrlo često</option>
                            <option value="5">Uvek</option>
                        </select>
                        <label for="floatingSelect">Koliko često se osećate odvojenim od kolega?</label>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary w-100 m-2" id="unesi">Unesi</button>
                    @else
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="posao" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($posao->tip_posla == 1)
                            <option value="1" selected="">Finansije i osiguranja</option>
                            @elseif ($posao->tip_posla == 2)
                            <option value="2" selected="">Informacije</option>
                            @elseif ($posao->tip_posla == 3)
                            <option value="3" selected="">Obrazovne usluge</option>
                            @elseif ($posao->tip_posla == 4)
                            <option value="4" selected="">Profesionalne, naučne ili tehničke usluge</option>
                            @elseif ($posao->tip_posla == 5)
                            <option value="5" selected="">Umetnost, zabava ili rekreacija</option>
                            @elseif ($posao->tip_posla == 6)
                            <option value="6" selected="">Usluge ishrane</option>
                            @elseif ($posao->tip_posla == 7)
                            <option value="7" selected="">Trgovina na malo</option>
                            @elseif ($posao->tip_posla == 8)
                            <option value="8" selected="">Zdravstvo i socijalna pomoć</option>
                            @elseif ($posao->tip_posla == 9)
                            <option value="9" selected="">Građevinski radovi</option>
                            @elseif ($posao->tip_posla == 10)
                            <option value="10" selected="">Javne usluge</option>
                            @elseif ($posao->tip_posla == 11)
                            <option value="11" selected="">Poljoprivreda, šumarstvo, lov ili ribolov</option>
                            @elseif ($posao->tip_posla == 12)
                            <option value="12" selected="">Proizvodnja</option>
                            @elseif ($posao->tip_posla == 13)
                            <option value="13" selected="">Usluga nekretnina, iznajmljivanje ili lizing</option>
                            @elseif ($posao->tip_posla == 14)
                            <option value="14" selected="">Uslužne usluge</option>
                            @elseif ($posao->tip_posla == 15)
                            <option value="15" selected="">Usluge prevoza i skladištenja</option>
                            @elseif ($posao->tip_posla == 16)
                            <option value="16" selected="">Administracija, podrška, upravljanje otpadom ili sanacija</option>
                            @elseif ($posao->tip_posla == 17)
                            <option value="17" selected="">Javna uprava</option>
                            @elseif ($posao->tip_posla == 18)
                            <option value="18" selected="">Trgovina na veliko</option>
                            @else
                            <option value="19" selected="">Ostalo/Nije na spisku</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Koji je tip posla koji obavljate?</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" name="stres" value="{{$posao->stres_posao}}" placeholder="stres" min="1" max="20" disabled>
                        <label for="floatingInput">Ocenite koliko je Vaš posao stresan na skali od 1 do 20</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" name="iskustvo" value="{{$posao->iskustvo}}" placeholder="iskustvo" min="1" max="80" disabled>
                        <label for="floatingInput">Koliko godina poslovnog iskustva imate(1 do 80 godina)?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" name="dani" value="{{$posao->radni_dani}}" placeholder="dani" min="1" max="7" disabled>
                        <label for="floatingInput">Koliki je broj radnih dana u nedelji u Vašem poslu?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="floatingInput" name="sati" value="{{$posao->radni_sati}}" placeholder="sati" min="1" max="300" disabled>
                        <label for="floatingInput">Koliko radnih sati nedeljno imate na poslu?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="vikend" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($posao->vikend == 1)
                            <option value="1" selected="">DA</option>
                            @elseif ($posao->vikend == 2)
                            <option value="2" selected="">NE</option>
                            @else
                            <option value="3" selected="">Ponekad</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Da li radite vikendima?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="energija" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($posao->umor == 0)
                            <option value="0" selected="">Nikad</option>
                            @elseif ($posao->umor == 1)
                            <option value="1" selected="">Retko</option>
                            @elseif ($posao->umor == 2)
                            <option value="2" selected="">Ponekad</option>
                            @elseif ($posao->umor == 3)
                            <option value="3" selected="">Često</option>
                            @elseif ($posao->umor == 4)
                            <option value="4" selected="">Vrlo često</option>
                            @else
                            <option value="5" selected="">Uvek</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Koliko često ste umorni i nedostaje Vam energije da odete na posao?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="iscrpljen" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($posao->iscrpljenost == 0)
                            <option value="0" selected="">Nikad</option>
                            @elseif ($posao->iscrpljenost == 1)
                            <option value="1" selected="">Retko</option>
                            @elseif ($posao->iscrpljenost == 2)
                            <option value="2" selected="">Ponekad</option>
                            @elseif ($posao->iscrpljenost == 3)
                            <option value="3" selected="">Često</option>
                            @elseif ($posao->iscrpljenost == 4)
                            <option value="4" selected="">Vrlo često</option>
                            @else
                            <option value="5" selected="">Uvek</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Koliko često se osećate iscrpljeno nakon radnog vremena?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="razmisljanje" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($posao->koncentracija == 0)
                            <option value="0" selected="">Nikad</option>
                            @elseif ($posao->koncentracija == 1)
                            <option value="1" selected="">Retko</option>
                            @elseif ($posao->koncentracija == 2)
                            <option value="2" selected="">Ponekad</option>
                            @elseif ($posao->koncentracija == 3)
                            <option value="3" selected="">Često</option>
                            @elseif ($posao->koncentracija == 4)
                            <option value="4" selected="">Vrlo često</option>
                            @else
                            <option value="5" selected="">Uvek</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Koliko često je Vaš proces razmišljanja spor ili koncentracija oslabljena?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="problemi" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($posao->problemi == 0)
                            <option value="0" selected="">Nikad</option>
                            @elseif ($posao->problemi == 1)
                            <option value="1" selected="">Retko</option>
                            @elseif ($posao->problemi == 2)
                            <option value="2" selected="">Ponekad</option>
                            @elseif ($posao->problemi == 3)
                            <option value="3" selected="">Često</option>
                            @elseif ($posao->problemi == 4)
                            <option value="4" selected="">Vrlo često</option>
                            @else
                            <option value="5" selected="">Uvek</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Koliko često razmišljate o složenim problemima na poslu?</label>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="zahtevi" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($posao->odvojeni == 0)
                            <option value="0" selected="">Nikad</option>
                            @elseif ($posao->odvojeni == 1)
                            <option value="1" selected="">Retko</option>
                            @elseif ($posao->odvojeni == 2)
                            <option value="2" selected="">Ponekad</option>
                            @elseif ($posao->odvojeni == 3)
                            <option value="3" selected="">Često</option>
                            @elseif ($posao->odvojeni == 4)
                            <option value="4" selected="">Vrlo često</option>
                            @else
                            <option value="5" selected="">Uvek</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Koliko često se osećate odvojenim od kolega?</label>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary w-100 m-2" id="unesi" disabled>Unesi</button>
                    @endif
                </form>
            </div>
        </div>

        <div class="col-xl-6 col-sm-12" id="porodica" style="display:none;">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align:center">Porodica</h6>
                <form action="{{ route('porodicaSrce.doctor') }}" method="POST">
                    @csrf
                    @if (empty($porodica))
                    <input type="text" class="form-control" id="floatingInput" name="id" value="{{$id}}" hidden="">
                    <input type="text" class="form-control" id="floatingInput" name="id_test" value="{{Session::get('ScreenIXID')}}" hidden="">
                    <div class="tab">
                        <button type="button" class="tablinks" onclick="openCity(event, 'bolesti_srca')">Hronična bolest srca</button>
                        <button type="button" class="tablinks" onclick="openCity(event, 'srcani_napad')">Srčani napad</button>
                        <button type="button" class="tablinks active" onclick="openCity(event, 'infarkt')">Infarkt</button>
                        <button type="button" class="tablinks" onclick="openCity(event, 'dijabetes')">Dijabetes</button>
                        <button type="button" class="tablinks" onclick="openCity(event, 'jetra')">Oboljenje jetre</button>
                        <button type="button" class="tablinks" onclick="openCity(event, 'reuma')">Reumatske bolesti</button>
                        <button type="button" class="tablinks" onclick="openCity(event, 'pritisak')">Visok pritisak</button>
                        <button type="button" class="tablinks" onclick="openCity(event, 'krv')">Bolesti krvi</button>
                        <button type="button" class="tablinks" onclick="openCity(event, 'bubreg')">Bolesti bubrega</button>
                        <button type="button" class="tablinks" onclick="openCity(event, 'pluca')">Bolesti pluća</button>
                        <button type="button" class="tablinks" onclick="openCity(event, 'zlezda')">Bolesti štitne žlezde</button>
                    </div>

                    <div id="bolesti_srca" class="tabcontent" style="display: none;">
                        <h3>Hronične bolesti srca</h3>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Majka</h6>
                            <label for="f-option1" class="l-radio">
                                <input type="radio" id="f-option1" name="majka_srce" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option1" class="l-radio">
                                <input type="radio" id="s-option1" name="majka_srce" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Otac</h6>
                            <label for="f-option2" class="l-radio">
                                <input type="radio" id="f-option2" name="otac_srce" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option2" class="l-radio">
                                <input type="radio" id="s-option2" name="otac_srce" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Baba</h6>
                            <label for="f-option3" class="l-radio">
                                <input type="radio" id="f-option3" name="baba_srce" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option3" class="l-radio">
                                <input type="radio" id="s-option3" name="baba_srce" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option3" class="l-radio">
                                <input type="radio" id="t-option3" name="baba_srce" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Deda</h6>
                            <label for="f-option4" class="l-radio">
                                <input type="radio" id="f-option4" name="deda_srce" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option4" class="l-radio">
                                <input type="radio" id="s-option4" name="deda_srce" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option4" class="l-radio">
                                <input type="radio" id="t-option4" name="deda_srce" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Ujaci</h6>
                            <label for="f-option5" class="l-radio">
                                <input type="radio" id="f-option5" name="ujak_srce" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option5" class="l-radio">
                                <input type="radio" id="s-option5" name="ujak_srce" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option5" class="l-radio">
                                <input type="radio" id="t-option5" name="ujak_srce" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option5" class="l-radio">
                                <input type="radio" id="4-option5" name="ujak_srce" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Tetke</h6>
                            <label for="f-option6" class="l-radio">
                                <input type="radio" id="f-option6" name="tetka_srce" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option6" class="l-radio">
                                <input type="radio" id="s-option6" name="tetka_srce" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option6" class="l-radio">
                                <input type="radio" id="t-option6" name="tetka_srce" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option6" class="l-radio">
                                <input type="radio" id="4-option6" name="tetka_srce" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Braća</h6>
                            <label for="f-option7" class="l-radio">
                                <input type="radio" id="f-option7" name="brat_srce" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option7" class="l-radio">
                                <input type="radio" id="s-option7" name="brat_srce" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option7" class="l-radio">
                                <input type="radio" id="t-option7" name="brat_srce" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option7" class="l-radio">
                                <input type="radio" id="4-option7" name="brat_srce" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Sestre</h6>
                            <label for="f-option8" class="l-radio">
                                <input type="radio" id="f-option8" name="sestra_srce" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option8" class="l-radio">
                                <input type="radio" id="s-option8" name="sestra_srce" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option8" class="l-radio">
                                <input type="radio" id="t-option8" name="sestra_srce" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option8" class="l-radio">
                                <input type="radio" id="4-option8" name="sestra_srce" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>
                    </div>

                    <div id="srcani_napad" class="tabcontent" style="display: none;">
                        <h3>Srčani napad</h3>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Majka</h6>
                            <label for="f-option11" class="l-radio">
                                <input type="radio" id="f-option11" name="majka_napad" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option11" class="l-radio">
                                <input type="radio" id="s-option11" name="majka_napad" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Otac</h6>
                            <label for="f-option21" class="l-radio">
                                <input type="radio" id="f-option21" name="otac_napad" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option21" class="l-radio">
                                <input type="radio" id="s-option21" name="otac_napad" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Baba</h6>
                            <label for="f-option31" class="l-radio">
                                <input type="radio" id="f-option31" name="baba_napad" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option31" class="l-radio">
                                <input type="radio" id="s-option31" name="baba_napad" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option31" class="l-radio">
                                <input type="radio" id="t-option31" name="baba_napad" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Deda</h6>
                            <label for="f-option41" class="l-radio">
                                <input type="radio" id="f-option41" name="deda_napad" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option41" class="l-radio">
                                <input type="radio" id="s-option41" name="deda_napad" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option41" class="l-radio">
                                <input type="radio" id="t-option41" name="deda_napad" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Ujaci</h6>
                            <label for="f-option51" class="l-radio">
                                <input type="radio" id="f-option51" name="ujak_napad" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option51" class="l-radio">
                                <input type="radio" id="s-option51" name="ujak_napad" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option51" class="l-radio">
                                <input type="radio" id="t-option51" name="ujak_napad" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option51" class="l-radio">
                                <input type="radio" id="4-option51" name="ujak_napad" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Tetke</h6>
                            <label for="f-option61" class="l-radio">
                                <input type="radio" id="f-option61" name="tetka_napad" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option61" class="l-radio">
                                <input type="radio" id="s-option61" name="tetka_napad" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option61" class="l-radio">
                                <input type="radio" id="t-option61" name="tetka_napad" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option61" class="l-radio">
                                <input type="radio" id="4-option61" name="tetka_napad" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Braća</h6>
                            <label for="f-option71" class="l-radio">
                                <input type="radio" id="f-option71" name="brat_napad" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option71" class="l-radio">
                                <input type="radio" id="s-option71" name="brat_napad" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option71" class="l-radio">
                                <input type="radio" id="t-option71" name="brat_napad" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option71" class="l-radio">
                                <input type="radio" id="4-option71" name="brat_napad" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Sestre</h6>
                            <label for="f-option81" class="l-radio">
                                <input type="radio" id="f-option81" name="sestra_napad" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option81" class="l-radio">
                                <input type="radio" id="s-option81" name="sestra_napad" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option81" class="l-radio">
                                <input type="radio" id="t-option81" name="sestra_napad" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option81" class="l-radio">
                                <input type="radio" id="4-option81" name="sestra_napad" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>
                    </div>

                    <div id="infarkt" class="tabcontent" style="display: block;">
                        <h3>Infarkt</h3>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Majka</h6>
                            <label for="f-option12" class="l-radio">
                                <input type="radio" id="f-option12" name="majka_infarkt" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option12" class="l-radio">
                                <input type="radio" id="s-option12" name="majka_infarkt" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Otac</h6>
                            <label for="f-option22" class="l-radio">
                                <input type="radio" id="f-option22" name="otac_infarkt" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option22" class="l-radio">
                                <input type="radio" id="s-option22" name="otac_infarkt" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Baba</h6>
                            <label for="f-option32" class="l-radio">
                                <input type="radio" id="f-option32" name="baba_infarkt" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option32" class="l-radio">
                                <input type="radio" id="s-option32" name="baba_infarkt" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option32" class="l-radio">
                                <input type="radio" id="t-option32" name="baba_infarkt" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Deda</h6>
                            <label for="f-option42" class="l-radio">
                                <input type="radio" id="f-option42" name="deda_infarkt" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option42" class="l-radio">
                                <input type="radio" id="s-option42" name="deda_infarkt" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option42" class="l-radio">
                                <input type="radio" id="t-option42" name="deda_infarkt" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Ujaci</h6>
                            <label for="f-option52" class="l-radio">
                                <input type="radio" id="f-option52" name="ujak_infarkt" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option52" class="l-radio">
                                <input type="radio" id="s-option52" name="ujak_infarkt" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option52" class="l-radio">
                                <input type="radio" id="t-option52" name="ujak_infarkt" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option52" class="l-radio">
                                <input type="radio" id="4-option52" name="ujak_infarkt" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Tetke</h6>
                            <label for="f-option62" class="l-radio">
                                <input type="radio" id="f-option62" name="tetka_infarkt" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option62" class="l-radio">
                                <input type="radio" id="s-option62" name="tetka_infarkt" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option62" class="l-radio">
                                <input type="radio" id="t-option62" name="tetka_infarkt" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option62" class="l-radio">
                                <input type="radio" id="4-option62" name="tetka_infarkt" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Braća</h6>
                            <label for="f-option72" class="l-radio">
                                <input type="radio" id="f-option72" name="brat_infarkt" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option72" class="l-radio">
                                <input type="radio" id="s-option72" name="brat_infarkt" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option72" class="l-radio">
                                <input type="radio" id="t-option72" name="brat_infarkt" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option72" class="l-radio">
                                <input type="radio" id="4-option72" name="brat_infarkt" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Sestre</h6>
                            <label for="f-option82" class="l-radio">
                                <input type="radio" id="f-option82" name="sestra_infarkt" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option82" class="l-radio">
                                <input type="radio" id="s-option82" name="sestra_infarkt" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option82" class="l-radio">
                                <input type="radio" id="t-option82" name="sestra_infarkt" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option82" class="l-radio">
                                <input type="radio" id="4-option82" name="sestra_infarkt" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>
                    </div>

                    <div id="dijabetes" class="tabcontent" style="display: none;">
                        <h3>Dijabetes</h3>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Majka</h6>
                            <label for="f-option13" class="l-radio">
                                <input type="radio" id="f-option13" name="majka_dijabetes" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option13" class="l-radio">
                                <input type="radio" id="s-option13" name="majka_dijabetes" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Otac</h6>
                            <label for="f-option23" class="l-radio">
                                <input type="radio" id="f-option23" name="otac_dijabetes" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option23" class="l-radio">
                                <input type="radio" id="s-option23" name="otac_dijabetes" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Baba</h6>
                            <label for="f-option33" class="l-radio">
                                <input type="radio" id="f-option33" name="baba_dijabetes" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option33" class="l-radio">
                                <input type="radio" id="s-option33" name="baba_dijabetes" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option33" class="l-radio">
                                <input type="radio" id="t-option33" name="baba_dijabetes" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Deda</h6>
                            <label for="f-option43" class="l-radio">
                                <input type="radio" id="f-option43" name="deda_dijabetes" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option43" class="l-radio">
                                <input type="radio" id="s-option43" name="deda_dijabetes" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option43" class="l-radio">
                                <input type="radio" id="t-option43" name="deda_dijabetes" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Ujaci</h6>
                            <label for="f-option53" class="l-radio">
                                <input type="radio" id="f-option53" name="ujak_dijabetes" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option53" class="l-radio">
                                <input type="radio" id="s-option53" name="ujak_dijabetes" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option53" class="l-radio">
                                <input type="radio" id="t-option53" name="ujak_dijabetes" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option53" class="l-radio">
                                <input type="radio" id="4-option53" name="ujak_dijabetes" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Tetke</h6>
                            <label for="f-option63" class="l-radio">
                                <input type="radio" id="f-option63" name="tetka_dijabetes" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option63" class="l-radio">
                                <input type="radio" id="s-option63" name="tetka_dijabetes" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option63" class="l-radio">
                                <input type="radio" id="t-option63" name="tetka_dijabetes" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option63" class="l-radio">
                                <input type="radio" id="4-option63" name="tetka_dijabetes" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Braća</h6>
                            <label for="f-option73" class="l-radio">
                                <input type="radio" id="f-option73" name="brat_dijabetes" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option73" class="l-radio">
                                <input type="radio" id="s-option73" name="brat_dijabetes" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option73" class="l-radio">
                                <input type="radio" id="t-option73" name="brat_dijabetes" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option73" class="l-radio">
                                <input type="radio" id="4-option73" name="brat_dijabetes" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Sestre</h6>
                            <label for="f-option83" class="l-radio">
                                <input type="radio" id="f-option83" name="sestra_dijabetes" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option83" class="l-radio">
                                <input type="radio" id="s-option83" name="sestra_dijabetes" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option83" class="l-radio">
                                <input type="radio" id="t-option83" name="sestra_dijabetes" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option83" class="l-radio">
                                <input type="radio" id="4-option83" name="sestra_dijabetes" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>
                    </div>

                    <div id="jetra" class="tabcontent" style="display: none;">
                        <h3>Oboljenje jetre</h3>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Majka</h6>
                            <label for="f-option14" class="l-radio">
                                <input type="radio" id="f-option14" name="majka_jetra" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option14" class="l-radio">
                                <input type="radio" id="s-option14" name="majka_jetra" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Otac</h6>
                            <label for="f-option24" class="l-radio">
                                <input type="radio" id="f-option24" name="otac_jetra" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option24" class="l-radio">
                                <input type="radio" id="s-option24" name="otac_jetra" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Baba</h6>
                            <label for="f-option34" class="l-radio">
                                <input type="radio" id="f-option34" name="baba_jetra" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option34" class="l-radio">
                                <input type="radio" id="s-option34" name="baba_jetra" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option34" class="l-radio">
                                <input type="radio" id="t-option34" name="baba_jetra" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Deda</h6>
                            <label for="f-option44" class="l-radio">
                                <input type="radio" id="f-option44" name="deda_jetra" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option44" class="l-radio">
                                <input type="radio" id="s-option44" name="deda_jetra" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option44" class="l-radio">
                                <input type="radio" id="t-option44" name="deda_jetra" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Ujaci</h6>
                            <label for="f-option54" class="l-radio">
                                <input type="radio" id="f-option54" name="ujak_jetra" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option54" class="l-radio">
                                <input type="radio" id="s-option54" name="ujak_jetra" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option54" class="l-radio">
                                <input type="radio" id="t-option54" name="ujak_jetra" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option54" class="l-radio">
                                <input type="radio" id="4-option54" name="ujak_jetra" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Tetke</h6>
                            <label for="f-option64" class="l-radio">
                                <input type="radio" id="f-option64" name="tetka_jetra" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option64" class="l-radio">
                                <input type="radio" id="s-option64" name="tetka_jetra" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option64" class="l-radio">
                                <input type="radio" id="t-option64" name="tetka_jetra" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option64" class="l-radio">
                                <input type="radio" id="4-option64" name="tetka_jetra" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Braća</h6>
                            <label for="f-option74" class="l-radio">
                                <input type="radio" id="f-option74" name="brat_jetra" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option74" class="l-radio">
                                <input type="radio" id="s-option74" name="brat_jetra" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option74" class="l-radio">
                                <input type="radio" id="t-option74" name="brat_jetra" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option74" class="l-radio">
                                <input type="radio" id="4-option74" name="brat_jetra" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Sestre</h6>
                            <label for="f-option84" class="l-radio">
                                <input type="radio" id="f-option84" name="sestra_jetra" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option84" class="l-radio">
                                <input type="radio" id="s-option84" name="sestra_jetra" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option84" class="l-radio">
                                <input type="radio" id="t-option84" name="sestra_jetra" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option84" class="l-radio">
                                <input type="radio" id="4-option84" name="sestra_jetra" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>
                    </div>

                    <div id="reuma" class="tabcontent" style="display: none;">
                        <h3>Reumatske bolesti</h3>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Majka</h6>
                            <label for="f-option15" class="l-radio">
                                <input type="radio" id="f-option15" name="majka_reuma" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option15" class="l-radio">
                                <input type="radio" id="s-option15" name="majka_reuma" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Otac</h6>
                            <label for="f-option25" class="l-radio">
                                <input type="radio" id="f-option25" name="otac_reuma" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option25" class="l-radio">
                                <input type="radio" id="s-option25" name="otac_reuma" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Baba</h6>
                            <label for="f-option35" class="l-radio">
                                <input type="radio" id="f-option35" name="baba_reuma" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option35" class="l-radio">
                                <input type="radio" id="s-option35" name="baba_reuma" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option35" class="l-radio">
                                <input type="radio" id="t-option35" name="baba_reuma" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Deda</h6>
                            <label for="f-option45" class="l-radio">
                                <input type="radio" id="f-option45" name="deda_reuma" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option45" class="l-radio">
                                <input type="radio" id="s-option45" name="deda_reuma" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option45" class="l-radio">
                                <input type="radio" id="t-option45" name="deda_reuma" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Ujaci</h6>
                            <label for="f-option55" class="l-radio">
                                <input type="radio" id="f-option55" name="ujak_reuma" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option55" class="l-radio">
                                <input type="radio" id="s-option55" name="ujak_reuma" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option55" class="l-radio">
                                <input type="radio" id="t-option55" name="ujak_reuma" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option55" class="l-radio">
                                <input type="radio" id="4-option55" name="ujak_reuma" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Tetke</h6>
                            <label for="f-option65" class="l-radio">
                                <input type="radio" id="f-option65" name="tetka_reuma" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option65" class="l-radio">
                                <input type="radio" id="s-option65" name="tetka_reuma" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option65" class="l-radio">
                                <input type="radio" id="t-option65" name="tetka_reuma" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option65" class="l-radio">
                                <input type="radio" id="4-option65" name="tetka_reuma" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Braća</h6>
                            <label for="f-option75" class="l-radio">
                                <input type="radio" id="f-option75" name="brat_reuma" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option75" class="l-radio">
                                <input type="radio" id="s-option75" name="brat_reuma" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option75" class="l-radio">
                                <input type="radio" id="t-option75" name="brat_reuma" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option75" class="l-radio">
                                <input type="radio" id="4-option75" name="brat_reuma" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Sestre</h6>
                            <label for="f-option85" class="l-radio">
                                <input type="radio" id="f-option85" name="sestra_reuma" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option85" class="l-radio">
                                <input type="radio" id="s-option85" name="sestra_reuma" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option85" class="l-radio">
                                <input type="radio" id="t-option85" name="sestra_reuma" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option85" class="l-radio">
                                <input type="radio" id="4-option85" name="sestra_reuma" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>
                    </div>

                    <div id="pritisak" class="tabcontent" style="display: none;">
                        <h3>Visok pritisak</h3>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Majka</h6>
                            <label for="f-option16" class="l-radio">
                                <input type="radio" id="f-option16" name="majka_pritisak" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option16" class="l-radio">
                                <input type="radio" id="s-option16" name="majka_pritisak" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Otac</h6>
                            <label for="f-option26" class="l-radio">
                                <input type="radio" id="f-option26" name="otac_pritsak" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option26" class="l-radio">
                                <input type="radio" id="s-option26" name="otac_pritsak" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Baba</h6>
                            <label for="f-option36" class="l-radio">
                                <input type="radio" id="f-option36" name="baba_pritisak" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option36" class="l-radio">
                                <input type="radio" id="s-option36" name="baba_pritisak" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option36" class="l-radio">
                                <input type="radio" id="t-option36" name="baba_pritisak" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Deda</h6>
                            <label for="f-option46" class="l-radio">
                                <input type="radio" id="f-option46" name="deda_pritisak" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option46" class="l-radio">
                                <input type="radio" id="s-option46" name="deda_pritisak" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option46" class="l-radio">
                                <input type="radio" id="t-option46" name="deda_pritisak" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Ujaci</h6>
                            <label for="f-option56" class="l-radio">
                                <input type="radio" id="f-option56" name="ujak_pritisak" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option56" class="l-radio">
                                <input type="radio" id="s-option56" name="ujak_pritisak" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option56" class="l-radio">
                                <input type="radio" id="t-option56" name="ujak_pritisak" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option56" class="l-radio">
                                <input type="radio" id="4-option56" name="ujak_pritisak" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Tetke</h6>
                            <label for="f-option66" class="l-radio">
                                <input type="radio" id="f-option66" name="tetka_pritisak" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option66" class="l-radio">
                                <input type="radio" id="s-option66" name="tetka_pritisak" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option66" class="l-radio">
                                <input type="radio" id="t-option66" name="tetka_pritisak" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option66" class="l-radio">
                                <input type="radio" id="4-option66" name="tetka_pritisak" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Braća</h6>
                            <label for="f-option76" class="l-radio">
                                <input type="radio" id="f-option76" name="brat_pritisak" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option76" class="l-radio">
                                <input type="radio" id="s-option76" name="brat_pritisak" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option76" class="l-radio">
                                <input type="radio" id="t-option76" name="brat_pritisak" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option76" class="l-radio">
                                <input type="radio" id="4-option76" name="brat_pritisak" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Sestre</h6>
                            <label for="f-option86" class="l-radio">
                                <input type="radio" id="f-option86" name="sestra_pritisak" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option86" class="l-radio">
                                <input type="radio" id="s-option86" name="sestra_pritisak" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option86" class="l-radio">
                                <input type="radio" id="t-option86" name="sestra_pritisak" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option86" class="l-radio">
                                <input type="radio" id="4-option86" name="sestra_pritisak" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>
                    </div>

                    <div id="krv" class="tabcontent" style="display: none;">
                        <h3>Bolesti krvi</h3>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Majka</h6>
                            <label for="f-option17" class="l-radio">
                                <input type="radio" id="f-option17" name="majka_krv" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option17" class="l-radio">
                                <input type="radio" id="s-option17" name="majka_krv" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Otac</h6>
                            <label for="f-option27" class="l-radio">
                                <input type="radio" id="f-option27" name="otac_krv" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option27" class="l-radio">
                                <input type="radio" id="s-option27" name="otac_krv" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Baba</h6>
                            <label for="f-option37" class="l-radio">
                                <input type="radio" id="f-option37" name="baba_krv" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option37" class="l-radio">
                                <input type="radio" id="s-option37" name="baba_krv" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option37" class="l-radio">
                                <input type="radio" id="t-option37" name="baba_krv" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Deda</h6>
                            <label for="f-option47" class="l-radio">
                                <input type="radio" id="f-option47" name="deda_krv" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option47" class="l-radio">
                                <input type="radio" id="s-option47" name="deda_krv" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option47" class="l-radio">
                                <input type="radio" id="t-option47" name="deda_krv" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Ujaci</h6>
                            <label for="f-option57" class="l-radio">
                                <input type="radio" id="f-option57" name="ujak_krv" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option57" class="l-radio">
                                <input type="radio" id="s-option57" name="ujak_krv" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option57" class="l-radio">
                                <input type="radio" id="t-option57" name="ujak_krv" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option57" class="l-radio">
                                <input type="radio" id="4-option57" name="ujak_krv" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Tetke</h6>
                            <label for="f-option67" class="l-radio">
                                <input type="radio" id="f-option67" name="tetka_krv" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option67" class="l-radio">
                                <input type="radio" id="s-option67" name="tetka_krv" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option67" class="l-radio">
                                <input type="radio" id="t-option67" name="tetka_krv" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option67" class="l-radio">
                                <input type="radio" id="4-option67" name="tetka_krv" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Braća</h6>
                            <label for="f-option77" class="l-radio">
                                <input type="radio" id="f-option77" name="brat_krv" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option77" class="l-radio">
                                <input type="radio" id="s-option77" name="brat_krv" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option77" class="l-radio">
                                <input type="radio" id="t-option77" name="brat_krv" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option77" class="l-radio">
                                <input type="radio" id="4-option77" name="brat_krv" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Sestre</h6>
                            <label for="f-option87" class="l-radio">
                                <input type="radio" id="f-option87" name="sestra_krv" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option87" class="l-radio">
                                <input type="radio" id="s-option87" name="sestra_krv" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option87" class="l-radio">
                                <input type="radio" id="t-option87" name="sestra_krv" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option87" class="l-radio">
                                <input type="radio" id="4-option87" name="sestra_krv" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>
                    </div>

                    <div id="bubreg" class="tabcontent" style="display: none;">
                        <h3>Bolesti bubrega</h3>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Majka</h6>
                            <label for="f-option18" class="l-radio">
                                <input type="radio" id="f-option18" name="majka_bubreg" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option18" class="l-radio">
                                <input type="radio" id="s-option18" name="majka_bubreg" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Otac</h6>
                            <label for="f-option28" class="l-radio">
                                <input type="radio" id="f-option28" name="otac_bubreg" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option28" class="l-radio">
                                <input type="radio" id="s-option28" name="otac_bubreg" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Baba</h6>
                            <label for="f-option38" class="l-radio">
                                <input type="radio" id="f-option38" name="baba_bubreg" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option38" class="l-radio">
                                <input type="radio" id="s-option38" name="baba_bubreg" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option38" class="l-radio">
                                <input type="radio" id="t-option38" name="baba_bubreg" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Deda</h6>
                            <label for="f-option48" class="l-radio">
                                <input type="radio" id="f-option48" name="deda_bubreg" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option48" class="l-radio">
                                <input type="radio" id="s-option48" name="deda_bubreg" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option48" class="l-radio">
                                <input type="radio" id="t-option48" name="deda_bubreg" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Ujaci</h6>
                            <label for="f-option58" class="l-radio">
                                <input type="radio" id="f-option58" name="ujak_bubreg" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option58" class="l-radio">
                                <input type="radio" id="s-option58" name="ujak_bubreg" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option58" class="l-radio">
                                <input type="radio" id="t-option58" name="ujak_bubreg" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option58" class="l-radio">
                                <input type="radio" id="4-option58" name="ujak_bubreg" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Tetke</h6>
                            <label for="f-option68" class="l-radio">
                                <input type="radio" id="f-option68" name="tetka_bubreg" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option68" class="l-radio">
                                <input type="radio" id="s-option68" name="tetka_bubreg" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option68" class="l-radio">
                                <input type="radio" id="t-option68" name="tetka_bubreg" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option68" class="l-radio">
                                <input type="radio" id="4-option68" name="tetka_bubreg" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Braća</h6>
                            <label for="f-option78" class="l-radio">
                                <input type="radio" id="f-option78" name="brat_bubreg" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option78" class="l-radio">
                                <input type="radio" id="s-option78" name="brat_bubreg" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option78" class="l-radio">
                                <input type="radio" id="t-option78" name="brat_bubreg" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option78" class="l-radio">
                                <input type="radio" id="4-option78" name="brat_bubreg" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Sestre</h6>
                            <label for="f-option88" class="l-radio">
                                <input type="radio" id="f-option88" name="sestra_bubreg" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option88" class="l-radio">
                                <input type="radio" id="s-option88" name="sestra_bubreg" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option88" class="l-radio">
                                <input type="radio" id="t-option88" name="sestra_bubreg" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option88" class="l-radio">
                                <input type="radio" id="4-option88" name="sestra_bubreg" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>
                    </div>

                    <div id="pluca" class="tabcontent" style="display: none;">
                        <h3>Bolesti pluća</h3>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Majka</h6>
                            <label for="f-option19" class="l-radio">
                                <input type="radio" id="f-option19" name="majka_pluca" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option19" class="l-radio">
                                <input type="radio" id="s-option19" name="majka_pluca" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Otac</h6>
                            <label for="f-option29" class="l-radio">
                                <input type="radio" id="f-option29" name="otac_pluca" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option29" class="l-radio">
                                <input type="radio" id="s-option29" name="otac_pluca" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Baba</h6>
                            <label for="f-option39" class="l-radio">
                                <input type="radio" id="f-option39" name="baba_pluca" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option39" class="l-radio">
                                <input type="radio" id="s-option39" name="baba_pluca" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option39" class="l-radio">
                                <input type="radio" id="t-option39" name="baba_pluca" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Deda</h6>
                            <label for="f-option49" class="l-radio">
                                <input type="radio" id="f-option49" name="deda_pluca" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option49" class="l-radio">
                                <input type="radio" id="s-option49" name="deda_pluca" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option49" class="l-radio">
                                <input type="radio" id="t-option49" name="deda_pluca" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Ujaci</h6>
                            <label for="f-option59" class="l-radio">
                                <input type="radio" id="f-option59" name="ujak_pluca" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option59" class="l-radio">
                                <input type="radio" id="s-option59" name="ujak_pluca" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option59" class="l-radio">
                                <input type="radio" id="t-option59" name="ujak_pluca" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option59" class="l-radio">
                                <input type="radio" id="4-option59" name="ujak_pluca" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Tetke</h6>
                            <label for="f-option69" class="l-radio">
                                <input type="radio" id="f-option69" name="tetka_pluca" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option69" class="l-radio">
                                <input type="radio" id="s-option69" name="tetka_pluca" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option69" class="l-radio">
                                <input type="radio" id="t-option69" name="tetka_pluca" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option69" class="l-radio">
                                <input type="radio" id="4-option69" name="tetka_pluca" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Braća</h6>
                            <label for="f-option79" class="l-radio">
                                <input type="radio" id="f-option79" name="brat_pluca" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option79" class="l-radio">
                                <input type="radio" id="s-option79" name="brat_pluca" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option79" class="l-radio">
                                <input type="radio" id="t-option79" name="brat_pluca" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option79" class="l-radio">
                                <input type="radio" id="4-option79" name="brat_pluca" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Sestre</h6>
                            <label for="f-option89" class="l-radio">
                                <input type="radio" id="f-option89" name="sestra_pluca" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option89" class="l-radio">
                                <input type="radio" id="s-option89" name="sestra_pluca" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option89" class="l-radio">
                                <input type="radio" id="t-option89" name="sestra_pluca" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option89" class="l-radio">
                                <input type="radio" id="4-option89" name="sestra_pluca" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>
                    </div>

                    <div id="zlezda" class="tabcontent" style="display: none;">
                        <h3>Bolesti štitne žlezde</h3>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Majka</h6>
                            <label for="f-option10" class="l-radio">
                                <input type="radio" id="f-option10" name="majka_stitna" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option10" class="l-radio">
                                <input type="radio" id="s-option10" name="majka_stitna" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Otac</h6>
                            <label for="f-option20" class="l-radio">
                                <input type="radio" id="f-option20" name="otac_stitna" tabindex="1" value="0">
                                <span>Da</span>
                            </label>
                            <label for="s-option20" class="l-radio">
                                <input type="radio" id="s-option20" name="otac_stitna" tabindex="2" value="1" checked="checked">
                                <span>Ne</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Baba</h6>
                            <label for="f-option30" class="l-radio">
                                <input type="radio" id="f-option30" name="baba_stitna" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option30" class="l-radio">
                                <input type="radio" id="s-option30" name="baba_stitna" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option30" class="l-radio">
                                <input type="radio" id="t-option30" name="baba_stitna" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Deda</h6>
                            <label for="f-option40" class="l-radio">
                                <input type="radio" id="f-option40" name="deda_stitna" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option40" class="l-radio">
                                <input type="radio" id="s-option40" name="deda_stitna" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option40" class="l-radio">
                                <input type="radio" id="t-option40" name="deda_stitna" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                        </div>
                        <br>
                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Ujaci</h6>
                            <label for="f-option50" class="l-radio">
                                <input type="radio" id="f-option50" name="ujak_stitna" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option50" class="l-radio">
                                <input type="radio" id="s-option50" name="ujak_stitna" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option50" class="l-radio">
                                <input type="radio" id="t-option50" name="ujak_stitna" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option50" class="l-radio">
                                <input type="radio" id="4-option50" name="ujak_stitna" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Tetke</h6>
                            <label for="f-option60" class="l-radio">
                                <input type="radio" id="f-option60" name="tetka_stitna" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option60" class="l-radio">
                                <input type="radio" id="s-option60" name="tetka_stitna" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option60" class="l-radio">
                                <input type="radio" id="t-option60" name="tetka_stitna" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option60" class="l-radio">
                                <input type="radio" id="4-option60" name="tetka_stitna" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Braća</h6>
                            <label for="f-option70" class="l-radio">
                                <input type="radio" id="f-option70" name="brat_stitna" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option70" class="l-radio">
                                <input type="radio" id="s-option70" name="brat_stitna" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option70" class="l-radio">
                                <input type="radio" id="t-option70" name="brat_stitna" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option70" class="l-radio">
                                <input type="radio" id="4-option70" name="brat_stitna" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>

                        <div style="display: inline-block;">
                            <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">Sestre</h6>
                            <label for="f-option80" class="l-radio">
                                <input type="radio" id="f-option80" name="sestra_stitna" tabindex="1" value="0" checked="checked">
                                <span>0</span>
                            </label>
                            <label for="s-option80" class="l-radio">
                                <input type="radio" id="s-option80" name="sestra_stitna" tabindex="2" value="1">
                                <span>1</span>
                            </label>
                            <label for="t-option80" class="l-radio">
                                <input type="radio" id="t-option80" name="sestra_stitna" tabindex="3" value="2">
                                <span>2</span>
                            </label>
                            <label for="4-option80" class="l-radio">
                                <input type="radio" id="4-option80" name="sestra_stitna" tabindex="4" value="3">
                                <span>&gt;2</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary w-100 m-2" id="unesi">Unesi</button>

                    @else
                    <div class="alert alert-success fade show" role="alert" style="text-align: center;">
                        <i class="fa fa-exclamation-circle me-2"></i>Uspešno ste popunili podatke o porodici!
                    </div>
                    @endif
                </form>
            </div>
        </div>

        <div class="col-xl-6 col-sm-12" id="hrana" style="display:none;">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align:center">Hrana</h6>
                <form action="{{ route('hranaSrce.doctor') }}" method="POST">
                    @csrf
                    @if (empty($hrana))
                    <input type="text" class="form-control" id="floatingInput" name="id" value="{{$id}}" hidden="">
                    <input type="text" class="form-control" id="floatingInput" name="id_test" value="{{Session::get('ScreenIXID')}}" hidden="">
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="pice" name="pice" placeholder="pice">
                        <label for="pice">Koju količinu tečnosti svakodnevno konzumirate?(Lit)</label>
                    </div>
                    <div class="container-range">
                        <span>Koliko dana u nedelji konzumirate alkoholna pića?</span>
                        <input class="range" type="range" name="alkohol_ned" min="0" max="7" value="0" step="1" onload="rangevalue1.value=value" onmousemove="rangevalue1.value=value">
                        <output id="rangevalue1">1</output>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="alkoholizam">
                            <option selected="" disabled="">Izaberite</option>
                            <option value="0">Ne</option>
                            <option value="1">Da</option>
                        </select>
                        <label for="floatingSelect">Da li ste se nekada lečili od alkoholizma?</label>
                    </div>

                    <div class="container-range">
                        <span>Koliko dana u nedelji konzumirate gazirana pića?</span>
                        <input class="range" type="range" name="gazirana_ned" min="0" max="7" value="0" step="1" onload="rangevalue2.value=value" onmousemove="rangevalue2.value=value">
                        <output id="rangevalue2"></output>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="pice" name="gazirana" placeholder="pice">
                        <label for="pice">Koju količinu gaziranih pića konzumirate dnevno?(Lit)</label>
                    </div>

                    <div class="container-range">
                        <span>Koliko dana u nedelji konzumirate "crveno meso"?</span>
                        <input class="range" type="range" name="crveno_meso" min="0" max="7" value="0" step="1" onload="rangevalue3.value=value" onmousemove="rangevalue3.value=value">
                        <output id="rangevalue3"></output>
                    </div>

                    <div class="container-range">
                        <span>Koliko dana u nedelji konzumirate "belo meso"?</span>
                        <input class="range" type="range" name="belo_meso" min="0" max="7" value="0" step="1" onload="rangevalue4.value=value" onmousemove="rangevalue4.value=value">
                        <output id="rangevalue4"></output>
                    </div>

                    <div class="container-range">
                        <span>Koliko dana u nedelji konzumirate riblje meso?</span>
                        <input class="range" type="range" name="riba" min="0" max="7" value="0" step="1" onload="rangevalue5.value=value" onmousemove="rangevalue5.value=value">
                        <output id="rangevalue5"></output>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="vegan">
                            <option selected="" disabled="">Izaberite</option>
                            <option value="0">Vegeterijanac</option>
                            <option value="1">Vegan</option>
                            <option value="2">Ništa od ponudjenog</option>
                        </select>
                        <label for="floatingSelect">Da li ste vegeterijanac, vegan ili ništa od ponuđenog?</label>
                    </div>

                    <div class="container-range">
                        <span>Koliko dana u nedelji konzumirate SAMO povrće?</span>
                        <input class="range" type="range" name="povrce" min="0" max="7" value="0" step="1" onload="rangevalue6.value=value" onmousemove="rangevalue6.value=value">
                        <output id="rangevalue6"></output>
                    </div>

                    <div class="container-range">
                        <span>Koliko dana u nedelji konzumirate citrusno voće?</span>
                        <input class="range" type="range" name="citrusi" min="0" max="7" value="0" step="1" onload="rangevalue7.value=value" onmousemove="rangevalue7.value=value">
                        <output id="rangevalue7"></output>
                    </div>

                    <div class="container-range">
                        <span>Koliko dana u nedelji konzumirate druga voća? (bez citrusnih)</span>
                        <input class="range" type="range" name="voca" min="0" max="7" value="0" step="1" onload="rangevalue8.value=value" onmousemove="rangevalue8.value=value">
                        <output id="rangevalue8"></output>
                    </div>

                    <div class="container-range">
                        <span>Koliko dana u nedelji konzumirate bilo koju hranu koja sadrži šećer? (slatkiše, čokoladu, ...)</span>
                        <input class="range" type="range" name="secer" min="0" max="7" value="0" step="1" onload="rangevalue9.value=value" onmousemove="rangevalue9.value=value">
                        <output id="rangevalue9"></output>
                    </div>
                    <h6> Da li uzimate neke suplemente? </h6>
                    <div style="display: inline-block;">
                        <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">sa vitaminima</h6>
                        <label for="f-option1" class="l-radio">
                            <input type="radio" id="f-option1" name="vitamini" tabindex="1" value="0" checked="checked">
                            <span>Ne</span>
                        </label>
                        <label for="s-option1" class="l-radio">
                            <input type="radio" id="s-option1" name="vitamini" tabindex="2" value="1">
                            <span>Da</span>
                        </label>
                    </div>
                    <br>
                    <div style="display: inline-block;">
                        <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">sa mineralima</h6>
                        <label for="f-option2" class="l-radio">
                            <input type="radio" id="f-option2" name="minerali" tabindex="1" value="0" checked="checked">
                            <span>Ne</span>
                        </label>
                        <label for="s-option2" class="l-radio">
                            <input type="radio" id="s-option2" name="minerali" tabindex="2" value="1">
                            <span>Da</span>
                        </label>
                    </div>
                    <br>
                    <div style="display: inline-block;">
                        <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">dijetalne</h6>
                        <label for="f-option3" class="l-radio">
                            <input type="radio" id="f-option3" name="dijetalni" tabindex="1" value="0" checked="checked">
                            <span>Ne</span>
                        </label>
                        <label for="s-option3" class="l-radio">
                            <input type="radio" id="s-option3" name="dijetalni" tabindex="2" value="1">
                            <span>Da</span>
                        </label>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary w-100 m-2" id="unesi">Unesi</button>
                    @else
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="pice" name="pice" placeholder="pice" value="{{$hrana->tecnost}}" disabled>
                        <label for="pice">Koju količinu tečnosti svakodnevno konzumirate?(Lit)</label>
                    </div>
                    <div class="container-range">
                        <span>Koliko dana u nedelji konzumirate alkoholna pića?</span>
                        <input class="range" type="range" name="alkohol_ned" min="0" max="7" value="{{$hrana->alkohol}}" step="1" onload="rangevalue1.value=value" onmousemove="rangevalue1.value=value" disabled>
                        <output id="rangevalue1">1</output>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="alkoholizam" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($hrana->alkoholizam == 0)
                            <option value="0" selected="">Ne</option>
                            @else
                            <option value="1" selected="">Da</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Da li ste se nekada lečili od alkoholizma?</label>
                    </div>

                    <div class="container-range">
                        <span>Koliko dana u nedelji konzumirate gazirana pića?</span>
                        <input class="range" type="range" name="gazirana_ned" min="0" max="7" value="{{$hrana->gazirana}}" step="1" onload="rangevalue2.value=value" onmousemove="rangevalue2.value=value" disabled>
                        <output id="rangevalue2"></output>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="pice" name="gazirana" placeholder="pice" value="{{$hrana->kolicina_gaziranih}}" disabled>
                        <label for="pice">Koju količinu gaziranih pića konzumirate dnevno?(Lit)</label>
                    </div>

                    <div class="container-range">
                        <span>Koliko dana u nedelji konzumirate "crveno meso"?</span>
                        <input class="range" type="range" name="crveno_meso" min="0" max="7" value="{{$hrana->crveno_meso}}" step="1" onload="rangevalue3.value=value" onmousemove="rangevalue3.value=value" disabled>
                        <output id="rangevalue3"></output>
                    </div>

                    <div class="container-range">
                        <span>Koliko dana u nedelji konzumirate "belo meso"?</span>
                        <input class="range" type="range" name="belo_meso" min="0" max="7" value="{{$hrana->belo_meso}}" step="1" onload="rangevalue4.value=value" onmousemove="rangevalue4.value=value" disabled>
                        <output id="rangevalue4"></output>
                    </div>

                    <div class="container-range">
                        <span>Koliko dana u nedelji konzumirate riblje meso?</span>
                        <input class="range" type="range" name="riba" min="0" max="7" value="{{$hrana->riblje_meso}}" step="1" onload="rangevalue5.value=value" onmousemove="rangevalue5.value=value" disabled>
                        <output id="rangevalue5"></output>
                    </div>

                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="vegan" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($hrana->vegan == 0)
                            <option value="0" selected="">Vegeterijanac</option>
                            @elseif ($hrana->vegan == 1)
                            <option value="1" selected="">Vegan</option>
                            @else
                            <option value="2" selected="">Ništa od ponudjenog</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Da li ste vegeterijanac, vegan ili ništa od ponuđenog?</label>
                    </div>

                    <div class="container-range">
                        <span>Koliko dana u nedelji konzumirate SAMO povrće?</span>
                        <input class="range" type="range" name="povrce" min="0" max="7" value="{{$hrana->riblje_meso}}" step="1" onload="rangevalue6.value=value" onmousemove="rangevalue6.value=value" disabled>
                        <output id="rangevalue6"></output>
                    </div>

                    <div class="container-range">
                        <span>Koliko dana u nedelji konzumirate citrusno voće?</span>
                        <input class="range" type="range" name="citrusi" min="0" max="7" value="{{$hrana->citrusno_voce}}" step="1" onload="rangevalue7.value=value" onmousemove="rangevalue7.value=value" disabled>
                        <output id="rangevalue7"></output>
                    </div>

                    <div class="container-range">
                        <span>Koliko dana u nedelji konzumirate druga voća? (bez citrusnih)</span>
                        <input class="range" type="range" name="voca" min="0" max="7" value="{{$hrana->druga_voca}}" step="1" onload="rangevalue8.value=value" onmousemove="rangevalue8.value=value" disabled>
                        <output id="rangevalue8"></output>
                    </div>

                    <div class="container-range">
                        <span>Koliko dana u nedelji konzumirate bilo koju hranu koja sadrži šećer? (slatkiše, čokoladu, ...)</span>
                        <input class="range" type="range" name="secer" min="0" max="7" value="{{$hrana->slatkisi}}" step="1" onload="rangevalue9.value=value" onmousemove="rangevalue9.value=value" disabled>
                        <output id="rangevalue9"></output>
                    </div>
                    <h6> Da li uzimate neke suplemente? </h6>
                    <div style="display: inline-block;">
                        <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">sa vitaminima</h6>
                        <label for="f-option1" class="l-radio">
                            <input type="radio" id="f-option1" name="vitamini" tabindex="1" value="0" {{($hrana->vitamini == 0) ? "checked" : ""}} disabled>
                            <span>Ne</span>
                        </label>
                        <label for="s-option1" class="l-radio">
                            <input type="radio" id="s-option1" name="vitamini" tabindex="2" value="1" {{($hrana->vitamini == 1) ? "checked" : ""}} disabled>
                            <span>Da</span>
                        </label>
                    </div>
                    <br>
                    <div style="display: inline-block;">
                        <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">sa mineralima</h6>
                        <label for="f-option2" class="l-radio">
                            <input type="radio" id="f-option2" name="minerali" tabindex="1" value="0" {{($hrana->minerali == 0) ? "checked" : ""}} disabled>
                            <span>Ne</span>
                        </label>
                        <label for="s-option2" class="l-radio">
                            <input type="radio" id="s-option2" name="minerali" tabindex="2" value="1" {{($hrana->minerali == 1) ? "checked" : ""}} disabled>
                            <span>Da</span>
                        </label>
                    </div>
                    <br>
                    <div style="display: inline-block;">
                        <h6 style="vertical-align: middle; padding: 6px; display: inline-block;">dijetalne</h6>
                        <label for="f-option3" class="l-radio">
                            <input type="radio" id="f-option3" name="dijetalni" tabindex="1" value="0" {{($hrana->dijetalne == 0) ? "checked" : ""}} disabled>
                            <span>Ne</span>
                        </label>
                        <label for="s-option3" class="l-radio">
                            <input type="radio" id="s-option3" name="dijetalni" tabindex="2" value="1" {{($hrana->dijetalne == 1) ? "checked" : ""}} disabled>
                            <span>Da</span>
                        </label>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary w-100 m-2" id="unesi" disabled>Unesi</button>
                    @endif
                </form>
            </div>
        </div>

        <div class="col-xl-6 col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align:center">Rizici posle trećeg koraka <i class="fa-solid fa-heart-circle-exclamation"></i></h6>
                <br>
                @if (!empty($navike))
                <div id="navikeRizik"></div>
                @else
                <div class="alert alert-warning fade show" role="alert" style="text-align: center;">
                    <i class="fa fa-exclamation-circle me-2"></i>Prvo popunite polja za navike!
                </div>
                @endif
                <br>
                @if (!empty($posao))
                <div id="posaoRizik"></div>
                @else
                <div class="alert alert-warning fade show" role="alert" style="text-align: center;">
                    <i class="fa fa-exclamation-circle me-2"></i>Prvo popunite polja za posao!
                </div>
                @endif
                <br>
                @if ($rizikPorodica->korak3_3 != 0)
                <div id="porodicaRizik"></div>
                @else
                <div class="alert alert-warning fade show" role="alert" style="text-align: center;">
                    <i class="fa fa-exclamation-circle me-2"></i>Prvo popunite polja za porodicu!
                </div>
                @endif
                <br>
                @if (!empty($hrana))
                <div id="hranaRizik"></div>
                @else
                <div class="alert alert-warning fade show" role="alert" style="text-align: center;">
                    <i class="fa fa-exclamation-circle me-2"></i>Prvo popunite polja za hranu!
                </div>
                @endif
            </div>
        </div>

        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                @if (!empty($rizikNavike) && !empty($rizikPosao) && !empty($rizikPorodica) && !empty($rizikHrana))
                <a href="{{ route('izvestajSrce.doctor', [$id]) }}"><button class="btn btn-primary w-100">Sledeći korak <i class="fa-solid fa-chevron-right"></i></button></a>
                @else
                <button class="btn btn-primary w-100" disabled>Sledeći korak <i class="fa-solid fa-chevron-right"></i></button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection