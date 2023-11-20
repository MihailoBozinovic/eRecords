@extends('layout.user')

@section('title', 'Istorija pregleda')

@section('content')
<div class="container-fluid pt-4 px-4">
    <a href="{{ url()->previous() }}" class="btn btn-primary" style="margin-bottom:10px;">
        <i class="fa-solid fa-chevron-left"></i> Nazad
    </a>
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="testimonial-item text-center">
                    <h5 class="mb-1">Pregled</h5>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="mere" style="text-align:center">
                            <thead>
                                <tr>
                                    <th style="text-align:center">Temperatura (°C)</th>
                                    <th style="text-align:center">Sistolni pritisak (mmHg)</th>
                                    <th style="text-align:center">Dijastolni pritisak (mmHg)</th>
                                    <th style="text-align:center">Saturacija (%)</th>
                                    <th style="text-align:center">Srčana frekvenca (bpm)</th>
                                    <th style="text-align:center">Visina (cm)</th>
                                    <th style="text-align:center">Težina (kg)</th>
                                    <th style="text-align:center">BMI</th>
                                    <th style="text-align:center">Anamneza</th>
                                    <th style="text-align:center">Vreme</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($mere as $m)
                                <tr>
                                    <td><strong>{{$m->temperatura}} °C</strong></td>
                                    <td><strong>{{$m->s_pritisak}} mmHg</strong></td>
                                    <td><strong>{{$m->d_pritisak}} mmHg</strong></td>
                                    <td><strong>{{$m->saturacija}} %</strong></td>
                                    <td><strong>{{$m->srcana_frekvenca}} bpm</strong></td>
                                    <td><strong>{{$m->visina}} cm</strong></td>
                                    <td><strong>{{$m->tezina}} kg</strong></td>
                                    @if ($m->bmi < 18.5) <td style="color:yellow;"><strong>{{$m->bmi}}</strong></td>
                                        @elseif ($m->bmi >= 18.5 && $m->bmi <= 24.9) <td style="color:green;"><strong>{{$m->bmi}}</strong></td>
                                            @elseif ($m->bmi > 24.9 && $m->bmi <= 29.9) <td style="color:orange;"><strong>{{$m->bmi}}</strong></td>
                                                @elseif ($m->bmi > 29.9)
                                                <td style="color:red;"><strong>{{$m->bmi}}</strong></td>
                                                @endif
                                                <td><a href="#" class="btn btn-primary w-100" title="Anamneza" data-toggle="popover" data-bs-placement="left" data-bs-content="{{$m->anamneza}}">
                                                        <i class="fa-solid fa-comment"></i>
                                                    </a></td>
                                                <td><strong>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $m->vreme)->format('d/m/Y H:i:s')}}</strong></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection