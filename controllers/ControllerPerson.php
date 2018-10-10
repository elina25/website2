<?php

class ControllerPerson {

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        
    }

        public function getPersonWithID($personID, $CultureID)
        {

         $stmt = $this->pdo->prepare('SELECT * 
            FROM `persons_details` WHERE personID = :personID AND CultureID = :CultureID;
            ');

        $stmt->execute( array('personID' => $personID ,'CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
        {
            //do something with $row
            $itm = new Person();
            $itm->personID = $row['personID'];
            $itm->CultureID = $row['CultureID'];
            $itm->fullName = $row['fullName'];
            $itm->relatives = $row['relatives'];
            $itm->profession = $row['profession'];
            $itm->biographicalData = $row['biographicalData'];
            $itm->biographicalDataPlainText = $row['biographicalDataPlainText'];
            $itm->remarks = $row['remarks'];
            $itm->comments = $row['comments'];
            $itm->commentsPlainText = $row['commentsPlainText'];
            $itm->createdOn = $row['createdOn'];
            $itm->specialIssues = $row['specialIssues'];

            $array[$ind] = $itm;
            $ind++;
        }

        return $array;

 }



  public function getPersonFromPersonID($personID)   //DISPLAY DATA FOR PERSON
    {

        $stmt = $this->pdo->prepare('SELECT `persons`.`UniqueName`, `persons`.`isAnonymous`,
            `persons`.`parentID`, `archivedobjects`.`PrivateData` ,`archivedobjects`.`ArchiveCode`, 
            `archivedobjects`.`IsComplete`,
            `archivedobjects`.`WebAccess`,`archivedobjects`.`Imprimatur`
            FROM `persons` 
            INNER JOIN `archivedobjects` 
            ON `archivedobjects`.`ArchivedObjectID` = `persons`.`personID` 
            WHERE `archivedobjects`.`ArchivedObjectID` = :personID;
');

        $stmt->execute( array('personID' => $personID ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Person();
            $itm->personID = $row['personID'];
            $itm->UniqueName = $row['UniqueName'];
            $itm->isAnonymous = $row['isAnonymous'];
            $itm->parentID = $row['parentID'];
            $itm->PrivateData = $row['PrivateData'];
            $itm->ArchiveCode = $row['ArchiveCode'];
            $itm->fullName = $row['fullName'];
            $itm->IsComplete = $row['IsComplete'];
            $itm->Imprimatur = $row['Imprimatur'];
            $itm->WebAccess = $row['WebAccess'];

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }


 






}