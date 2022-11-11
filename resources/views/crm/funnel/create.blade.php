<div class="modal-header">
    <h5 class="modal-title" id="ModalLabel">Title</h5>
    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<form class="forms-sample" id="formCards" method="POST"
      action="{{route('people.store')}}">
    @csrf
    <div class="modal-body">

        <div class="form-group col-12 ">
            <label for="type">{{trans('form.posicao_no_funil')}}:</label>
            <select class="form-control" id="order" name="order">
                @foreach($funnel->json as $item)
                    <option value="{{$item['order']}}">
                        {{$item['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Cliente</label>
            <select class="select2-single w-100" name="person">
                <option value=""></option>
                @foreach($people as $person)
                <option value="{{$person['id']}}">{{$person['name']}}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label>Imóvel</label>
            <select class="select2-single w-100" name="imovel">
                <option value=""></option>
                @foreach($imoveis as $imovel)
                    <option value="{{$imovel['uuid']}}">{{$imovel['json']['nome']}}</option>
                @endforeach
            </select>
        </div>

    </div>
    <div class="modal-footer">
        <button class="btn btn-success modal-button-success">{{trans('form.salvar')}}</button>
        <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{trans('form.fechar')}}</button>
    </div>
</form>
<script src="{{url('vendors/inputmask/jquery.inputmask.bundle.js')}}"></script>
<script src="{{ url("vendors/jquery-validation/jquery.validate.min.js") }}"></script>
<script src="{{ url("vendors/bootstrap-maxlength/bootstrap-maxlength.min.js") }}"></script>

<script>
    $("#formCards").validate({
        rules: {
            order: "required",
            person: "required",
            imovel: "required",
        },
        messages: {
            order: "Insira a posição",
            person: "Insira o cliente",
            imovel: "Insira o imovel",
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
            var formulario = document.getElementById('formCards');
            var formData = new FormData(formulario);
            $.ajax({
                type: "POST",
                url: "{{route('funnelCard.store')}}",
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                beforeSend: function () {
                    showToast('Aguarde...', 'Cadastro em andamento', 'warning');
                },
                success: function (data) {
                    showToast('Sucesso!', 'Cadastro com sucesso!', 'success');
                    $('#modal-tela').modal('toggle');

                    createCard(data.card)
                    // $("#dragula-"+data.order).append()
                    // window.location.reload();
                    {{--window.location = '<?=route("funnel.index")?>'--}}
                },

                error: function (data) {
                    showToast('Erro!', 'Erro no cadastro inesperado...', 'danger');
                    console.log(data)
                }
            });
        }
    });


    $('.select2-single').select2({
        width: '100%',
        dropdownParent: $('#modal-tela')
    });
</script>

