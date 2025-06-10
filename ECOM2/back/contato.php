<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Contato - Locadora StartCar</title>
   <link rel="stylesheet" href="../estilos/contato.css" />
</head>
<body>

<header>
        <div class="container-cabecalho">
            <a href="../index.php">
            <h1 class="logo">StartCar</h1>
            </a>
            <nav class="nav">
                <a href="../back/login.php">Login</a>
                <a href="../back/cadastro.php">Cadastrar</a>
            </nav>
        </div>
    </header>

<main>
    <div class="form-container">
        <h2>Fale Conosco</h2>
        <form action="processa_contato.php" method="POST">
            <input type="text" name="nome" placeholder="Seu nome" required>
            <input type="email" name="email" placeholder="Seu e-mail" required>
            <input type="text" name="assunto" placeholder="Assunto" required>
            <textarea name="mensagem" rows="5" placeholder="Sua mensagem" required></textarea>
            <button type="submit">Enviar</button>
        </form>
    </div>
</main>

<footer>
    <p>&copy; 2025 Eco Locadora. Todos os direitos reservados.</p>
</footer>

</body>
</html>
