<?php

    class Team {
        
        // DB 
        private $conn;

        // Post props
        public $id;
        public $name;
        public $uuid;
        public $role;
        
        public function __construct($db) {
            $this->conn = $db;
        }

        /*
            GET Request
            Desc: Creates a member
            Endpoint: /api/team/fetch.php
        */
        public function fetch() {
            $query = 'SELECT * FROM team ORDER BY id';
            $stmt = $this->conn->prepare($query);
            $stmt->execute();
            return $stmt;
        }

        /*
            GET Request
            Desc: Creates a member
            Endpoint: /api/team/fetchID.php?id=
        */
        public function fetchID() {
            $query = 'SELECT * FROM team WHERE id = ? LIMIT 0,1';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $this->id);
            $stmt->execute();
            
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $this->id = $row['id'];
            $this->name = $row['name'];
            $this->uuid = $row['uuid'];
            $this->role = $row['role'];
        }


        /*
            POST Request
            Desc: Creates a member
            Endpoint: /api/team/create.php?id=ID&name=NAME&uuid=UUID&role=ROLE
        */
        public function create() {

            $query = 'INSERT INTO team SET
            id = :id,
            name = :name,
            uuid = :uuid,
            role = :role ';

            $stmt = $this->conn->prepare($query);
            
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->uuid = htmlspecialchars(strip_tags($this->uuid));
            $this->role = htmlspecialchars(strip_tags($this->role));

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':uuid', $this->uuid);
            $stmt->bindParam(':role', $this->role);

            if($stmt->execute()) {
                return true;
            }
            
            printf("Error: %s.\n", $stmt->error);    
            
            return false;
            
        }

        /*
            PUT Request
            Desc: Updates the teammember
            Endpoint: /api/team/update.php?id=ID&name=NAME&role=ROLE
        */
        public function update() {

            $query = 'UPDATE team SET
            name = :name,
            role = :role 
            WHERE id = :id';

            $stmt = $this->conn->prepare($query);
            
            $this->id = htmlspecialchars(strip_tags($this->id));
            $this->name = htmlspecialchars(strip_tags($this->name));
            $this->role = htmlspecialchars(strip_tags($this->role));

            $stmt->bindParam(':id', $this->id);
            $stmt->bindParam(':name', $this->name);
            $stmt->bindParam(':role', $this->role);

            if($stmt->execute()) {
                return true;
            }
            
            printf("Error: %s.\n", $stmt->error);    
            
            return false;
            
        }

        /*
            DELETE Request
            Desc: Deletes the teammember
            Endpoint: /api/team/delete.php?id=ID
        */
        public function delete() {
            $query = 'DELETE FROM team WHERE id = :id';

            $stmt = $this->conn->prepare($query);
            
            $this->id = htmlspecialchars(strip_tags($this->id));
            $stmt->bindParam(':id', $this->id);

            if($stmt->execute()) {
                return true;
            }
            
            printf("Error: %s.\n", $stmt->error);    
            
            return false;
        }

    }

?>