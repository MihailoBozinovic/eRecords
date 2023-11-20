@extends('layout.doclayout')

@section('title', 'Srce | Izveštaji')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align:center">Izveštaji</h6>
                <div class="responsive">
                    <table class="table table-bordered table-hover" id="srceIzvestaji" style="text-align:center">
                        <thead>
                            <th style="text-align:center">Ime pacijenta</th>
                            <th style="text-align:center">JMBG</th>
                            <th style="text-align:center">Status</th>
                            <th style="text-align:center">Tri koraka</th>
                            <th style="text-align:center">Pet koraka</th>
                            <th style="text-align:center">Datum</th>
                        </thead>
                        <tbody>
                            @foreach ($srceTest as $s)
                            <tr>
                                <td>{{$s->ime}}</td>
                                <td>{{$s->jmbg}}</td>
                                @if ($s->status == 5)
                                <td style="color:green"><strong><i class="fa-solid fa-circle-check"></i></strong></td>
                                @elseif ($s->status < 5 && $s->status >= 1)
                                    <td style="color:orange"><strong><i class="fa-solid fa-circle-check"></i></strong></td>
                                    @else
                                    <td style="color:red"><strong><i class="fa-solid fa-land-mine-on"></i></strong></td>
                                    @endif
                                    @if ($s->status >= 1)
                                    <td><a href="{{ route('izvestajSrceIzvestaji.doctor', [$s->id_test, $s->id]) }}"><button class="btn btn-primary w-100">Pristupite <i class="fa-solid fa-circle-chevron-right"></i></button></a></td>
                                    @else
                                    <td><button class="btn btn-primary w-100" disabled>Pristupite <i class="fa-solid fa-circle-chevron-right"></i></button></td>
                                    @endif
                                    @if ($s->status == 5)
                                    <td><a href="{{ route('finalniIzvestajSrce.doctor', [$s->id_test, $s->id]) }}"><button class="btn btn-primary w-100">Pristupite <i class="fa-solid fa-circle-chevron-right"></i></button></a></td>
                                    @else
                                    <td><button class="btn btn-primary w-100" disabled>Pristupite</button></td>
                                    @endif
                                    <td><strong>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $s->datum)->format('d/m/Y H:i:s')}}</strong></td>
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