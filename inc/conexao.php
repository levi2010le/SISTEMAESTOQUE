<?php 

    $servidor = "localhost";
    $banco = "ESTOQUE";
    $usuario = "root";
    $senha = "usbw";

    $conexao = new mysqli($servidor, $usuario, $senha, $banco);

    $conexao->set_charset("utf8mb4");

?>