@extends('layout.pages')

@section('title', 'Pacijenti')

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
        <div class="col-6">
            <div class="bg-light rounded h-100 p-4">
                <h5 style="text-align: center">Broj pacijenata</h5>
                <h1 class="counter" style="text-align: center; margin:10%; color: #009CFF">
                    @foreach ($broj_pacijenata as $b) {{$b->broj}} @endforeach
                </h1>
                <br>
            </div>
        </div>
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h5 style="text-align: center"><i class="fa-solid fa-hospital-user"></i> Pacijenti</h5>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="pacijenti" style="width:100%; text-align: center;">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: center">Ime</th>
                                <th scope="col" style="text-align: center">Prezime</th>
                                <th scope="col" style="text-align: center">Datum Rodjenja</th>
                                <th scope="col" style="text-align: center">JMBG</th>
                                <th scope="col" style="text-align: center">Lekar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pacijenti as $p)
                            <tr>
                                <td>{{$p->ime}}</td>
                                <td>{{$p->prezime}}</td>
                                <td>{{$p->datum_rodjenja}}</td>
                                <td><strong>{{$p->jmbg}}</strong></td>
                                <td style="color: #009CFF">{{$p->ime_lekara}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col" style="text-align: center">Ime</th>
                                <th scope="col" style="text-align: center">Prezime</th>
                                <th scope="col" style="text-align: center">Datum Rodjenja</th>
                                <th scope="col" style="text-align: center">JMBG</th>
                                <th scope="col" style="text-align: center">Lekar</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection