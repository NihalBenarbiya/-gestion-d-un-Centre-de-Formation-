<?php
class Emploi {
    private $conn;
    private $table_name = "emploie";

    public function __construct($db){
        $this->conn = $db;
    }

    function all(){
        $result = [];
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $stmt2 = $this->conn->prepare("SELECT * FROM formation WHERE ID_FORMATION IN (SELECT ID_FORMATION FROM appartenir WHERE ID_EMPLOIE = ".$row['ID_EMPLOIE'].")");
            $stmt2->execute();
//            var_dump($stmt2->debugDumpParams());
            $row['FORMATIONS'] = [];
            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                array_push($row['FORMATIONS'], $row2);
            }
            array_push($result, $row);
        }
        return $result;
    }

    function monEmploi(){
        session_start();
        $result = [];
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $stmt2 = $this->conn->prepare("SELECT * FROM formation WHERE ID_FORMATION IN (SELECT ID_FORMATION FROM inscrire WHERE 	ID_APPRENANT = ".$_SESSION['userID'].") AND
                ID_FORMATION IN (SELECT ID_FORMATION FROM appartenir WHERE ID_EMPLOIE = ".$row['ID_EMPLOIE'].")
            ");
            $stmt2->execute();
//            var_dump($stmt2->debugDumpParams());
            $row['FORMATIONS'] = [];
            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                array_push($row['FORMATIONS'], $row2);
            }
            array_push($result, $row);
        }
        return $result;
    }



    function read($id){
        $stmt = $this->conn->prepare("SELECT * FROM appartenir WHERE ID_EMPLOIE = ".$id);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            return $row;
        }

        return [];
    }

    function create($data){
        $query = "INSERT INTO appartenir SET ID_EMPLOIE=:ID_EMPLOIE, ID_FORMATION=:ID_FORMATION";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ID_EMPLOIE", $data['ID_EMPLOIE']);
        $stmt->bindParam(":ID_FORMATION", $data['ID_FORMATION']);


        if($stmt->execute()){
            return true;
        }
        $stmt->debugDumpParams();

        return false;
    }
    function update($data){
        $query = "  UPDATE " . $this->table_name . " 
                    SET NOM=:NOM, PRENOM=:PRENOM, CIN=:CIN, EMAIL=:EMAIL, TEL=:TEL, ADRESSE=:ADRESSE 
                    WHERE ID_EMPLOIE=:ID_EMPLOIE
                    ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ID_EMPLOIE", $data['ID_EMPLOIE']);
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

        $query = "DELETE FROM " . $this->table_name . " WHERE ID_EMPLOIE = ".$id;
        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}


?>