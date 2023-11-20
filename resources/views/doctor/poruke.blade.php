@extends('layout.doclayout')

@section('title', 'Poruke')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align: center;">Poruke</h6>
                <hr>
                <div id="poruke">
                    <style>
                        .prelaz:hover {
                            background-color: #D3D3D3;
                        }
                    </style>
                    @foreach ($poruke as $p)
                    <a href="#">
                        <div class="d-flex align-items-center prelaz">
                            <img class="rounded-circle" src="{{ asset('img/user.png') }}" alt="" style="width: 40px; height: 40px" />
                            <div class="ms-2">
                                <h6 class="fw-normal mb-0">
                                    {{ $p->ime_pacijenta }}
                                </h6>
                                <small>
                                    {{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $p->vreme)->format('d/m/Y H:i:s')}}
                                </small>
                            </div>
                        </div>
                    </a>
                    <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>@endsection