@extends('layout.doclayout')

@section('title', 'Srce | Korak 2')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <a href="#" style="pointer-events: none;"><button class="btn btn-success">1</button></a>
                    @if (empty($posete))
                    <a href="#" style="pointer-events: none;"><button class="btn btn-primary">2</button></a>
                    @else
                    <a href="#" style="pointer-events: none;"><button class="btn btn-success">2</button></a>
                    @endif
                    <a href="#" style="pointer-events: none;"><button class="btn btn-secondary" disabled>3</button></a>
                    <a href="#" style="pointer-events: none;"><button class="btn btn-secondary" disabled><i class="fa-regular fa-id-card"></i></button></a>
                    <a href="#" style="pointer-events: none;"><button class="btn btn-secondary" disabled>4</button></a>
                    <a href="#" style="pointer-events: none;"><button class="btn btn-secondary" disabled>5</button></a>
                    <a href="#" style="pointer-events: none;"><button class="btn btn-secondary" disabled><i class="fa-solid fa-file-medical"></i></button></a>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align:center">Drugi korak</h6>
                <form action="{{ route('korak2Forma.doctor') }}" method="POST">
                    @csrf
                    @if (empty($parametri))
                    <input type="text" class="form-control" id="floatingInput" name="id" value="{{$id}}" hidden="">
                    <input type="text" class="form-control" id="floatingInput" name="id_test" value="{{Session::get('ScreenIXID')}}" hidden="">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="sistolni" placeholder="name@example.com">
                        <label for="floatingInput">Sistolni pritisak (mmHg)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingPassword" placeholder="Password" name="dijastolni">
                        <label for="floatingPassword">Dijastolni pritisak (mmHg)</label>
                    </div>
                    @else
                    <input type="text" class="form-control" id="floatingInput" name="id" value="{{$id}}" hidden="">
                    <input type="text" class="form-control" id="floatingInput" name="id_test" value="{{Session::get('ScreenIXID')}}" hidden="">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" value="{{$parametri->s_pritisak}}" name="sistolni" placeholder="name@example.com" readonly>
                        <label for="floatingInput">Sistolni pritisak (mmHg)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingPassword" value="{{$parametri->d_pritisak}}" placeholder="Password" name="dijastolni" readonly>
                        <label for="floatingPassword">Dijastolni pritisak (mmHg)</label>
                    </div>
                    @endif

                    @if (empty($posete))
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="last">
                            <option disabled="" selected="">Izaberite</option>
                            <option value="-1">Nikad pre</option>
                            <option value="0">Ne secam se</option>
                            <option value="1">Pre mesec dana</option>
                            <option value="2">Pre dva meseca</option>
                            <option value="3">Pre tri meseca</option>
                            <option value="4">Pre četiri meseca</option>
                            <option value="5">Pre pet meseci</option>
                            <option value="6">Pre šest meseci</option>
                            <option value="7">Pre sedam meseci</option>
                            <option value="8">Pre osam meseci</option>
                            <option value="9">Pre devet meseci</option>
                            <option value="10">Pre deset meseci</option>
                            <option value="11">Pre jedanaest meseci</option>
                            <option value="12">Pre dvanaest meseci</option>
                        </select>
                        <label for="floatingSelect">Kada ste poslednji put bili kod lekara?</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="frequency">
                            <option disabled="" selected="">Izaberite</option>
                            <option value="-1">Nikad pre</option>
                            <option value="0">Manje od dva puta godišnje</option>
                            <option value="1">Jednom godišnje</option>
                            <option value="2">Dva puta godišnje</option>
                            <option value="3">Tri puta godišnje</option>
                            <option value="4">Četiri puta godišnje</option>
                            <option value="5">Pet puta godišnje</option>
                            <option value="6">Šest puta godišnje</option>
                        </select>
                        <label for="floatingSelect">Koliko puta godišnje posetite lekara?</label>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-100 m-2" id="unesi">Unesi</button>
                    @else
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="last" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($posete->poslednja_poseta == -1)
                            <option value="-1" selected>Nikad pre</option>
                            @elseif ($posete->poslednja_poseta == 0)
                            <option value="0" selected>Ne secam se</option>
                            @elseif ($posete->poslednja_poseta == 1)
                            <option value="1" selected>Pre mesec dana</option>
                            @elseif ($posete->poslednja_poseta == 2)
                            <option value="2" selected>Pre dva meseca</option>
                            @elseif ($posete->poslednja_poseta == 3)
                            <option value="3" selected>Pre tri meseca</option>
                            @elseif ($posete->poslednja_poseta == 4)
                            <option value="4" selected>Pre četiri meseca</option>
                            @elseif ($posete->poslednja_poseta == 5)
                            <option value="5" selected>Pre pet meseci</option>
                            @elseif ($posete->poslednja_poseta == 6)
                            <option value="6" selected>Pre šest meseci</option>
                            @elseif ($posete->poslednja_poseta == 7)
                            <option value="7" selected>Pre sedam meseci</option>
                            @elseif ($posete->poslednja_poseta == 8)
                            <option value="8" selected>Pre osam meseci</option>
                            @elseif ($posete->poslednja_poseta == 9)
                            <option value="9" selected>Pre devet meseci</option>
                            @elseif ($posete->poslednja_poseta == 10)
                            <option value="10" selected>Pre deset meseci</option>
                            @elseif ($posete->poslednja_poseta == 11)
                            <option value="11" selected>Pre jedanaest meseci</option>
                            @else
                            <option value="12" selected>Pre dvanaest meseci</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Kada ste poslednji put bili kod lekara?</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="frequency" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($posete->godisnja_poseta == -1)
                            <option value="-1" selected>Nikad pre</option>
                            @elseif ($posete->godisnja_poseta == 0)
                            <option value="0" selected>Manje od dva puta godišnje</option>
                            @elseif ($posete->godisnja_poseta == 1)
                            <option value="1" selected>Jednom godišnje</option>
                            @elseif ($posete->godisnja_poseta == 2)
                            <option value="2" selected>Dva puta godišnje</option>
                            @elseif ($posete->godisnja_poseta == 3)
                            <option value="3" selected>Tri puta godišnje</option>
                            @elseif ($posete->godisnja_poseta == 4)
                            <option value="4" selected>Četiri puta godišnje</option>
                            @elseif ($posete->godisnja_poseta == 5)
                            <option value="5" selected>Pet puta godišnje</option>
                            @else
                            <option value="6" selected>Šest puta godišnje</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Koliko puta godišnje posetite lekara?</label>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-100 m-2" id="unesi" disabled>Unesi</button>
                    @endif
                </form>
            </div>
        </div>
        <div class="col-xl-6 col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align:center">Rizik posle drugog koraka <i class="fa-solid fa-heart-circle-exclamation"></i></h6>
                @if (!empty($parametri))
                <div class="d-flex align-items-center py-3">
                    <div class="container-progress">
                        <div class="circular-progress">
                            <span class="progress-value">0%</span>
                        </div>
                    </div>
                </div>
                @else
                <div class="alert alert-danger fade show" role="alert" style="text-align: center;">
                    <i class="fa fa-exclamation-circle me-2"></i>Prvo popunite sva potrebna polja!
                </div>
                @endif
            </div>
        </div>

        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                @if (!empty($posete))
                <a href="{{ route('korak3Srce.doctor', [$id]) }}"><button class="btn btn-primary w-100">Sledeći korak <i class="fa-solid fa-chevron-right"></i></button></a>
                @else
                <button class="btn btn-primary w-100" disabled>Sledeći korak <i class="fa-solid fa-chevron-right"></i></button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection