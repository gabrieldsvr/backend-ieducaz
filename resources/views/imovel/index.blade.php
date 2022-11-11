@extends('layouts.master')

@push('styles')

    <link rel="stylesheet" href="{{url('vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
@endpush

@section('content')


    <div class="row flex-grow">
        <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
            <div class="card card-rounded">
                <div class="card-body">
                    <div class="row">
                        <div class="col-2">
                            <a href="{{route('imovel.create')}}" class="btn btn-info btn-sm">Adicionar Imóvel</a>
                        </div>
                    </div>
                    <div class="d-sm-flex justify-content-between align-items-start mb-3 mt-5">
                        <div>
                            <h3 class="card-title card-title-dash">Lista de imóveis</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table id="myTable" class="table">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th>Nome</th>
                                    <th>Código</th>
                                    <th>Valor</th>
                                    <th>Endereço</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($listImovel as $imovel)
                                    <tr>
                                    <td></td>
                                        <td>{{$imovel->json['nome']}}</td>
                                        <td>{{$imovel->json['codigo'] ?? ""}}</td>
                                        <td>{{$imovel->json['valor']}}</td>
                                        <td>{{$imovel->json['rua']}} - {{$imovel->json['bairro']}} - {{$imovel->json['cidade']}}</td>
                                        <td>
                                            <form action="/imovel/inativa/{{$imovel->id}}" method="POST" class="formDelete">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn {{$imovel->status ? 'badge-success' : 'badge-danger'}} btn-sm text-center badge">{{$imovel->status ? 'Ativo' : 'Inativo'}}</button>

                                            </form>
                                        </td>
                                        <td class="row">

                                            <div class="col-12 mb-2">
                                                <a class="btn btn-primary  btn-icon text-center"  href="{{route('imovel.edit',$imovel)}}">
                                                    <i class="fa fa-pencil ms-1"></i></a>
                                            </div>
                                            <div class="col-12 mb-2">
                                                <a class="btn btn-primary  btn-icon text-center"  href="{{route('imovel.duplicate',$imovel)}}">
                                                    <i class="mdi mdi-content-duplicate ms-1"></i></a>
                                            </div>
                                            <div class="col-12">
                                                <form action="/imovel/{{$imovel->id}}" id="formDelete{{$imovel->id}}" method="POST" class="formDelete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger  btn-icon  text-center" type="button" onclick="deletaImovel({{$imovel->id}})"><i
                                                            class="fa fa-trash-o ms-1"></i></button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
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
@endpush
@push('custom-scripts')
    <script>
        function deletaImovel(id) {
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
                      document.getElementById("formDelete"+id).submit();
                  }
                });
        }
    </script>



    <script>
        initDataTables("myTable")
    </script>
@endpush
