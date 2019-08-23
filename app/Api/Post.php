<?php

namespace App\Api;

class Post
{
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var string
     */
    public $body;

    /**
     * @var int
     */
    public $authorId;

    /**
     * @var \DateTime
     */
    public $createdAt;

    /**
     * @var \DateTime
     */
    public $updatedAt;

    public static function fromApiResponse(array $data)
    {
        $new = new self();

        $new->name = (string) $data['name'];
        $new->slug = (string) $data['slug'];
        try {
            $new->createdAt = new \DateTime($data['created_at']);
        } catch (\Exception $e) {
            // createdAt stays null
        }
        if (array_key_exists('body', $data)) {
            $new->body = (string) $data['body'];
            $new->authorId = (int) $data['author_id'];
            try {
                $new->updatedAt = new \DateTime($data['updated_at']);
            } catch (\Exception $e) {
                // updatedAt stays null
            }
        }

        return $new;
    }
}
