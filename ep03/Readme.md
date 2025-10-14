# 📨 PHP Tips — Episódio 03: Envio de E-mails Autenticados com PHPMailer

Este é o terceiro episódio da série **PHP Tips**, baseado nas aulas de Robson V. Leite.  
Neste episódio, o foco foi aprender a **enviar e-mails com PHPMailer**, configurando corretamente um ambiente seguro para testes e execução em produção.

---

## ⚙️ Tecnologias e Ferramentas Utilizadas

- **PHP 8.1** (via Docker)
- **Apache 2**
- **MySQL 8**
- **PHPMailer**
- **Mailtrap** (ambiente de testes SMTP)
- **Docker Compose**

---

## 🧱 Estrutura do Projeto

```
php_tips/
│
├── docker-compose.yml
├── Dockerfile
├── src/
│   └── public/
│       └── ep03/
│           ├── send.php
│           ├── config.php
│           └── vendor/
│               └── autoload.php
│
└── README.md
```

---

## 🔧 Configuração do Ambiente

O ambiente foi montado utilizando **Docker Compose** com os serviços:
- `php81-apache`: container principal rodando PHP e Apache;
- `mysql8`: banco de dados relacional para integração com os exemplos;
- `phpmyadmin`: interface visual para o banco;
- Rede interna `devnet` para comunicação entre containers.

Para iniciar o ambiente:
```bash
docker compose up -d --build
```

O projeto estará acessível em:
```
http://localhost:8080
```

---

## ✉️ Configuração do PHPMailer com Mailtrap

Para evitar o uso de credenciais reais (como Gmail), foi utilizado o **Mailtrap.io**, um ambiente seguro e gratuito para testes de envio de e-mail SMTP.

### Exemplo de configuração (`config.php`):

```php
define("MAIL", [
    "host" => "sandbox.smtp.mailtrap.io",
    "port" => "587",
    "user" => "SEU_USERNAME_AQUI",
    "passwd" => "SEU_PASSWORD_AQUI",
    "from_name" => "Nicolas Torelli",
    "from_email" => "noreply@php_tips.test"
]);
```

---

## 💻 Exemplo de Envio (`send.php`)

```php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . "/vendor/autoload.php";
require __DIR__ . "/config.php";

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = MAIL['host'];
    $mail->SMTPAuth = true;
    $mail->Username = MAIL['user'];
    $mail->Password = MAIL['passwd'];
    $mail->Port = MAIL['port'];
    $mail->SMTPSecure = 'tls';

    $mail->setFrom(MAIL['from_email'], MAIL['from_name']);
    $mail->addAddress("teste@exemplo.com", "Destinatário Teste");

    $mail->isHTML(true);
    $mail->Subject = "Teste de envio com PHPMailer";
    $mail->Body = "<strong>Funcionando!</strong> Este e-mail foi enviado via Mailtrap.";

    $mail->send();
    echo "E-mail enviado com sucesso (capturado pelo Mailtrap).";
} catch (Exception $e) {
    echo "Erro ao enviar: {$mail->ErrorInfo}";
}
```

---

## 🧪 Resultado do Teste

O envio foi realizado com sucesso e o e-mail pôde ser visualizado diretamente na **Inbox do Mailtrap**, confirmando que a integração SMTP e o PHPMailer funcionaram corretamente no ambiente Docker.

---

## 🚀 Próximos Passos

No próximo episódio, será explorado o envio de **e-mails personalizados** com templates HTML e layouts dinâmicos, além da introdução ao uso de **view engines** e boas práticas de separação de camadas.

---

## 📚 Créditos

Baseado na série **[PHP Tips — Robson V. Leite](https://www.youtube.com/playlist?list=PLi_gvjv-JgXqsmCAOrUEv8xXhS2yF4XvF)**  
Implementação e ambiente: **Nicolas Torelli**

---

📦 Repositório: [github.com/torellinicolas/php_tips](https://github.com/torellinicolas/php_tips)
