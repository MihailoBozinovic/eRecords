@extends('layout.doclayout')

@section('title', 'Debelo Crevo | Korak 1')

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
                <form action="{{ route('korak1DebeloCrevoForma.doctor') }}" method="POST">
                    @csrf
                    <input hidden name="godine" value="{{$year}}" />
                    <input hidden name="id" value="{{$id}}" />
                    <input hidden name="id_test" value="{{$id_test}}" />
                    <input hidden name="pol" value="{{$pacijent->pol}}" />
                    <input hidden name="bmi" value="{{$parametri[0]->bmi}}" />
                    @if (empty($rizik1DC))
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="tezina" value="" placeholder="name@example.com">
                        <label for="floatingInput">Težina</label>
                    </div>
                    @if (empty($parametri[0]))
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="tezina_pre_merenja" placeholder="name@example.com">
                        <label for="floatingInput">Težina pre poslednjeg merenja(ako postoji)</label>
                    </div>
                    @else
                    <div class="form-floating mb-3">
                        <input readonly type="text" class="form-control" id="floatingInput" name="tezina_pre_merenja" placeholder="name@example.com" value="{{$parametri[0]->tezina}}">
                        <label for="floatingInput">Težina pre poslednjeg merenja(ako postoji)</label>
                    </div>
                    @endif
                    @if (empty($parametri[1]))
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingInput" name="tezina_pre_oba_merenja" placeholder="name@example.com">
                        <label for="floatingInput">Težina pre oba merenja(ako postoji)</label>
                    </div>
                    @else
                    <div class="form-floating mb-3">
                        <input type="text" readonly class="form-control" id="floatingInput" name="tezina_pre_oba_merenja" placeholder="name@example.com" value="{{$parametri[1]->tezina}}">
                        <label for="floatingInput">Težina pre oba merenja(ako postoji)</label>
                    </div>
                    @endif
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="dijeta">
                            <option selected disabled>Izaberite</option>
                            <option value="1">Da</option>
                            <option value="0">Ne</option>
                        </select>
                        <label for="floatingSelect">Da li držite neku dijetu u proteklih 6 meseci?</label>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-100 m-2">Unesi <i class="fa-solid fa-plus"></i></button>
                    @else
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="floatingInput" name="tezina" placeholder="name@example.com" value="{{$korak1->tezina}}">
                        <label for="floatingInput">Težina</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="floatingInput" name="tezina_pre_merenja" placeholder="name@example.com" value="{{$korak1->tezina_pre_merenja}}">
                        <label for="floatingInput">Težina pre poslednjeg merenja(ako postoji)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input disabled type="text" class="form-control" id="floatingInput" name="tezina_pre_oba_merenja" placeholder="name@example.com" value="{{$korak1->tezina_pre_oba_merenja}}">
                        <label for="floatingInput">Težina pre oba merenja(ako postoji)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select disabled class="form-select" id="floatingSelect" aria-label="Floating label select example" name="dijeta">
                            @if ($korak1->dijeta == 1)
                            <option value="1" selected>Da</option>
                            @else
                            <option value="0" selected>Ne</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Da li držite neku dijetu u proteklih 6 meseci?</label>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-100 m-2" disabled>Unesi <i class="fa-solid fa-plus"></i></button>
                    @endif
                </form>
            </div>
        </div>
        <div class="col-xl-6 col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align:center">Rizik posle prvog koraka <i class="fa-solid fa-percent"></i></h6>
                @if (!empty($rizik1DC))
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
                @if (!empty($rizik1DC))
                <a href="{{ route('korak2Srce.doctor', [$id]) }}"><button class="btn btn-primary w-100">Sledeći korak <i class="fa-solid fa-chevron-right"></i></button></a>
                @else
                <button class="btn btn-primary w-100" disabled>Sledeći korak <i class="fa-solid fa-chevron-right"></i></button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection