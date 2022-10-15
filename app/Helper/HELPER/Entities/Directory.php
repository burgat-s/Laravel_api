<?php

namespace App\Helper\HELPER\Entities;

class Directory
{
    /** @var string */
    public $title;
    /** @var Directory[]|null */
    public $children;

    public function __construct(string $title, ?array $children)
    {
        $this->title = $title;
        $this->children = $children;
    }

    public function addChild(Directory $directory)
    {
        $this->children[] = $directory;
    }

    public function toArray()
    {
        if ($this->children) {
            $this->children = collect($this->children)->map(function (Directory $directory) {
                return $directory->toArray();
            })->toArray();
        }

        return [
            'title' => $this->title,
            'key' => uniqid(),
            'children' => $this->children
        ];
    }
}
