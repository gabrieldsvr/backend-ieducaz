@extends('layouts.master')

@push('styles')

    <link rel="stylesheet" href="{{url('vendors/jquery-file-upload/uploadfile.css')}}">
    <link rel="stylesheet" href="{{url('css/swiper-bundle.min.css')}}">
@endpush

@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Adicione novo imovel</h4>
                <form class="forms-sample" id="formImovel" enctype="multipart/form-data" method="POST"
                      action="{{route('imovel.update',$id)}}">
                    @csrf
                    @method('PUT')
                    {{--                    INFORMAÇÕES PRINCIPAIS--}}

                    <div class="row">
                        <div class="form-group">
                            <div class="tooltip-static-demo">
                                <div class="tooltip bs-tooltip-top bs-tooltip-top-demo" data-bs-toggle="tooltip"
                                     data-bs-placement="top"
                                     title="Acione quando tiver mais de uma planta no mesmo link">
                                    <div class="arrow"></div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="quantidade_venda"
                                                   id="quantidade_venda1"
                                                   value="0" {{$imovel['quantidade_venda'] == 0 ? "checked" : ""}} >
                                            Mais de um imóvel diferente
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="quantidade_venda"
                                           id="quantidade_venda2"
                                           value="1" {{$imovel['quantidade_venda'] == 1 ? "checked" : ""}}>
                                    Somente um imóvel a venda
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12 col-sm-6 col-md-4">
                            <label for="exampleInputName1">{{trans('imovel_form.nome')}}:</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Name"
                                   value="{{$imovel['nome'] ?? ""}}">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-4">
                            <label for="exampleSelectGender">{{trans('imovel_form.tipo_do_imovel')}}:</label>
                            <select class="form-control" id="tipo" name="tipo">
                                <option value="casa" {{$imovel['tipo'] == 'casa' ? "selected" : ""}}>Casa</option>
                                <option value="apartamento" {{$imovel['tipo'] == 'apartamento' ? "selected" : ""}}>
                                    Apartamento
                                </option>
                            </select>
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-4">
                            <label for="exampleSelectGender">{{trans('imovel_form.valor')}}:</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-primary text-white"><span
                                            style="vertical-align: inherit;"><span
                                                style="vertical-align: inherit;">R$</span></span></span>
                                </div>
                                <input type="text" class="form-control valor" aria-label="Valor do imóvel"
                                       data-inputmask="'alias': 'real'" id="valor" name="valor"
                                       value="{{$imovel['valor'] ?? ""}}">
                            </div>
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-4">
                            <label for="codigo">{{trans('imovel_form.codigo')}}:</label>
                            <input type="text" class="form-control" id="codigo" name="codigo"
                                   placeholder="codigo do imóvel" value="{{$imovel['codigo'] ?? ""}}">
                        </div>
                        <div class="form-group col-12 ">
                            <label for="descricao">{{trans('imovel_form.descricao')}}:</label>
                            <textarea class="form-control" name="descricao" id="descricao"
                                      rows="5">{{$imovel['descricao'] ?? ""}}</textarea>
                        </div>
                    </div>
                    <hr>


                    {{--                    ENDEREÇO--}}
                    <h4 class="card-title">Endereço</h4>
                    <div class="row">
                        <div class="col-12 col-md-3 form-group">
                            <label for="cep" class="text-uppercase">{{trans('imovel_form.cep')}}: </label>
                            <input type="text" class="form-control cep" id="cep" onfocusout="busca(this.value)"
                                   name="cep" data-inputmask-alias="99999-999" value="{{$imovel['cep'] ?? ""}}">
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group col-12 col-sm-6 col-md-3 ">
                            <label for="estado" class="text-uppercase">{{trans('imovel_form.estado')}}: </label>
                            <input type="text" class="form-control" id="estado" name="estado" placeholder="uf"
                                   value="{{$imovel['estado'] ?? ""}}">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-3">
                            <label for="cidade" class="text-uppercase">{{trans('imovel_form.cidade')}}: </label>
                            <input type="text" class="form-control" id="cidade" name="cidade" placeholder="cidade"
                                   value="{{$imovel['cidade'] ?? ""}}">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-3">
                            <label for="bairro" class="text-uppercase">{{trans('imovel_form.bairro')}}: </label>
                            <input type="text" class="form-control" id="bairro" name="bairro" placeholder="bairro"
                                   value="{{$imovel['bairro'] ?? ""}}">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-3">
                            <label for="rua" class="text-uppercase">{{trans('imovel_form.rua')}}: </label>
                            <input type="text" class="form-control" id="rua" name="rua" placeholder="Name"
                                   value="{{$imovel['rua'] ?? ""}}">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-2">
                            <label for="numero" class="text-uppercase">{{trans('imovel_form.numero')}}: </label>
                            <input type="text" class="form-control" id="numero" name="numero" placeholder="numero"
                                   value="{{$imovel['numero'] ?? ""}}">
                        </div>
                    </div>
                    <hr>

                    {{--                    CARACTERISTICAS--}}
                    <h4 class="card-title">Características</h4>
                    <div class="row">
                        <div class="form-group col-12 col-sm-6 col-md-3">
                            <label for="dormitorios" class="text-uppercase">{{trans('imovel_form.dormitorios')}}
                                :</label>
                            <input type="text" class="form-control" id="dormitorios" name="dormitorios"
                                   placeholder="1-2" value="{{$imovel['caracteristicas']['cama'] ?? ""}}">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-3">
                            <label for="suites" class="text-uppercase">{{trans('imovel_form.suites')}}
                                :</label>
                            <input type="text" class="form-control" id="suites" name="suites"
                                   placeholder="1-2" value="{{$imovel['caracteristicas']['suites'] ?? ""}}">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-3">
                            <label for="banheiros" class="text-uppercase">{{trans('imovel_form.banheiros')}}:</label>
                            <input type="text" class="form-control" id="banheiros" name="banheiros" placeholder="1-2"
                                   value="{{$imovel['caracteristicas']['banheiro'] ?? ""}}">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-3">
                            <label for="garagem" class="text-uppercase">{{trans('imovel_form.garagem')}}:</label>
                            <input type="text" class="form-control" id="garagem" name="garagem" placeholder="1-2"
                                   value="{{$imovel['caracteristicas']['garagem'] ?? ""}}">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-3">
                            <label for="area" class="text-uppercase">{{trans('imovel_form.area')}}:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="area" name="area" placeholder="110-180"
                                       value="{{$imovel['area'] ?? ""}}">
                                <div class="input-group-append">
                                    <span class="input-group-text">m²</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>


                    {{--                    UNIDADES--}}
                    <h4 class="card-title">Unidades:</h4>
                    <div class="row">
                        <div class="" id="div-unidades">
                            @if(isset($imovel['unidades']))
                                @foreach($imovel['unidades'] as $key =>$unidade)
                                    <div class="form-group" id="unidade{{$key}}">
                                        <input type="text" name="unidades[]" placeholder="Descrição da unidade "
                                               class="form-control w-75 d-inline-block" value="{{$unidade}}">
                                        @if($key == 0)
                                            <button id="add-campo" type="button"
                                                    class="btn btn-info btn-sm icon-btn ms-2 mb-2">
                                                <i class="ti-plus"></i>
                                            </button>
                                        @endif
                                        @if($key != 0)
                                            <button type="button" id="{{$key}}"
                                                    class="btn btn-danger btn-sm icon-btn ms-2 btn-apagar"
                                                    onclick="apagarItemUnidade({{$key}})"><i class="ti-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                            @if(!isset($imovel['unidades']))
                                <div class="form-group" id="unidade0">
                                    <input type="text" name="unidades[]" placeholder="Descrição da unidade "
                                           class="form-control w-75 d-inline-block">
                                    <button id="add-campo" type="button"
                                            class="btn btn-info btn-sm icon-btn ms-2 mb-2">
                                        <i class="ti-plus"></i>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <hr>


                    {{--                    DETALHES DO APARTAMENTO--}}
                    <h4 class="card-title">Detalhes do apartamento:</h4>
                    <div class="row">
                        <div class="" id="div-detalhes-ape">

                            @if(isset($imovel['detalhes']))
                                @foreach($imovel['detalhes'] as $key =>$detalhes)
                                    <div class="form-group" id="detalhe{{$key}}">
                                        <input type="text" name="detalhes[]" placeholder="Descrição da unidade "
                                               class="form-control w-75 d-inline-block" value="{{$detalhes}}">
                                        @if($key == 0)
                                            <button id="add-campo-detalhe_ape" type="button"
                                                    class="btn btn-info btn-sm icon-btn ms-2 mb-2">
                                                <i class="ti-plus"></i>
                                            </button>
                                        @endif
                                        @if($key != 0)
                                            <button type="button" id="{{$key}}"
                                                    class="btn btn-danger btn-sm icon-btn ms-2 btn-apagar"
                                                    onclick="apagarItemDetalhe({{$key}})"><i class="ti-trash"></i>
                                            </button>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                            @if(!isset($imovel['detalhes']))
                                <div class="form-group" id="detalhe0">
                                    <input type="text" name="detalhes[]" placeholder="Descrição dos detalhes"
                                           class="form-control w-75 d-inline-block">

                                    <button id="add-campo-detalhe_ape" type="button"
                                            class="btn btn-info btn-sm icon-btn ms-2 mb-2">
                                        <i class="ti-plus"></i>
                                    </button>
                                </div>
                            @endif

                        </div>
                    </div>
                    <hr>


                    {{--                    DETALHES DO CONDOMINIO--}}
                    <h4 class="card-title">Detalhes do condominio:</h4>
                    <div class="row">
                        <div class="" id="div-condominio">
                            <div class="form-group">

                                @if(isset($imovel['condominio']))
                                    @foreach($imovel['condominio'] as $key =>$condominio)
                                        <div class="form-group" id="condominio{{$key}}">
                                            <input type="text" name="condominio[]"
                                                   placeholder="Descrição do condominio "
                                                   class="form-control w-75 d-inline-block" value="{{$condominio}}">
                                            @if($key == 0)
                                                <button id="add-campo-condominio" type="button"
                                                        class="btn btn-info btn-sm icon-btn ms-2 mb-2">
                                                    <i class="ti-plus"></i>
                                                </button>
                                            @endif
                                            @if($key != 0)
                                                <button type="button" id="{{$key}}"
                                                        class="btn btn-danger btn-sm icon-btn ms-2 btn-apagar"
                                                        onclick="apagarItemCondominio({{$key}})"><i
                                                        class="ti-trash"></i></button>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                                @if(!isset($imovel['condominio']))
                                    <div class="form-group" id="condominio0">
                                        <input type="text" name="condominio[]" placeholder="Descrição do condominio "
                                               class="form-control w-75 d-inline-block">
                                        <button id="add-campo-condominio" type="button"
                                                class="btn btn-info btn-sm icon-btn ms-2 mb-2">
                                            <i class="ti-plus"></i>
                                        </button>
                                    </div>
                                @endif


                            </div>
                        </div>
                    </div>
                    <hr>


                    {{--                    UPLOAD IMAGENS--}}
                    <h4 class="card-title">Midias do Empreendimento:</h4>
                    <div class="row">
                        <div class="form-group">
                            <label for="imagem_destaque[]" class="label">Imagem de capa</label>
                            <input type="file" class="form-control" name="imagem_destaque[]" id="imagem_destaque"
                                   value="{{$imovel['imagem_destaque'] ?? ""}}">

                        </div>
                        <div class="form-group">

                            <img src="{{$imovel['imagem_destaque']}}" class="img-thumbnail" style=" max-width: 200px;
    max-height:250px;
    width: auto;
    height: auto;">
                        </div>
                        <div class="form-group">
                            <label for="photos[]" class="label">Imagens da propriedade</label>
                            <input type="file" class="form-control" name="photos[]" multiple>
                        </div>
                        <div class="form-group">
                            @foreach($imovel['imagens'] as $img)
                                <img src="{{$img}}" class="img-thumbnail" style=" max-width: 200px;
    max-height:250px;
    width: auto;
    height: auto;">
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label for="video" class="label">URL do video ou playlist</label>
                            <input type="text" value="{{$imovel['video'] ?? ""}}" class="form-control" name="video"
                                   id="video" placeholder="https://www.youtube.com/watch?v=exemplo">
                        </div>
                    </div>

                    {{--                    BOTÕES DE ENVIO--}}
                    <button type="submit" class="btn btn-primary me-2">Editar</button>
                    <a class="btn btn-light" href="{{route('dashboard')}}">Cancelar</a>
                </form>

            </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')

    <script src="{{url('vendors/inputmask/jquery.inputmask.bundle.js')}}"></script>
    <script src="{{url('vendors/jquery-file-upload/jquery.uploadfile.min.js')}}"></script>
    <script src="{{ url("vendors/jquery-validation/jquery.validate.min.js") }}"></script>
    <script src="{{ url("vendors/sweetalert/sweetalert.min.js") }}"></script>
    <script src="{{ url("vendors/bootstrap-maxlength/bootstrap-maxlength.min.js") }}"></script>
