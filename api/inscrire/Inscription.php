<?php
class Inscription {
    private $conn;
    private $table_name = "inscrire";

    public function __construct($db){
        $this->conn = $db;
    }

    function all(){
        $result = [];
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $stmt2 = $this->conn->prepare("SELECT * FROM apprenant WHERE ID_APPRENANT = ".$row['ID_APPRENANT']);
            $stmt2->execute();
            if($stmt2->rowCount())
            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $row['APPRENANT'] = $row2;
            }
            $stmt3 = $this->conn->prepare("SELECT * FROM formation WHERE ID_FORMATION = ".$row['ID_FORMATION']);
            $stmt3->execute();
            while ($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                $row['FORMATION'] = $row3;
            }
            array_push($result, $row);
        }
        return $result;
    }

    function read($ID_APPRENANT, $ID_FORMATION){
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name ." WHERE 	ID_APPRENANT=:ID_APPRENANT AND ID_FORMATION=:ID_FORMATION");
        $stmt->bindParam(":ID_APPRENANT", $ID_APPRENANT);
        $stmt->bindParam(":ID_FORMATION", $ID_FORMATION);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            return $row;
        }

        return [];
    }

    function create($data){
        $query = "INSERT INTO " . $this->table_name . " 
        SET  ID_APPRENANT=:ID_APPRENANT, ID_FORMATION=:ID_FORMATION, ETAT_DE_PAIEMENT=:ETAT_DE_PAIEMENT";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ID_APPRENANT", $data['ID_APPRENANT']);
        $stmt->bindParam(":ID_FORMATION", $data['ID_FORMATION']);
        $stmt->bindParam(":ETAT_DE_PAIEMENT", $data['ETAT_DE_PAIEMENT']);



        if($stmt->execute()){
            return true;
        }

        return false;
    }
    function update($data,$ID_APPRENANT, $ID_FORMATION){
        $query = "  UPDATE " . $this->table_name . " 
                    SET ID_APPRENANT=:ID_APPRENANT, ID_FORMATION=:ID_FORMATION, ETAT_DE_PAIEMENT=:ETAT_DE_PAIEMENT
                    WHERE ID_APPRENANT=:ID_APPRENANT2 AND ID_FORMATION=:ID_FORMATION2
                    ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ID_APPRENANT", $data['ID_APPRENANT']);
        $stmt->bindParam(":ID_FORMATION", $data['ID_FORMATION']);
        $stmt->bindParam(":ETAT_DE_PAIEMENT", $data['ETAT_DE_PAIEMENT']);
        $stmt->bindParam(":ID_APPRENANT2", $ID_APPRENANT);
        $stmt->bindParam(":ID_FORMATION2", $ID_FORMATION);


        if($stmt->execute()){
//            $stmt->debugDumpParams();
            return true;
        }



        return false;
    }

    function delete($ID_APPRENANT, $ID_FORMATION){

        $query = "DELETE FROM " . $this->table_name . " WHERE ID_APPRENANT=:ID_APPRENANT AND ID_FORMATION=:ID_FORMATION";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ID_APPRENANT", $ID_APPRENANT);
        $stmt->bindParam(":ID_FORMATION", $ID_FORMATION);
        if($stmt->execute()){
            return true;
        }
        return false;
    }
}


?>