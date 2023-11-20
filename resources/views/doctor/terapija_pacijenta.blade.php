@extends('layout.doclayout')

@section('title', 'Novi terapija')

@section('content')
<div class="container-fluid pt-4 px-4">
    <a href="{{ url()->previous() }}" class="btn btn-primary" style="margin-bottom:10px;">
        <i class="fa-solid fa-chevron-left"></i> Nazad
    </a>
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align: center;">Novi terapija</h6>
                <form action="{{ route('insertTerapija.doctor') }}" method="POST">
                    @csrf
                    <input type="number" hidden readonly id="floatingInput" name="id" value="{{ $id }}">

                    <sup style="color: red">@error('temperatura') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" id="search_lekovi" class="form-control" placeholder="name@example.com" name="search_lekovi">
                        <label for="floatingInput">Pretražite lek</label>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover" style="width:100%; text-align: center;">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center">Naziv</th>
                                    <th scope="col" style="text-align: center">Oblik/Doza</th>
                                    <th scope="col" style="text-align: center">Nosilac Dozvole</th>
                                    <th scope="col" style="text-align: center"></th>
                                </tr>
                            </thead>
                            <tbody id="lekovi_body">
                            </tbody>
                            <div class="alert alert-info fade show" role="alert" style="text-align: center;" id="alert1">
                                <i class="fa fa-exclamation-circle me-2"></i>Nema izabranih lekova
                            </div>
                        </table>
                    </div>
                    <hr>
                    <h6>Dodata terapija</h6>
                    <hr>
                    <div class="table-responsive">
                        <table class="table table-hover" style="width:100%; text-align: center;">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center">Naziv</th>
                                    <th scope="col" style="text-align: center">Oblik/Doza</th>
                                    <th scope="col" style="text-align: center">Nosilac Dozvole</th>
                                    <th scope="col" style="text-align: center; width:20%">Količina <i class="fa-solid fa-scale-unbalanced-flip"></i></th>
                                    <th scope="col" style="text-align: center; width:20%">Period <i class="fa-solid fa-calendar-week"></i></th>
                                </tr>
                            </thead>
                            <tbody id="terapija_body">
                            </tbody>
                            <div class="alert alert-info fade show" role="alert" style="text-align: center;" id="alert2">
                                <i class="fa fa-exclamation-circle me-2"></i>Nema terapija
                            </div>
                        </table>
                    </div>
                    <div class="form-floating mb-3">
                        <textarea name="komentar" class="form-control" placeholder="name@example.com"></textarea>
                        <label for="floatingInput">Upišite komentar<sup style="color:red">*</sup></label>
                    </div>
                    <button class="btn btn-primary w-100" type="submit" id="zavrsi" disabled>Unesi terapiju</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection