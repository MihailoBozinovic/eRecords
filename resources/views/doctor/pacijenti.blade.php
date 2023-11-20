@extends('layout.doclayout')

@section('title', 'Pacijenti')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h5 style="text-align: center"><i class="fa-solid fa-hospital-user"></i> Pacijenti</h5>
                <div class="table-responsive">
                    <table class="table table-hover" id="pacijenti" style="width:100%; text-align: center;">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: center">Ime</th>
                                <th scope="col" style="text-align: center">Prezime</th>
                                <th scope="col" style="text-align: center">Datum Rodjenja</th>
                                <th scope="col" style="text-align: center">JMBG</th>
                                <th scope="col" style="text-align: center">Novi pregled</th>
                                <th scope="col" style="text-align: center">Profil</th>
                                <th scope="col" style="text-align: center; color: red;"><i class="fa-solid fa-trash-can"></i></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dokumenti as $d)
                            <tr>
                                <td>{{$d->ime}}</td>
                                <td>{{$d->prezime}}</td>
                                <td>{{$d->datum_rodjenja}}</td>
                                <td>{{$d->jmbg}}</td>
                                <td>
                                    <a href="{{route('pregled_pacijenta.doctor', [$d->id])}}">
                                        <button class='btn btn-primary w-100 m-2'>
                                            Novi pregled
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <a href="{{route('profil_pacijenta.doctor', [$d->id])}}">
                                        <button class='btn btn-primary w-100 m-2'>
                                            <i class="fa-solid fa-eye"></i>
                                        </button>
                                    </a>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-danger w-100 m-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Brisanje kartona</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    Da li ste sigurni da želite da obrišete karton ovog pacijenta?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">Otkaži</button>
                                                    <form action="{{route('brisanje_pacijenta.doctor', [$d->id])}}" method="POST">
                                                        @csrf
                                                        <button type="submit" class='btn btn-danger'>
                                                            Obriši karton <i class="fa-solid fa-trash-can"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col" style="text-align: center">Ime</th>
                                <th scope="col" style="text-align: center">Prezime</th>
                                <th scope="col" style="text-align: center">Datum Rodjenja</th>
                                <th scope="col" style="text-align: center">JMBG</th>
                                <th scope="col" style="text-align: center">Novi pregled</th>
                                <th scope="col" style="text-align: center">Profil</th>
                                <th scope="col" style="text-align: center; color: red;"><i class="fa-solid fa-trash-can"></i></th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection