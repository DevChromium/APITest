<?php

     // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: DELETE');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization,X-Requested-With');

    // Including DB and Team model
    include_once '../../config/Database.php';
    include_once '../../models/Team.php';

    $database = new Database();
    $db = $database->connect();

    $team = new Team($db);

    $data = json_decode(file_get_contents("php://input"));

    $team->id = $data->id;

    if($team->delete()) {
        echo json_encode(
            array('message' => "Member deleted")
        );
    } else  {
        echo json_encode(
            array('message' => "Member not deleted")
        );
    }

?>