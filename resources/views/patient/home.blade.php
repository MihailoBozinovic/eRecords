@extends('layout.user')

@section('title', 'Početna')

@section('content')

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="testimonial-item text-center">
                    <img class="img-fluid mx-auto mb-4" src="{{ asset('img/medical-record.png') }}" style="width: 100px; height: 100px;">
                    <h5 class="mb-1">Vaš profil</h5>
                    <a href="{{ route('profile.patient') }}">
                        <button class="btn btn-primary w-100 m-2" type="button">Izaberite</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="testimonial-item text-center">
                    <img class="img-fluid mx-auto mb-4" src="{{ asset('img/calendar.png') }}" style="width: 100px; height: 100px;">
                    <h5 class="mb-1">Zakažite termin</h5>
                    <a href="{{ route('calendar.patient') }}">
                        <button class="btn btn-primary w-100 m-2" type="button">Izaberite</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="testimonial-item text-center">
                    <img class="img-fluid mx-auto mb-4" src="{{ asset('img/live-chat.png') }}" style="width: 100px; height: 100px;">
                    <h5 class="mb-1">Razgovor sa lekarom</h5>
                    <a href="{{ route('livechat.patient') }}">
                        <button class="btn btn-primary w-100 m-2" type="button">Izaberite</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="testimonial-item text-center">
                    <img class="img-fluid mx-auto mb-4" src="{{ asset('img/reservation.png') }}" style="width: 100px; height: 100px;">
                    <h5 class="mb-1">Vaši termini</h5>
                    <a href="{{ route('vasi-termini.patient') }}">
                        <button class="btn btn-primary w-100 m-2" type="button">Izaberite</button>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align: center;">Zakazani termini</h6>
                <div class="resposnive">
                    <table class="table table-hover table-bordered" id="termini">
                        <thead>
                            <tr>
                                <th style="text-align: center;">ID termina</th>
                                <th style="text-align: center;">Lekar</th>
                                <th style="text-align: center;">Datum</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($termini as $t)
                            <tr>
                                <td style="text-align: center;">{{$t->id_termin}}</td>
                                <td style="text-align: center;">{{$t->ime}} {{$t->prezime}}</td>
                                <td style="text-align: center;"><strong>{{\Carbon\Carbon::parse($t->vreme)->format('d/m/Y H:i:s')}}</strong></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection