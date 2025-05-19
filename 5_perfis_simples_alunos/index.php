
<?php

// Arquivo principal sistema

session_start();

// Carrega arquivos necessários
require_once 'config/database.php';
require_once 'Services/Auth.php';
require_once 'controllers/AuthController.php';

// Criar objeto (Instanciar) Controle de autenticação
$authController = new AuthController();

// Ação padrão
$pagina = $_GET['pagina'] ?? '';

// Roteamento básico (Teste de autenticação)
switch ($pagina) {
    case 'login':
        $authController->login();
        break;
    case 'autenticar':
        $authController->autenticar();
        break;
    case 'logout':
        $authController->logout();
        break;
    default:
        if (Auth::estaLogado()) {
            echo"Login bem-sucedido! Bem-vindo, " .Auth::obterUsuario()['nome'];
            echo"<br><a href='index.php?pagina=logout'>Sair</a>";
        } else {
            header('Location: index.php?pagina=login');
            exit;
        }
        break;
}
