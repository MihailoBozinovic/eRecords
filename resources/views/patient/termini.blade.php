@extends('layout.user')

@section('title', 'Vaši termini')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align:center">Vaši termini</h6>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="termini1" style="text-align:center">
                        <thead>
                            <th style="text-align:center">ID Termina</th>
                            <th style="text-align:center">Lekar</th>
                            <th style="text-align:center">Datum i vreme</th>
                        </thead>
                        <tbody>
                            @foreach ($termini as $t)
                            <tr>
                                <td>{{$t->id_termin}}</td>
                                <td>{{$t->ime}} {{$t->prezime}}</td>
                                <td><strong>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $t->vreme_datum)->format('d/m/Y H:i:s')}}</strong></td>
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