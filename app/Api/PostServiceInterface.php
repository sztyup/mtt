<?php

namespace App\Api;

interface PostServiceInterface
{
    /**
     * @param \DateTime|null $from
     * @param \DateTime|null $to
     *
     * @return Post[]
     */
    public function index(\DateTime $from = null, \DateTime $to = null);

    /**
     * @param $idOrSlug
     *
     * @return Post
     */
    public function getPost($idOrSlug);

    /**
     * @param Post $post
     *
     * @return Post
     */
    public function insert(Post $post);
}
