<?php

namespace App\Api;

class Author
{
    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

    public static function fromApiResponse(array $data)
    {
        $new = new self();

        $new->id = $data['id'];
        $new->name = $data['name'];

        return $new;
    }
}
