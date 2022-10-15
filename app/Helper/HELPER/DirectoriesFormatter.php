<?php

namespace App\Helper\HELPER;

use Illuminate\Support\Facades\Storage;

class DirectoriesFormatter
{
    /** @var string */
    private $root;

    public function __construct(string $root)
    {
        $this->root = $root;
    }

    private function getDirectoryName($directory)
    {
        $separacion = $directory ? explode('/', $directory) : null;
        return $separacion ? $separacion[count($separacion) - 1] : null;
    }

    private function getSubDirectories($directory)
    {
        $subdirectorios = Storage::directories($directory);
        $mapeo = array_map(function ($directory) {
            return new Entities\Directory($this->getDirectoryName($directory), $this->getSubDirectories($directory));
        }, $subdirectorios);
        return $mapeo;
    }

    public function listDirectories()
    {
        $subdirectorios = $this->getSubDirectories($this->root);
        $nombreDirectorio = $this->getDirectoryName($this->root);
        return (new Entities\Directory($nombreDirectorio, $subdirectorios))->toArray();
    }
}
