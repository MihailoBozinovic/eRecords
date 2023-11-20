@extends('layout.pages')

@section('title', 'Lekari')

@section('content')
@if(Session::has('success'))
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="alert alert-success alert-dismissible fade show" role="alert" style="text-align: center;">
            <i class="fa fa-exclamation-circle me-2"></i>{{Session::get('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</div>
@endif
@if(Session::has('fail'))
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="alert alert-danger alert-dismissible fade show" role="alert" style="text-align: center;">
            <i class="fa fa-exclamation-circle me-2"></i>{{Session::get('fail')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
</div>
@endif
<!-- Navbar End -->

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h5 style="text-align: center"><i class="fa-solid fa-user-doctor"></i> Lekari</h5>
                <div class="table-responsive">
                    <table class="table table-hover" id="lekari" style="width:100%; text-align: center;">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: center">Ime</th>
                                <th scope="col" style="text-align: center">Prezime</th>
                                <th style="text-align: center">ID</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lekari as $l)
                            <tr>
                                <td>{{$l->name}}</td>
                                <td>{{$l->surname}}</td>
                                <td>{{$l->identity_number}}</td>
                                <td><a href="{{ route('profil_lekara.admin', [$l->id]) }}"><button class="btn btn-primary w-100">Profil lekara</button></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col" style="text-align: center">Ime</th>
                                <th scope="col" style="text-align: center">Prezime</th>
                                <th style="text-align: center">ID</th>
                                <th></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection