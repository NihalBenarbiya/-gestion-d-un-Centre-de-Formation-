<?php
class Formation {
    private $conn;
    private $table_name = "formation";

    public function __construct($db){
        $this->conn = $db;
    }

    function all(){
        $result = [];
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $query2 = "SELECT * FROM formateur WHERE ID_FORMATEUR = ".$row['ID_FORMATEUR'];
            $stmt2 = $this->conn->prepare($query2);
            $stmt2->execute();
            while ($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $row['FORMATEUR'] = $row2;
            }
            array_push($result, $row);
        }
        return $result;
    }

    function mesFormations(){
        session_start();
        $result = [];
        $stmt = $this->conn->prepare("SELECT * FROM formation WHERE ID_FORMATION IN (SELECT ID_FORMATION FROM inscrire WHERE ID_APPRENANT = ".$_SESSION['userID'].")");
        $stmt->execute();
//        $stmt2->debugDumpParams();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            array_push($result, $row);
        }
        return $result;
    }

    function read($id){
        $stmt = $this->conn->prepare("SELECT * FROM " . $this->table_name ." WHERE ID_FORMATION = ".$id);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            return $row;
        }

        return [];
    }

    function create($data){
        $query = "INSERT INTO " . $this->table_name . " SET  ID_FORMATEUR=:ID_FORMATEUR, NOM=:NOM, DATE_DEBUT=:DATE_DEBUT, 	DATE_FIN=:DATE_FIN, 	PRIX=:PRIX";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ID_FORMATEUR", $data['ID_FORMATEUR']);
        $stmt->bindParam(":NOM", $data['NOM']);
        $stmt->bindParam(":DATE_DEBUT", $data['DATE_DEBUT']);
        $stmt->bindParam(":DATE_FIN", $data['DATE_FIN']);
        $stmt->bindParam(":PRIX", $data['PRIX']);


        if($stmt->execute()){
            return true;
        }

        return false;
    }
    function update($data){
        $query = "  UPDATE " . $this->table_name . " 
                    SET ID_FORMATEUR=:ID_FORMATEUR, NOM=:NOM, DATE_DEBUT=:DATE_DEBUT, DATE_FIN=:DATE_FIN, PRIX=:PRIX
                    WHERE ID_FORMATION=:ID_FORMATION
                    ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":ID_FORMATION", $data['ID_FORMATION']);
        $stmt->bindParam(":ID_FORMATEUR", $data['ID_FORMATEUR']);
        $stmt->bindParam(":NOM", $data['NOM']);
        $stmt->bindParam(":DATE_DEBUT", $data['DATE_DEBUT']);
        $stmt->bindParam(":DATE_FIN", $data['DATE_FIN']);
        $stmt->bindParam(":PRIX", $data['PRIX']);


        if($stmt->execute()){
            return true;
        }

        return false;
    }

    function delete($id){

        $query = "DELETE FROM " . $this->table_name . " WHERE ID_FORMATION = ".$id;
        $stmt = $this->conn->prepare($query);

        if($stmt->execute()){
            return true;
        }
        return false;
    }
}


?>