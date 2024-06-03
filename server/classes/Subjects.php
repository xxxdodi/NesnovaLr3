<?php
require_once 'Database.php';
class Subjects
{
    public static function getRecords($id = null)
    {
        if ($id !== null) {
            $sql = "SELECT * FROM halls WHERE id = :id";
            $stmt = Database::prepare($sql);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch();
        } else {
            $sql = "SELECT * FROM halls";
            $stmt = Database::prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        }
    }

    public static function getTableName()
    {
        return 'halls';
    }

    public static function getFieldsForRead()
    {
        return [
            'id' => 'int',
            'name' => 'string'
        ];
    }
    public static function getFieldsForCreate()
    {
        return [
            'name' => 'string'
        ];
    }

    public static function deleteRecord($id)
    {
        $stmt = Database::prepare("DELETE FROM halls WHERE id = :id");
        $stmt->execute(['id' => $id]);
    }

}
