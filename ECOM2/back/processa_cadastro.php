<?php
session_start();
$conn = new mysqli('localhost', 'root', '', 'locadora');

if ($conn->connect_error) {
    die('Erro na conexão: ' . $conn->connect_error);
}

$nome = $conn->real_escape_string($_POST['nome']);
$sobrenome = $conn->real_escape_string($_POST['sobrenome']);
$telefone = $conn->real_escape_string($_POST['telefone']);
$email = $conn->real_escape_string($_POST['email']);
$senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
$tipo = 'usuario';

$sql = "INSERT INTO usuarios (nome, sobrenome, telefone, email, senha, tipo) 
        VALUES ('$nome', '$sobrenome', '$telefone', '$email', '$senha', '$tipo')";

if ($conn->query($sql) === TRUE) {
    echo "Cadastro realizado com sucesso! <a href='login.php'>Faça login</a>";
} else {
    echo "Erro ao cadastrar: " . $conn->error;
}

$conn->close();
?>
