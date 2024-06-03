<?php

require_once 'Database.php';

class Teachers
{

    public static function getRecords($id = null)
    {
        if ($id !== null) {
            $sql = "SELECT * FROM paintings WHERE id = :id";
            $stmt = Database::prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch();
        } else {
            $sql = "SELECT p.id, p.name, p.description, p.img, COALESCE(h.name, 'No Hall') AS hall_name, p.year 
            FROM paintings p 
            LEFT JOIN halls h ON p.id_hall = h.id";
            $stmt = Database::prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    public static function getRecordsByFilter($id_hall)
    {
        $sql = "SELECT p.id, p.name, p.description, p.img, COALESCE(h.name, 'No Hall') AS hall_name, p.year 
                FROM paintings p 
                LEFT JOIN halls h ON p.id_hall = h.id WHERE p.id_hall = :id_hall";
        $stmt = Database::prepare($sql);
        $stmt->execute(['id_hall' => $id_hall]);
        return $stmt->fetchAll();
    }

    public static function getTableName()
    {
        return 'paintings';
    }

    public static function getFieldsForRead()
    {
        return [
            'id' => 'int',
            'name' => 'string',
            'hall_name' => 'string',
            'description' => 'string',
            'img' => 'string',
            'year' => 'int'
        ];
    }

    public static function getFieldsForCreate()
    {
        return [
            'name' => 'string',
            'id_hall' => 'int',
            'description' => 'string',
            'img' => 'string',
            'year' => 'int'
        ];
    }

    public static function deleteRecord($id)
    {
        $stmt = Database::prepare("DELETE FROM paintings WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }
}
