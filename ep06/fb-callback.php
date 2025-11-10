<?php
require __DIR__ . "/vendor/autoload.php";

session_start();

$fb = new \Facebook\Facebook([
    'app_id' => 'seu_app_id',
    'app_secret' => 'seu_app_secret',
    'default_graph_version' => 'v20.0',
]);

$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    echo "Erro da Graph API: " . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "Erro do SDK: " . $e->getMessage();
    exit;
}

if (!isset($accessToken)) {
    if ($helper->getError()) {
        echo "Erro: " . $helper->getErrorDescription();
    } else {
        echo "Token não recebido.";
    }
    exit;
}

$_SESSION['fb_access_token'] = (string) $accessToken;

// Solicita dados do usuário
try {
    $response = $fb->get('/me?fields=id,name,email', $accessToken);
    $user = $response->getGraphUser();
    echo "<h2>Login realizado com sucesso!</h2>";
    echo "<p>ID: " . $user['id'] . "</p>";
    echo "<p>Nome: " . $user['name'] . "</p>";
    echo "<p>Email: " . $user['email'] . "</p>";
} catch (Facebook\Exceptions\FacebookResponseException $e) {
    echo "Erro da Graph API: " . $e->getMessage();
    exit;
} catch (Facebook\Exceptions\FacebookSDKException $e) {
    echo "Erro do SDK: " . $e->getMessage();
    exit;
}
