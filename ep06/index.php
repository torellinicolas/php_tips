<?php
require __DIR__ . "/vendor/autoload.php";

session_start();

$fb = new \Facebook\Facebook([
    'app_id' => 'seu_app_secret',
    'app_secret' => 'seu_app_id',
    'default_graph_version' => 'v20.0',
]);

$helper = $fb->getRedirectLoginHelper();
$permissions = ['email']; // Pode adicionar 'public_profile', etc.
$callbackUrl = 'http://localhost:8080/ep06/fb-callback.php';

$loginUrl = $helper->getLoginUrl($callbackUrl, $permissions);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login com Facebook</title>
</head>
<body>
    <h1>Login com Facebook</h1>
    <a href="<?php echo htmlspecialchars($loginUrl); ?>">Entrar com Facebook</a>
</body>
</html>
