<?php

    // Headers
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');


    // Including DB and Team model
    include_once '../../config/Database.php';
    include_once '../../models/Team.php';

    $database = new Database();
    $db = $database->connect();

    $team = new Team($db);
    $team->id = isset($_GET['id']) ? $_GET['id'] : die();
    $team->fetchID();

    $team_array = array(
        'id' => $team->id,
        'name' => $team->name,
        'uuid' => $team->uuid,
        'role' => $team->role
    );

    print_r(json_encode($team_array));

?>