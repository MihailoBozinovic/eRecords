@extends('layout.doclayout')

@section('title', 'Srce | Korak 1')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <a href="#" style="pointer-events: none;"><button class="btn btn-success">1</button></a>
                    <a href="#" style="pointer-events: none;"><button class="btn btn-secondary" disabled>2</button></a>
                    <a href="#" style="pointer-events: none;"><button class="btn btn-secondary" disabled>3</button></a>
                    <a href="#" style="pointer-events: none;"><button class="btn btn-secondary" disabled><i class="fa-regular fa-id-card"></i></button></a>
                    <a href="#" style="pointer-events: none;"><button class="btn btn-secondary" disabled>4</button></a>
                    <a href="#" style="pointer-events: none;"><button class="btn btn-secondary" disabled>5</button></a>
                    <a href="#" style="pointer-events: none;"><button class="btn btn-secondary" disabled><i class="fa-solid fa-file-medical"></i></button></a>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align:center">Prvi korak</h6>
                <form action="{{ route('korak1Forma.doctor') }}" method="POST">
                    @if (empty($parametri))
                    <input type="text" hidden class="form-control" id="floatingInput" value="{{$id}}" name="id" placeholder="Godine" readonly>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" value="{{$year}}" name="godine" placeholder="Godine" readonly>
                        <label for="floatingInput">{{$year}}</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingPassword" placeholder="Visina" name="visina">
                        <label for="floatingPassword">Visina</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingPassword" placeholder="Težina" name="tezina">
                        <label for="floatingPassword">Težina</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="pol">
                            <option disabled="" selected="">Izaberite pol</option>
                            <option value="Muški">Muški</option>
                            <option value="Ženski">Ženski</option>
                        </select>
                        <label for="floatingSelect">Pol</label>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-100 m-2">Unesi <i class="fa-solid fa-plus"></i></button>
                    @else
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="godine" value="{{$year}}" placeholder="name@example.com" disabled="">
                        <label for="floatingInput">Godine</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingPassword" value="{{$parametri->visina}}" placeholder="Password" name="visina" disabled="">
                        <label for="floatingPassword">Visina (cm)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingPassword" value="{{$parametri->tezina}}" placeholder="Password" name="tezina" disabled="">
                        <label for="floatingPassword">Tezina (kg)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="pol" disabled="">
                            <option disabled="">Izaberite pol</option>
                            @if ($pacijent->pol == 1)
                            <option value="Muški" selected>Muški</option>
                            @else
                            <option value="Ženski" selected>Ženski</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Pol</label>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-100 m-2" id="unesi" disabled="">Unesi <i class="fa-solid fa-plus"></i></button>
                    @endif
                </form>
            </div>
        </div>
        <div class="col-xl-6 col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align:center">Rizik posle prvog koraka <i class="fa-solid fa-heart-circle-exclamation"></i></h6>
                @if (!empty($parametri))
                <div class="d-flex align-items-center py-3">
                    <div class="container-progress">
                        <div class="circular-progress">
                            <span class="progress-value">0%</span>
                        </div>
                    </div>
                </div>
                @else
                <div class="alert alert-danger fade show" role="alert" style="text-align: center;">
                    <i class="fa fa-exclamation-circle me-2"></i>Prvo popunite sva potrebna polja!
                </div>
                @endif
            </div>
        </div>

        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                @if (!empty($parametri))
                <a href="{{ route('korak2Srce.doctor', [$id]) }}"><button class="btn btn-primary w-100">Sledeći korak <i class="fa-solid fa-chevron-right"></i></button></a>
                @else
                <button class="btn btn-primary w-100" disabled>Sledeći korak <i class="fa-solid fa-chevron-right"></i></button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection