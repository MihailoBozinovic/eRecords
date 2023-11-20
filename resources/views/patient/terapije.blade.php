@extends('layout.user')

@section('title', 'Terapije')

@section('content')
<div class="container-fluid pt-4 px-4">
    <a href="{{ url()->previous() }}" class="btn btn-primary" style="margin-bottom:10px;">
        <i class="fa-solid fa-chevron-left"></i> Nazad
    </a>
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align: center;">Terapije</h6>
                <div class="table-responsive">
                    <table class="table table-hover" style="width:100%; text-align: center;" id="terapijeTabela">
                        <thead>
                            <tr>
                                <th scope="col" style="text-align: center">Naziv</th>
                                <th scope="col" style="text-align: center">Oblik/Doza</th>
                                <th scope="col" style="text-align: center">Nosilac Dozvole</th>
                                <th scope="col" style="text-align: center; width:20%">Količina <i class="fa-solid fa-scale-unbalanced-flip"></i></th>
                                <th scope="col" style="text-align: center; width:20%">Period <i class="fa-solid fa-calendar-week"></i></th>
                                <th scope="col" style="text-align: center;">Komentar</th>
                                <th scope="col" style="text-align: center;">Vreme</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($terapije as $t)

                            @php
                            $r = rand(50,100);
                            $g = rand(50,100);
                            $b = rand(50,100);
                            @endphp
                            <tr style="background-color:rgba({{$r}},{{$g}},{{$b}}, 0.2);">
                                <td>{{$t->naziv}}</td>
                                <td>{{$t->oblik_doza}}</td>
                                <td>{{$t->nosilac_dozvole}}</td>
                                <td>{{$t->kolicina}}</td>
                                <td>{{$t->period}}</td>
                                <td>
                                    <a href="#" class="btn btn-primary w-100" title="Komentar" data-toggle="popover" data-bs-placement="left" data-bs-content="{{$t->komentar}}">
                                        <i class="fa-solid fa-comment"></i>
                                    </a>
                                </td>
                                <td><strong>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $t->vreme)->format('d/m/Y H:i:s')}}</strong></td>
                            </tr>
                            @empty
                            <div class="alert alert-info fade show" role="alert" style="text-align: center;">
                                <i class="fa fa-exclamation-circle me-2"></i>Nema unetih terapija!
                            </div>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection