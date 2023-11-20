@extends('layout.pages')

@section('title', 'Kalendar')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align: center;">Izaberite lekara</h6>
                <div class="form-floating mb-3">
                    <select class="js-example-responsive" style="width: 100%" id="lekari_list" aria-label="Floating label select example" onchange="rasporedLekara(this.id);">
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
                <div class="testimonial-item text-center">
                    <div class="alert alert-info fade show" role="alert" style="text-align: center;" id="alert">
                        <i class="fa fa-exclamation-circle me-2"></i> Molimo vas izaberite lekara čiji raspored hoćete da vidite!
                    </div>
                    <div class="responsive" style="display:none" id="tabelaTerminaDiv">
                        <table class="table table-responsive table-border" id="tabela_termina" style="text-align: center;">
                            <thead>
                                <tr>
                                    <th style="text-align: center;">Ime i prezime lekara</th>
                                    <th style="text-align: center;">Tag lekara</th>
                                    <th style="text-align: center;">ID Termina</th>
                                    <th style="text-align: center;">Ime i prezime pacijenta</th>
                                    <th style="text-align: center;">Datum i vreme</th>
                                </tr>
                            </thead>
                            <tbody id="termini_body">

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th style="text-align: center;">Ime i prezime lekara</th>
                                    <th style="text-align: center;">Tag lekara</th>
                                    <th style="text-align: center;">ID Termina</th>
                                    <th style="text-align: center;">Ime i prezime pacijenta</th>
                                    <th style="text-align: center;">Datum i vreme</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection