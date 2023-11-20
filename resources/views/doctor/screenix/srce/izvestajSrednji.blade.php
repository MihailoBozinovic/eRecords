@extends('layout.doclayout')

@section('title', 'Srce | Izveštaj - Posle prva tri koraka')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="bg-light text-center rounded p-4">
                    <h6 class="mb-0" style="text-align: center;">Izveštaj (Prva tri koraka)</h6>
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
        <div class="col-sm-12 col-md-6 col-xl-4">
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
        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="bg-light rounded h-100 p-4">
                <div class="bg-light text-center rounded p-4">
                    <h6 class="mb-0" style="text-align: center;">Informacije - Nalaz krvi</h6>
                    <span>Morate imati sledeće parametre za dalje korake</span><br>
                    <span><sup style="color: red;">*Obavezno</sup></span>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-transparent"><sup style="color: red;">*</sup>Hemoglobin, <sup style="color: red;">*</sup>Leukociti, <sup style="color: red;">*</sup>Neutrofili, <sup style="color: red;">*</sup>Limfociti, BNP</li>
                        <li class="list-group-item bg-transparent"><sup style="color: red;">*</sup>Kalijum, <sup style="color: red;">*</sup>Natrijum, <sup style="color: red;">*</sup>Kalcijum, <sup style="color: red;">*</sup>Magnezijum</li>
                        <li class="list-group-item bg-transparent"><sup style="color: red;">*</sup>TRY, <sup style="color: red;">*</sup>HDL, <sup style="color: red;">*</sup>LDL</li>
                        <li class="list-group-item bg-transparent"><sup style="color: red;">*</sup>Kreatinin, <sup style="color: red;">*</sup>Urea, BUN</li>
                        <li class="list-group-item bg-transparent">CK, CK MB, MYG, CTI, CTT, CRP</li>
                        <li class="list-group-item bg-transparent"><sup style="color: red;">*</sup>Glukoza</li>
                        <li class="list-group-item bg-transparent">AST, ALT, GGT, ALP, <sup style="color: red;">*</sup>LDH, <sup style="color: red;">*</sup>BLR, <sup style="color: red;">*</sup>ALB</li>
                        <li class="list-group-item bg-transparent">TSH, FREE T3, FREE T4</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-md-6 col-xl-4">
            <div class="bg-light rounded h-100 p-4">
                <div class="bg-light text-center rounded p-4">
                    <h6 class="mb-0" style="text-align: center;">Informacije - EKG</h6>
                    <span>Morate imati sledeće parametre za dalje korake</span>
                    <br>
                    <span><sup style="color: red;">*Obavezno</sup></span>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item bg-transparent"><sup style="color: red;">*</sup>Srčani ritam</li>
                        <li class="list-group-item bg-transparent"><sup style="color: red;">*</sup>Broj otkucaja srca</li>
                        <li class="list-group-item bg-transparent">P talasi, PR segment, QRS kompleks, T talasi, ST segment, U talasi, D (delta) talasi</li>
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
                    <h6 class="mb-0" style="text-align: center;">Ukupan rizik posle tri koraka</h6>
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
                <div class="responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Parametar</th>
                                <th scope="col">Trenutni</th>
                                <th scope="col">Preporučeni</th>
                                <th scope="col">Promena</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>BMI</td>
                                <td>{{$parametri->bmi}}</td>
                                <td style="color: green;">22</td>
                                @if ($parametri->bmi > 22)
                                <td style="color: blue;">↓{{round($parametri->bmi / 22, 2)}}%</td>
                                @else
                                <td style="color: blue;">↑{{round(22/ $parametri->bmi, 2)}}%</td>
                                @endif
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Sistolni/Dijastolni(mmHg)</td>
                                <td>{{$parametri->s_pritisak}} / {{$parametri->d_pritisak}}</td>
                                <td style="color: green;">128 / 85</td>
                                @if ($parametri->s_pritisak > 128 && $parametri->d_pritisak > 85)
                                <td style="color: blue;">↓{{((round($parametri->s_pritisak / 128, 2)) + (round($parametri->d_pritisak / 85, 2))) / 2}}%</td>
                                @else
                                <td style="color: blue;">↑{{round(((round(128 / $parametri->s_pritisak, 2)) + (round(85 / $parametri->d_pritisak, 2))) / 2, 2)}}%</td>
                                @endif
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Cigarete/Dan</td>
                                <td></td>
                                <td style="color: green;">0</td>
                                <td style="color: blue;">↓1.9%</td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Fizička aktivnost/Nedeljno</td>
                                <td></td>
                                <td style="color: green;"> >5</td>
                                <td style="color: blue;">↓1.9%</td>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <td>Stres na poslu (1 - 20)</td>
                                <td></td>
                                <td style="color: green;">
                                    < 10 </td>
                                <td style="color: blue;">↓2.8%</td>
                            </tr>
                            <tr>
                                <th scope="row">6</th>
                                <td>Alkohol/Nedeljno</td>
                                <td></td>
                                <td style="color: green;">0</td>
                                <td style="color: blue;">↓2.1%</td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Parametar</th>
                                <th scope="col">Trenutni</th>
                                <th scope="col">Preporučeni</th>
                                <th scope="col">Promena</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0" id="predikcija">Rezultat</h6><i class="fa-solid fa-chart-simple"></i>
                </div>
                <canvas id="myChart1"></canvas>
            </div>
        </div>
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <h6 class="mb-0" id="preporuke">Hrana</h6><i class="fa-solid fa-utensils"></i>
                </div>
                <canvas id="myChart2"></canvas>
            </div>
        </div>
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <a href="{{ route('zavrsiTestSrce.doctor') }}"><button class="btn btn-primary w-100">Završi test <i class="fa-solid fa-flag-checkered"></i></button></a>
                <br>
                <button class="btn btn-primary w-100" style="margin-top:10px;" data-bs-toggle="modal" data-bs-target="#potvrdaKoraka">Sledeći korak <i class="fa-solid fa-chevron-right"></i></button>
            </div>
            <div class="modal fade" id="potvrdaKoraka" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="potvrdaKoraka" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Sledeći korak</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <span>Da li ste sigurni da želite da predjete na sledeći korak?</span><br>
                            Naša preporuka je da predjete na sledeći korak <strong style="color:red">samo ako je rizik veći od 50%</strong> radi daljih ispitivanja.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Zatvorite</button>
                            <a href="{{ route('korak4Srce.doctor', [$id_test, $id]) }}"><button type="button" class="btn btn-success">Sledeći korak <i class="fa-solid fa-chevron-right"></i></button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection