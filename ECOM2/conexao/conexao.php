<?php
$conn = new mysqli('localhost', 'root', '', 'locadora');

if ($conn->connect_error) {
    die('Erro: ' . $conn->connect_error);
}
?>
