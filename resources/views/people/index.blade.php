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
{{--                            <a  href="{{route('people.create')}}" class="btn btn-info btn-md" data-title="Cadastro Cliente">Adicionar Cliente</a>--}}

                                <a class="btn btn-info btn-md" href="#" data-bs-toggle="modal" data-route="{{route('people.modal')}}" data-bs-target="#modal-tela"
                                                    data-button-success="Cadastrar" data-body="Cadastro Cliente" data-title="Cadastro Cliente" >
                                    Novo Cliente</a>
                        </div>

                    </div>
                    <div class="d-sm-flex justify-content-between align-items-start mb-3 mt-5">
                        <div>
                            <h3 class="card-title card-title-dash">Lista de Clientes</h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped ">
                                <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Nome</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Documento</th>
                                    <th>Tipo</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($peoples as $person)
                                    <tr>
                                        <td></td>
                                        <td>
                                            <div class="dropdown">
                                                <button class="btn btn-info btn-sm dropdown-toggle" type="button"
                                                        id="dropdownMenuSizeButton3" data-bs-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                    Ações
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">
                                                    <a href="{{route('people.edit',$person)}}" class="dropdown-item" data-title="Cadastro Cliente"> <i class="fa fa-pencil ms-1"></i>
                                                        Editar</a>




                                                    <form action="/people/{{$person['id']}}" id="formDelete{{$person['id']}}" method="POST" class="formDelete">
                                                        @csrf
                                                        @method('DELETE')

                                                        <a class="dropdown-item" href="#" onclick="deletaPeople('{{$person['id']}}')"><i class="fa fa-trash-o ms-1"></i>
                                                            Excluir</a>
                                                    </form>

                                                </div>
                                            </div>
                                        </td>
                                        <td>{{$person['name'] ?? ""}}</td>
                                        <td>{{$person['mail']  ?? ""}}</td>
                                        <td>{{$person['phone']  ?? ""}}</td>
                                        <td>{{$person['document']  ?? ""}}</td>
                                        <td>{{$person['type']  ?? ""}}</td>
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
        function deletaPeople(id) {
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
