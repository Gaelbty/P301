<?php
namespace Controllers;

use \Controllers\PostRepository;
use \Includes\Database\DatabaseConnection;
use \Models\Post;

class Example
{
    public function execute(): void
    {
        $postRepository = new PostRepository(DatabaseConnection::getInstance());
        $posts = $postRepository->getPosts();
        (new \Views\Post($posts))->show();
    }
}