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
            <button type="button" id="novo-cliente" class="btn btn-primary btn-sm btn-block"><span class="fa fa-plus"></span> Novo</button>
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
                            <th class="text-center" width="40">STATUS</th>
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
                                <button class="edit-cliente" data-id="{{$cliente->id}}">
                                    <span class="fa fa-edit"></span>
                                </button>
                            </td>
                            <td class="text-center">
                                <button class="remove-cliente" data-id="{{$cliente->id}}">
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

<div class="modal fade" id="novo-cliente-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="cliente-modal">Nova mensagem</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>  
            <div class="modal-body">
                <form action="" method="POST">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label>Razão Social</label>
                        <input type="text" name="razaoSocial" id="razaoSocial" class="form-control">
                    </div>
                    <div class="form-group">
                            <label>STATUS</label>
                    </div>
                    <div>
                        <label class="switch">
                            <input checked name="ativo" id="ativo" type="checkbox" value="1">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" id="salvar-cliente">Enviar</button>
            </div>
        </div>
    </div>
</div>


@stop

@section('js')
<script>
    $(function(){
        
        $('#novo-cliente').on('click',function(e){
            e.preventDefault();
            $('#cliente-modal').text("Novo Cliente");
            $('#novo-cliente-modal').modal('show');
        });

        $("input[name=ativo]").change(function () {
            if (document.getElementById("ativo").checked == true){
                $('#ativo').val('1');
            } else{
                $('#ativo').val('0');
            }
        });

        $('#salvar-cliente').on('click',function(e){
            e.preventDefault();
            console.log($("#razaoSocial").val());
            console.log($("#ativo").val());

            $.ajax({
                type: 'POST',
                url: '/cliente',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'razaoSocial': $("#razaoSocial").val(),
                    'ativo': $("#ativo").val(),
                },
                beforeSend: function() {
                    $('#carregamento-title').text("Processando...");
                    $('#carregamento').modal('show');
                    
                },
                success: function(data) {
                    $('#carregamento').modal('hide');
                    swal({
                        title: "Sucesso",
                        text: "",
                        icon: "success",
                    })
                    .then((value) => {
                        location.reload();
                    });

                },
                error: function(data) {
                    $('#carregamento').modal('hide');
                    var dados = $.parseJSON(data.responseText);
                    var erro = "";
                    if(data.status == 422){
                        if(dados.errors.razaoSocial){
                            var linha_nova = dados.errors.razaoSocial.toString();
                            var linha = linha_nova.replace("razaoSocial", "Razão Social");
                            erro = erro + "-> " + linha + "\n" ;
                        }
                        if(dados.errors.ativo){
                            var linha_nova = dados.errors.ativo.toString();
                            var linha = linha_nova.replace("ativo", "Ativo");
                            erro = erro + "-> " + linha + "\n" ;
                        }
                    }else{
                        erro = "Erro Desconhecido!";
                    }
                     swal("Error", erro , "error");
                    
                },
            });
        });

        $(".edit-cliente").on('click',function(e){
            e.preventDefault();
            var id = $(this).data('id');
            location.replace("cliente/"+id+"/edit");

        });


        $(".remove-cliente").on('click', function(e){
            e.preventDefault();
            var id = $(this).data('id');
            swal({
                title: "Deseja continuar?",
                text: "Deseja realmente remover o cliente?",
                icon: "warning",
                buttons: ["Cancelar","Confirmar"],
                dangerMode: true,
              })
              .then((willDelete) => {
                if (willDelete) {
                                        
                    $.ajax({
                        type: 'DELETE',
                        url: "/cliente/" + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                            'id' : id,
                        },
                        beforeSend: function() {
                            $('#carregamento-title').text("Processando...");
                            $('#carregamento').modal('show');
                        },
                        success: function() {
                            $('#carregamento').modal('hide');
                            $('.modal-title').text("");
                            swal({
                                title: "Removido",
                                text: "O cliente foi removido com sucesso!",
                                icon: "success",
                            })
                                .then((value) => {
                                    location.reload();
                                });
                        },
                        error: function(data) {
                            $('#carregamento').modal('hide');
                            $('.modal-title').text("");
                            var erro = "";
                            
                            swal("Erro",erro, "error");
                        },
                    })
                  
                } else {
                  swal("Cancelado","A remoção foi cancelada!","info");
                }
            });

        });
        
        
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
            }
        });
    });
</script>
@stop