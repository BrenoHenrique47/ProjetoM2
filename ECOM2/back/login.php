<?php
session_start();
$mensagemErro = $_SESSION['erro_login'] ?? '';
unset($_SESSION['erro_login']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login - Locadora StartCar</title>
    <link rel="stylesheet" href="../estilos/login.css">
    <style>
        .erro-login {
            color: red;
            margin: 10px 0;
            font-weight: bold;
        }
    </style>
</head>
<body>
    
    <header>
        <div class="container-cabecalho">
            <a href="../index.php">
            <h1 class="logo">StartCar</h1>
            </a>
            <nav class="nav">
                <a href="../back/cadastro.php">Cadastrar</a>
                <a href="../back/contato.php">Contato</a>
            </nav>
        </div>
    </header>

<main>
    <div class="form-container">
        <h2>Login</h2>

        <?php if ($mensagemErro): ?>
            <div class="erro-login"><?php echo $mensagemErro; ?></div>
        <?php endif; ?>

        <form action="processa_login.php" method="POST">
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <select name="vinculo" required>
                <option value="">Selecione o vínculo</option>
                <option value="usuario">Usuário</option>
                <option value="admin">Admin</option>
            </select>
            <button type="submit">Entrar</button>
        </form>

        <div class="link">
            Ainda não possui conta? <a href="cadastro.php">Cadastre-se</a>
        </div>
    </div>
</main>
<footer>
    <p>&copy; 2025 Eco Locadora. Todos os direitos reservados.</p>
</footer>
</body>
</html>
