<?php

require __DIR__ . "/vendor/autoload.php";

use Source\Models\Post;
$faker = Faker\Factory::create();

for ($i = 0; $i < 30; $i++) {
    $post = new Post();
    $post->title = $faker->text(80);
    $post->cover = './images/300x150.svg';
    $post->description = $faker->paragraphs(2, true);

    if (!$post->save()) {
        echo "<pre>";
        print_r($post->fail());
        echo "</pre>";
    } else {
        echo "Salvo com sucesso<br>";
    }
}