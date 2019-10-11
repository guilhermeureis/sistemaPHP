@extends('layout.master')


@section('body')

<div class="jumbotron text-center">
  <h1>Recrutamento Mindtec</h1>
  <p>Exemplo básico de um GRUD.</p> 
</div>

<div class="container">
    <h2>Edição do Cliente</h2>
    <hr>
    <form action="" method="PUT">
        {!! csrf_field() !!}
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label>Razão Social</label>
                    <input type="text" name="razaoSocial" id="razaoSocial" class="form-control" value="{{$cliente->razaoSocial}}">
                </div> 
            </div>
            <div class="col-md-6">
                 <div class="form-group">
                        <label>STATUS</label>
                </div>
                <div>
                    <label class="switch">
                        <input checked name="ativo" id="ativo" type="checkbox">
                        <span class="slider round"></span>
                    </label>
                   
                </div> 
            </div>
           
        </div>
        <hr>

        <h2>Contatos do Cliente</h2>
        <div class="row">
            <div class="col-md-2 col-xs-2 col-sm-2">
                <button type="button" id="novo-contato" class="btn btn-primary btn-sm btn-block"><span class="fa fa-plus"></span> Novo</button>
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
                                <th class="text-center">Tipo do Contato</th>
                                <th class="text-center">Contato</th>
                                <th class="text-center" width="40">STATUS</th>
                                <th class="text-center" width="40">Edição</th>
                                <th class="text-center" width="40">Remoção</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($contatos as $index => $contato)
                            <tr>
                                <td class="text-center">{{++$index}}</td>
                                <td class="text-center">{{$contato->tipoContato}}</td>
                                <td>{{$contato->tipoContato}}</td>
                                @if($contato->ativo == 1)
                                    <td class="text-center"><small class="badge badge-pill badge-success">ATIVO</small></td>
                                @else
                                    <td class="text-center"><small class="badge badge-pill badge-danger">INATIVO</small></td>
                                @endif
                               
                                <td class="text-center">
                                    <button class="edit-contato" data-id="{{$contato->id}}">
                                        <span class="fa fa-edit"></span>
                                    </button>
                                </td>
                                <td class="text-center">
                                    <button class="remove-contato" data-id="{{$contato->id}}">
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
       <div class="btn-group" role="group">
            <button type="button" class="btn btn-danger" id="voltar">Voltar</button>
            <button type="button" class="btn btn-primary" id="editar-cliente">Editar</button>
        </div>
    </form>
</div>

<div class="modal fade" id="novo-contato-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contato-modal">Nova mensagem</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>  
            <div class="modal-body">
                <form action="" method="POST">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label>Tipo de Contato</label>
                        <input type="text" name="tipoContato" id="tipoContato" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Contato</label>
                        <input type="text" name="descContato" id="descContato" class="form-control">
                    </div>
                    <div class="form-group">
                            <label>STATUS</label>
                    </div>
                    <div>
                        <label class="switch">
                            <input checked name="ativoContato" id="ativoContato" type="checkbox" value="1">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" id="salvar-contato">Enviar</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="edit-contato-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contato-edit-modal">Nova mensagem</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>  
            <div class="modal-body">
                <form action="" method="POST">
                    {!! csrf_field() !!}
                    <div class="form-group">
                        <label>Tipo de Contato</label>
                        <input type="text" name="tipoContato_edit" id="tipoContato_edit" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Contato</label>
                        <input type="text" name="descContato_edit" id="descContato_edit" class="form-control">
                    </div>
                    <div class="form-group">
                            <label>STATUS</label>
                    </div>
                    <div>
                        <label class="switch">
                            <input checked name="ativoContato_edit" id="ativoContato_edit" type="checkbox" value="1">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" id="salvar-contato">Enviar</button>
            </div>
        </div>
    </div>
</div>

@stop

@section('js')
<script>
    $(function(){
        var teste = "{{$cliente->bolAtivo}}";
        $('#ativo').val(teste);
        if(teste == 0){
            document.getElementById("ativo").checked = false;
        }else{
            document.getElementById("ativo").checked = true;
        }
        
        $("input[name=ativo]").change(function () {
            if (document.getElementById("ativo").checked == true){
                $('#ativo').val('1');
            } else{
                $('#ativo').val('0');
            }
        });

        $('#editar-cliente').on('click',function(e){
            e.preventDefault();
            var id = "{{$cliente->id}}"

            $.ajax({
                type: 'PUT',
                url: '/cliente/'+id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'razaoSocial': $("#razaoSocial").val(),
                    'ativo': $("#ativo").val()
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
                        window.location.replace("{{url('cliente')}}")
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

        $("#voltar").on('click', function(){
            window.location.replace("{{url('cliente')}}")
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

        $('#novo-contato').on('click',function(e){
            e.preventDefault();
            $('#contato-modal').text("Novo Contato");
            $('#novo-contato-modal').modal('show');
        });

        $("input[name=ativoContato]").change(function () {
            if (document.getElementById("ativoContato").checked == true){
                $('#ativoContato').val('1');
            } else{
                $('#ativoContato').val('0');
            }
        });
        $('#salvar-contato').on('click',function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '/contato',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'tipoContato': $("#tipoContato").val(),
                    'contato': $("#descContato").val(),
                    'ativo': $("#ativoContato").val(),
                    'id': "{{$cliente->id}}"
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
                        if(dados.errors.tipoContato){
                            var linha_nova = dados.errors.tipoContato.toString();
                            var linha = linha_nova.replace("tipoContato", "Tipo de Contato");
                            erro = erro + "-> " + linha + "\n" ;
                        }
                        if(dados.errors.contato){
                            var linha_nova = dados.errors.contato.toString();
                            var linha = linha_nova.replace("contato", "Contato");
                            erro = erro + "-> " + linha + "\n" ;
                        }
                        if(dados.errors.ativo){
                            var linha_nova = dados.errors.ativo.toString();
                            var linha = linha_nova.replace("ativoContato", "STATUS");
                            erro = erro + "-> " + linha + "\n" ;
                        }
                    }else{
                        erro = "Erro Desconhecido!";
                    }
                     swal("Error", erro , "error");
                    
                },
            });
        });

    });
</script>
@stop