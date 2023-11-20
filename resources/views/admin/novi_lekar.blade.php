@extends('layout.pages')

@section('title', 'Novi lekar')

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
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align: center;">Novi lekar</h6>
                <form action="{{ route('unos_lekara.admin') }}" method="POST">
                    @csrf
                    <sup style="color: red">@error('ime') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="ime" value="{{old('ime')}}">
                        <label for="floatingInput">Ime</label>
                    </div>
                    <sup style="color: red">@error('prezime') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="prezime" value="{{old('prezime')}}">
                        <label for="floatingInput">Prezime</label>
                    </div>
                    <sup style="color: red">@error('email') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="{{old('email')}}">
                        <label for="floatingInput">E-mail adresa</label>
                    </div>
                    <sup style="color: red">@error('jmbg') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="jmbg" value="{{old('jmbg')}}">
                        <label for="floatingInput">JMBG</label>
                    </div>

                    <button class="btn btn-primary w-100" type="submit">Unesite podatke</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection