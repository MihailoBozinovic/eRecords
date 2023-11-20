@extends('layout.doclayout')

@section('title', 'Novi pacijent')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align: center;">Novi pacijent</h6>
                <form action="{{ route('unos_pacijenta.doctor') }}" method="POST">
                    @csrf
                    <sup style="color: red">@error('ime') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="ime" value="{{old('ime')}}">
                        <label for="floatingInput">Ime</label>
                    </div>
                    <sup style="color: red">@error('prezime') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="prezime" value="{{old('prezime')}}">
                        <label for="floatingInput">Prezime</label>
                    </div>
                    <sup style="color: red">@error('email') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="{{old('email')}}">
                        <label for="floatingInput">E-mail</label>
                    </div>
                    <sup style="color: red">@error('datum_rodjenja') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control pickadate" style="background: white;" name="datum_rodjenja" placeholder="Datum rodjenja" id="datum_rodjenja" value="{{old('datum_rodjenja')}}" />
                        <label for="pickadate" id="datum">Datum rodjenja</label>
                    </div>
                    <sup style="color: red">@error('jmbg') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="jmbg" value="{{old('jmbg')}}">
                        <label for="floatingInput">JMBG</label>
                    </div>
                    <sup style="color: red">@error('pol') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="pol" value="{{old('pol')}}">
                            <option selected disabled>Izaberite pol</option>
                            <option value="1">Muško</option>
                            <option value="2">Žensko</option>
                        </select>
                        <label for="floatingSelect">Pol</label>
                    </div>
                    <sup style="color: red">@error('zanimanje') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="zanimanje" value="{{old('zanimanje')}}">
                        <label for="floatingInput">Zanimanje</label>
                    </div>
                    <sup style="color: red">@error('mesto') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="mesto" value="{{old('mesto')}}">
                        <label for="floatingInput">Mesto</label>
                    </div>
                    <sup style="color: red">@error('opstina') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="opstina" value="{{old('opstina')}}">
                        <label for="floatingInput">Opština</label>
                    </div>
                    <sup style="color: red">@error('adresa') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="adresa" value="{{old('adresa')}}">
                        <label for="floatingInput">Adresa stanovanja</label>
                    </div>
                    <sup style="color: red">@error('telefon') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="telefon" value="{{old('telefon')}}">
                        <label for="floatingInput">Telefon</label>
                    </div>
                    <sup style="color: red">@error('krvna_grupa') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="krvna_grupa">
                            <option selected disabled>Izaberite krvnu grupu</option>
                            <option value="0+">0+</option>
                            <option value="0-">0-</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                        </select>
                        <label for="floatingSelect">Krvna grupa</label>
                    </div>
                    <sup style="color: red">@error('alergije') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <textarea type="text" class="form-control" style="height:10%" id="floatingInput" placeholder="name@example.com" name="alergije" value="{{old('alergije')}}"></textarea>
                        <label for="floatingInput">Alergije</label>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Unesite podatke</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection