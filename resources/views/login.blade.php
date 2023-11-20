@extends('layout.app')

@section('title', 'Prijava')

@section('content')
<!-- Sign In Start -->
<div class="container-fluid">
    <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
        <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
            <div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
                <div class="alert alert-info show" role="alert" style="text-align: center;">
                    <i class="fa fa-exclamation-circle me-2"></i>Dobro došli na eKarton 2.0
                </div>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <a href="/" class="">
                        <h3 class="text-primary"><i class="fa-solid fa-hand-holding-medical me-2"></i>eKarton</h3>
                    </a>
                    <h4 class="text-primary"><i class="fa-solid fa-arrow-right-to-bracket"></i></h4>
                </div>
                <form action="{{ route('form.login') }}" method="post">
                    @if(Session::has('fail'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align: center;">
                        <i class="fa fa-exclamation-circle me-2"></i>{{Session::get('fail')}}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    @csrf
                    <sup style="color: red">@error('email') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com" value="{{old('email')}}">
                        <label for="floatingInput"><i class="fa-solid fa-at me-2"></i> E-mail adresa</label>
                    </div>
                    <sup style="color: red">@error('password') {{$message}} @enderror</sup>
                    <div class="form-floating mb-4">
                        <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
                        <label for="floatingPassword"><i class="fa-solid fa-key me-2"></i> Šifra</label>
                    </div>
                    <button type="submit" class="btn btn-primary py-3 w-100 mb-4" name="submit">Prijavi se <i class="fa-solid fa-right-to-bracket"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Sign In End -->
@endsection