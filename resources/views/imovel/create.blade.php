@extends('layouts.master')

@push('styles')

    <link rel="stylesheet" href="{{url('vendors/jquery-file-upload/uploadfile.css')}}">
@endpush
@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Adicione novo imovel</h4>
                <form class="forms-sample" id="formImovel" enctype="multipart/form-data" method="POST"
                      action="{{route('imovel.store')}}">
                    @csrf
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
                                                   id="quantidade_venda1" value="0">
                                            Mais de um imóvel diferente
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="quantidade_venda"
                                           id="quantidade_venda2" value="1" onclick="handleClick(this)" checked>
                                    Somente um imóvel a venda
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-12 col-sm-6 col-md-4">
                            <label for="exampleInputName1">{{trans('imovel_form.nome')}}:</label>
                            <input type="text" class="form-control" id="nome" name="nome" placeholder="Name">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-4">
                            <label for="exampleSelectGender">{{trans('imovel_form.tipo_do_imovel')}}:</label>
                            <select class="form-control" id="tipo" name="tipo">
                                <option value="casa">Casa</option>
                                <option value="apartamento" selected>Apartamento</option>
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
                                       data-inputmask="'alias': 'real'" id="valor" name="valor">
                            </div>
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-4">
                            <label for="codigo">{{trans('imovel_form.codigo')}}:</label>
                            <input type="text" class="form-control" id="codigo" name="codigo"
                                   placeholder="codigo do imóvel">
                        </div>
                        <div class="form-group col-12 ">
                            <label for="descricao">{{trans('imovel_form.descricao')}}:</label>
                            <textarea class="form-control" name="descricao" id="descricao" rows="5"></textarea>
                        </div>
                    </div>
                    <hr>


                    {{--                    ENDEREÇO--}}
                    <h4 class="card-title">Endereço</h4>
                    <div class="row">
                        <div class="col-12 col-md-3 form-group">
                            <label for="cep" class="text-uppercase">{{trans('imovel_form.cep')}}: </label>
                            <input type="text" class="form-control cep" id="cep" onfocusout="busca(this.value)"
                                   name="cep" data-inputmask-alias="99999-999">
                        </div>
                    </div>
                    <div class="row">

                        <div class="form-group col-12 col-sm-6 col-md-3 ">
                            <label for="estado" class="text-uppercase">{{trans('imovel_form.estado')}}: </label>
                            <input type="text" class="form-control" id="estado" name="estado" placeholder="uf">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-3">
                            <label for="cidade" class="text-uppercase">{{trans('imovel_form.cidade')}}: </label>
                            <input type="text" class="form-control" id="cidade" name="cidade" placeholder="cidade">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-3">
                            <label for="bairro" class="text-uppercase">{{trans('imovel_form.bairro')}}: </label>
                            <input type="text" class="form-control" id="bairro" name="bairro" placeholder="bairro">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-3">
                            <label for="rua" class="text-uppercase">{{trans('imovel_form.rua')}}: </label>
                            <input type="text" class="form-control" id="rua" name="rua" placeholder="Name">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-2">
                            <label for="numero" class="text-uppercase">{{trans('imovel_form.numero')}}: </label>
                            <input type="text" class="form-control" id="numero" name="numero" placeholder="numero">
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
                                   placeholder="1-2">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-3">
                            <label for="suites" class="text-uppercase">{{trans('imovel_form.suites')}}
                                :</label>
                            <input type="text" class="form-control" id="suites" name="suites"
                                   placeholder="1-2">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-3">
                            <label for="banheiros" class="text-uppercase">{{trans('imovel_form.banheiros')}}:</label>
                            <input type="text" class="form-control" id="banheiros" name="banheiros" placeholder="1-2">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-3">
                            <label for="garagem" class="text-uppercase">{{trans('imovel_form.garagem')}}:</label>
                            <input type="text" class="form-control" id="garagem" name="garagem" placeholder="1-2">
                        </div>
                        <div class="form-group col-12 col-sm-6 col-md-3">
                            <label for="area" class="text-uppercase">{{trans('imovel_form.area')}}:</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="area" name="area" placeholder="110-180">
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
                            <div class="form-group">
                                <input type="text" name="unidades[]" class="form-control w-75 d-inline-block"
                                       placeholder="Descrição da unidade">
                                <button id="add-campo" type="button" class="btn btn-info btn-sm icon-btn ms-2 mb-2">
                                    <i class="ti-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>


                    {{--                    DETALHES DO CONDOMINIO--}}
                    <h4 class="card-title">Detalhes do apartamento:</h4>
                    <div class="row">
                        <div class="" id="div-detalhes-ape">
                            <div class="form-group">
                                <input type="text" name="detalhes[]" class="form-control w-75 d-inline-block"
                                       placeholder="Detalhe do condominio">
                                <button id="add-campo-detalhe_ape" type="button"
                                        class="btn btn-info btn-sm icon-btn ms-2 mb-2">
                                    <i class="ti-plus"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>


                    {{--                    DETALHES DO CONDOMINIO--}}
                    <h4 class="card-title">Detalhes do condominio:</h4>
                    <div class="row">
                        <div class="" id="div-condominio">
                            <div class="form-group">
                                <input type="text" name="condominio[]" class="form-control w-75 d-inline-block"
                                       placeholder="Adicione um detalhe sobre o condominio">
                                <button id="add-campo-condominio" type="button"
                                        class="btn btn-info btn-sm icon-btn ms-2 mb-2">
                                    <i class="ti-plus"></i>
                                </button>
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
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="photos[]" class="label">Imagens da propriedade</label>
                            <input type="file" class="form-control" name="photos[]" multiple required>
                        </div>

                    </div>

                    <div class="form-group">
                        <label for="video" class="label">URL do video ou playlist</label>
                        <input type="text" class="form-control" name="video" id="video"
                               placeholder="https://www.youtube.com/watch?v=exemplo">
                    </div>

                    {{--                    BOTÕES DE ENVIO--}}
                    <button type="submit" class="btn btn-primary me-2">Cadastrar</button>
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
    <script src="{{ url("vendors/bootstrap-maxlength/bootstrap-maxlength.min.js") }}"></script>
