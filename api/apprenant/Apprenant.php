<?php
class Apprenant {
    private $conn;
    private $table_name = "apprenant";

    public function __construct($db){
        $this->conn = $db;
    }

    function all(){
        $result = [];
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $stmt2 = $this->conn->prepare("SELECT * FROM formation WHERE ID_FORMATION IN (SELECT ID_FORMATION FROM inscrire WHERE ID_APPRENANT = ".$row['ID_APPRENANT'].")");
            $stmt2->execute();
            $row['INSCRIRE'] = [];
            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)){
                array_push($row['INSCRIRE'], $row2);
            }
            array_push($result, $row);
        }
        return $result;
    }

    function read($id){
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name ." WHERE 	ID_APPRENANT = ".$id);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            return $row;
        }

        return [];
    }

    function create($data){
        $query = "INSERT INTO " . $this->table_name . " 
        SET  NOM=:NOM, PRENOM=:PRENOM, TEL=:TEL, ADRESSE=:ADRESSE, EMAIL=:EMAIL, MDP=:MDP";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":NOM", $data['NOM']);
        $stmt->bindParam(":PRENOM", $data['PRENOM']);
        $stmt->bindParam(":TEL", $data['TEL']);
        $stmt->bindParam(":ADRESSE", $data['ADRESSE']);
        $stmt->bindParam(":EMAIL", $data['EMAIL']);
        $stmt->bindParam(":MDP", $data['MDP']);




        if($stmt->execute()){
            return true;
        }

        return false;
    }
    function update($data){
        $query = "  UPDATE " . $this->table_name . " 
                    SET  NOM=:NOM, PRENOM=:PRENOM, TEL=:TEL, ADRESSE=:ADRESSE, EMAIL=:EMAIL, MDP=:MDP, IMAGE=:IMAGE
                    WHERE ID_APPRENANT=:ID_APPRENANT
                    ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ID_APPRENANT", $data['ID_APPRENANT']);
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

        $query = "DELETE FROM " . $this->table_name . " WHERE ID_APPRENANT = ".$id;
        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}


?>