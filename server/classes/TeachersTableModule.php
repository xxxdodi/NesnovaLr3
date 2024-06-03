<?php

require_once 'Teachers.php';
include 'TableModule.php';

class TeachersTableModule extends TableModule
{
    public function read($id = null): array
    {
        return Teachers::getRecords($id);
    }

    public function readByFilter($id_hall)
    {
        return Teachers::getRecordsByFilter($id_hall);
    }

    public function create(array $data, array $file): void
    {
        if (!isset($data['year']) || $data['year'] <= 0 || $data['year'] > 2024) {
            throw new Exception("Ошибка: Неверное значение года. Год должен быть в диапазоне от 1 до 2024.");
        }

        if (!isset($file['img']) || $file['img']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Ошибка: Не удалось загрузить изображение.");
        }

        $uploadDir = 'C:/user/projects/crud_vue/src/assets/';
        $uploadFileName = basename($file['img']['name']);
        $uploadFile = $uploadDir . $uploadFileName;
        if (!move_uploaded_file($file['img']['tmp_name'], $uploadFile)) {
            throw new Exception("Ошибка: Не удалось скопировать изображение в папку pics.");
        }

        // Сохранение только имени файла в базу данных
        $data['img'] = $uploadFileName;

        $tableName = Teachers::getTableName();
        $fields = Teachers::getFieldsForCreate();

        $resetAutoIncrementSql = "ALTER TABLE $tableName AUTO_INCREMENT = 1";

        $fieldNames = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $validData = array_intersect_key($data, $fields);

        $sql = "INSERT INTO $tableName ($fieldNames) VALUES ($placeholders)";

        $stmt = Database::prepare($resetAutoIncrementSql);
        $stmt->execute();
        $stmt = Database::prepare($sql);
        $stmt->execute($validData);
    }

    public function update(int $id, array $data, array $file): void
    {
        if (!isset($data['year']) || $data['year'] <= 0 || $data['year'] > 2024) {
            throw new Exception("Ошибка: Неверное значение года. Год должен быть в диапазоне от 1 до 2024.");
        }

        if (!isset($file['img']) || $file['img']['error'] !== UPLOAD_ERR_OK) {
            throw new Exception("Ошибка: Не удалось загрузить изображение.");
        }

        $uploadDir = 'C:/user/projects/crud_vue/src/assets/';
        $uploadFileName = basename($file['img']['name']);
        $uploadFile = $uploadDir . $uploadFileName;
        if (!move_uploaded_file($file['img']['tmp_name'], $uploadFile)) {
            throw new Exception("Ошибка: Не удалось скопировать изображение в папку pics.");
        }

        $data['img'] = $uploadFileName;

        $tableName = Teachers::getTableName();
        $fields = Teachers::getFieldsForCreate();

        $validData = array_intersect_key($data, $fields);


        $setClause = implode(', ', array_map(fn($field) => "$field = :$field", array_keys($validData)));
        $sql = "UPDATE $tableName SET $setClause WHERE id = :id";
        $validData['id'] = $id;

        $stmt = Database::prepare($sql);
        $stmt->execute($validData);
    }

    public function delete(int $id): void
    {
        Teachers::deleteRecord($id);
    }
}