@endpush

@push('custom-scripts')
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
                    url: "cep/" + cep,
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
        var cont = 1;
        //https://api.jquery.com/click/
        $('#add-campo').click(function () {
            cont++;
            //https://api.jquery.com/append/
            $('#div-unidades').append('<div class="form-group" id="unidade' + cont + '"><input type="text" name="unidades[]" placeholder="Descrição da unidade " class="form-control w-75 d-inline-block" ><button type="button" id="' + cont + '" class="btn btn-danger btn-sm icon-btn ms-2 btn-apagar" onclick="apagarItemUnidade(' + cont + ')"><i class="ti-trash"></i></button>');
        });

        function apagarItemUnidade(id) {
            $('#unidade' + id).remove();
        }
    </script>

    {{--ADICIONA NOVO CAMPO DETALHES APARTAMENTO--}}
    <script>
        var cont = 1;
        $('#add-campo-detalhe_ape').click(function () {
            cont++;
            $('#div-detalhes-ape').append('<div class="form-group" id="detalhe' + cont + '"><input type="text" name="detalhes[]" placeholder="Adicione um detalhe do apartamento" class="form-control w-75 d-inline-block" ><button type="button" id="excluirdetalhe' + cont + '" class="btn btn-danger btn-sm icon-btn ms-2" onclick="apagarItemDetalhe(' + cont + ')"><i class="ti-trash"></i></button>');
        });

        function apagarItemDetalhe(id) {
            $('#detalhe' + id).remove();
        }

    </script>


    {{--ADICIONA NOVO CAMPO DETALHES CONDOMINIO--}}
    <script>
        var cont = 1;
        $('#add-campo-condominio').click(function () {
            cont++;
            $('#div-condominio').append('<div class="form-group" id="condominio' + cont + '"><input type="text" name="condominio[]" placeholder="Adicione um detalhe sobre o condominio" class="form-control w-75 d-inline-block" ><button type="button" id="condominio' + cont + '" class="btn btn-danger btn-sm icon-btn ms-2" onclick="apagarItemCondominio(' + cont + ')"><i class="ti-trash"></i></button>');
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
        showInfoImagemToast = function (data) {
            'use strict';
            resetToastPosition();
            $.toast({
                heading: 'Atenção...',
                text: 'Salvando a imagem '+data,
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
                image_destaque: "required",
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
                estado: "Insira o estado",
                imagem_destaque: "Insira a imagem que será destaque na capa",
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
                    url: "{{route('imovel.store')}}",
                    data: formDataSemImage,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    beforeSend: function () {
                        showInfoToast();
                    },
                    success: function (data) {
                        send_image(formData.getAll('photos[]'), formData.get('_token'), data.data,0)
                    },
                    error: function (data) {
                        showDangerToast();
                    }
                });
            }
        });

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
                        setTimeout(function() {
                            window.location.reload(1);
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
