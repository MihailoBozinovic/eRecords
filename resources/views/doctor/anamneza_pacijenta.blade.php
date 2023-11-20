@extends('layout.doclayout')

@section('title', 'Novi pregled - anamneza')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align: center;">Novi pregled (Anamneza)</h6>
                <form action="{{ route('unos_anamneze.doctor') }}" method="POST">
                    @csrf
                    <input type="number" hidden readonly id="floatingInput" name="id" value="{{ $id }}">
                    <input type="number" hidden readonly id="floatingInput" name="id_pregled" value="{{ $id_pregled }}">

                    <sup style="color: red">@error('temperatura') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <textarea class="form-control" style="height:200px;" id="floatingInput" cols="15" placeholder="name@example.com" name="anamneza" value="{{old('anamneza')}}"></textarea>
                        <label for="floatingInput">Anamneza</label>
                    </div>

                    <button class="btn btn-primary w-100" type="submit">Završi pregled</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection