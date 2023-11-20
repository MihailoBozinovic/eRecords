@extends('layout.doclayout')

@section('title', 'Novi pregled - Mere')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align: center;">Novi pregled (Mere)</h6>
                <form action="{{ route('unos_mera.doctor') }}" method="POST">
                    @csrf
                    <input type="number" hidden readonly id="floatingInput" name="id" value="{{ $id }}">
                    <input type="number" hidden readonly id="floatingInput" name="id_pregled" value="{{ $id_pregled }}">

                    <sup style="color: red">@error('temperatura') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" step="0.01" min="30" id="floatingInput" placeholder="name@example.com" name="temperatura" value="{{old('temperatura')}}">
                        <label for="floatingInput">Temperatura</label>
                    </div>

                    <sup style="color: red">@error('s_pritisak') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" step="0.01" min="90" id="floatingInput" placeholder="name@example.com" name="s_pritisak" value="{{old('s_pritisak')}}">
                        <label for="floatingInput">Sistolni pritisak</label>
                    </div>

                    <sup style="color: red">@error('d_pritisak') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" step="0.01" min="50" id="floatingInput" placeholder="name@example.com" name="d_pritisak" value="{{old('d_pritisak')}}">
                        <label for="floatingInput">Dijastolni pritisak</label>
                    </div>

                    <sup style="color: red">@error('saturacija') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" step="0.01" min="80" max="100" id="floatingInput" placeholder="name@example.com" name="saturacija" value="{{old('saturacija')}}">
                        <label for="floatingInput">Saturacija</label>
                    </div>

                    <sup style="color: red">@error('srcana_frekvenca') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" step="0.01" min="40" id="floatingInput" placeholder="name@example.com" name="srcana_frekvenca" value="{{old('srcana_frekvenca')}}">
                        <label for="floatingInput">Srčana frekvenca</label>
                    </div>

                    <sup style="color: red">@error('visina') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input id="visina" type="number" class="form-control" step="0.01" min="100" placeholder="name@example.com" name="visina" value="{{old('visina')}}">
                        <label for="floatingInput">Visina</label>
                    </div>

                    <sup style="color: red">@error('tezina') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" step="0.01" min="20" id="tezina" placeholder="name@example.com" name="tezina" value="{{old('tezina')}}">
                        <label for="floatingInput">Težina</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input readonly type="number" class="form-control" step="0.01" id="bmi" placeholder="name@example.com" name="bmi" value="{{old('bmi')}}">
                        <label for="floatingInput">BMI</label>
                    </div>

                    <button class="btn btn-primary w-100" type="submit">Sledeći korak</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection