@extends('layout.doclayout')

@section('title', 'Izmenite postojeće podatke')

@section('content')
<div class="container-fluid pt-4 px-4">
    <a href="{{ url()->previous() }}" class="btn btn-primary" style="margin-bottom:10px;">
        <i class="fa-solid fa-chevron-left"></i> Nazad
    </a>
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align: center;">Ažurirajte podatke o pacijentu</h6>
                <form action="{{ route('unos_pacijenta.doctor') }}" method="POST">
                    @csrf
                    <sup style="color: red">@error('ime') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="ime" value="{{$pacijent->ime}}">
                        <label for="floatingInput">Ime</label>
                    </div>
                    <sup style="color: red">@error('prezime') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="prezime" value="{{$pacijent->prezime}}">
                        <label for="floatingInput">Prezime</label>
                    </div>
                    <sup style="color: red">@error('email') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="{{$pacijent->email}}">
                        <label for="floatingInput">E-mail</label>
                    </div>
                    <sup style="color: red">@error('datum_rodjenja') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control pickadate" style="background: white;" name="datum_rodjenja" placeholder="Datum rodjenja" id="datum_rodjenja" value="{{$pacijent->datum_rodjenja}}" />
                        <label for="pickadate" id="datum">Datum rodjenja</label>
                    </div>
                    <sup style="color: red">@error('jmbg') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="jmbg" value="{{$pacijent->jmbg}}">
                        <label for="floatingInput">JMBG</label>
                    </div>
                    <sup style="color: red">@error('pol') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <select disabled class="form-select" id="floatingSelect" aria-label="Floating label select example" name="pol">
                            @if ($pacijent->pol == 1)
                            <option selected disabled>Muško</option>
                            @else
                            <option selected disabled>Žensko</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Pol</label>
                    </div>
                    <sup style="color: red">@error('zanimanje') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="zanimanje" value="{{$pacijent->zanimanje}}">
                        <label for="floatingInput">Zanimanje</label>
                    </div>
                    <sup style="color: red">@error('mesto') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="mesto" value="{{$pacijent->mesto}}">
                        <label for="floatingInput">Mesto</label>
                    </div>
                    <sup style="color: red">@error('opstina') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="opstina" value="{{$pacijent->opstina}}">
                        <label for="floatingInput">Opština</label>
                    </div>
                    <sup style="color: red">@error('adresa') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="adresa" value="{{$pacijent->adresa}}">
                        <label for="floatingInput">Adresa stanovanja</label>
                    </div>
                    <sup style="color: red">@error('telefon') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" placeholder="name@example.com" name="telefon" value="{{$pacijent->telefon}}">
                        <label for="floatingInput">Telefon</label>
                    </div>
                    <sup style="color: red">@error('krvna_grupa') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <select disabled class="form-select" id="floatingSelect" aria-label="Floating label select example" name="krvna_grupa">
                            @if ($pacijent->krvna_grupa == '0+')
                            <option selected disabled>0+</option>
                            @elseif ($pacijent->krvna_grupa == '0-')
                            <option selected disabled>0-</option>
                            @elseif ($pacijent->krvna_grupa == 'A+')
                            <option selected disabled>A+</option>
                            @elseif ($pacijent->krvna_grupa == 'A-')
                            <option selected disabled>A-</option>
                            @elseif ($pacijent->krvna_grupa == 'B+')
                            <option selected disabled>B+</option>
                            @elseif ($pacijent->krvna_grupa == 'B-')
                            <option selected disabled>B-</option>
                            @elseif ($pacijent->krvna_grupa == "AB")
                            <option selected disabled>AB+</option>
                            @else
                            <option selected disabled>AB-</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Krvna grupa</label>
                    </div>
                    <sup style="color: red">@error('alergije') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <textarea type="text" class="form-control" style="height:10%" id="floatingInput" placeholder="name@example.com" name="alergije">{{$pacijent->alergije}}</textarea>
                        <label for="floatingInput">Alergije</label>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Unesite podatke</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection