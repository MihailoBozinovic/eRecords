@extends('layout.doclayout')

@section('title', 'Profil Pacijenta')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <!-- PROFIL -->
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="testimonial-item text-center">
                    @if ($pacijent->pol == 1)
                    <img class="img-fluid rounded-circle mx-auto mb-4" src="{{ asset('img/man.png') }}" style="width: 100px; height: 100px;">
                    @else
                    <img class="img-fluid rounded-circle mx-auto mb-4" src="{{ asset('img/woman.png') }}" style="width: 100px; height: 100px;">
                    @endif
                    <h5 class="mb-1">{{ $pacijent->ime }} {{ $pacijent->prezime }}</h5>
                    <p>{{ $pacijent->zanimanje }}</p>
                    <p class="mb-0"><i class="fa-solid fa-mobile"></i> Telefon: <a href="tel:{{$pacijent->telefon}}">{{ $pacijent->telefon }}</a></p>
                    <p class="mb-0"><i class="fa-solid fa-at"></i> E-mail: <a href="mailto:{{$pacijent->email}}">{{ $pacijent->email }}</a></p>
                </div>
            </div>
        </div>
        <!-- PROFIL KRAJ -->
        <!-- PODACI -->
        <div class="col-12">
            <div class="h-100 bg-light rounded p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0">Podaci o pacijentu</h6>
                    <a href="{{ route('update_patient.doctor', ['id' => $pacijent->id]) }}"><i class="fa-regular fa-pen-to-square"></i></a>
                </div>
                <div class="d-flex align-items-center border-bottom py-3">
                    <img class="flex-shrink-0" src="{{ asset('img/warning.png') }}" alt="" style="width: 40px; height: 40px;">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0" style="color: red;">Alergije</h6><i class="fa-solid fa-triangle-exclamation text-danger"></i>
                        </div>
                        @if (empty($pacijent->alergije))
                        <span>Nema alergija!</span>
                        @else
                        <span>{{$pacijent->alergije}}</span>
                        @endif
                    </div>
                </div>
                <div class="d-flex align-items-center border-bottom py-3">
                    <img class="flex-shrink-0" src="{{ asset('img/address.png') }}" alt="" style="width: 40px; height: 40px;">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0" id="adresa">Adresa</h6><i class="fa-solid fa-location-dot"></i>
                        </div>
                        <span>{{ $pacijent->adresa}}</span>
                    </div>
                </div>
                <div class="d-flex align-items-center border-bottom py-3">
                    <img class="flex-shrink-0" src="{{ asset('img/sex.png') }}" alt="" style="width: 40px; height: 40px;">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0">Pol</h6><i class="fa-solid fa-venus-mars"></i>
                        </div>
                        @if ($pacijent->pol == 1)
                        <span>Muški</span>
                        @else
                        <span>Ženski</span>
                        @endif
                    </div>
                </div>
                <div class="d-flex align-items-center border-bottom py-3">
                    <img class=" flex-shrink-0" src="{{ asset('img/erythrocytes.png') }}" alt="" style="width: 40px; height: 40px;">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0" id="krvna_grupa">Krvna grupa</h6><i class="fa-solid fa-fire-flame-simple"></i>
                        </div>
                        <span>{{ $pacijent->krvna_grupa }}</span>
                    </div>
                </div>
                <div class="d-flex align-items-center border-bottom py-3">
                    <img class="rounded-circle flex-shrink-0" src="{{ asset('img/date-of-birth.png') }}" alt="" style="width: 40px; height: 40px;">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0" id="datum">Datum rođenja</h6><i class="fa-solid fa-calendar"></i>
                        </div>
                        <span>{{ $pacijent->datum_rodjenja }}</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- PODACI KRAJ -->
    </div>
</div>

<!-- DODATNE INFORMACIJE -->
<div class="container-fluid pt-4 px-4">
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 style="text-align: center" class="mb-4" id="spisak">Informacije <i class="fa-solid fa-info"></i></h6>
            <div class="m-n2">
                <a href="{{ route('istorija_pregleda.doctor', [$pacijent->id]) }}"><button class="btn btn-primary w-100 m-2" type="button" id='istorija_pregleda'>Istorija pregleda <i class="fa-solid fa-clock-rotate-left"></i></button></a>
                <a href="{{ route('dijagnoze.doctor', [$pacijent->id]) }}"><button class="btn btn-primary w-100 m-2" type="button">Dijagnoze <i class="fa-solid fa-disease"></i></button></a>
                <a href="{{ route('terapije.doctor', [$pacijent->id]) }}"><button class="btn btn-primary w-100 m-2" type="button">Terapije <i class="fa-solid fa-prescription-bottle-medical"></i></button></a>
                <a href="{{ route('radioloskeSlike.doctor', [$pacijent->id]) }}"><button class="btn btn-primary w-100 m-2" type="button">Radiološke slike <i class="fa-solid fa-file-waveform"></i></button></a>
                <a href="{{ route('nalazi.doctor', [$pacijent->id]) }}"><button class="btn btn-primary w-100 m-2" type="button">Nalazi iz laboratorije <i class="fa-solid fa-heart-pulse"></i></button></a>
                <a href="#"><button class="btn btn-primary w-100 m-2" type="button">Beleške <i class="fa-solid fa-note-sticky"></i></button></a>
            </div>
        </div>
    </div>
</div>
<!-- DODATNE INFORMACIJE -->

<!-- SCREENIX PROCENE SRCE -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0">Rizik od srčanog udara</h6><a href="#">ScreenIX by BRI</a>
                </div>
                <div class="d-flex align-items-center py-3">
                    <div class="container-progress">
                        <div class="circular-progress">
                            <span class="progress-value">0%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0">Rizik od raka debelog creva</h6><a href="#">ScreenIX by BRI</a>
                </div>
                <div class="d-flex align-items-center py-3">
                    <div class="container-progress">
                        <div class="circular-progress">
                            <span class="progress-value">0%</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- SCREENIX PROCENE SRCE -->

<!-- DODATNE INFORMACIJE -->
<div class="container-fluid pt-4 px-4">
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 style="text-align: center" class="mb-4" id="spisak">Dodatne opcije</h6>
            <div class="m-n2">
                <a href="{{ route('kontaktPacijenta.doctor', [$pacijent->id]) }}"><button class="btn btn-primary w-100 m-2" type="button">Kontakt <i class="fa-solid fa-address-book"></i></button></a>
                <button type="button" class="btn btn-danger w-100 m-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Obrišite karton <i class="fa-solid fa-trash-can"></i>
                </button>
                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Brisanje kartona</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Da li ste sigurni da želite da obrišete karton ovog pacijenta?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-success" data-bs-dismiss="modal">Otkaži</button>
                                <form action="{{route('brisanje_pacijenta.doctor', [$pacijent->id])}}" method="POST">
                                    @csrf
                                    <button type="submit" class='btn btn-danger'>
                                        Obriši karton <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- DODATNE INFORMACIJE -->
@endsection