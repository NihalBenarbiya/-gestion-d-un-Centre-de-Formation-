<?php
class Formateur {
    private $conn;
    private $table_name = "formateur";

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
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name ." WHERE ID_FORMATEUR = ".$id);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            return $row;
        }

        return [];
    }

    function create($data){
        $query = "INSERT INTO " . $this->table_name . " SET NOM=:NOM, PRENOM=:PRENOM, CIN=:CIN, EMAIL=:EMAIL, TEL=:TEL, ADRESSE=:ADRESSE ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":NOM", $data['NOM']);
        $stmt->bindParam(":PRENOM", $data['PRENOM']);
        $stmt->bindParam(":CIN", $data['CIN']);
        $stmt->bindParam(":EMAIL", $data['EMAIL']);
        $stmt->bindParam(":TEL", $data['TEL']);
        $stmt->bindParam(":ADRESSE", $data['ADRESSE']);


        if($stmt->execute()){
            return true;
        }

        return false;
    }
    function update($data){
        $query = "  UPDATE " . $this->table_name . " 
                    SET NOM=:NOM, PRENOM=:PRENOM, CIN=:CIN, EMAIL=:EMAIL, TEL=:TEL, ADRESSE=:ADRESSE 
                    WHERE ID_FORMATEUR=:ID_FORMATEUR
                    ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ID_FORMATEUR", $data['ID_FORMATEUR']);
        $stmt->bindParam(":NOM", $data['NOM']);
        $stmt->bindParam(":PRENOM", $data['PRENOM']);
        $stmt->bindParam(":CIN", $data['CIN']);
        $stmt->bindParam(":EMAIL", $data['EMAIL']);
        $stmt->bindParam(":TEL", $data['TEL']);
        $stmt->bindParam(":ADRESSE", $data['ADRESSE']);


        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function delete($id){

        $query = "DELETE FROM " . $this->table_name . " WHERE ID_FORMATEUR = ".$id;
        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}


?>