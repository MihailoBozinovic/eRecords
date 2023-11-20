@extends('layout.pages')

@section('title', 'Početna')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="testimonial-item text-center">
                    <img class="img-fluid mx-auto mb-4" src="{{ asset('img/newDoctor.png') }}" style="width: 100px; height: 100px;">
                    <h5 class="mb-1" id="novi">Novi lekar</h5>
                    <a href="{{ route('dodaj_lekara.admin') }}">
                        <button class="btn btn-primary w-100 m-2" type="button" id="izaberite">Izaberite</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="testimonial-item text-center">
                    <img class="img-fluid mx-auto mb-4" src="{{ asset('img/hospital.png') }}" style="width: 100px; height: 100px;">
                    <h5 class="mb-1" id="novi">Moja klinika</h5>
                    <a href="{{ route('klinika.admin') }}">
                        <button class="btn btn-primary w-100 m-2" type="button" id="izaberite">Izaberite</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection