@extends('layout.doclayout')

@section('title', 'Vaš profil')

@section('content')

@if(Session::has('sifra_success'))
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align: center;">
            <i class="fa fa-exclamation-circle me-2"></i>{{Session::get('sifra_success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</div>
@endif
<!-- Navbar End -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="testimonial-item text-center">
                    <img class="img-fluid rounded-circle mx-auto mb-4" src="{{ asset('img/user.png') }}" style="width: 100px; height: 100px;">

                    <h5 class="mb-1">{{ $data->name }} {{ $data->surname }}</h5>
                    <p class="mb-0"><i class="fa-solid fa-at"></i> E-mail: {{ $data->email }}</p>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <button class="btn btn-primary w-100" type="button" onclick="otvoriDiv();">Promeni šifru</button>
            </div>
        </div>
        <div class="col-12" id="promena_sifre" style="display:none">
            <div class="bg-light rounded h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-1">Promena šifre</h6>
                    <button class="btn btn-danger" onclick="zatvoriDiv();"><i class="fa-solid fa-xmark"></i></button>
                </div>
                @if(Session::has('sifra_fail'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align: center;">
                    <i class="fa fa-exclamation-circle me-2"></i>{{Session::get('sifra_fail')}}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif
                <form action="{{ route('promeniSifru.doctor') }}" method="POST">
                    @csrf
                    <sup style="color:red;">@error('sifra') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="stara_sifra" onkeyup="staraSifra();" name="sifra" placeholder="name@example.com">
                        <label for="floatingInput"><i class="fa-solid fa-key me-2"></i> Stara šifra</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="nova_sifra" name="nova" placeholder="name@example.com">
                        <label for="floatingInput"><i class="fa-solid fa-key me-2"></i> Nova šifra</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="sifra_confirm" name="confirm" onkeyup="proveriSifru();" placeholder="name@example.com">
                        <label for="floatingInput"><i class="fa-solid fa-key me-2"></i> Potvrda nove šifre <span id="potvrda_sifre"></span></label>
                    </div>
                    <button class="btn btn-primary w-100" disabled type="submit" id="potvrdi">Potvrdi</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection