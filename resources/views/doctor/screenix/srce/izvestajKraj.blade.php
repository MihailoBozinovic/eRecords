@extends('layout.doclayout')

@section('title', 'Srce | Izveštaj - Posle pet koraka')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="bg-light text-center rounded p-4">
                    <h6 class="mb-0" style="text-align: center;">Izveštaj (Pet koraka)</h6>
                    <span class="mb-0" style="text-align: center;"><strong>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $test->datum)->format('d/m/Y H:i:s')}}</strong></span>
                    <br>
                    @if ($pacijent->pol == 1)
                    <img class="img-fluid rounded-circle mx-auto mb-4" src="{{ asset('img/man.png') }}" style="width: 100px; height: 100px; margin-top: 15px;"><br>
                    @else
                    <img class="img-fluid rounded-circle mx-auto mb-4" src="{{ asset('img/woman.png') }}" style="width: 100px; height: 100px; margin-top: 15px;"><br>
                    @endif
                    <span class="mb-0" style="text-align: center;">Ime i prezime: {{$pacijent->ime}} {{$pacijent->prezime}}</span><br>
                    <span class="mb-0" style="text-align: center;">Visina: {{$parametri->visina}} cm</span><br>
                    <span class="mb-0" style="text-align: center;">Tezina: {{$parametri->tezina}} kg</span><br>
                    <span class="mb-0" style="text-align: center;">BMI: {{$parametri->bmi}}</span>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="bg-light text-center rounded p-4">
                    <h6 class="mb-0" style="text-align: center;">Skala</h6>
                    <span>Procena rizika u procentima</span>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-transparent" style="color:navy"><strong>0% - 15% Veoma nizak rizik</strong></li>
                        <li class="list-group-item bg-transparent" style="color:#03C04A;"><strong>15% - 20% Nizak rizik</strong></li>
                        <li class="list-group-item bg-transparent" style="color:green;"><strong>20% - 25% Rizično</strong></li>
                        <li class="list-group-item bg-transparent" style="color:#EFFD5F;"><strong>25% - 30% Srednje rizično</strong></li>
                        <li class="list-group-item bg-transparent" style="color:orange;"><strong>30% - 50% Veoma rizično</strong></li>
                        <li class="list-group-item bg-transparent" style="color:red;"><strong>50% - 100% Najrizičnije</strong></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0" id="rizik_bmi">Rizici</h6><i class="fa-solid fa-info"></i>
                </div>
                <h6 class="mb-0" id="navike">Navike</h6>
                <div id="navikeRizik"></div>
                <br>
                <h6 class="mb-0" id="navike">Posao</h6>
                <div id="posaoRizik"></div>
                <br>
                <h6 class="mb-0" id="navike">Porodica</h6>
                <div id="porodicaRizik"></div>
                <br>
                <h6 class="mb-0" id="navike">Hrana</h6>
                <div id="hranaRizik"></div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="bg-light text-center rounded p-4">
                    <h6 class="mb-0" style="text-align: center;">Ukupan rizik</h6>
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
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <a href="{{ route('izvestajiSrce.doctor') }}"><button type="button" class="btn btn-success w-100">Početna <i class="fa-solid fa-chevron-right"></i></button></a>
            </div>
        </div>
    </div>
</div>
@endsection