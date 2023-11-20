@extends('layout.doclayout')

@section('title', 'ScreenIX | Početna')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="testimonial-item text-center">
                    <img class="img-fluid mx-auto mb-4" src="{{ asset('img/heart.png') }}" style="width: 100px; height: 100px;">
                    <h5 class="mb-1" id="srce">Predikcija bolesti srca</h5>
                    <a href="{{ route('srcePocetna.doctor') }}">
                        <button class="btn btn-primary w-100 m-2" type="button" id="izaberite">Izaberite <i class="fa-solid fa-arrow-pointer"></i></button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="testimonial-item text-center">
                    <img class="img-fluid mx-auto mb-4" src="{{ asset('img/colon.png') }}" style="width: 100px; height: 100px;">
                    <h5 class="mb-1" id="crevo">Predikcija raka debelog creva</h5>
                    <a href="{{ route('debeloCrevoPocetna.doctor') }}">
                        <button class="btn btn-primary w-100 m-2" type="button" id="izaberite4">Izaberite <i class="fa-solid fa-arrow-pointer"></i></button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="testimonial-item text-center">
                    <img class="img-fluid mx-auto mb-4" src="{{ asset('img/brain.png') }}" style="width: 100px; height: 100px;">
                    <h5 class="mb-1" id="mozak">Predikcija mozdanog udara</h5>
                    <button disabled class="btn btn-secondary w-100 m-2" type="button" id="izaberite1"><i class="fa-solid fa-lock"></i></button>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="testimonial-item text-center">
                    <img class="img-fluid mx-auto mb-4" src="{{ asset('img/kidney.png') }}" style="width: 100px; height: 100px;">
                    <h5 class="mb-1" id="bubreg">Predikcija bolesti bubrega</h5>
                    <button disabled class="btn btn-secondary w-100 m-2" type="button" id="izaberite2"><i class="fa-solid fa-lock"></i></button>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="testimonial-item text-center">
                    <img class="img-fluid mx-auto mb-4" src="{{ asset('img/liver.png') }}" style="width: 100px; height: 100px;">
                    <h5 class="mb-1" id="jetra">Predikcija bolesti jetre</h5>
                    <button disabled class="btn btn-secondary w-100 m-2" type="button" id="izaberite3"><i class="fa-solid fa-lock"></i></button>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="testimonial-item text-center">
                    <img class="img-fluid mx-auto mb-4" src="{{ asset('img/endocrine.png') }}" style="width: 100px; height: 100px;">
                    <h5 class="mb-1" id="stitna">Predikcija endokrinoloških bolesti</h5>
                    <button disabled class="btn btn-secondary w-100 m-2" type="button" id="izaberite5"><i class="fa-solid fa-lock"></i></button>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="testimonial-item text-center">
                    <img class="img-fluid mx-auto mb-4" src="{{ asset('img/birth.png') }}" style="width: 100px; height: 100px;">
                    <h5 class="mb-1" id="porodjaj">Predikcija prevremenog porodjaja</h5>
                    <button disabled class="btn btn-secondary w-100 m-2" type="button" id="izaberite6"><i class="fa-solid fa-lock"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection