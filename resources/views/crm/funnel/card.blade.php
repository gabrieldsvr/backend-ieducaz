<div class="card rounded border mb-2" id="{{$card['id']}}">

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
                    <a class="dropdown-item" href="#" onclick="excluiCard('{{$card['id']}}')">
                        <i class="ti-trash icon-sm text-danger"></i> Excluir</a>
                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-route="{{route('funnelCard.edit', $card['id'])}}"
                       data-bs-target="#modal-tela"
                       data-button-success="Editar" data-body="Edição de negócio"
                       data-title="Edição de negócio">
                        <i class="ti-pencil icon-sm text-info"></i> Editar</a>
{{--                    <a class="dropdown-item" href="#">--}}
{{--                        <i class="ti-na icon-sm text-danger"></i> Negócio perdido</a>--}}
{{--                    <a class="dropdown-item" href="#">--}}
{{--                        <i class="ti-check-box icon-sm text-success"></i> Negócio fechado</a>--}}
                </div>
            </div>
            <div class="media-body">
                <h6 class="mb-1 d-inline-block"> {{$card['person']}}</h6>
                <p class="mb-0 text-muted">
                    {{$card['imovel']}}
                </p>
            </div>
        </div>
    </div>
</div>
