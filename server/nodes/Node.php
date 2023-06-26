<?php

namespace nodes;

class Node
{
    public int $id;
    public string $name;
    public int $parentId;
    public array $childs;

    public function __construct(array $data)
    {
        if (isset($data['id'])) {
            $this->id = (int)$data['id'];
        }

        if (isset($data['name'])) {
            $this->name = $data['name'];
        }

        if (isset($data['parentId'])) {
            $this->parentId = (int)$data['parentId'];
        }
    }
}
