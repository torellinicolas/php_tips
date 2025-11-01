<?php

require __DIR__ . "/vendor/autoload.php";

use CoffeeCode\Paginator\Paginator;
use Source\Models\Post;

$post = new Post();

// Função compatível com PHP 7.4 até 8.4+
if (function_exists("filter_validate")) {
    // PHP 8.4+
    $page = filter_validate($_GET["page"] ?? 1, FILTER_VALIDATE_INT, default: 1);
} else {
    // PHP 7.4–8.3
    $page = isset($_GET["page"]) ? filter_var($_GET["page"], FILTER_VALIDATE_INT) : 1;
    $page = $page ?: 1;
}

$paginator = new Paginator("http://localhost:8080/ep05/?page=", "Página", ["Primeira página", "Primeira"], ["Última página", "Última"]);
$paginator->pager($post->find()->count(), 3, $page, 2);

$posts = $post->find()->limit($paginator->limit())->offset($paginator->offset())->fetch(true);

echo "<link rel='stylesheet' href='style.css'/>";
echo "<p>Página {$paginator->page()} de {$paginator->pages()}</p>";

if ($posts) {
    foreach ($posts as $post) {
        echo "
        <article class='post'>
            <img src='{$post->cover}' />
            <div>
                <h1>{$post->title}</h1>
                <div>{$post->description}</div>
            </div>
        </article>";
    }
}

echo $paginator->render("paginator");
