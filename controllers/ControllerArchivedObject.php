<?php

class ControllerArchivedObject{

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        
    }




        public function getAllRegionsWithNoParent($CultureID)  //Dipslays all the countries in the dropdownmenu in header
    {

        $stmt = $this->pdo->prepare('SELECT regions.* ,regionsdetails.CultureID, regionsdetails.FriendlyName
            FROM `regions` 
            INNER JOIN regionsdetails
            ON regions.RegionID = regionsdetails.RegionID
            WHERE regions.`ParentID` IS NULL  AND CultureID = :CultureID');

       $stmt->execute( array('CultureID' => $CultureID));


        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new ArchivedObject();
            $itm->ParentID = $row['ParentID'];
            $itm->UniqueName = $row['UniqueName'];
            $itm->CultureID = $row['CultureID'];  
            $itm->FriendlyName = $row['FriendlyName']; 
            $itm->RegionID = $row['RegionID'];          
         
        
       
           

            $array[$ind] = $itm;
            $ind++;

          }

          
        return $array;



    }



    public function getAllFamilyOfARegion($ArchivedObjectID)
    {

        $stmt = $this->pdo->prepare('SELECT * FROM archivedobjects pa WHERE pa.ArchivedObjectID =:ArchivedObjectID
            OR pa.ArchivedObjectID = (SELECT pb.ParentID FROM archivedobjects pb
            WHERE pb.ArchivedObjectID =:ArchivedObjectIDpa)
            OR pa.ParentID = (SELECT pg.ParentID FROM archivedobjects pg
            WHERE pg.ArchivedObjectID =:ArchivedObjectIDpb)');

       $stmt->execute( array('ArchivedObjectID' => $ArchivedObjectID ,'ArchivedObjectIDpa' => $ArchivedObjectID ,'ArchivedObjectIDpb' => $ArchivedObjectID ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
        {
            //do something with $row
            $itm = new ArchivedObject();
            $itm->ArchivedObjectID = $row['ArchivedObjectID'];
            $itm->ParentID = $row['ParentID'];
            $itm->UniqueName = $row['UniqueName'];
                
            

            $array[$ind] = $itm;
            $ind++;
        }

        return $array;

    }




    public function getAllBrothersOfARegion($RegionID,$CultureID)
    {

        $stmt = $this->pdo->prepare('SELECT re.* , regionsdetails.FriendlyName, regionsdetails.CultureID
            FROM regions re 
            INNER JOIN regionsdetails
            ON re.RegionID = regionsdetails.RegionID
            WHERE re.RegionID =:RegionID AND regionsdetails.CultureID = :CultureSecID
            OR re.ParentID = (SELECT pg.ParentID FROM regions pg
            WHERE pg.RegionID =:RegionIDpb  AND CultureID = :CultureID) 
            ORDER BY regionsdetails.FriendlyName');

       $stmt->execute( array('RegionID' => $RegionID ,'RegionIDpb' => $RegionID,'CultureID' => $CultureID, 'CultureSecID' => $CultureID ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
        {
            //do something with $row
            $itm = new ArchivedObject();
            $itm->RegionID = $row['RegionID'];
            $itm->ParentID = $row['ParentID'];
            $itm->UniqueName = $row['UniqueName'];
            $itm->FriendlyName = $row['FriendlyName'];
            $itm->CultureID = $row['CultureID'];
                
            

            $array[$ind] = $itm;
            $ind++;
        }

        return $array;

    }




      public function getTheFatherOfAOfARegion($RegionID,$CultureID)
    {

        $stmt = $this->pdo->prepare('SELECT re.* , regionsdetails.FriendlyName ,regionsdetails.CultureID
            FROM regions re 
            INNER JOIN regionsdetails
            ON re.RegionID = regionsdetails.RegionID
            WHERE re.RegionID =:RegionID
            OR re.RegionID = (SELECT pb.ParentID FROM regions pb
            WHERE pb.RegionID =:RegionIDpa AND CultureID = :CultureID)');

       $stmt->execute( array('RegionID' => $RegionID ,'RegionIDpa' => $RegionID,'CultureID' => $CultureID ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
        {
            //do something with $row
            $itm = new ArchivedObject();
            $itm->RegionID = $row['RegionID'];
            $itm->ParentID = $row['ParentID'];
            $itm->UniqueName = $row['UniqueName'];
            $itm->FriendlyName = $row['FriendlyName'];
            $itm->CultureID = $row['CultureID'];

            $array[$ind] = $itm;
            $ind++;
        }

        return $array;

    }


    public function getAllRegionsWithParentID($ParentID,$CultureID)  
    {

        $stmt = $this->pdo->prepare('SELECT archivedobjects.*, regionsdetails.FriendlyName,regionsdetails.CultureID

            FROM archivedobjects  
           
            INNER JOIN regionsdetails
            ON archivedobjects.ArchivedObjectID = regionsdetails.RegionID
            WHERE `ParentID` = :ParentID AND `IsRegion` = 1 AND CultureID =:CultureID
            ORDER BY regionsdetails.FriendlyName ');

        $stmt->execute( array('ParentID' => $ParentID ,'CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
        {
            //do something with $row
            $itm = new ArchivedObject();
            $itm->ArchivedObjectID = $row['ArchivedObjectID'];
            $itm->ParentID = $row['ParentID'];
            $itm->UniqueName = $row['UniqueName'];
            $itm->FriendlyName = $row['FriendlyName'];
                
            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }


//getting archivedobject and ImprimaturInfo data together

    public function getArchivedObjectWithImprimaturInfo($archivedID) {

        $stmt = $this->pdo->prepare('SELECT arch.*, i.Imprimatur Imprimatur_GR,i2.Imprimatur Imprimatur_EN

                                        FROM `archivedobjects` arch 

                                        left join imprimaturinfo i on (i.DatabaseID=arch.ArchivedObjectID) and i.CultureID = 1

                                        left join imprimaturinfo i2 on (i2.DatabaseID=arch.ArchivedObjectID) and i2.CultureID = 2

                                        WHERE `ArchivedObjectID`=:arch_id

                                        ');



        $result = $stmt->execute(array('arch_id' => $archivedID));



        //$array = array();

        //$ind = 0;

        foreach ($stmt as $row) {

            // do something with $row

            $itm = new ArchivedObject();

            $itm->archivedObjectID = $row['ArchivedObjectID'];

            $itm->parentID = $row['ParentID'];

            $itm->uniqueName = $row['UniqueName'];

            $itm->digitizationSponsor = $row['DigitizationSponsor'];

            $itm->createdOn = $row['CreatedOn'];

            $itm->isRegion = $row['IsRegion'];

            $itm->privateData = $row['PrivateData'];

            $itm->isComplete = $row['IsComplete'];

            $itm->isCompleteEN = $row['IsCompleteEN'];

            $itm->isCompleteGR = $row['IsCompleteGR'];

            $itm->archiveCode = $row['ArchiveCode'];

            $itm->webAccess = $row['WebAccess'];

            $itm->imprimatur = $row['Imprimatur'];

            $itm->zoom = $row['Zoom'];

            $itm->Imprimatur_GR = $row['Imprimatur_GR'];

            $itm->Imprimatur_EN = $row['Imprimatur_EN'];



            return $itm;

            //$array[$ind] = $itm;

            //$ind++;

        }

        //return $array;

    }





    public function getArchivedObjectWithID($archivedID) {

        $stmt = $this->pdo->prepare('SELECT * 

                                        FROM `archivedobjects` 

                                        WHERE `ArchivedObjectID`=:arch_id

                                        ');



        $result = $stmt->execute(array('arch_id' => $archivedID));



        //$array = array();

        //$ind = 0;

        foreach ($stmt as $row) {

            // do something with $row

            $itm = new ArchivedObject();

            $itm->ArchivedObjectID = $row['ArchivedObjectID'];

            $itm->ParentID = $row['ParentID'];

            $itm->UniqueName = $row['UniqueName'];

            $itm->DigitizationSponsor = $row['DigitizationSponsor'];

            $itm->CreatedOn = $row['CreatedOn'];

            $itm->IsRegion = $row['IsRegion'];

            $itm->PrivateData = $row['PrivateData'];

            $itm->IsComplete = $row['IsComplete'];

            $itm->IsCompleteEN = $row['IsCompleteEN'];

            $itm->IsCompleteGR = $row['IsCompleteGR'];

            $itm->ArchiveCode = $row['ArchiveCode'];

            $itm->WebAccess = $row['WebAccess'];

            $itm->Imprimatur = $row['Imprimatur'];

            $itm->Zoom = $row['Zoom'];



            return $itm;

            //$array[$ind] = $itm;

            //$ind++;

        }

}

   public function getRelationEntitiesOfArchivedObjectID($archivedObjectID) {

        $stmt = $this->pdo->prepare('SELECT r.*,ao.* ,it.SingularDesc

                                        FROM `references` as r 

                                        INNER JOIN `archivedobjects` as ao ON `r`.`ArchivedObjectID` = `ao`.`ArchivedObjectID`

                                        LEFT JOIN `items` ON `r`.`ArchivedObjectID` = `items`.`itemID`

                                        LEFT JOIN `itemtypes` as it ON `items`.`itemTypeID` = `it`.`itemTypeID`

                                        WHERE `r`.`PointsTo`=:arch_id

                                        ');



        $result = $stmt->execute(array('arch_id' => $archivedObjectID));



        $array = array();

        $ind = 0;

        foreach ($stmt as $row) {

            // do something with $row

            $itm = new ArchivedObject();

            $itm->archivedObjectID = $row['ArchivedObjectID'];

            $itm->uniqueName = $row['UniqueName'];

            $itm->archiveCode = $row['ArchiveCode'];

            $itm->itemType = $row['SingularDesc'];

            $itm->ReferenceID = $row['ReferenceID'];




            //return $itm;

            $array[$ind] = $itm;

            $ind++;

        }

        return $array;

    }

}