@extends('layout.user')

@section('title', 'Radiološke slike')

@section('content')
<div class="container-fluid pt-4 px-4">
    <a href="{{ url()->previous() }}" class="btn btn-primary" style="margin-bottom:10px;">
        <i class="fa-solid fa-chevron-left"></i> Nazad
    </a>
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="testimonial-item text-center">
                    <h5 class="mb-1">Unos slika</h5>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="slike" style="text-align:center">
                            <thead>
                                <tr>
                                    <th style="text-align:center">#</th>
                                    <th style="text-align:center">Slika</th>
                                    <th style="text-align:center">Datum</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($slike as $s)
                                <tr>
                                    <td><strong>Slika</strong></td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal{{$s->id}}">
                                            Pogledaj sliku
                                        </button>
                                        <!-- Modal -->
                                        <div class="modal fade" id="modal{{$s->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Radiološka slika</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{asset($s->putanja)}}" />
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Zatvori</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><strong>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $s->vreme)->format('d/m/Y H:i:s')}}</strong></td>
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