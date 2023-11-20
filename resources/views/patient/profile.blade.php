@extends('layout.user')

@section('title', 'Profil')

@section('content')

@if(Session::has('success'))
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-align: center;">
            <i class="fa fa-exclamation-circle me-2"></i>{{Session::get('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</div>
@endif
@if(Session::has('fail'))
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align: center;">
            <i class="fa fa-exclamation-circle me-2"></i>{{Session::get('fail')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</div>
@endif
<!-- Navbar End -->
@foreach ($pacijent as $pacijent)
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
                </div>
                <div class="d-flex align-items-center border-bottom py-3">
                    <img class="flex-shrink-0" src="{{ asset('img/warning.png') }}" alt="" style="width: 40px; height: 40px;">
                    <div class="w-100 ms-3">
                        <div class="d-flex w-100 justify-content-between">
                            <h6 class="mb-0" style="color: red;">Alergije</h6>
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
            <h6 style="text-align: center" class="mb-4" id="spisak">Informacije</h6>
            <div class="m-n2">
                <a href="{{ route('istorijaPregleda.patient') }}"><button class="btn btn-primary w-100 m-2" type="button">Istorija pregleda</button></a>
                <a href="#"><button class="btn btn-primary w-100 m-2" type="button">Dijagnoze</button></a>
                <a href="{{ route('terapije.patient') }}"><button class="btn btn-primary w-100 m-2" type="button">Terapije</button></a>
                <a href="{{ route('radioloskeSlike.patient') }}"><button class="btn btn-primary w-100 m-2" type="button">Radiološke slike</button></a>
                <a href="{{ route('nalaziLaboratorija.patient') }}"><button class="btn btn-primary w-100 m-2" type="button">Nalazi iz laboratorije</button></a>
                <a href="#"><button class="btn btn-primary w-100 m-2" type="button">Beleške</button></a>
            </div>
        </div>
    </div>
</div>
<!-- DODATNE INFORMACIJE -->

<!-- SCREENIX PROCENE -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12">
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
    </div>
</div>
<!-- SCREENIX PROCENE -->
@endforeach
@endsection