@extends('layout.doclayout')

@section('title', 'Srce | Korak 4')

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
                    @if (!empty($filter1) && !empty($filter2) && !empty($filter3) && !empty($filter4) && !empty($filter5) && !empty($filter6) && !empty($filter7) && !empty($filter8))
                    <a href="#" style="pointer-events: none;"><button class="btn btn-success">4</button></a>
                    @else
                    <a href="#" style="pointer-events: none;"><button class="btn btn-primary">4</button></a>
                    @endif
                    <a href="#" style="pointer-events: none;"><button class="btn btn-secondary" disabled>5</button></a>
                    <a href="#" style="pointer-events: none;"><button class="btn btn-secondary" disabled><i class="fa-solid fa-file-medical"></i></button></a>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align:center">Četvrti korak</h6>
                <div class="d-flex align-items-center justify-content-between mb-2 border-bottom">
                    <h6 class="mb-0" id="nalaz">Nalaz krvi</h6><i class="fa-solid fa-droplet"></i>
                </div>
                <div class="accordion accordion-flush" id="accordionFlushExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                Filter 1
                            </button>
                        </h2>
                        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <form action="{{ route('filter1.doctor') }}" method="POST">
                                    @csrf
                                    <input type="text" class="form-control" id="floatingInput" name="id" value="{{$id}}" hidden="">
                                    <input type="text" class="form-control" id="floatingInput" name="id_test" value="{{$id_test}}" hidden="">
                                    @if (empty($filter1))
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="hemoglobin" step="0.1">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Hemoglobin</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="leukociti" step="0.1">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Leukociti</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="neutrofili" step="0.1">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Neutrofili</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="limfociti" step="0.1">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Limfociti</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="peptidi" step="0.1">
                                        <label for="floatingInput">Natriuretski peptidi B-Tipa</label>
                                    </div>
                                    <button class="btn btn-primary w-100 m-2" type="submit" id="unesi1" name="unesi1">Unesi</button>
                                    @else
                                    <div class="form-floating mb-3">
                                        <input type="number" disabled class="form-control" id="floatingInput" placeholder="name@example.com" name="hemoglobin" step="0.1" value="{{$filter1->hemoglobin}}">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Hemoglobin</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" disabled class="form-control" id="floatingInput" placeholder="name@example.com" name="leukociti" step="0.1" value="{{$filter1->leukociti}}">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Leukociti</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" disabled class="form-control" id="floatingInput" placeholder="name@example.com" name="neutrofili" step="0.1" value="{{$filter1->neutrofili}}">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Neutrofili</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" disabled class="form-control" id="floatingInput" placeholder="name@example.com" name="limfociti" step="0.1" value="{{$filter1->limfociti}}">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Limfociti</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" disabled class="form-control" id="floatingInput" placeholder="name@example.com" name="peptidi" step="0.1" value="{{$filter1->peptidi}}">
                                        <label for="floatingInput">Natriuretski peptidi B-Tipa</label>
                                    </div>
                                    <button class="btn btn-primary w-100 m-2" type="submit" id="unesi1" name="unesi1" disabled>Unesi</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                Filter 2
                            </button>
                        </h2>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <form action="{{ route('filter2.doctor') }}" method="POST">
                                    @csrf
                                    <input type="text" class="form-control" id="floatingInput" name="id" value="{{$id}}" hidden="">
                                    <input type="text" class="form-control" id="floatingInput" name="id_test" value="{{$id_test}}" hidden="">
                                    @if (empty($filter2))
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="k" step="0.1">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Kalijum(K)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="na" step="0.1">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Natrijum(Na)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="ca" step="0.1">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Kalcijum(Ca)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="mg" step="0.1">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Magnezijum(Mg)</label>
                                    </div>
                                    <button class="btn btn-primary w-100 m-2" type="submit" id="unesi2" name="unesi2">Unesi</button>
                                    @else
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" disabled id="floatingInput" placeholder="name@example.com" name="k" step="0.1" value="{{$filter2->k}}">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Kalijum(K)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" disabled id="floatingInput" placeholder="name@example.com" name="na" step="0.1" value="{{$filter2->na}}">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Natrijum(Na)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" disabled id="floatingInput" placeholder="name@example.com" name="ca" step="0.1" value="{{$filter2->ca}}">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Kalcijum(Ca)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" disabled id="floatingInput" placeholder="name@example.com" name="mg" step="0.1" value="{{$filter2->mg}}">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Magnezijum(Mg)</label>
                                    </div>
                                    <button class="btn btn-primary w-100 m-2" type="submit" disabled id="unesi2" name="unesi2">Unesi</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                Filter 3
                            </button>
                        </h2>
                        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <form action="{{ route('filter3.doctor') }}" method="POST">
                                    @csrf
                                    <input type="text" class="form-control" id="floatingInput" name="id" value="{{$id}}" hidden="">
                                    <input type="text" class="form-control" id="floatingInput" name="id_test" value="{{$id_test}}" hidden="">
                                    @if (empty($filter3))
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="tryg" step="0.1">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Trigliceridi(TRY)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="hdl" step="0.1">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Lipoprotein visoke gustine(HDL)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="ldl" step="0.1">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Lipoprotein male gustine(LDL)</label>
                                    </div>
                                    <button class="btn btn-primary w-100 m-2" type="submit" id="unesi3" name="unesi3">Unesi</button>
                                    @else
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" disabled id="floatingInput" placeholder="name@example.com" name="tryg" step="0.1" value="{{$filter3->tryg}}">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Trigliceridi(TRY)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" disabled id="floatingInput" placeholder="name@example.com" name="hdl" step="0.1" value="{{$filter3->hdl}}">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Lipoprotein visoke gustine(HDL)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" disabled id="floatingInput" placeholder="name@example.com" name="ldl" step="0.1" value="{{$filter3->ldl}}">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Lipoprotein male gustine(LDL)</label>
                                    </div>
                                    <button class="btn btn-primary w-100 m-2" type="submit" id="unesi3" name="unesi3" disabled>Unesi</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseFour">
                                Filter 4
                            </button>
                        </h2>
                        <div id="flush-collapseFour" class="accordion-collapse collapse" aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <form action="{{ route('filter4.doctor') }}" method="POST">
                                    @csrf
                                    <input type="text" class="form-control" id="floatingInput" name="id" value="{{$id}}" hidden="">
                                    <input type="text" class="form-control" id="floatingInput" name="id_test" value="{{$id_test}}" hidden="">
                                    @if (empty($filter4))
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="kreatinin" step="0.1">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Kreatinin(mmol/L)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="urea" step="0.1">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Urea(mmol/L)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="bun" step="0.1">
                                        <label for="floatingInput">BUN test(mg/dl)</label>
                                    </div>
                                    <button class="btn btn-primary w-100 m-2" type="submit" id="unesi4" name="unesi4">Unesi</button>
                                    @else
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" disabled id="floatingInput" placeholder="name@example.com" name="kreatinin" step="0.1" value="{{$filter4->kreatinin}}">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Kreatinin(mmol/L)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" disabled id="floatingInput" placeholder="name@example.com" name="urea" step="0.1" value="{{$filter4->urea}}">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Urea(mmol/L)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" disabled id="floatingInput" placeholder="name@example.com" name="bun" step="0.1" value="{{$filter4->bun}}">
                                        <label for="floatingInput">BUN test(mg/dl)</label>
                                    </div>
                                    <button class="btn btn-primary w-100 m-2" type="submit" id="unesi4" name="unesi4" disabled>Unesi</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive">
                                Filter 5
                            </button>
                        </h2>
                        <div id="flush-collapseFive" class="accordion-collapse collapse" aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <form action="{{ route('filter5.doctor') }}" method="POST">
                                    @csrf
                                    <input type="text" class="form-control" id="floatingInput" name="id" value="{{$id}}" hidden="">
                                    <input type="text" class="form-control" id="floatingInput" name="id_test" value="{{$id_test}}" hidden="">
                                    @if (empty($filter5))
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="ck" step="0.1">
                                        <label for="floatingInput">Kreatin kinaza(CK)(IU/L)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="ckmb" step="0.1">
                                        <label for="floatingInput">Kreatin kinaza MB(CK MB)(ng/mL)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="mioglobin" step="0.1">
                                        <label for="floatingInput">Mioglobin(MYG)(ng/mL)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="troponini" step="0.01">
                                        <label for="floatingInput">Srčani Troponin I tipa(mg/L)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="troponint" step="0.001">
                                        <label for="floatingInput">Srčani Troponin T tipa(ng/mL)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="cprotein" step="0.1">
                                        <label for="floatingInput">C-Reaktivni Protein(mg/L)</label>
                                    </div>
                                    <button class="btn btn-primary w-100 m-2" type="submit" id="unesi5" name="unesi5">Unesi</button>
                                    @else
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" disabled id="floatingInput" placeholder="name@example.com" name="ck" step="0.1" value="{{$filter5->ck}}">
                                        <label for="floatingInput">Kreatin kinaza(CK)(IU/L)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" disabled id="floatingInput" placeholder="name@example.com" name="ckmb" step="0.1" value="{{$filter5->ckmb}}">
                                        <label for="floatingInput">Kreatin kinaza MB(CK MB)(ng/mL)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" disabled id="floatingInput" placeholder="name@example.com" name="mioglobin" step="0.1" value="{{$filter5->mioglobin}}">
                                        <label for="floatingInput">Mioglobin(MYG)(ng/mL)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" disabled id="floatingInput" placeholder="name@example.com" name="troponini" step="0.01" value="{{$filter5->troponini}}">
                                        <label for="floatingInput">Srčani Troponin I tipa(mg/L)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" disabled id="floatingInput" placeholder="name@example.com" name="troponint" step="0.001" value="{{$filter5->troponint}}">
                                        <label for="floatingInput">Srčani Troponin T tipa(ng/mL)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" disabled id="floatingInput" placeholder="name@example.com" name="cprotein" step="0.1" value="{{$filter5->cprotein}}">
                                        <label for="floatingInput">C-Reaktivni Protein(mg/L)</label>
                                    </div>
                                    <button class="btn btn-primary w-100 m-2" type="submit" id="unesi5" name="unesi5" disabled>Unesi</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSix" aria-expanded="false" aria-controls="flush-collapseSix">
                                Filter 6
                            </button>
                        </h2>
                        <div id="flush-collapseSix" class="accordion-collapse collapse" aria-labelledby="flush-headingSix" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <form action="{{ route('filter6.doctor') }}" method="POST">
                                    @csrf
                                    <input type="text" class="form-control" id="floatingInput" name="id" value="{{$id}}" hidden="">
                                    <input type="text" class="form-control" id="floatingInput" name="id_test" value="{{$id_test}}" hidden="">
                                    @if (empty($filter6))
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="glukoza" step="0.1">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Glukoza(mmol/L)</label>
                                    </div>
                                    <button class="btn btn-primary w-100 m-2" type="submit" id="unesi6" name="unesi6">Unesi</button>
                                    @else
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" disabled placeholder="name@example.com" name="glukoza" step="0.1" value="{{$filter6->glukoza}}">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Glukoza(mmol/L)</label>
                                    </div>
                                    <button class="btn btn-primary w-100 m-2" type="submit" id="unesi6" name="unesi6" disabled>Unesi</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseSeven" aria-expanded="false" aria-controls="flush-collapseSeven">
                                Filter 7
                            </button>
                        </h2>
                        <div id="flush-collapseSeven" class="accordion-collapse collapse" aria-labelledby="flush-headingSeven" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <form action="{{ route('filter7.doctor') }}" method="POST">
                                    @csrf
                                    <input type="text" class="form-control" id="floatingInput" name="id" value="{{$id}}" hidden="">
                                    <input type="text" class="form-control" id="floatingInput" name="id_test" value="{{$id_test}}" hidden="">
                                    @if (empty($filter7))
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="aspartat" step="0.1">
                                        <label for="floatingInput">Aspartat Aminotransferaza(IU/L)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="alanin" step="0.1">
                                        <label for="floatingInput">Alaninska Aminotransferaza(IU/L)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="ggt" step="0.1">
                                        <label for="floatingInput">Gama Glutamil Transferaza(GGT)(IU/L)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="alp" step="0.1">
                                        <label for="floatingInput">Alkalna fosfataza(ALP)(IU/L)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="ldh" step="0.1">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Laktat Dehidrogeneza(LDH)(IU/L)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="blr" step="0.1">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>(BLR)Biliruibn(mg/dL)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="alb" step="0.1">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>(ALB)Albumin(g/dL)</label>
                                    </div>
                                    <button class="btn btn-primary w-100 m-2" type="submit" id="unesi7" name="unesi7">Unesi</button>
                                    @else
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" disabled name="aspartat" step="0.1" value="{{$filter7->aspartat}}">
                                        <label for="floatingInput">Aspartat Aminotransferaza(IU/L)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" disabled name="alanin" step="0.1" value="{{$filter7->alanin}}">
                                        <label for="floatingInput">Alaninska Aminotransferaza(IU/L)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" disabled name="ggt" step="0.1" value="{{$filter7->ggt}}">
                                        <label for="floatingInput">Gama Glutamil Transferaza(GGT)(IU/L)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" disabled name="alp" step="0.1" value="{{$filter7->alp}}">
                                        <label for="floatingInput">Alkalna fosfataza(ALP)(IU/L)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" disabled name="ldh" step="0.1" value="{{$filter7->ldh}}">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>Laktat Dehidrogeneza(LDH)(IU/L)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" disabled name="blr" step="0.1" value="{{$filter7->blr}}">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>(BLR)Biliruibn(mg/dL)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" disabled name="alb" step="0.1" value="{{$filter7->alb}}">
                                        <label for="floatingInput"><sup style="color: red;">*</sup>(ALB)Albumin(g/dL)</label>
                                    </div>
                                    <button class="btn btn-primary w-100 m-2" type="submit" id="unesi7" name="unesi7" disabled>Unesi</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseEight" aria-expanded="false" aria-controls="flush-collapseEight">
                                Filter 8
                            </button>
                        </h2>
                        <div id="flush-collapseEight" class="accordion-collapse collapse" aria-labelledby="flush-headingEight" data-bs-parent="#accordionFlushExample">
                            <div class="accordion-body">
                                <form action="{{ route('filter8.doctor') }}" method="POST">
                                    @csrf
                                    <input type="text" class="form-control" id="floatingInput" name="id" value="{{$id}}" hidden="">
                                    <input type="text" class="form-control" id="floatingInput" name="id_test" value="{{$id_test}}" hidden="">
                                    @if (empty($filter8))
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="tsh" step="0.01">
                                        <label for="floatingInput">Tierostimiulišući hormon(TSH)(mIU/L)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="freet3" step="0.01">
                                        <label for="floatingInput">Triiodotironin(FREE T3)(pg/mL)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" placeholder="name@example.com" name="freet4" step="0.01">
                                        <label for="floatingInput">Tiroksin(FREE T4)(pg/mL)</label>
                                    </div>
                                    <button class="btn btn-primary w-100 m-2" type="submit" id="unesi8" name="unesi8">Unesi</button>
                                    @else
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" disabled id="floatingInput" placeholder="name@example.com" name="tsh" step="0.01" value="{{$filter8->tsh}}">
                                        <label for="floatingInput">Tierostimiulišući hormon(TSH)(mIU/L)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" disabled id="floatingInput" placeholder="name@example.com" name="freet3" step="0.01" value="{{$filter8->freet3}}">
                                        <label for="floatingInput">Triiodotironin(FREE T3)(pg/mL)</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="number" class="form-control" id="floatingInput" disabled placeholder="name@example.com" name="freet4" step="0.01" value="{{$filter8->freet4}}">
                                        <label for="floatingInput">Tiroksin(FREE T4)(pg/mL)</label>
                                    </div>
                                    <button class="btn btn-primary w-100 m-2" type="submit" id="unesi8" name="unesi8" disabled>Unesi</button>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-sm-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align:center">Rizici posle četvrtog koraka <i class="fa-solid fa-heart-circle-exclamation"></i></h6>
                <br>
                @if (!empty($filter1))
                <div id="filter1Rizik"></div>
                @else
                <div class="alert alert-warning fade show" role="alert" style="text-align: center;">
                    <i class="fa fa-exclamation-circle me-2"></i>Prvo popunite filter 1!
                </div>
                @endif
                <br>
                @if (!empty($filter2))
                <div id="filter2Rizik"></div>
                @else
                <div class="alert alert-warning fade show" role="alert" style="text-align: center;">
                    <i class="fa fa-exclamation-circle me-2"></i>Prvo popunite filter 2!
                </div>
                @endif
                <br>
                @if (!empty($filter3))
                <div id="filter3Rizik"></div>
                @else
                <div class="alert alert-warning fade show" role="alert" style="text-align: center;">
                    <i class="fa fa-exclamation-circle me-2"></i>Prvo popunite filter 3!
                </div>
                @endif
                <br>
                @if (!empty($filter4))
                <div id="filter4Rizik"></div>
                @else
                <div class="alert alert-warning fade show" role="alert" style="text-align: center;">
                    <i class="fa fa-exclamation-circle me-2"></i>Prvo popunite filter 4!
                </div>
                @endif
                <br>
                @if (!empty($filter5))
                <div id="filter5Rizik"></div>
                @else
                <div class="alert alert-warning fade show" role="alert" style="text-align: center;">
                    <i class="fa fa-exclamation-circle me-2"></i>Prvo popunite filter 5!
                </div>
                @endif
                <br>
                @if (!empty($filter6))
                <div id="filter6Rizik"></div>
                @else
                <div class="alert alert-warning fade show" role="alert" style="text-align: center;">
                    <i class="fa fa-exclamation-circle me-2"></i>Prvo popunite filter 6!
                </div>
                @endif
                <br>
                @if (!empty($filter7))
                <div id="filter7Rizik"></div>
                @else
                <div class="alert alert-warning fade show" role="alert" style="text-align: center;">
                    <i class="fa fa-exclamation-circle me-2"></i>Prvo popunite filter 7!
                </div>
                @endif
                <br>
                @if (!empty($filter8))
                <div id="filter8Rizik"></div>
                @else
                <div class="alert alert-warning fade show" role="alert" style="text-align: center;">
                    <i class="fa fa-exclamation-circle me-2"></i>Prvo popunite filter 8!
                </div>
                @endif
            </div>
        </div>

        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                @if (!empty($filter1) && !empty($filter2) && !empty($filter3) && !empty($filter4) && !empty($filter5) && !empty($filter6) && !empty($filter7) && !empty($filter8))
                <a href="{{ route('korak5Srce.doctor', [$id_test, $id]) }}"><button class="btn btn-primary w-100">Sledeći korak <i class="fa-solid fa-chevron-right"></i></button></a>
                @else
                <button class="btn btn-primary w-100" disabled>Sledeći korak <i class="fa-solid fa-chevron-right"></i></button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection