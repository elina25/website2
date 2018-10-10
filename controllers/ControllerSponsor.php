<?php

class ControllerSponsor {

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        
    }

  public function getAllSponsors($CultureID,$PageSize = NULL, $RecordOffest = NULL) {

        $query = 'SELECT SponsorID,FriendlyName,CultureID  FROM Sponsors_Details 
        WHERE CultureID = :CultureID';
        
        if(is_numeric($PageSize) && is_numeric($RecordOffest))
        {
            //echo '2:' . $PageSize . ' ' . $RecordOffest ;
            $query .= " LIMIT " .  $RecordOffest . "," . $PageSize;
        }

        $stmt = $this->pdo->prepare($query);      

        

        $result = $stmt->execute( array('CultureID' => $CultureID ));
        $array = array();

        $ind = 0;

        foreach ($stmt as $row) {

            $itm = new Sponsor();



            $itm->SponsorID = $row['SponsorID'];

            $itm->CultureID = $row['CultureID'];

            $itm->FriendlyName = $row['FriendlyName'];

          
            $array[$ind] = $itm;

            $ind++;


        }

        return $array;

    }


         public function getAllSponsorCount($CultureID) {

        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM Sponsors_Details WHERE CultureID = :CultureID;');
        $result = $stmt->execute( array('CultureID' => $CultureID ));

        //print_r($stmt);
        foreach ($stmt as $row) {
            //print_r($row);
            return $row[0];
        }

        return null;
    }


      public function getSponsorWithID($SponsorID, $CultureID)
    {
    $stmt = $this->pdo->prepare('SELECT * FROM `Sponsors_Details`
         WHERE SponsorID=:SponsorID AND CultureID = :CultureID');

        $stmt->execute( array('SponsorID' => $SponsorID, 'CultureID' => $CultureID ) );

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Sponsor();
            $itm->ID = $row['ID'];
            $itm->SponsorID = $row['SponsorID'];
            $itm->CultureID = $row['CultureID'];
            $itm->FriendlyName = $row['FriendlyName'];
            $itm->Comments = $row['Comments'];
   
            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }


}