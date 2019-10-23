<?php


namespace App;


class HtmlAttribute
{
    private $attributes;

    public function __construct(array $attributes = [])
    {
        $this->attributes = $attributes;
    }
}