<?php

include "navbar.php";

?>

<head>
<link rel="stylesheet" href="chatbox.css">
</head>


<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

<script>
    var from = null, start = 0;
    $(document).ready(function(){
        // from = prompt("Qual seu nome?");
        from = "Leonardo";
        alert("eae " + from);
    })

</script>


<div id="mensagens"></div>

<form action="post">
<input type="text" id="mensagem" autocomplete="off" autofocus placeholder="Digite a mensagem...">
<input type="button" id="enviar" value="enviar">
</form>

<script>

    $("#enviar").click(function(){
        var mensagem = $("#mensagem").val();

        $.ajax({
            url: "http://localhost:8000/api/posts",
            type: "POST",
            data: {
                name:from,
                message:mensagem,
            },
            dataType: 'json',
            success: function(result){
                console.log(result);
            },
            error: function(error){
                console.log(error);
            }

        })

    });

</script>