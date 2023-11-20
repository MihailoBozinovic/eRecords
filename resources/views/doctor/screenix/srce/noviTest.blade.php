@extends('layout.doclayout')

@section('title', 'Srce | Novi test')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align:center">Izaberite pacijenta</h6>
                <div class="responsive">
                    <table class="table table-bordered table-hover" id="pacijentiSrce" style="text-align:center">
                        <thead>
                            <tr>
                                <th style="text-align:center">Ime</th>
                                <th style="text-align:center">Prezime</th>
                                <th style="text-align:center">JMBG</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pacijenti as $p)
                            <tr>
                                <td>{{$p->ime}}</td>
                                <td>{{$p->prezime}}</td>
                                <td><strong>{{$p->jmbg}}</strong></td>
                                <td><a href="{{ route('korak1Srce.doctor' , [$p->id]) }}"><button class="btn btn-primary w-100">Započni test</button></a></td>
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