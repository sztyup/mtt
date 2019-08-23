<?php

namespace App\Api;

class AuthorService extends BaseService implements AuthorServiceInterface
{
    /**
     * @return Author[]
     */
    public function index()
    {
        $authors = [];

        $data = $this->get('authors');

        foreach ($data as $item) {
            $authors[] = Author::fromApiResponse($item);
        }

        return $authors;
    }

    /**
     * @param int $id
     *
     * @return Author
     */
    public function getAuthor($id)
    {
        $data = $this->get('authors/' . $id);

        return Author::fromApiResponse($data);
    }

    /**
     * @param Author $author
     *
     * @return Post[]
     */
    public function getPostByAuthor(Author $author)
    {
        $posts = [];
        $data = $this->get(sprintf('authors/%d/posts', $author->id));

        foreach ($data as $item) {
            $posts[] = Post::fromApiResponse($item);
        }

        return $posts;
    }
}
