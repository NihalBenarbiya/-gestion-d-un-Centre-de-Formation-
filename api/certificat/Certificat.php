<?php
class Certificat {
    private $conn;
    private $table_name = "certificat";

    public function __construct($db){
        $this->conn = $db;
    }

    function all(){
        $result = [];
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $query2 = "SELECT * FROM formation WHERE ID_FORMATION = ".$row['ID_FORMATION'];
            $stmt2 = $this->conn->prepare($query2);
            $stmt2->execute();
            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $row['FORMATION'] = $row2;
            }
            $query2 = "SELECT * FROM formation WHERE APPRENANT = ".$row['ID_APPRENANT'];
            $stmt2 = $this->conn->prepare($query2);
            $stmt2->execute();
            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $row['APPRENANT'] = $row2;
            }
            array_push($result, $row);
        }
        return $result;
    }

    function read($id){
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name ." WHERE ID_CERTIFICAT = ".$id);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            return $row;
        }

        return [];
    }

    function create($data){
        $query = "INSERT INTO " . $this->table_name . " SET ID_FORMATION=:ID_FORMATION, ID_APPRENANT=:ID_APPRENANT";
        session_start();
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ID_FORMATION", $data['ID_FORMATION']);
        $stmt->bindParam(":ID_APPRENANT", $_SESSION['userID']);


        if($stmt->execute()){
            return true;
        }
        $stmt->debugDumpParams();

        return false;
    }
    function update($data){
        $query = "  UPDATE " . $this->table_name . " 
                    SET ID_FORMATION=:ID_FORMATION, ID_APPRENANT=:ID_APPRENANT
                    WHERE ID_CERTIFICAT=:ID_CERTIFICAT
                    ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ID_CERTIFICAT", $data['ID_CERTIFICAT']);
        $stmt->bindParam(":ID_FORMATION", $data['ID_FORMATION']);
        $stmt->bindParam(":ID_APPRENANT", $data['ID_APPRENANT']);


        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function delete($id){

        $query = "DELETE FROM " . $this->table_name . " WHERE ID_CERTIFICAT = ".$id;
        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}


?>