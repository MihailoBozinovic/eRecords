@extends('layout.doclayout')

@section('title', 'Razgovor uživo')

@section('content')
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 style="text-align:center;">Razgovori</h6>
                <div class="card">
                    <div class="row g-0">
                        <div class="col-12 col-lg-5 col-xl-3 border-right">
                            @foreach ($razgovori as $l)
                            <a href="#" id="{{$l->id}}" data-id-lekar="{{$l->id_lekar}}" data-id-chat="{{$l->id}}" data-id-pacijent="{{Session::get('ID')}}" onclick="otvoriChatPacijent(this.id);" class="list-group-item list-group-item-action border-0">
                                <div class="badge bg-success float-right" id="brojPoruka{{$l->id}}">{{$l->brojPoruka}}</div>
                                <div class="d-flex align-items-start">
                                    <img src="{{ asset('img/user.png') }}" class="rounded-circle mr-1" alt="{{$l->ime}} {{$l->prezime}}" width="40" height="40">
                                    <div class="flex-grow-1 ml-3" style="margin-left:10px;">
                                        <strong>{{$l->ime}} {{$l->prezime}}</strong>
                                        @if ($l->online == 1)
                                        <div class="small"><span class="fas fa-circle chat-online"></span> Na mreži</div>
                                        @else
                                        <div class="small"><span class="fas fa-circle chat-offline"></span> Nije na mreži</div>
                                        @endif
                                    </div>
                                </div>
                            </a>
                            <hr style="width:75%; margin: auto;">
                            @endforeach
                            <hr class="d-block d-lg-none mt-1 mb-0">
                        </div>
                        @php
                        $i = 0;
                        @endphp
                        @foreach ($razgovori as $r)
                        @if ($i == 0)
                        <div class="col-12 col-lg-7 col-xl-9 aktivanRazgovor" style="height:auto;" id="konverzacija{{$r->id}}">
                            <input hidden id="id_primalac{{$r->id}}" value="{{$r->id_pacijent}}" />
                            <input hidden id="id_posiljalac{{$r->id}}" value="{{$r->id_lekar}}" />
                            <input hidden id="idChat{{$r->id}}" value="{{$r->id}}" />
                            <input hidden id="ime{{$r->id}}" value="{{$r->ime}} {{$r->prezime}}" />
                            <div class="py-2 px-4 border-bottom d-none d-lg-block">
                                <div class="d-flex align-items-center py-1">
                                    <div class="position-relative">
                                        <img src="{{ asset('img/user.png') }}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                    </div>
                                    <div class="flex-grow-1 pl-3" style="margin-left: 15px;">
                                        <strong>{{$r->ime}} {{$r->prezime}}</strong>
                                        <div class="text-muted small"><em id="typing{{$r->id_pacijent}}"></em></div>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative aktivnePoruke" id="poruke{{$r->id}}" style="height:500px; overflow-y: auto;" data-id="{{$r->id}}">
                            </div>
                            <div class="flex-grow-0 py-3 px-4 border-top">
                                <div class="input-group">
                                    <input type="text" class="form-control slanje_poruke" data-id="{{$r->id}}" placeholder="Napišite poruku..." id="poruka{{$r->id}}" onkeypress="slanjePoruke(event, this.id)">
                                    <button class="btn btn-primary" id="slanjePoruke{{$r->id}}" onclick="posaljiPoruku('{{$r->id}}')" type="button"><i class="fa-solid fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-12 col-lg-7 col-xl-9" style="height:auto; display: none;" id="konverzacija{{$r->id}}">
                            <input hidden id="id_primalac{{$r->id}}" value="{{$r->id_pacijent}}" />
                            <input hidden id="id_posiljalac{{$r->id}}" value="{{$r->id_lekar}}" />
                            <input hidden id="idChat" value="{{$r->id}}" />
                            <input hidden id="ime{{$r->id}}" value="{{$r->ime}} {{$r->prezime}}" />
                            <div class="py-2 px-4 border-bottom d-none d-lg-block">
                                <div class="d-flex align-items-center py-1">
                                    <div class="position-relative">
                                        <img src="{{ asset('img/user.png') }}" class="rounded-circle mr-1" alt="Sharon Lessman" width="40" height="40">
                                    </div>
                                    <div class="flex-grow-1 pl-3" style="margin-left: 15px;">
                                        <strong>{{$r->ime}} {{$r->prezime}}</strong>
                                        <div class="text-muted small"><em id="typing{{$r->id_pacijent}}"></em></div>
                                    </div>
                                </div>
                            </div>
                            <div class="position-relative" id="poruke{{$r->id}}" data-id="{{$r->id}}" style="height:500px; overflow-y: auto;">
                            </div>
                            <div class="flex-grow-0 py-3 px-4 border-top">
                                <div class="input-group">
                                    <input type="text" class="form-control slanje_poruke" data-id="{{$r->id}}" placeholder="Napišite poruku..." id="poruka{{$r->id}}" onkeypress="slanjePoruke(event, this.id)">
                                    <button class="btn btn-primary" id="slanjePoruke{{$r->id}}" onclick="posaljiPoruku('{{$r->id}}')" type="button"><i class="fa-solid fa-paper-plane"></i></button>
                                </div>
                            </div>
                        </div>
                        @endif
                        @php
                        $i++;
                        @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection