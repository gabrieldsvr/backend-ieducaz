@extends('layouts.master')

@push('styles')
    <link rel="stylesheet" href="{{url('vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
    <link rel="stylesheet" href="{{url('vendors/dragula/dragula.min.css')}}">
    <style>
        .dropdown .dropdown-toggle:after {
            display: none !important;
        }
    </style>
@endpush

@section('content')


    <div class="row flex-grow">
        <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
            <div class="card card-rounded">
                <div class="card-body">
                    <div class="row mb-5">
                        <div class="col-10">
                            <div class="d-sm-flex justify-content-between align-items-start mb-3 mt-5">
                                <h5 class="card-title">Funil de vendas</h5>
                            </div>
                        </div>

                        <div class="col-md-2 col-6 d-flex align-items-center ">
                            <a href="#" data-bs-toggle="modal" data-route="{{route('funnel.create')}}"
                               data-bs-target="#modal-tela"
                               data-button-success="Criar" data-body="Cadastro de negócio"
                               data-title="Cadastro de negócio" class="box btn btn-sm btn-info float-end ">

                                <div class="d-flex align-items-center">
                                    <i class="icon icon-plus me-1"></i> Adicionar negócio ao funil
                                </div>
                            </a>

                        </div>

                    </div>
                    <div class="row">
                        <div class="container overflow-auto pt-5" id="div-darcula">
                            <div class="row flex-nowrap">
                                @foreach($funnel->json as $key=>$value)
                                    <div class="col-lg-3 col-4">
                                        <blockquote class="blockquote p-3 text-center"
                                                    style="background-color: {{$value['color']}}">
                                            <h6 class="card-title m-0 text-white">{{$value['name']}}</h6>
                                        </blockquote>
                                        <div id="dragula-{{$key}}" class="py-2">
                                            @foreach($cards as $card)
                                                @if($card->order == $key)
                                                    <div class="card rounded border mb-2" id="{{$card->id}}">
                                                        <div class="card-body p-3">
                                                            <div class="media">
                                                                <div class="dropdown dropup me-3">
                                                                    <button class="btn dropdown-toggle p-0"
                                                                            type="button" id="dropdownMenuIconButton1"
                                                                            data-bs-toggle="dropdown"
                                                                            aria-haspopup="true" aria-expanded="false">
                                                                        <i class="ti-more icon-sm align-self-center me-3"></i>
                                                                    </button>
                                                                    <div class="dropdown-menu"
                                                                         aria-labelledby="dropdownMenuIconButton1">
                                                                        <h6 class="dropdown-header">Opções</h6>
                                                                        <a class="dropdown-item" href="#" onclick="excluiCard('{{$card->id}}')">
                                                                            <i class="ti-trash icon-sm text-danger"></i> Excluir</a>

                                                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-route="{{route('funnelCard.edit', $card)}}"
                                                                           data-bs-target="#modal-tela"
                                                                           data-button-success="Editar" data-body="Edição de negócio"
                                                                           data-title="Edição de negócio">
                                                                            <i class="ti-pencil icon-sm text-info"></i> Editar</a>
{{--                                                                        <a class="dropdown-item" href="#">--}}
{{--                                                                            <i class="ti-na icon-sm text-danger"></i> Negócio perdido</a>--}}
{{--                                                                        <a class="dropdown-item" href="#">--}}
{{--                                                                            <i class="ti-check-box icon-sm text-success"></i> Negócio fechado</a>--}}
                                                                    </div>
                                                                </div>
                                                                <div class="media-body">
                                                                    <h6 class="mb-1 d-inline-block"> {{$card->person()->name}}</h6>
                                                                    <p class="mb-0 text-muted">
                                                                        {{$card->imovel()->getName()}}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('plugin-scripts')
    <script src="{{ url("vendors/datatables.net/jquery.dataTables.js") }}"></script>
    <script src="{{ url("vendors/datatables.net-bs4/dataTables.bootstrap4.js") }}"></script>
    <script src="{{ url("vendors/sweetalert/sweetalert.min.js") }}"></script>
    <script src="{{ url("vendors/jquery.avgrund/jquery.avgrund.min.js") }}"></script>


    <script src="{{url('js/datatables.js')}}"></script>
    <script src="{{url('vendors/dragula/dragula.min.js')}}"></script>
@endpush
@push('custom-scripts')
{{--    DRAGULA--}}
    <script>

        var teste = 0;

        dragula([document.getElementById("dragula-0"), document.getElementById("dragula-1"), document.getElementById("dragula-2"), document.getElementById("dragula-3"), document.getElementById("dragula-4"), document.getElementById("dragula-5")]).on('drop', function (el) {
            var index_new_pos = $(el).parent().attr('id').split('dragula-')[1];
            console.log(index_new_pos);
            var id_card = $(el).attr("id")
            $.ajax({
                type: "POST",
                url: "funnelCard/changePosition",
                data: {"order": index_new_pos, "id": id_card, "_token": "{{@csrf_token()}}"},
                dataType: 'json'
            });
        });
    </script>

<script>

    function excluiCard(id){
        swal({
            title: 'Você tem certeza?',
            text: "Você não terá como recuperar os dados!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3f51b5',
            cancelButtonColor: '#ff4081',
            confirmButtonText: 'Great ',
            buttons: {
                cancel: {
                    text: "Cancelar",
                    value: null,
                    visible: true,
                    className: "btn btn-danger",
                    closeModal: true,
                },
                confirm: {
                    text: "OK",
                    value: true,
                    visible: true,
                    className: "btn btn-primary",
                    closeModal: true
                }
            }
        })
            .then(function(e) {
                if(e){

                    $.ajax({
                        type: "DELETE",
                        url: "funnelCard/"+id,
                        data: {"id": id, "_token": "{{@csrf_token()}}"},
                        dataType: 'json',
                        beforeSend: function () {
                            showToast('Aguarde...', 'Excluindo', 'warning');
                        },
                        success: function (data) {
                            showToast('Sucesso!', 'Removido com sucesso!', 'success');
                            removeCard(id);
                        },

                    });
                }
            });
    }
    function createCard(card) {
        $.ajax({
            type: "POST",
            url: "funnelCard/getCard",
            data: {"card": card, "_token": "{{@csrf_token()}}"},
            success: function (data) {
                $("#dragula-"+card.order).append(data)
            },
        });

    }

    function removeCard(card_id) {
        $("#"+card_id).remove()
    }

</script>
@endpush
