@extends('layout.master')


@section('body')

<div class="jumbotron text-center">
  <h1>Recrutamento Mindtec</h1>
  <p>Exemplo básico de um GRUD.</p> 
</div>

<div class="container">
    <h2>Lista de Clientes</h2>
    
    <div class="row">
        <div class="col-md-2 col-xs-2 col-sm-2">
            <button type="button" class="btn btn-primary btn-sm btn-block"><span class="fa fa-plus"></span> Novo</button>
        </div>
    </div>
    
    <br>
    <div class="row">
        <div class="col-md-12 col-xs-12 col-sm-12">
            <div class="table-responsive">
                <table class="table table-striped" id="dataTable">
                    <thead>
                        <tr>
                            <th class="text-center" width="5">#</th>
                            <th>Razão Social</th>
                            <th class="text-center" width="30">Status</th>
                            <th class="text-center">Data de Criação</th>
                            <th class="text-center">Data de Edição</th>
                            <th class="text-center">Edição</th>
                            <th class="text-center">Remoção</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($clientes as $index => $cliente)
                        <tr>
                            <td class="text-center">{{++$index}}</td>
                            <td>{{$cliente->razaoSocial}}</td>
                            @if($cliente->bolAtivo == 1)
                                <td class="text-center"><small class="badge badge-pill badge-success">ATIVO</small></td>
                            @else
                                <td class="text-center"><small class="badge badge-pill badge-danger">INATIVO</small></td>
                            @endif
                            <td class="text-center">{{$cliente->created_at->format('H:i:s - d/m/Y')}}</td> 
                            <td class="text-center">{{$cliente->updated_at->format('H:i:s - d/m/Y')}}</td>
                            <td class="text-center">
                                <button class="edit">
                                    <span class="fa fa-edit"></span>
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="remove">
                                    <span class="fa fa-trash"></span>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
        </div>
    </div>
</div>
@stop

@section('js')
<script>
    $(function(){
        $('#dataTable').DataTable({
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisar",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },
            dom: 'Bfrtip',
            buttons: [
                {
                    text: "<i class='fa fa-plus'></i>  NOVO",
                    action: function () {
                        window.location.replace("#");
                    }
                }
            ]

        });
    });
</script>
@stop