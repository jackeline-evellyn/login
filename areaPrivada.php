<?php


    session_start();
    if(!isset($_SESSION['id_usuario'])){
        header("location: index.php");
        exit;
    }



?>
    <link rel="stylesheet" href="_css/areaPrivada.css"><div id="private">		
<div id="private">		
    <h1>Você perdeu o jogo</h1>
    <a href="sair.php">Sair</a>
</div>