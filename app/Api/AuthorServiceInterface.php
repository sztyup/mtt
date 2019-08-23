<?php

namespace App\Api;

interface AuthorServiceInterface
{
    /**
     * @return Author[]
     */
    public function index();

    /**
     * @param $id
     *
     * @return Author
     */
    public function getAuthor($id);

    /**
     * @param Author $author
     *
     * @return Post[]
     */
    public function getPostByAuthor(Author $author);
}
