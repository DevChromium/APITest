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

    $result = $team->fetch();
    $num = $result->rowCount();

    if($num > 0) { 
        // Team array
        $team_arr = array();
        $team_arr['data'] = array();

        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            extract($row);

            $team_item = array(
                'id' => $id,
                'name' => $name,
                'uuid' => $uuid,
                'role' => $role
            );

            array_push($team_arr['data'], $team_item);

        }

        echo json_encode($team_arr);

    } else {
        echo json_encode(
            array('message' => "No team member found")
        );
    }

?>