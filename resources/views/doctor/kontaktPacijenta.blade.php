@extends('layout.doclayout')

@section('title', 'Kontakt pacijenta')

@section('content')
<div class="container-fluid pt-4 px-4">
    <a href="{{ url()->previous() }}" class="btn btn-primary" style="margin-bottom:10px;">
        <i class="fa-solid fa-chevron-left"></i> Nazad
    </a>
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6>Kontaktirajte pacijenta preko e-mail-a</h6>
                <form method="POST" action="{{ route('kontaktMail.doctor') }}">
                    @csrf
                    <input hidden name="email" value="{{$pacijent->email}}" />
                    <input hidden name="id" value="{{$pacijent->id}}" />
                    <sup style="color: red">@error('subject') {{$message}} @enderror</sup>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="subject" placeholder="name@example.com" value="{{old('subject')}}">
                        <label for="floatingInput"><i class="fa-solid fa-heading me-2"></i> Naslov</label>
                    </div>
                    <textarea id="email" name="tekst">
                        Napravite sadržaj email-a!
                    </textarea>
                    <button class="btn btn-primary w-100" type="submit" style="margin-top:10px;">Pošalji <i class="fa-solid fa-share"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection