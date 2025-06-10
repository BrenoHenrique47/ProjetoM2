<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro - Locadora StartCar</title>
    <link rel="stylesheet" href="../estilos/cadastro.css">
</head>
<body>

<header>
        <div class="container-cabecalho">
            <a href="../index.php">
            <h1 class="logo">StartCar</h1>
            </a>
            <nav class="nav">
                <a href="../back/login.php">Login</a>
                <a href="../back/contato.php">Contato</a>
            </nav>
        </div>
    </header>

<main>
    <div class="form-container">
        <h2>Cadastro</h2>
        <form action="processa_cadastro.php" method="POST">
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="text" name="sobrenome" placeholder="Sobrenome" required>
            <input type="tel" name="telefone" placeholder="Telefone" required>
            <input type="email" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <button type="submit">Cadastrar</button>
        </form>
        <div class="link">
            Já possui conta? <a href="login.php">Faça login</a>
        </div>
    </div>
</main>
<footer>
    <p>&copy; 2025 Eco Locadora. Todos os direitos reservados.</p>
</footer>
</body>
</html>
