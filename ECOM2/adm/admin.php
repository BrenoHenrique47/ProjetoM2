<?php
session_start();

// Verifica se é admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: ../back/login.php");
    exit();
}

$conn = new mysqli('localhost', 'root', '', 'locadora');
if ($conn->connect_error) {
    die('Erro de conexão: ' . $conn->connect_error);
}

// Inserção
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['adicionar'])) {
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $placa = $_POST['placa'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("INSERT INTO veiculos (marca, modelo, placa, status) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $marca, $modelo, $placa, $status);
    $stmt->execute();
    header("Location: admin.php");
    exit();
}

// Atualização
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['atualizar'])) {
    $id = $_POST['id'];
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $placa = $_POST['placa'];
    $status = $_POST['status'];

    $stmt = $conn->prepare("UPDATE veiculos SET marca=?, modelo=?, placa=?, status=? WHERE id=?");
    $stmt->bind_param("ssssi", $marca, $modelo, $placa, $status, $id);
    $stmt->execute();
    header("Location: admin.php");
    exit();
}

// Excluir
if (isset($_GET['excluir'])) {
    $id = $_GET['excluir'];
    $stmt = $conn->prepare("DELETE FROM veiculos WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    header("Location: admin.php");
    exit();
}

// Editar
$editar_dados = null;
if (isset($_GET['editar'])) {
    $id = $_GET['editar'];
    $stmt = $conn->prepare("SELECT * FROM veiculos WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $editar_dados = $resultado->fetch_assoc();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Admin - Locadora StartCar</title>
    <link rel="stylesheet" href="../estilos/admin.css">
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        h2 { margin-bottom: 10px; }
        form, table { margin-top: 20px; }
        input, select, button { margin: 5px; padding: 8px; }
        table { border-collapse: collapse; width: 100%; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        a { text-decoration: none; color: #007bff; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<h2>Administração de Veículos</h2>

<form method="POST">
    <input type="hidden" name="id" value="<?= $editar_dados['id'] ?? '' ?>">
    <input type="text" name="marca" placeholder="Marca" value="<?= $editar_dados['marca'] ?? '' ?>" required>
    <input type="text" name="modelo" placeholder="Modelo" value="<?= $editar_dados['modelo'] ?? '' ?>" required>
    <input type="text" name="placa" placeholder="Placa" value="<?= $editar_dados['placa'] ?? '' ?>" required>
    <select name="status" required>
        <option value="Disponível" <?= (isset($editar_dados['status']) && $editar_dados['status'] === 'Disponível') ? 'selected' : '' ?>>Disponível</option>
        <option value="Indisponível" <?= (isset($editar_dados['status']) && $editar_dados['status'] === 'Indisponível') ? 'selected' : '' ?>>Indisponível</option>
    </select>

    <?php if ($editar_dados): ?>
        <button type="submit" name="atualizar">Atualizar</button>
    <?php else: ?>
        <button type="submit" name="adicionar">Adicionar</button>
    <?php endif; ?>
</form>

<table>
    <tr>
        <th>ID</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Placa</th>
        <th>Status</th>
        <th>Ações</th>
    </tr>

    <?php
    $resultado = $conn->query("SELECT * FROM veiculos");
    while ($row = $resultado->fetch_assoc()):
    ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['marca'] ?></td>
        <td><?= $row['modelo'] ?></td>
        <td><?= $row['placa'] ?></td>
        <td><?= $row['status'] ?></td>
        <td>
            <a href="admin.php?editar=<?= $row['id'] ?>">Editar</a> |
            <a href="admin.php?excluir=<?= $row['id'] ?>" onclick="return confirm('Excluir este veículo?')">Excluir</a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>

</body>
</html>
