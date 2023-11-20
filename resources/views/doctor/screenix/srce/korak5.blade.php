@extends('layout.doclayout')

@section('title', 'Srce | Korak 5')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="d-flex align-items-center justify-content-between mb-2">
                    <a href="#" style="pointer-events: none;"><button class="btn btn-success">1</button></a>
                    <a href="#" style="pointer-events: none;"><button class="btn btn-success">2</button></a>
                    <a href="#" style="pointer-events: none;"><button class="btn btn-success">3</button></a>
                    <a href="#" style="pointer-events: none;"><button class="btn btn-success"><i class="fa-regular fa-id-card"></i></button></a>
                    <a href="#" style="pointer-events: none;"><button class="btn btn-success">4</button></a>
                    @if (empty($ekg))
                    <a href="#" style="pointer-events: none;"><button class="btn btn-primary">5</button></a>
                    @else
                    <a href="#" style="pointer-events: none;"><button class="btn btn-success">5</button></a>
                    @endif
                    <a href="#" style="pointer-events: none;"><button class="btn btn-secondary" disabled><i class="fa-solid fa-file-medical"></i></button></a>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align:center">Peti korak</h6>
                <div class="d-flex align-items-center justify-content-between mb-2 border-bottom">
                    <h6 class="mb-0" id="nalaz">EKG test</h6><i class="fa-solid fa-droplet"></i>
                </div>
                <form action="{{ route('korak5SrceForma.doctor') }}" method="POST">
                    @csrf
                    <input type="text" name="id" value="{{$id}}" hidden="">
                    <input type="text" name="id_test" value="{{$id_test}}" hidden="">
                    @if (empty($ekg))
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="rhytm" onchange="provera1(this);">
                            <option selected="" disabled="">Izaberite</option>
                            <option value="0">Ne postoji</option>
                            <option value="1">Pravilan</option>
                            <option value="2">Nepravilan</option>
                            <option value="3">Jedan (ventrikularni ili atrijalni) regularan, drugi nije</option>
                        </select>
                        <label for="floatingSelect">Status ritma</label>
                    </div>
                    <div id="p1" class="form-floating mb-3" style="display: none;">
                        <input type="number" id="x1" class="form-control" name="rhytm_value" placeholder="Ritam srca (u sekundi)" value="0">
                        <label for="x1">Ritam srca (u sekundi)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="heart_rate" onchange="provera2(this);">
                            <option selected="" disabled="">Izaberite</option>
                            <option value="0">Ne postoji</option>
                            <option value="1">Nije merljiv</option>
                            <option value="2">Pravilan</option>
                            <option value="3">Merljiv, ali nepravilan</option>
                        </select>
                        <label for="floatingSelect">Status pulsa</label>
                    </div>
                    <div id="p2" class="form-floating mb-3" style="display: none;">
                        <input type="number" id="x2" class="form-control" name="heart_rate_value" placeholder="Puls(otkucaja po sekundi)" value="0">
                        <label for="x2">Puls(otkucaja po sekundi)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="p_wave" onchange="provera3(this);">
                            <option selected="" disabled="">Izaberite</option>
                            <option value="0">Nema odogovora</option>
                            <option value="1">Ne postoji</option>
                            <option value="2">Nije merljiv</option>
                            <option value="3">Pravilan</option>
                            <option value="4">Prisutan pre, tokom (skriven) ili posle QRS-a, ako je vidljiv invertovan je</option>
                            <option value="5">Nepravilan</option>
                        </select>
                        <label for="floatingSelect">Status P talasa</label>
                    </div>
                    <div id="p3" class="form-floating mb-3" style="display: none;">
                        <input type="number" id="x3" class="form-control" name="p_value" placeholder="P talasi (u sekundi)" value="0" step="0.001">
                        <label for="x3">P talasi (u sekundi)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="pr_segment" onchange="provera4(this);">
                            <option selected="" disabled="">Izaberite</option>
                            <option value="0">Ne postoji</option>
                            <option value="1">Nije merljiv</option>
                            <option value="2">Pravilan</option>
                            <option value="3">Merljiv, ali nepravilan</option>
                        </select>
                        <label for="floatingSelect">Status PR segmenta</label>
                    </div>
                    <div id="p4" class="form-floating mb-3" style="display: none;">
                        <input type="number" id="x4" class="form-control" name="pr_value" placeholder="PR segment (u sekundi)" value="0" step="0.001">
                        <label for="x4">PR segment (u sekundi)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="qrs_complex" onchange="provera5(this);">
                            <option selected="" disabled="">Izaberite</option>
                            <option value="0">Ne postoji</option>
                            <option value="1">Nije merljiv</option>
                            <option value="2">Pravilan</option>
                            <option value="3">Pravilan, ali širok</option>
                            <option value="4">Pravilan, ali bizaran</option>
                        </select>
                        <label for="floatingSelect">Status QRS kompleksa</label>
                    </div>
                    <div id="p5" class="form-floating mb-3" style="display: none;">
                        <input type="number" id="x5" class="form-control" name="qrs_complex_value" placeholder="QRS kompleks (u sekundi)" value="0" step="0.001">
                        <label for="x5">QRS kompleks (u sekundi)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="t_wave" onchange="provera6(this);">
                            <option selected="" disabled="">Izaberite</option>
                            <option value="0">Ne postoji</option>
                            <option value="1">Pravilan</option>
                            <option value="2">Invertovan</option>
                        </select>
                        <label for="floatingSelect">Status T talasa</label>
                    </div>
                    <div id="p6" class="form-floating mb-3" style="display: none;">
                        <input type="number" id="x6" class="form-control" name="t_value" placeholder="T talasi (u sekundi)" value="0" step="0.001">
                        <label for="x6">T talasi (u sekundi)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="st_segment" onchange="provera7(this);">
                            <option selected="" disabled="">Izaberite</option>
                            <option value="0">Ne postoji</option>
                            <option value="1">Nije merljiv</option>
                            <option value="2">Pravilan</option>
                            <option value="3">Pravilan, ali opada</option>
                            <option value="4">Pravilan, ali raste</option>
                        </select>
                        <label for="floatingSelect">Status ST segmenta</label>
                    </div>
                    <div id="p7" class="form-floating mb-3" style="display: none;">
                        <input type="number" id="x7" class="form-control" name="st_value" placeholder="ST segment (u sekundi)" value="0" step="0.001">
                        <label for="x7">ST segment (u sekundi)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="u_wave" onchange="provera8(this);">
                            <option selected="" disabled="">Izaberite</option>
                            <option value="0">Postoji i pravilan je</option>
                            <option value="1">Ne postoji ili postoji i nepravilan je</option>
                        </select>
                        <label for="floatingSelect">Status U talasa</label>
                    </div>
                    <div id="p8" class="form-floating mb-3" style="display: none;">
                        <input type="number" id="x8" class="form-control" name="u_value" placeholder="U talasi (u sekundi)" value="0" step="0.001">
                        <label for="x8">U talasi (u sekundi)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="d_wave">
                            <option selected="" disabled="">Izaberite</option>
                            <option value="0">Postoji</option>
                            <option value="1">Ne postoji</option>
                        </select>
                        <label for="floatingSelect">Status D(Delta) talasa</label>
                    </div>
                    <button class="btn btn-primary w-100 m-2" type="submit" id="unesi" name="unesi">Unesi</button>
                    @else <!-- PRESEK -->
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="rhytm" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($ekg->rythm == 0)
                            <option value="0" selected="">Ne postoji</option>
                            @elseif ($ekg->rythm == 1)
                            <option value="1" selected="">Pravilan</option>
                            @elseif ($ekg->rythm == 2)
                            <option value="2" selected="">Nepravilan</option>
                            @elseif ($ekg->rythm == 3)
                            <option value="3" selected="">Jedan (ventrikularni ili atrijalni) regularan, drugi nije</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Status ritma</label>
                    </div>
                    <div id="p1" class="form-floating mb-3">
                        <input type="number" id="x1" class="form-control" name="rhytm_value" disabled placeholder="Ritam srca (u sekundi)" value="{{$ekg->rhytm_value}}">
                        <label for="x1">Ritam srca (u sekundi)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="heart_rate" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($ekg->heart_rate == 0)
                            <option value="0" selected="">Ne postoji</option>
                            @elseif ($ekg->heart_rate == 1)
                            <option value="1" selected="">Nije merljiv</option>
                            @elseif ($ekg->heart_rate == 2)
                            <option value="2" selected="">Pravilan</option>
                            @else
                            <option value="3" selected="">Merljiv, ali nepravilan</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Status pulsa</label>
                    </div>
                    <div id="p2" class="form-floating mb-3">
                        <input type="number" id="x2" class="form-control" name="heart_rate_value" disabled placeholder="Puls(otkucaja po sekundi)" value="{{$ekg->heart_rate_value}}">
                        <label for="x2">Puls(otkucaja po sekundi)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="p_wave" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($ekg->p_wave == 0)
                            <option value="0" selected="">Nema odogovora</option>
                            @elseif ($ekg->p_wave == 1)
                            <option value="1" selected="">Ne postoji</option>
                            @elseif ($ekg->p_wave == 2)
                            <option value="2" selected="">Nije merljiv</option>
                            @elseif ($ekg->p_wave == 3)
                            <option value="3" selected="">Pravilan</option>
                            @elseif ($ekg->p_wave == 4)
                            <option value="4" selected="">Prisutan pre, tokom (skriven) ili posle QRS-a, ako je vidljiv invertovan je</option>
                            @else
                            <option value="5">Nepravilan</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Status P talasa</label>
                    </div>
                    <div id="p3" class="form-floating mb-3">
                        <input type="number" id="x3" class="form-control" disabled name="p_value" placeholder="P talasi (u sekundi)" value="{{$ekg->p_value}}" step="0.001">
                        <label for="x3">P talasi (u sekundi)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="pr_segment" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($ekg->pr_segment == 0)
                            <option value="0" selected="">Ne postoji</option>
                            @elseif ($ekg->pr_segment == 1)
                            <option value="1" selected="">Nije merljiv</option>
                            @elseif ($ekg->pr_segment == 2)
                            <option value="2" selected="">Pravilan</option>
                            @else
                            <option value="3" selected="">Merljiv, ali nepravilan</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Status PR segmenta</label>
                    </div>
                    <div id="p4" class="form-floating mb-3">
                        <input type="number" id="x4" class="form-control" disabled name="pr_value" placeholder="PR segment (u sekundi)" value="{{$ekg->pr_value}}" step="0.001">
                        <label for="x4">PR segment (u sekundi)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="qrs_complex" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($ekg->qrs_complex == 0)
                            <option value="0" selected="">Ne postoji</option>
                            @elseif ($ekg->qrs_complex == 1)
                            <option value="1" selected="">Nije merljiv</option>
                            @elseif ($ekg->qrs_complex == 2)
                            <option value="2" selected="">Pravilan</option>
                            @elseif ($ekg->qrs_complex == 3)
                            <option value="3" selected="">Pravilan, ali širok</option>
                            @else
                            <option value="4" selected="">Pravilan, ali bizaran</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Status QRS kompleksa</label>
                    </div>
                    <div id="p5" class="form-floating mb-3">
                        <input type="number" id="x5" class="form-control" disabled name="qrs_complex_value" placeholder="QRS kompleks (u sekundi)" value="{{$ekg->qrs_value}}" step="0.001">
                        <label for="x5">QRS kompleks (u sekundi)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="t_wave" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($ekg->t_wave == 0)
                            <option value="0" selected="">Ne postoji</option>
                            @elseif ($ekg->t_wave == 1)
                            <option value="1" selected="">Pravilan</option>
                            @else
                            <option value="2" selected="">Invertovan</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Status T talasa</label>
                    </div>
                    <div id="p6" class="form-floating mb-3">
                        <input type="number" id="x6" class="form-control" name="t_value" placeholder="T talasi (u sekundi)" value="{{$ekg->t_value}}" disabled step="0.001">
                        <label for="x6">T talasi (u sekundi)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="st_segment" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($ekg->st_segment == 0)
                            <option value="0" selected="">Ne postoji</option>
                            @elseif ($ekg->st_segment == 1)
                            <option value="1" selected="">Nije merljiv</option>
                            @elseif ($ekg->st_segment == 2)
                            <option value="2" selected="">Pravilan</option>
                            @elseif ($ekg->st_segment == 3)
                            <option value="3" selected="">Pravilan, ali opada</option>
                            @else
                            <option value="4" selected="">Pravilan, ali raste</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Status ST segmenta</label>
                    </div>
                    <div id="p7" class="form-floating mb-3">
                        <input type="number" id="x7" class="form-control" disabled name="st_value" placeholder="ST segment (u sekundi)" value="{{$ekg->st_value}}" step="0.001">
                        <label for="x7">ST segment (u sekundi)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="u_wave" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($ekg->u_wave == 0)
                            <option value="0" selected="">Postoji i pravilan je</option>
                            @else
                            <option value="1" selected="">Ne postoji ili postoji i nepravilan je</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Status U talasa</label>
                    </div>
                    <div id="p8" class="form-floating mb-3">
                        <input type="number" id="x8" class="form-control" name="u_value" placeholder="U talasi (u sekundi)" value="{{$ekg->u_value}}" step="0.001" disabled>
                        <label for="x8">U talasi (u sekundi)</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="floatingSelect" aria-label="Floating label select example" name="d_wave" disabled>
                            <option disabled="">Izaberite</option>
                            @if ($ekg->d_wave == 0)
                            <option value="0" selected="">Postoji</option>
                            @else
                            <option value="1" selected="">Ne postoji</option>
                            @endif
                        </select>
                        <label for="floatingSelect">Status D(Delta) talasa</label>
                    </div>
                    <button class="btn btn-primary w-100 m-2" type="submit" id="unesi" name="unesi" disabled>Unesi</button>
                    @endif
                </form>
            </div>
        </div>
        <div class="col-xl-6 col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align:center">Rizici posle petog koraka <i class="fa-solid fa-heart-circle-exclamation"></i></h6>
                <br>
                @if (!empty($ekg))
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
                @if (!empty($ekg))
                <a href="{{ route('finalniIzvestajSrce.doctor', [$id_test, $id]) }}"><button class="btn btn-primary w-100">Sledeći korak <i class="fa-solid fa-chevron-right"></i></button></a>
                @else
                <button class="btn btn-primary w-100" disabled>Sledeći korak <i class="fa-solid fa-chevron-right"></i></button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection