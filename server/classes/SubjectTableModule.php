<?php
require_once 'Subjects.php';
require_once 'TableModule.php';
class SubjectTableModule extends TableModule
{
    public function read($id = null): array
    {
        return Subjects::getRecords($id);
    }

    public function create(array $data, array $file): void
    {
        $tableName = Subjects::getTableName();
        $fields = Subjects::getFieldsForCreate();

        $resetAutoIncrementSql = "ALTER TABLE $tableName AUTO_INCREMENT = 1";

        $fieldNames = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $validData = array_intersect_key($data, $fields);

        $sql = "INSERT INTO $tableName ($fieldNames) VALUES ($placeholders)";

        $stmt = Database::prepare($resetAutoIncrementSql);
        $stmt->execute();
        $stmt = Database::prepare($sql);
        try {
            $stmt->execute($validData);
        } catch (PDOException $e) {
            // Если произошла ошибка при выполнении запроса, выбрасываем исключение
            throw new PDOxception("Error creating hall: " . $e->getMessage());
        }
    }

    public function update(int $id, array $data): void
    {
        $tableName = Subjects::getTableName();
        $fields = Subjects::getFieldsForCreate();

        $validData = array_intersect_key($data, $fields);

        $setClause = implode(', ', array_map(fn($field) => "$field = :$field", array_keys($validData)));
        $sql = "UPDATE $tableName SET $setClause WHERE id = :id";
        $validData['id'] = $id;

        $stmt = Database::prepare($sql);
        $stmt->execute($validData);
    }

    public function delete(int $id): void
    {
        Subjects::deleteRecord($id);
    }
}