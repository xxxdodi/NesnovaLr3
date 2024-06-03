<?php
require_once '../vendor/autoload.php';
require_once "../classes/Subjects.php";
require_once "../classes/Teachers.php";
require_once "../classes/TeachersTableModule.php";
require_once "../classes/SubjectTableModule.php";
$app = new Silex\Application();

$app->after(function ($request, $response) {
    $response->headers->set('Access-Control-Allow-Origin', '*');
    $response->headers->set('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
    $response->headers->set('Access-Control-Allow-Headers', 'Origin, Content-Type, X-Auth-Token');
});


//для групп:
$app->get('/halls/list.json', function () use ($app){
    $hall = new SubjectTableModule();
    $list = $hall->read();
    return $app->json($list);
});

$app->post('/halls/add-item', function () use ($app){
    if (strlen($_POST['name'])) {
        $name = $_POST['name'];
        $hall = new SubjectTableModule();
        try {
            $hall->create(array('name' => $name), []);
            $response = $app->json(array("create-hall" => "yes"));
            $response->headers->set('Content-Type', 'application/json');
            return $response;
        } catch (PDOException $e) {
            return $app->json(array("error" => $e->getMessage(), "create-hall" => "no"));
        } catch (Exception $e) { // Добавляем обработку любых других исключений
            return $app->json(array("error" => $e->getMessage(), "create-hall" => "no"));
        }
    } else {
        return $app->json(array("create-hall" => "no"));
    }
});




$app->post('/halls/update-item', function ()use ($app) {



    $hall = new SubjectTableModule();
    $id = intval($_POST['id']);
    $name = $_POST['name'];
    if (strlen($name)) {
        try {
            $hall->update($id, array("name" => $name));
            return $app->json(array("update-hall" => "yes"));
        } catch (PDOException $e) {
            return $app->json(array("error" => $e->getMessage(), "update-hall" => "no"));
        }
    } else {
        return $app->json(array("update-hall" => "no"));
    }
});

$app->post('/halls/delete-item', function ()use ($app) {
    $id = intval($_POST["id"]);
    $hall = new SubjectTableModule();

        try {
            $hall->delete($id);
            return $app->json(array("delete-hall" => "yes", "id_delete" => $id));
        } catch (PDOException $e) {
            return $app->json(array("error" => $e->getMessage(), "delete-hall" => "no"));
        }

});

//для студентов:

$app->get('/paintings/list.json', function () use ($app){
    $painting = new TeachersTableModule();
    $list = $painting->read();
    return $app->json($list);
});

$app->get('/paintings/SelectByID', function () use ($app){
    $id_hall = intval($_GET['id_hall']);
   $painting = new TeachersTableModule();
   $list = $painting->readByFilter($id_hall);
   return $app->json($list);
});


$app->post('/paintings/add-item', function () use ($app) {
    $name = $_POST["name"];
    $year = $_POST["year"];
    $description = $_POST["description"];
    $id_hall = intval($_POST["id_hall"]);
    $painting = new TeachersTableModule();
        try {
            $painting->create(array('name' => $name,"year" => $year, "description" => $description, "id_hall" => $id_hall), $_FILES);
            return $app->json(array("create-painting" => "yes"));
        } catch (PDOException $e) {
            return $app->json(array("error" => $e->getMessage(), "create-painting" => "no"));
        }
});

$app->post('/paintings/update-item', function () use ($app){
    $id = intval($_POST["id"]);
    $name = $_POST["name"];
    $description = $_POST["description"];
    $year = intval($_POST["year"]);
    $id_hall = intval($_POST["id_hall"]);

    $painting = new TeachersTableModule();
        try {
            $painting->update($id, array("name" => $name, "description" => $description, "year" => $year, "id_hall" => $id_hall),$_FILES);
            return $app->json(array("update-painting" => "yes"));
        } catch (PDOException $e) {
            return $app->json(array("error" => $e->getMessage(), "update-painting" => "no"));
        }
});

$app->post('/paintings/delete-item', function () use ($app) {

    $painting = new TeachersTableModule();
    $id = intval($_POST["id"]);
        try {
            $painting->delete($id);
            return $app->json(array("delete-painting" => "yes", "id_delete" => $id));
        } catch (PDOException $e) {
            return $app->json(array("error" => $e->getMessage(), "delete-painting" => "no"));
        }

});

$app->run();
