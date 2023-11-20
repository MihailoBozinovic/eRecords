@extends('layout.user')

@section('title', 'Zakazivanje')

@section('content')

<style>
    .service_div {
        height: auto;
        border: 2px solid #FC9303;
        margin-bottom: 15px;
        position: relative;
    }

    .service_div:hover {
        border-color: #383E42;
        background-color: #d3d3d3;
    }

    .service_div_active {
        border-color: #383E42;
        background-color: #d3d3d3;
    }

    .hr_custom {
        background-color: #FC9303;
        width: 75%;
        height: 1px;
    }

    .center {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
    }

    th,
    td {
        text-align: center;
        width: 14.44%;
        padding: 8px;
    }

    .calendar_div {
        height: auto;
        margin-bottom: 15px;
        position: relative;
        width: 100%;
    }

    .razmak {
        margin-bottom: 10px;
    }

    .btn-previous {
        float: left;
    }

    .btn-next {
        float: right;
    }
</style>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align: center;">Izaberite lekara</h6>
                <div class="form-floating mb-3">
                    <select class="form-control" style="width: 100%" id="lekari" aria-label="Floating label select example" onchange="loadSchedule(this.id);">
                        <option selected disabled>Izaberite lekara</option>
                        @foreach ($lekari as $l)
                        <option value="{{$l->id}}">{{$l->name}} {{$l->surname}} | {{$l->email}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align: center;">Izaberite termin</h6>
                <div class="calendar_div">
                    <div class="center razmak">
                        <div class="col-md-4">
                            <button id="previous" onclick="previous()" class="btn btn-primary btn-previous w-50" style="float:left;"><i class="fa-solid fa-chevron-left"></i></button>
                        </div>
                        <div class="col-md-4">
                            <h3 style="text-align:center;" id="monthAndYear"></h3>
                        </div>
                        <div class="col-md-4">
                            <button id="next" onclick="next()" class="btn btn-primary btn-next w-50"><i class="fa-solid fa-chevron-right"></i></button>
                        </div>
                    </div>

                    <table id="calendar" class="table table-responsive table-bordered">
                        <thead style="width:100%">
                            <tr id="calendar-head"></tr>
                        </thead>
                        <tbody style="width:100%">
                            <tr id="calendar-body"></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align: center;">Informacije o terminu</h6>
                <dl class="row mb-0">
                    <dt class="col-sm-4"><i class="fa-solid fa-hashtag"></i> ID Termina</dt>
                    <dd class="col-sm-8" id="id_termin">---------</dd>

                    <dt class="col-sm-4"><i class="fa-solid fa-clock"></i> Datum i vreme termina: </dt>
                    <dd class="col-sm-8" id="datum_vreme">---------</dd>

                    <dt class="col-sm-4"><i class="fa-solid fa-user-doctor"></i> Lekar: </dt>
                    <dd class="col-sm-8" id="lekar">---------</dd>
                </dl>
                <form action="{{ route('unosTermina.patient') }}" method="POST">
                    @csrf
                    <input hidden name="k" id="k" />
                    <input hidden name="id" id="id" />
                    <input hidden name="datum" id="datum" />
                    <input hidden name="id_lekar" id="id_lekar" />
                    <button type="submit" class="btn btn-primary w-100" disabled id="submit">Potvrdite termin</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection