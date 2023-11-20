@extends('layout.doclayout')

@section('title', 'Debelo crevo | Početna')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="testimonial-item text-center">
                    <img class="img-fluid mx-auto mb-4" src="{{ asset('img/add_user.png') }}" style="width: 100px; height: 100px;">
                    <h5 class="mb-1" id="srce">Novi test</h5>
                    <a href="{{ route('debeloCrevoNoviTest.doctor') }}">
                        <button class="btn btn-primary w-100 m-2" type="button" id="izaberite">Izaberite <i class="fa-solid fa-arrow-pointer"></i></button>
                    </a>
                </div>
            </div>
        </div>
        <!-- TODO -->
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="testimonial-item text-center">
                    <img class="img-fluid mx-auto mb-4" src="{{ asset('img/report.png') }}" style="width: 100px; height: 100px;">
                    <h5 class="mb-1" id="crevo">Izveštaji</h5>
                    <a href="{{ route('debeloCrevoIzvestaji.doctor') }}">
                        <button class="btn btn-primary w-100 m-2" type="button" id="izaberite4">Izaberite <i class="fa-solid fa-arrow-pointer"></i></button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection