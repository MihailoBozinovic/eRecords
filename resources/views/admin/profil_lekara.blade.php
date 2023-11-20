@extends('layout.pages')

@section('title', 'Profil lekara | '.$lekar->name.' '.$lekar->surname)

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
                <div class="testimonial-item text-center">
                    <img class="img-fluid rounded-circle mx-auto mb-4" src="{{ asset('img/doctor.png') }}" style="width: 100px; height: 100px;">
                    <h5 class="mb-1">{{ $data->name }} {{ $data->surname }}</h5>
                    <p class="mb-0"><i class="fa-solid fa-at"></i> E-mail: {{ $data->email }}</p>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align:center;">Opcije</h6>
            </div>
        </div>
    </div>
</div>
@endsection