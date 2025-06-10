<?php
session_start();

if (isset($_POST["email"], $_POST["senha"], $_POST["vinculo"])) {
    $email = $_POST["email"];
    $senha = $_POST["senha"];
    $vinculo = $_POST["vinculo"];

    include("../conexao/conexao.php");

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $resultado = $stmt->get_result();

        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();

            if (password_verify($senha, $row['senha']) && $row['tipo'] === $vinculo) {
                $_SESSION['usuario_id'] = $row['id'];
                $_SESSION['usuario_nome'] = $row['nome'];
                $_SESSION['tipo'] = $row['tipo'];

                // Definir sessão de admin se for admin
                if ($vinculo === "usuario") {
                    header("Location: ../index.php");
                } else {
                    $_SESSION['admin'] = true; 
                    header("Location: ../adm/admin.php");
                }
                exit;
            } else {
                $_SESSION['erro_login'] = "Senha ou vínculo incorreto.";
                header("Location: ../login.php");
                exit;
            }
        } else {
            $_SESSION['erro_login'] = "Usuário não encontrado.";
            header("Location: ../login.php");
            exit;
        }
    } else {
        $_SESSION['erro_login'] = "Erro ao preparar a consulta.";
        header("Location: ../login.php");
        exit;
    }
} else {
    $_SESSION['erro_login'] = "Dados não enviados corretamente.";
    header("Location: ../login.php");
    exit;
}
?>