@endpush

@push('custom-scripts')

    <script>
        swal({
            title: 'Atenção!',
            text: "As imagens do imóvel só serão alteradas caso você efetue upload de imagens novamente",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3f51b5',
            cancelButtonColor: '#ff4081',
            confirmButtonText: 'Great ',
            buttons: {
                confirm: {
                    text: "OK",
                    value: true,
                    visible: true,
                    className: "btn btn-primary",
                    closeModal: true
                }
            }
        })
    </script>
    <script src="{{url('js/inputmask.js')}}"></script>




    {{--SCRIPTS CEP--}}
    <script>
        showNaoEncontradoCepToast = function (text) {
            'use strict';
            resetToastPosition();
            $.toast({
                heading: 'Atenção!',
                text: text,
                showHideTransition: 'slide',
                icon: 'warning',
                loaderBg: '#57c7d4',
                position: 'top-right'
            })
        };
        resetToastPosition = function () {
            $('.jq-toast-wrap').removeClass('bottom-left bottom-right top-left top-right mid-center'); // to remove previous position class
            $(".jq-toast-wrap").css({
                "top": "",
                "left": "",
                "bottom": "",
                "right": ""
            }); //to remove previous position style
        }

        function busca(cep) {

            if (cep) {
                $.ajax({
                    type: "GET",
                    url: "<?=env('APP_URL', '')?>/imovel/cep/" + cep,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    dataType: 'json',
                    success: function (data) {
                        autoCompleateCep(data);
                        console.log(data);
                    },
                    error: function (data) {
                        showNaoEncontradoCepToast(data.responseText);
                        $("#rua").val("");
                        $("#bairro").val("");
                        $("#cidade").val("");
                        $("#estado").val("");
                    }
                });
            }
        }

        function autoCompleateCep(cep) {
            $("#rua").val(cep.logradouro);
            $("#bairro").val(cep.bairro);
            $("#cidade").val(cep.localidade);
            $("#estado").val(cep.uf);
        }
    </script>

    {{--ADICIONA NOVO CAMPO UNIDADE--}}
    <script>
        var contUnidade = document.getElementById('div-unidades').children.length - 1;
        //https://api.jquery.com/click/
        $('#add-campo').click(function () {
            contUnidade++;
            //https://api.jquery.com/append/
            $('#div-unidades').append('<div class="form-group" id="unidade' + contUnidade + '"><input type="text" name="unidades[]" placeholder="Descrição da unidade " class="form-control w-75 d-inline-block" ><button type="button" id="' + contUnidade + '" class="btn btn-danger btn-sm icon-btn ms-2 btn-apagar" onclick="apagarItemUnidade(' + contUnidade + ')"><i class="ti-trash"></i></button></div>');
        });

        function apagarItemUnidade(id) {
            $('#unidade' + id).remove();
        }
    </script>

    {{--ADICIONA NOVO CAMPO DETALHES APARTAMENTO--}}
    <script>
        var contApe = document.getElementById('div-detalhes-ape').children.length - 1;
        $('#add-campo-detalhe_ape').click(function () {
            contApe++;
            $('#div-detalhes-ape').append('<div class="form-group" id="detalhe' + contApe + '"><input type="text" name="detalhes[]" placeholder="Adicione um detalhe do apartamento" class="form-control w-75 d-inline-block" ><button type="button" id="excluirdetalhe' + contApe + '" class="btn btn-danger btn-sm icon-btn ms-2" onclick="apagarItemDetalhe(' + contApe + ')"><i class="ti-trash"></i></button></div>');
        });

        function apagarItemDetalhe(id) {
            $('#detalhe' + id).remove();
        }

    </script>


    {{--ADICIONA NOVO CAMPO DETALHES CONDOMINIO--}}
    <script>
        var contCondominio = document.getElementById('div-condominio').children.length - 1;
        $('#add-campo-condominio').click(function () {
            contCondominio++;
            $('#div-condominio').append('<div class="form-group" id="condominio' + contCondominio + '"><input type="text" name="condominio[]" placeholder="Adicione um detalhe sobre o condominio" class="form-control w-75 d-inline-block" ><button type="button" id="condominio' + contCondominio + '" class="btn btn-danger btn-sm icon-btn ms-2" onclick="apagarItemCondominio(' + contCondominio + ')"><i class="ti-trash"></i></button></div>');
        });

        function apagarItemCondominio(id) {
            $('#condominio' + id).remove();
        }

    </script>


    {{--SUBMIT FORM--}}
    <script>
        resetToastPosition = function () {
            $('.jq-toast-wrap').removeClass('bottom-left bottom-right top-left top-right mid-center'); // to remove previous position class
            $(".jq-toast-wrap").css({
                "top": "",
                "left": "",
                "bottom": "",
                "right": ""
            });

        };
        showDangerToast = function () {
            'use strict';
            resetToastPosition();
            $.toast({
                heading: 'Erro!',
                text: 'Ocorreu um erro inesperado no envio do formulário',
                showHideTransition: 'slide',
                icon: 'error',
                loaderBg: '#f2a654',
                position: 'top-right'
            })
        };
        showSuccessToast = function () {
            'use strict';
            resetToastPosition();
            $.toast({
                heading: 'Sucesso!',
                text: 'Cadastrado com concluido!',
                showHideTransition: 'slide',
                icon: 'success',
                loaderBg: '#f96868',
                position: 'top-right'
            })
        };
        showInfoToast = function () {
            'use strict';
            resetToastPosition();
            $.toast({
                heading: 'Atenção...',
                text: 'Salvando o formulário',
                showHideTransition: 'slide',
                icon: 'info',
                loaderBg: '#46c35f',
                position: 'top-right'
            })
        };
        $("#formImovel").validate({
            rules: {
                nome: "required",
                codigo: "required",
                descricao: "required",
                dormitorios: "required",
                banheiros: "required",
                garagem: "required",
                area: "required",
                photos: "required",
                rua: "required",
                bairro: "required",
                cidade: "required",
                estado: "required",
            },
            messages: {
                nome: "Insira o seu nome completo",
                codigo: "Insira o codigo do imóvel",
                descricao: "Insira uma descrição sobre o empreendimento",
                dormitorios: "Insira um numero minimo de dormitorios",
                banheiros: "Insira um numero minimo de banheiros",
                garagem: "Insira um numero minimo de garagem",
                area: "Insira a area do imóvel",
                photos: "Insira no mínimo uma imagem",
                rua: "Insira a rua",
                bairro: "Insira o bairro",
                cidade: "Insira a cidade",
                estado: "Insira o estado"
            },

            errorPlacement: function (label, element) {
                label.addClass('mt-2 text-danger');
                label.insertAfter(element);
            },
            highlight: function (element, errorClass) {
                $(element).parent().addClass('has-danger')
                $(element).addClass('form-control-danger')
            },
            submitHandler: function (form, event) {


                event.preventDefault();
                var formulario = document.getElementById('formImovel');
                var formData = new FormData(formulario);
                var formDataSemImage = new FormData(formulario);
                formDataSemImage.delete('photos[]');


                $.ajax({
                    type: "POST",
                    url: "{{route('imovel.update',$id)}}",
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    beforeSend: function () {
                        showInfoToast();
                        console.log(formulario)
                    },
                    success: function (data) {
                        if (formData.getAll('photos[]')[0].name !== '') {
                            send_image(formData.getAll('photos[]'), formData.get('_token'), data.data, 0)
                        }else{
                            showSuccessToast();
                            setTimeout(function () {
                                window.location = data.url
                            }, 3000);
                        }
                    },
                    error: function (data) {
                        showDangerToast();
                    }
                });
            }
        });
        showInfoImagemToast = function (data) {
            'use strict';
            resetToastPosition();
            $.toast({
                heading: 'Atenção...',
                text: 'Salvando a imagem ' + data,
                showHideTransition: 'slide',
                icon: 'info',
                loaderBg: '#46c35f',
                position: 'top-right'
            })
        };


        async function send_image(imagens, token, id, cont) {

            var formData = new FormData();
            formData.append('photos[]', imagens[cont]);
            formData.append('_token', token);
            formData.append('id', id);

            $.ajax({
                type: "POST",
                url: "{{route('fileUpload')}}",
                // headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function () {
                    showInfoImagemToast(imagens[cont].name);
                },
                success: function (data) {
                    cont++
                    if (imagens[cont] !== undefined) {
                        send_image(imagens, formData.get('_token'), id, cont)
                    } else {
                        showSuccessToast();
                        setTimeout(function () {
                            window.location = data.url
                        }, 3000);
                    }
                },
                error: function (data) {
                    showDangerToast();
                }
            });
        }

    </script>



@endpush
