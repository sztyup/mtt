<?php

namespace App\Api;

class PostService extends BaseService implements PostServiceInterface
{
    /**
     * @param \DateTime|null $from
     * @param \DateTime|null $to
     *
     * @return Post[]
     */
    public function index(\DateTime $from = null, \DateTime $to = null)
    {
        $posts = [];

        $data = $this->get('posts', [
            'from' => $from,
            'to' => $to,
        ]);

        foreach ($data as $item) {
            $posts[] = Post::fromApiResponse($item);
        }

        return $posts;
    }

    /**
     * @param $idOrSlug
     *
     * @return Post
     */
    public function getPost($idOrSlug)
    {
        $data = $this->get('posts/' . $idOrSlug);

        return Post::fromApiResponse($data);
    }

    /**
     * @param Post $post
     *
     * @return Post
     */
    public function insert(Post $post)
    {
        $this->post('posts', [
            'name' => $post->name,
            'body' => $post->body,
            'author_id' => $post->authorId
        ]);

        return $post;
    }
}
