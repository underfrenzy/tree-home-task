<?php

namespace nodes;



use db\Db;
use PDO;

class Service
{
    /**
     * @param $id
     * @return Node | null
     */
    public static function findById($id): Node | null
    {
        $db = Db::getInstance();

        $stmt = $db->prepare("SELECT * FROM node WHERE id=:id");
        $stmt->execute(['id' => $id]);
        $result = $stmt->fetch();

        return $result ? new Node($result): null;

    }

    /**
     * @param int $parentId
     * @return Node[]
     */
    public static function getChilds (int $parentId): array {
        $db = Db::getInstance();

        $stmt = $db->prepare("
            SELECT n.*
            FROM node_parent_child AS npc 
            LEFT JOIN node AS n ON n.id = npc.child 
            WHERE npc.parent=:id
        ");
        $stmt->execute(['id' => $parentId]);
        $result = $stmt->fetchAll();

        $nodes = [];
        foreach ($result as $item) {
            $node = new Node($item);
            $node->childs = self::getChilds($node->id);
            $nodes[] = $node;
        }

        return $nodes;
    }

    public static function create (mixed $data): Node {
        $db = Db::getInstance();
        $node = new Node($data);

        $db->prepare("INSERT INTO node (name) VALUES (?)")
            ->execute([$node->name]);

        $node->id = (int)$db->lastInsertId();

        $stmt = $db->prepare("INSERT INTO node_parent_child (parent, child) VALUES (:parentId, :childId)");
        $stmt->bindParam(':parentId', $node->parentId, PDO::PARAM_INT);
        $stmt->bindParam(':childId', $node->id, PDO::PARAM_INT);
        $stmt->execute();


        return $node;
    }

    public static function delete (int $id): void
    {
        $db = Db::getInstance();

        $stmt= $db->prepare("DELETE FROM node WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $stmt= $db->prepare("DELETE FROM node_parent_child WHERE parent = :id");
        $stmt->execute(['id' => $id]);
    }

    public static function update(int $id, array $postBody)
    {

    }
}
