@extends('layouts.app')


<style>
body {
    background-color: #fff;
    color: #636b6f;
    font-family: 'Nunito', sans-serif;
    background-image: url('/img/back_home.jpg');
    background-repeat: no-repeat;
    background-attachment: fixed;
    background-size: 100% 100%;
    }
.btn-success {
    margin-top: 10
}
/* Thick red border */
.hr-1  {
    border: 1px solid black;
    }
td {
    text-transform: uppercase;
}
.img-q{
    height: 200px;
    width: 200px;
}
.table{
    table-layout:fixed;
    overflow-wrap: break-word;
}
</style>


@section('content')

@if(isset($head))
    <script>$(document).ready(function(){
    $('#store_task').modal({backdrop: 'static', keyboard: false})  
    $("#store_task").modal('show');
    });</script> 
@endif


<div class="container" style="border-style: solid; background-color: white;overflow-y:scroll; height: 85%">
    <div class="row">
        <div class="col">
            <button class="btn btn-success" data-toggle="modal" data-target="#store_task" >@if(isset($head)) Editar Tarefa @else Adicionar Tarefa @endif </button>
        </div>
        <div class="col">
            <h2 >Suas Tarefas</h2>
        </div>
        <div class="col">
        <button type="button" class="btn btn-primary q" data-toggle="modal" data-target=".news-modal" style="margin-top: 10">Fique Atualizado: Noticias!</button>
        </div>
    </div>
    <hr class="hr-1">

    <table class="table">
        <tr>
            <th scope="">Id</th>
            <th scope="">Nome</th>
            <th scope="">Descrição</th>
            <th scope="">Ações</th>
        </tr>
        @foreach($data as $value)
        <tr>
            <td width="10%"> {{$value->id}} </td>
            <td width="30%"> {{$value->name_task}} </td>
            <td width="40%"> {{$value->desc_task}} </td>

            <td><a class="btn btn-primary" href="{{route('read', $value->id)}}">Detalhes</a> <a href="{{route('delete', $value->id)}}" class="btn btn-danger" onclick="return confirm('Voçe tem certeza?')" >Delete</a></td>
        </tr>
        @endforeach
    </table>



<!-- Modal de Adicionar Tarefa--> 
<form action="{{route('store_task')}}" method="post" autocomplete="off" enctype="multipart/form-data">
@csrf
<input type="hidden" @if(isset($head)) value="{{$head->id}}" name="id" @endif>
    <div class="modal fade store_task-lg" id="store_task" tabindex="-1" role="dialog" aria-labelledby="storage_modal" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="storage_modal_title"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row" style="margin: 10px">
                        <div class="col-sm-12">
                            <label>Nome da Tarefa</label>
                            <input class="form-control" name="name_task" placeholder="Nome do Produto" style="text-transform: uppercase" maxlength="100" @if(isset($head)) value="{{$head->name_task}}" @endif  required>
                        </div>

                        <div class="col-sm-12">
                            <label>Descrição da Tarefa</label>
                            <textarea class="form-control" name="desc_task" placeholder="Descrição" rows="4" style="text-transform: uppercase" maxlength="200"> @if(isset($head)) {{$head->desc_task}} @endif  </textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        @if(isset($head))
                        <a class="btn btn-primary" href="{{route('home')}}">Sair</a>
                        @else
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                        @endif
                        <button type="submit" class="btn btn-success">@if(isset($head)) Editar @else Salvar @endif</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<div class="content">
    <?php 
    $url = "http://newsapi.org/v2/top-headlines?sources=google-news-br&apiKey=1c3d750ef01d454f889b2c1b65d5a5fe";
    $response = file_get_contents($url);
    $NewsData = json_decode($response);
    ?>
</div>

<div class="modal fade news-modal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="container fluid">
                    <div class="jumbotron">
                        <h1 class="display-4">API de autoria de: <a href="https://newsapi.org/">News API!</a></h1>
                    </div>
                <hr>
                    <?php
                        foreach($NewsData->articles as $News){
                    ?>
                    <div class="row grid" style="margin: 2px">
                        <div class="col-md-4">
                            <img class="img-q" src="<?php echo $News->urlToImage?>" >
                        </div>
                        <div class="col-md-8" style="text-align: center">
                            <h2><a href="<?php echo $News->url?>" style="color: black"> <?php echo $News->title ?> </a></h2>
                            <h5><?php echo $News->description?></h5>
                            <p><?php echo $News->content ?></p>
                            <h6>Autor: <?php echo $News->author?></h6>
                            <h6>Data: <?php echo $News->publishedAt ?></h6>
                        </div>           
                    <div>
                    <hr>
                    <?php }?>
                    
                </div>
            <div>
        </div>
    </div>


</div>
@endsection
