@extends('layouts.master')
@section('content')

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Editar imovel</h4>
                <form class="forms-sample" id="formPeople" method="POST"
                      action="{{route('people.update', $person)}}">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">

                        <div class="form-group col-12 ">
                            <label for="nome" class="text-capitalize">{{trans('form.nome')}}</label>
                            <input type="text" class="form-control" id="nome" name="name"
                                   placeholder="<?=$person->name ?? "" ?>"
                                   value="{{$person->name ?? ""}}"/>
                        </div>

                        <div class="form-group col-12 ">
                            <label for="email" class="text-capitalize">{{trans('form.email')}}:</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="Email"
                                   value="{{$person->mail ?? ""}}"/>
                        </div>

                        <div class="form-group col-12 ">
                            <label for="phone" class="text-capitalize">{{trans('form.telefone')}}:</label>
                            <input type="text" class="form-control" id="phone" name="phone" placeholder="Telefone"
                                   value="{{$person->phone ?? ""}}">
                        </div>

                        <div class="form-group col-12 ">
                            <label for="document" class="text-capitalize">{{trans('form.document')}}:</label>
                            <input type="text" class="form-control" id="document" name="document"
                                   placeholder="Documento" value="{{$person->document ?? ""}}">
                        </div>

                        <div class="form-group col-12 ">
                            <label for="type">{{trans('form.tipo_cliente')}}:</label>
                            <select class="form-control" id="type" name="type">
                                <option
                                    value="comprador" <?=$person->type == 'comprador' ? 'selected' : "" ?> >{{trans('form.comprador')}}</option>
                                <option
                                    value="investidor" <?=$person->type== 'investidor' ? 'selected' : "" ?> >{{trans('form.investidor')}}</option>
                                <option
                                    value="locador" <?=$person->type == 'locador' ? 'selected' : "" ?> >{{trans('form.locador')}}</option>
                                <option
                                    value="locatario" <?=$person->type == 'locatario' ? 'selected' : "" ?> >{{trans('form.locatario')}}</option>
                                <option
                                    value="proprietario" <?=$person->type == 'proprietario' ? 'selected' : "" ?> >{{trans('form.proprietario')}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button class="btn btn-success modal-button-success">{{trans('form.editar')}}</button>
                        <a class="btn btn-light" href="{{route('people.index')}}">{{trans('form.fechar')}}</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection
@push('plugin-scripts')
    <script src="{{url('vendors/inputmask/jquery.inputmask.bundle.js')}}"></script>
    <script src="{{ url("vendors/jquery-validation/jquery.validate.min.js") }}"></script>
    <script src="{{ url("vendors/bootstrap-maxlength/bootstrap-maxlength.min.js") }}"></script>
@endpush
@push('custom-scripts')
    <script>
        $("#formPeople").validate({
            rules: {
                name: "required",
                email: "required",
                type: "required",
            },
            messages: {
                name: "Insira o nome",
                email: "Insira o email",
                type: "Insira o tipo do cliente",
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
                var formulario = document.getElementById('formPeople');
                var formData = new FormData(formulario);
                $.ajax({
                    type: "POST",
                    url: "{{route('people.update' , $person)}}",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    beforeSend: function () {
                        showToast('Aguarde...', 'Cadastro em andamento', 'warning');
                    },
                    success: function (data) {
                        showToast('Sucesso!', 'Cadastro com sucesso!', 'success');

                        setTimeout(function () {
                            window.location = '<?=route("people.index")?>'
                        }, 2000);
                    },

                    error: function (data) {
                        showToast('Erro!', 'Erro no cadastro inesperado...', 'danger');
                        console.log(data)
                    }
                });
            }
        });

    </script>
@endpush

