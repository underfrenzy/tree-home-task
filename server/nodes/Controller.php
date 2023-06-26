<?php

namespace nodes;

class Controller
{
    public function get(int $id = null)
    {
        echo json_encode(Service::findById($id));
    }

    public function getChilds(int $parentId)
    {
        echo json_encode(Service::getChilds($parentId));
    }

    public function post(mixed $postBody)
    {
        echo json_encode(Service::create($postBody));
    }

    public function put(int $id, array $postBody): Node
    {
        echo json_encode(Service::update($id, $postBody));
    }

    public function delete(int $id): void
    {
        Service::delete($id);
    }
}
