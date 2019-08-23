<?php

require 'vendor/autoload.php';

$postsApi = new \App\Api\PostService();

$posts = $postsApi->index();

foreach ($posts as $post) {
    echo sprintf("Post: %s (%s)\n", $post->name, $post->createdAt->format('Y.m.d. H:i:s'));
}

echo "\n";

$authorsApi = new \App\Api\AuthorService();

$samplePost = $postsApi->getPost($post->slug);

$author = $authorsApi->getAuthor($samplePost->authorId);

echo sprintf("Author: %s (%s)\n", $author->name, $author->id);

echo "\n";

$newPost = new \App\Api\Post();
$newPost->name = 'Teszt hír';
$newPost->authorId = $author->id;
$newPost->body = 'Lorem Ipsum';

$postsApi->insert($newPost);

echo 'New post inserted';

$postsApi->reset();
