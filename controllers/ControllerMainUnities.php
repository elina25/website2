<?php

class ControllerMainUnities     
{

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        
    }


    public function getParentWithID($regionID) 
    {
        $stmt = $this->pdo->prepare('SELECT * FROM `archivedobjects` WHERE `ArchivedObjectID`=:reg_id');

        $result = $stmt->execute(array('reg_id' => $regionID));

        //$array = array();
        //$ind = 0;
        foreach ($stmt as $row) {
            // do something with $row
            $itm = new Person();
            $itm->region_id = $row['ArchivedObjectID'];
            $itm->unique_name = $row['UniqueName'];
//            print_r($itm);
            return $itm;
            //$array[$ind] = $itm;
            //$ind++;
        }
        //return $array;
    }





    public function getchristianorthodoxMonumentsWithID($ChristianorthodoxMonumentId)   //Display the ChristianMonuments
    {

        $stmt = $this->pdo->prepare('SELECT christianorthodoxMonumentsDetails.* , archivedobjects.UniqueName, archivedobjects.IsRegion, 
            archivedobjects.PrivateData, archivedobjects.ArchiveCode, archivedobjects.WebAccess, 
            archivedobjects.Imprimatur, christianorthodoxMonuments.UniqueName, christianorthodoxMonuments.parentID,
            christianorthodoxMonuments.religiousStructureID, christianorthodoxMonumentsDetails.usefulInfo
            

            FROM christianorthodoxMonuments
            INNER JOIN christianorthodoxMonumentsDetails
            ON `christianorthodoxMonumentsDetails`.`ChristianorthodoxMonumentId` = `christianorthodoxMonuments`.`ChristianorthodoxMonumentId`
            INNER JOIN archivedobjects
            ON `archivedobjects`.`ArchivedObjectID` = `christianorthodoxMonuments`.`ChristianorthodoxMonumentId`
            
            WHERE `archivedobjects`.`ArchivedObjectID` = :ChristianorthodoxMonumentId;
');

        $stmt->execute( array('ChristianorthodoxMonumentId' => $ChristianorthodoxMonumentId ));

        $array = array();
        $ind = 0;
       foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new ChristianorthodoxMonument();
            $itm->ChristianorthodoxMonumentId = $row['ChristianorthodoxMonumentId'];
            $itm->parentID = $row['parentID'];
            $itm->religiousStructureID = $row['religiousStructureID'];
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->IsRegion = $row['IsRegion'];
            $itm->PrivateData = $row['PrivateData'];
            $itm->ArchiveCode = $row['ArchiveCode'];
            $itm->WebAccess = $row['WebAccess'];
            $itm->Imprimatur = $row['Imprimatur'];
            $itm->usefulInfo = $row['usefulInfo'];
            $itm->contact = $row['contact'];
            $itm->historicalElements = $row['historicalElements'];
            $itm->descriptionForm = $row['descriptionForm'];
            $itm->areIncluded = $row['areIncluded'];
            $itm->embeddedArtwork = $row['embeddedArtwork'];
            $itm->artists = $row['artists'];
            $itm->founder = $row['founder'];
            $itm->Comments = $row['Comments'];
            $itm->renovations = $row['renovations'];
            $itm->officialName = $row['officialName'];
            $itm->friendlyName = $row['friendlyName'];
            $itm->localName = $row['localName'];
          
           

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }  

       public function getAllMainUnitiesItemTypes() //GET ALL MAIN UNITIES or themes
    {

        $stmt = $this->pdo->prepare('SELECT * FROM `itemtypes` 
            WHERE itemTypeID NOT IN (8,9,10,11,12);');

        $result = $stmt->execute();

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new ItemType();
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->StandardName = $row['StandardName'];
            $itm->SingularDesc = $row['SingularDesc'];
            $itm->PluralDesc = $row['PluralDesc'];

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }



        public function getAllItemTypes() //GET ALL 
    {

        $stmt = $this->pdo->prepare('SELECT * FROM `itemtypes` ;');

        $result = $stmt->execute();

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new ItemType();
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->StandardName = $row['StandardName'];
            $itm->SingularDesc = $row['SingularDesc'];
            $itm->PluralDesc = $row['PluralDesc'];

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }

      public function getAllGeoUnities() //GET ALL GEOPHYSICAL UNITIES
    {

        $stmt = $this->pdo->prepare('SELECT * FROM `itemtypes` WHERE `itemTypeID` IN (8,9,10,11,12); ');

        $result = $stmt->execute();

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new ItemType();
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->StandardName = $row['StandardName'];
            $itm->SingularDesc = $row['SingularDesc'];
            $itm->PluralDesc = $row['PluralDesc'];

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }



    public function getAllItemsWithItemType($itemTypeID) //Get all items with TypeID
    {

        $stmt = $this->pdo->prepare('SELECT * FROM `itemtypes` WHERE `itemTypeID` IN (8,9,10,11,12) 
            AND `itemTypeID` = :itemTypeID; 
            ');

        $stmt->execute( array('itemTypeID' => $itemTypeID ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new ItemType();
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->StandardName = $row['StandardName'];
            $itm->SingularDesc = $row['SingularDesc'];
            $itm->PluralDesc = $row['PluralDesc'];
           

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }


    


        public function getAllWithItemTypeID($itemTypeID) //Get all items with ID
    {

        $stmt = $this->pdo->prepare('SELECT * FROM `items` 
            WHERE itemTypeID = :itemTypeID;
            ');

        $stmt->execute( array('itemTypeID' => $itemTypeID ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new ItemType();
            $itm->itemTypeID = $row['itemTypeID '];
            $itm->UniqueName = $row['UniqueName'];
            $itm->parentID = $row['parentID'];
            $itm->conditionID = $row['conditionID'];
            $itm->lastVisitInfo = $row['lastVisitInfo'];
            $itm->lastVisitDate = $row['lastVisitDate'];
            $itm->isCurrent = $row['isCurrent'];
           

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }



        public function getAllKindsForGeoUnitiesWithTypeID($itemTypeID,$CultureID) //Get all Kinds for Geophysical Unities
    {

        $stmt = $this->pdo->prepare('SELECT `item_kinds`.`ItemTypeID`, `item_kinds`.`ItemKindID`,  `item_kinds_detail`.`ItemKindID`, `item_kinds_detail`.`LookupValue`, `item_kinds_detail`.`CultureID`  FROM `item_kinds`
            INNER JOIN `item_kinds_detail` 
            ON `item_kinds`.`ItemKindID` = `item_kinds_detail`.`ItemKindID`
            WHERE itemTypeID = :itemTypeID
            AND CultureID = :CultureID;;
            ');

        $stmt->execute( array('itemTypeID' => $itemTypeID, 'CultureID' => $CultureID ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new ItemType();
            $itm->itemTypeID = $row['itemTypeID '];
            $itm->ItemKindID = $row['ItemKindID'];
            $itm->CultureID = $row['CultureID'];
            $itm->LookupValue = $row['LookupValue'];
        
            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }




       public function getAllSourcesForPhotos() 
    {

        $stmt = $this->pdo->prepare('SELECT * FROM `photoSources` ');

        $result = $stmt->execute();

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new ItemType();
            $itm->photoSourceID = $row['photoSourceID'];
            $itm->standardValue = $row['standardValue'];
             $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }
 


}






