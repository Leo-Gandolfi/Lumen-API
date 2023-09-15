<?php

include "navbar.php";
?>

<div class="container text-center">
  <div class="row align-items-start">
    <div class="col">
    </div>
    <div class="col">
    <form>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Título</label>
    <input type="text" class="form-control" id="titulo" aria-describedby="emailHelp">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Mensagem</label>
    <input type="text" class="form-control" id="mensagem">
  </div>
  
  <div class="mb-3 form-check">
  </div> 
  <button type="button" class="btn btn-primary" id="gravar">Enviar</button>
  <button type="button" class="btn btn-warning" id="buscar">Buscar</button>
  <button type="button" class="btn btn-danger"  id="deletar">Deletar</button>
</form>    
  <div class="alert alert-warning" role="alert">
    <h1>
  </div>
</div>
    <div class="col">
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>

<script>
$('#buscar').click(function() {
  var title = $("#titulo").val();

if(title){
  console.log("chegou aqui");
    $.ajax({
        url: 'http://localhost:8000/api/posts/'+title, 
        type: 'get',
        dataType: 'json',
        success: function (result) {
            console.log(result);
        },
        error: function (error) {
            console.error('Algo deu errado: ' + error);
        }
    });
}else{
      $.ajax({
          url: 'http://localhost:8000/api/posts', 
          type: 'get',
          dataType: 'json',
          success: function (result) {
              console.log(result);
          },
          error: function (error) {
              console.error('Algo deu errado: ' + error);
          }
      });
    }
  });

$('#gravar').click(function () {
        var title = $("#titulo").val();
        var body = $("#titulo").val();
        
        $.ajax({
            url: 'http://localhost:8000/api/posts',
            type: 'POST',
            data: {
                title: title,
                body: body,
            },
            success: function (result) {
                console.log(result);
            },
            error: function (error) {
                console.error('Algo deu errado: ' + error);
            }
        });
    });

  $('#deletar').click(function(){
      var title = $("#titulo").val();

    $.ajax({
      url: 'http://localhost:8000/api/delete/'+title,
      type: 'DELETE',
      success: function (result) {
        console.log("Chegou aqui - DELETE");
        console.log(result);
        $('#aviso').val("Deu bom" + result);
      },
      error:function(error) {
        $('#aviso').val("Deu ruim" + error);

      }
    })

  });
</script>

