<?php

class BaseDAOnationality {

    function __construct() {
        
    }

    function findAll() {
        $pdo = $GLOBALS['pdo'];
        $stm = $pdo->prepare("select id,short_name from buddy_nationality order by short_name");
        $stm->execute();
        //$resultSelect = mysql_query($query,$_SESSION['link']);

        //if ($res == TRUE) {
            //print "Fetching data was successful";
        //} else {
        //    die("Fetching groups database error: ");
        //}

        $countries[0] = "select...";
        while( $row = $stm->fetch( PDO::FETCH_OBJ ) ){
            $countries[$row->id] = $row->short_name;
        }

        return($countries);
    }

    function findById($id) {
        if ($id == NULL) {
            $id = 14;
        }

        $query = "select id,short_name from buddy_nationality WHERE id=:id";
        
        $pdo = $GLOBALS['pdo'];
        $stm=$pdo->prepare($query);
        $stm->bindValue(":id", $id );
        
        
        $resultSelect = $stm->execute();
        if ($resultSelect == TRUE) {
            //print "Fetching data was successful";
        } else {
            die("Fetching nationality error");
        }

        $incomingRow = $stm->fetch();
        //var_export($incomingRow);
        $country = array();
        $country['id'] = $incomingRow['id'];
        $country['country'] = $incomingRow['short_name'];

        return($country);
    }

}

?>