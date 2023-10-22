<?php
class Secretaire {
    private $conn;
    private $table_name = "secretaire";

    public function __construct($db){
        $this->conn = $db;
    }

    function all(){
        $result = [];
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($result, $row);
        }
        return $result;
    }

    function read($id){
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name ." WHERE ID_SECRETAIRE = ".$id);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            return $row;
        }

        return [];
    }

    function create($data){
        $query = "INSERT INTO " . $this->table_name . " SET NOM=:NOM, PRENOM=:PRENOM, TEL=:TEL, ADRESSE=:ADRESSE, EMAIL=:EMAIL, MDP=:MDP, IMAGE=:IMAGE";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":NOM", $data['NOM']);
        $stmt->bindParam(":PRENOM", $data['PRENOM']);
        $stmt->bindParam(":TEL", $data['TEL']);
        $stmt->bindParam(":ADRESSE", $data['ADRESSE']);
        $stmt->bindParam(":EMAIL", $data['EMAIL']);
        $stmt->bindParam(":MDP", $data['MDP']);
        $stmt->bindParam(":IMAGE", $data['IMAGE']);


        if($stmt->execute()){
            return true;
        }

        return false;
    }
    function update($data){
        $query = "  UPDATE " . $this->table_name . " 
                    SET NOM=:NOM, PRENOM=:PRENOM, TEL=:TEL, ADRESSE=:ADRESSE, EMAIL=:EMAIL, MDP=:MDP, IMAGE=:IMAGE
                    WHERE ID_SECRETAIRE=:ID_SECRETAIRE
                    ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ID_SECRETAIRE", $data['ID_SECRETAIRE']);
        $stmt->bindParam(":NOM", $data['NOM']);
        $stmt->bindParam(":PRENOM", $data['PRENOM']);
        $stmt->bindParam(":TEL", $data['TEL']);
        $stmt->bindParam(":ADRESSE", $data['ADRESSE']);
        $stmt->bindParam(":EMAIL", $data['EMAIL']);
        $stmt->bindParam(":MDP", $data['MDP']);
        $stmt->bindParam(":IMAGE", $data['IMAGE']);

        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function delete($id){

        $query = "DELETE FROM " . $this->table_name . " WHERE ID_SECRETAIRE = ".$id;
        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}


?>