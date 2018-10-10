<?php

class ControllerAccompanyingObject {

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        
    }



    public function getAllAccompanyingItemTypes() 
    {

        $stmt = $this->pdo->prepare('SELECT * FROM `accompanyingItemTypes` ORDER BY SingularDesc');

        $result = $stmt->execute();

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new AccompanyingItemType();
            $itm->accompanyingItemTypeID = $row['accompanyingItemTypeID'];
            $itm->StandardName = $row['StandardName'];
            $itm->SingularDesc = $row['SingularDesc'];
            $itm->PluralDesc = $row['PluralDesc'];


            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }



   public function getAllItemTypes() //GET ALL ITEM TYPES FOR FILTER 
    {

        $stmt = $this->pdo->prepare('SELECT * FROM `itemtypes` 
            ');

        $result = $stmt->execute();

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new AccompanyingItemType ();
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->StandardName = $row['StandardName'];
            $itm->SingularDesc = $row['SingularDesc'];
            $itm->PluralDesc = $row['PluralDesc'];

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }




    public function CountItemsWithID($accompanyingItemTypeID) //Count how many records are in Dtabase 
    {

        $stmt = $this->pdo->prepare('SELECT  COUNT(*) FROM `accompanyingObjects` 
            WHERE accompanyingItemTypeID =: $accompanyingItemTypeID');

        $stmt->execute( array('accompanyingItemTypeID' => $accompanyingItemTypeID ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new AccompanyingObject();
            $itm->accompanyingItemTypeID = $row['accompanyingItemTypeID'];
            $itm->accompanyingObjectID = $row['accompanyingObjectID'];
            $itm->uniqueName = $row['uniqueName'];
            $itm->isComplete = $row['isComplete'];
           

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }

    public function getAllAccompanyingItemsWithItemType($accompanyingItemTypeID) //Get all items with ID
    {

        $stmt = $this->pdo->prepare('SELECT * FROM `accompanyingObjects` 
            WHERE accompanyingItemTypeID = :accompanyingItemTypeID;
            ');

        $stmt->execute( array('accompanyingItemTypeID' => $accompanyingItemTypeID ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new AccompanyingObject();
            $itm->accompanyingItemTypeID = $row['accompanyingItemTypeID'];
            $itm->accompanyingObjectID = $row['accompanyingObjectID'];
            $itm->uniqueName = $row['uniqueName'];
            $itm->isComplete = $row['isComplete'];
           

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }



    public function getAllAccompanyingItemsWithItemTypeIdAndType($accompanyingItemTypeID,$accompanyingObjectID) //Get all items with ID and with TypeID
    {

        $stmt = $this->pdo->prepare('SELECT * FROM `accompanyingObjects` 
            WHERE accompanyingItemTypeID = :accompanyingItemTypeID
            AND accompanyingObjectID = :accompanyingObjectID;
            ');

        $stmt->execute( array('accompanyingItemTypeID' => $accompanyingItemTypeID, 'accompanyingObjectID' => $accompanyingObjectID ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new AccompanyingObject();
            $itm->accompanyingItemTypeID = $row['accompanyingItemTypeID'];
            $itm->accompanyingObjectID = $row['accompanyingObjectID'];
            $itm->uniqueName = $row['uniqueName'];
            $itm->isComplete = $row['isComplete'];
            $itm->digitizationSponsor = $row['digitizationSponsor'];
            $itm->isCompleteGR = $row['isCompleteGR'];
            $itm->isCompleteEN = $row['isCompleteEN'];
            $itm->accompanyingItemTypeID = $row['accompanyingItemTypeID'];
            $itm->privateData = $row['privateData'];
            $itm->documentPath = $row['documentPath'];
            $itm->archiveCode = $row['archiveCode'];
            $itm->webAccess = $row['webAccess'];
            $itm->imprimatur = $row['imprimatur']; 

           

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }




    public function getItemTypeFromItemID($itemID) //display the type of an archived object
    {

        $stmt = $this->pdo->prepare('SELECT items.itemID, items.itemTypeID, itemtypes.itemTypeID,
            itemtypes.StandardName , itemtypes.SingularDesc, itemtypes.PluralDesc

         FROM `items` 
         INNER JOIN itemtypes
         ON items.itemTypeID = itemtypes.itemTypeID
         WHERE `items`.`itemID` = :itemID;




         ');

        $stmt->execute( array('itemID' => $itemID ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new AccompanyingItemType();
            $itm->itemID = $row['itemID'];
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->StandardName = $row['StandardName'];
            $itm->SingularDesc = $row['SingularDesc'];
            $itm->PluralDesc = $row['PluralDesc'];

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }



    public function getItemTypes() {  // GET ALL MAIN ENTITIES

        $stmt = $this->pdo->prepare('SELECT * FROM `itemtypes` WHERE itemTypeID NOT IN (8,9,10,11,12) ORDER BY PluralDesc');

        $result = $stmt->execute();
        $array = array();

        //$ind = 0;

        foreach ($stmt as $row) {

            // do something with $row



            $array[] = array(

                'itemTypeID' => $row['itemTypeID'],

                'StandardName' => $row['StandardName'],

                'PluralDesc' => $row['PluralDesc'],

                'SingularDesc' => $row['SingularDesc']

            );

//            $ind++;

        }

        return $array;
    }





    public function getAllMainTypes() 
    {

        $stmt = $this->pdo->prepare('SELECT * FROM `itemtypes` WHERE itemTypeID NOT IN (8,9,10,11,12) ORDER BY PluralDesc');

        $result = $stmt->execute();
        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new AccompanyingItemType();
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->StandardName = $row['StandardName'];
            $itm->PluralDesc = $row['PluralDesc'];
            $itm->SingularDesc = $row['SingularDesc'];

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }


        public function getAllRelationsWithAccompanyingObjectId($item_id) {
        $stmt = $this->pdo->prepare('SELECT *
                                        FROM `AccompanyingObjectsRelations`
                                        WHERE `firstObjectID`=:arch_id
                                        ');

        $result = $stmt->execute(array('arch_id' => $item_id));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            // do something with $row
            //return $itm;
            $array[$ind] = $row['secondObjectID'];
            $ind++;
        }
        return $array;
    }


        public function GetAllRelationsAccToAccItems($item_id) {   //fortonei tis sisxetizomenes ontotites tou kathe accompanying item

        $stmt = $this->pdo->prepare('SELECT accompanyingObjects.*, AccompanyingObjectsRelations.*,accompanyingItemTypes.*, count(*) as rowsum
                                  FROM AccompanyingObjectsRelations
                                  INNER JOIN accompanyingObjects
                                  ON AccompanyingObjectsRelations.secondObjectID = accompanyingObjects.accompanyingObjectID
                                  INNER JOIN accompanyingItemTypes
                                  ON accompanyingObjects.accompanyingItemTypeID = accompanyingItemTypes.accompanyingItemTypeID
                                  where firstObjectID=:item_id 
                                  GROUP BY accompanyingObjects.accompanyingItemTypeID
                                    ');

        $stmt->execute(array('item_id' => $item_id));
         

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->itemID = $row['itemID'];
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->StandardName = $row['StandardName'];
            $itm->SingularDesc = $row['SingularDesc'];
            $itm->accompanyingItemTypeID = $row['accompanyingItemTypeID'];
            $itm->UniqueName = $row['UniqueName'];   
            $itm->rowsum = $row['rowsum'];       
            
            array_push($items, $itm);

        }

        return $items;

 }



        public function GetAllRelationsAccToAccItemsS($item_id,$itemTypeID,$CultureID) {  //fortonei ti lista ton sisxetizomenenon accompanaying object mesa sti lista 
  try {
 
                if ($itemTypeID == 1) {

                    $select = 'Photos_Details.Title, Photos_Details.PhotoID,Photos_Details.CultureID';
                    $innerjoin ='INNER JOIN Photos_Details
                                ON Photos_Details.PhotoID = AccompanyingObjectsRelations.secondObjectID';


                } else if ($itemTypeID == 2) {

                    $select = 'PrintedOrHandWrittenDocs_Details.Title, PrintedOrHandWrittenDocs_Details.PrintedOrHandwrittenDocID,PrintedOrHandWrittenDocs_Details.CultureID';
                    $innerjoin ='INNER JOIN PrintedOrHandWrittenDocs_Details
                                ON PrintedOrHandWrittenDocs_Details.PrintedOrHandwrittenDocID = AccompanyingObjectsRelations.secondObjectID';

                } else if  ($itemTypeID == 3){

                    $select = 'biographies_details.FullName, biographies_details.biographyID,biographies_details.CultureID';
                    $innerjoin ='INNER JOIN biographies_details
                                ON biographies_details.biographyID = AccompanyingObjectsRelations.secondObjectID';


                } else if ($itemTypeID == 4){

                    $select = 'bibliographies.title, bibliographies.bibliographyID,bibliographies_details.cultureID,bibliographies_details.bibliographyID';
                    $innerjoin ='INNER JOIN bibliographies
                                ON bibliographies.bibliographyID = AccompanyingObjectsRelations.secondObjectID
                                INNER JOIN bibliographies_details ON bibliographies.bibliographyID = bibliographies_details.bibliographyID  ';
                }  else if ($itemTypeID == 5){

                    $select = 'audioVisuals_details.title, audioVisuals_details.audioVisualID,audioVisuals_details.cultureID';
                    $innerjoin ='INNER JOIN audioVisuals_details
                                ON audioVisuals_details.audioVisualID = AccompanyingObjectsRelations.secondObjectID';

                } else if ($itemTypeID == 6){

                    $select = 'Documents_Details.Title, Documents_Details.DocumentID,Documents_Details.CultureID';
                    $innerjoin ='INNER JOIN Documents_Details
                                ON Documents_Details.DocumentID = AccompanyingObjectsRelations.secondObjectID';   
                } else if ($itemTypeID == 7){
                    $select = 'Notes_Details.Title, Notes_Details.NoteID,Notes_Details.CultureID';
                    $innerjoin ='INNER JOIN Notes_Details
                                ON Notes_Details.NoteID = AccompanyingObjectsRelations.secondObjectID'; 

                } else if ($itemTypeID == 8){

                    $select = 'Maps_Details.Title, Maps_Details.MapID,Maps_Details.CultureID';
                    $innerjoin ='INNER JOIN Maps_Details
                                ON Maps_Details.MapID = AccompanyingObjectsRelations.secondObjectID';                    

               } else {

                    $select = 'Sponsors_Details.FriendlyName, Sponsors_Details.SponsorID,Sponsors_Details.CultureID';
                    $innerjoin = 'INNER JOIN Sponsors_Details
                                  ON Sponsors_Details.SponsorID = AccompanyingObjectsRelations.secondObjectID';
                 }



                $query = 'SELECT accompanyingObjects.*, AccompanyingObjectsRelations.*,accompanyingItemTypes.* , ' . $select . '
                                  FROM AccompanyingObjectsRelations
                                  INNER JOIN accompanyingObjects
                                  ON AccompanyingObjectsRelations.secondObjectID = accompanyingObjects.accompanyingObjectID
                                  INNER JOIN accompanyingItemTypes 
                                  ON accompanyingObjects.accompanyingItemTypeID = accompanyingItemTypes.accompanyingItemTypeID
                                  ' . $innerjoin . ' 
                                  where firstObjectID =:item_id AND accompanyingObjects.accompanyingItemTypeID =:itemTypeID AND CultureID =:CultureID';

                 
        //echo $query;
        $stmt = $this->pdo->prepare($query);                     
        $stmt->execute( array('item_id' => $item_id,'itemTypeID' => $itemTypeID, 'CultureID' => $CultureID));
         

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->StandardName = $row['StandardName'];
            $itm->SingularDesc = $row['SingularDesc'];
            $itm->accompanyingItemTypeID = $row['accompanyingItemTypeID'];  
            $itm->uniqueName = $row['uniqueName'];   
            $itm->secondObjectID = $row['secondObjectID'];
            $itm->Title = $row['Title'];
            $itm->title = $row['title'];
            $itm->FullName = $row['FullName'];
            $itm->FriendlyName = $row['FriendlyName'];
            $itm->CultureID = $row['CultureID'];

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;


         } 

                    catch (Exception $e) {
                         echo $e->getMessage();
                    }

    }


       public function GetPhotoNames($item_id) { //fortonei ti lista ton sisxetizomenon ontotiton mesa sto ajax
 
        $stmt = $this->pdo->prepare('SELECT AccompanyingObjectsRelations.*, Photos_Details.Title
                                  FROM AccompanyingObjectsRelations
                                  INNER JOIN Photos_Details
                                  ON Photos_Details.PhotoID = AccompanyingObjectsRelations.secondObjectID
                                  where firstObjectID=:item_id');

        $stmt->execute(array('item_id' => $item_id));
         

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->Title = $row['Title'];
            $itm->uniqueName = $row['uniqueName'];   
            $itm->secondObjectID = $row['secondObjectID'];
 
            
            array_push($items, $itm);

        }

        return $items;

 }





    public function GetAllRelationsAccToGeo($item_id) {   //fortonei tis sisxetizomenes ontotites tou kathe accompanying item

        $stmt = $this->pdo->prepare('SELECT items.*, accompanyingObjectsPerArchivedObjects.*,itemtypes.*, count(*) as rowsum
                                  FROM accompanyingObjectsPerArchivedObjects
                                  INNER JOIN items
                                  ON accompanyingObjectsPerArchivedObjects.archivedObjectID = items.itemID
                                  INNER JOIN itemtypes
                                  ON items.itemTypeID = itemtypes.itemTypeID
                                  where `accompanyingObjectsPerArchivedObjects`.`accompanyingObjectID` =:item_id AND itemtypes.itemTypeID IN (8,9,10,11,12)
                                  GROUP BY itemtypes.itemTypeID');

        $stmt->execute(array('item_id' => $item_id));
         

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->itemID = $row['itemID'];
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->StandardName = $row['StandardName'];
            $itm->SingularDesc = $row['SingularDesc'];
            $itm->UniqueName = $row['UniqueName'];   
            $itm->rowsum = $row['rowsum'];       
            array_push($items, $itm);

        }

          

        return $items;

 }


     public function GetAllRelationsAccToGeoList($item_id,$itemTypeID) {  //fortonei tin lista ton sisxetizomenon geografikon ontotiton me kapoio accompanaying item
        $stmt = $this->pdo->prepare('SELECT items.*, accompanyingObjectsPerArchivedObjects.*,itemtypes.*
                                  FROM accompanyingObjectsPerArchivedObjects
                                  INNER JOIN items
                                  ON accompanyingObjectsPerArchivedObjects.archivedObjectID = items.itemID
                                  INNER JOIN itemtypes
                                  ON items.itemTypeID = itemtypes.itemTypeID
                                  where `accompanyingObjectsPerArchivedObjects`.`accompanyingObjectID` =:item_id AND itemtypes.itemTypeID=:itemTypeID AND itemtypes.itemTypeID IN (8,9,10,11,12)');

        $stmt->execute(array('item_id' => $item_id,'itemTypeID' => $itemTypeID));
         

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->itemID = $row['itemID'];
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->StandardName = $row['StandardName'];
            $itm->SingularDesc = $row['SingularDesc'];
            $itm->UniqueName = $row['UniqueName'];   
            $itm->rowsum = $row['rowsum'];       
            array_push($items, $itm);

        }

          

        return $items;

 }




    public function GetAllRelationsAccToMainEntities($item_id) {   //fortonei tis sisxetizomenes ontotites tou kathe accompanying item

        $stmt = $this->pdo->prepare('SELECT items.*, accompanyingObjectsPerArchivedObjects.*,itemtypes.*, count(*) as rowsum
                                  FROM accompanyingObjectsPerArchivedObjects
                                  INNER JOIN items
                                  ON accompanyingObjectsPerArchivedObjects.archivedObjectID = items.itemID
                                  INNER JOIN itemtypes
                                  ON items.itemTypeID = itemtypes.itemTypeID
                                  where `accompanyingObjectsPerArchivedObjects`.`accompanyingObjectID` =:item_id AND itemtypes.itemTypeID NOT IN (8,9,10,11,12)
                                  GROUP BY itemtypes.itemTypeID');

        $stmt->execute(array('item_id' => $item_id));
         

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->accompanyingObjectID = $row['accompanyingObjectID'];
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->StandardName = $row['StandardName'];
            $itm->SingularDesc = $row['SingularDesc'];
            $itm->UniqueName = $row['UniqueName'];   
            $itm->rowsum = $row['rowsum'];       
            array_push($items, $itm);

        }

          

        return $items;

 }




    public function GetAllRelationsFromPhotosToOthers($item_id) { //fortonei tis sisxetizomenes ontotites tou kathe accompanying item


        $stmt = $this->pdo->prepare('SELECT items.*, accompanyingObjectsPerArchivedObjects.*,itemtypes.*,archivedobjects.*
                                  FROM accompanyingObjectsPerArchivedObjects
                                  INNER JOIN items
                                  ON accompanyingObjectsPerArchivedObjects.archivedObjectID = items.itemID
                                  INNER JOIN itemtypes
                                  ON items.itemTypeID = itemtypes.itemTypeID
                                  INNER JOIN archivedobjects
                                  ON archivedobjects.ArchivedObjectID = accompanyingObjectsPerArchivedObjects.ArchivedObjectID
                                  where `accompanyingObjectsPerArchivedObjects`.`accompanyingObjectID` =:item_id AND itemtypes.itemTypeID NOT IN (8,9,10,11,12)
                                  GROUP BY itemtypes.itemTypeID');

        $stmt->execute(array('item_id' => $item_id));
         

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
//            $itm->PhotoID = $row['PhotoID'];
            $itm->accompanyingObjectID = $row['accompanyingObjectID'];
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->itemID = $row['itemID'];
            $itm->StandardName = $row['StandardName'];
            $itm->SingularDesc = $row['SingularDesc'];
            $itm->UniqueName = $row['UniqueName'];   
//            $itm->rowsum = $row['Title'];        
            array_push($items, $itm);

        }

          

        return $items;

 }


   public function GetAllRelationsFromPhotosToRegions($photo_id,$CultureID) { //fortonei tous topous pou sindeontai me tis fotografies


        $stmt = $this->pdo->prepare('SELECT  accompanyingObjectsPerArchivedObjects.*,archivedobjects.*,regionsdetails.*
                                   FROM accompanyingObjectsPerArchivedObjects
                                   
                                   INNER JOIN archivedobjects
                                   ON accompanyingObjectsPerArchivedObjects.archivedObjectID = archivedobjects.ArchivedObjectID
                                   LEFT JOIN regionsdetails
                                   ON archivedobjects.ArchivedObjectID = `regionsdetails`.`RegionID`
                                   where `accompanyingObjectsPerArchivedObjects`.`accompanyingObjectID` =: photo_id AND `regionsdetails`.`RegionID` = 1 AND CultureID =:CultureID');

        $stmt->execute(array('photo_id' => $photo_id,'CultureID' => $CultureID));
         

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->CultureID = $row['CultureID'];
            $itm->OfficialName = $row['OfficialName'];
            $itm->ArchivedObjectID = $row['ArchivedObjectID'];
            $itm->accompanyingObjectID = $row['accompanyingObjectID'];
            array_push($items, $itm);

        }
      return $items;

 }


 // SELECT items.*, accompanyingObjectsPerArchivedObjects.*,itemtypes.*,Photos_Details.Title
 //                                  FROM accompanyingObjectsPerArchivedObjects
 //                                  INNER JOIN items
 //                                  ON accompanyingObjectsPerArchivedObjects.archivedObjectID = items.itemID
 //                                  INNER JOIN archivedobjects
 //                                  ON accompanyingObjectsPerArchivedObjects.archivedObjectID = archivedobjects.ArchivedObjectID
 //                                  INNER JOIN itemtypes
 //                                  ON items.itemTypeID = itemtypes.itemTypeID
 //                                  INNER JOIN accompanyingObjectsPerArchivedObjects
 //                                  -- INNER JOIN Photos_Details
 //                                  -- ON Photos_Details.PhotoID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID
 //                                  where `accompanyingObjectsPerArchivedObjects`.`accompanyingObjectID` =:photo_id AND itemtypes.itemTypeID NOT IN (8,9,10,11,12)
 //                                  GROUP BY itemtypes.itemTypeID


    public function GetAllRelationsAccToMainEntitiesList($item_id,$itemTypeID,$CultureID) {   //fortonei tin lista ton sisxetizomenon kirion ontotiton me kapoio accompanaying item

  try {
                     if ($itemTypeID == 1) {

                    $select = 'religiousMonumentsDetails.friendlyName, religiousMonumentsDetails.ReligiousMonumentId,religiousMonumentsDetails.cultureID';
                    $innerjoin ='INNER JOIN religiousMonumentsDetails
                                ON religiousMonumentsDetails.ReligiousMonumentId = accompanyingObjectsPerArchivedObjects.archivedObjectID';

                } else if ($itemTypeID == 2) {

                    $select = 'christianorthodoxMonumentsDetails.friendlyName, christianorthodoxMonumentsDetails.ChristianorthodoxMonumentId,christianorthodoxMonumentsDetails.cultureID';
                    $innerjoin ='INNER JOIN christianorthodoxMonumentsDetails
                                ON christianorthodoxMonumentsDetails.ChristianorthodoxMonumentId = accompanyingObjectsPerArchivedObjects.archivedObjectID';

                } else if  ($itemTypeID == 3){

                    $select = 'artworks_details.FriendlyName, artworks_details.ArtworkID,artworks_details.CultureID';
                    $innerjoin ='INNER JOIN artworks_details
                                ON artworks_details.ArtworkID = accompanyingObjectsPerArchivedObjects.archivedObjectID';

                } else if ($itemTypeID == 4){

                   $select = 'educationalFoundationDetails.friendlyName, educationalFoundationDetails.EducationFoundationId,educationalFoundationDetails.cultureID';
                    $innerjoin ='INNER JOIN educationalFoundationDetails
                                ON educationalFoundationDetails.EducationFoundationId = accompanyingObjectsPerArchivedObjects.archivedObjectID';

                } else if ($itemTypeID == 5){

                    $select = 'epigraphsDetails.friendlyName, epigraphsDetails.EpigraphId,epigraphsDetails.cultureID';
                    $innerjoin ='INNER JOIN epigraphsDetails
                                ON epigraphsDetails.EpigraphId = accompanyingObjectsPerArchivedObjects.archivedObjectID';

                } else if ($itemTypeID == 6){

                 $select = 'communityDetails.friendlyName, communityDetails.CommunityId,communityDetails.cultureID';
                    $innerjoin ='INNER JOIN communityDetails
                                ON communityDetails.CommunityId = accompanyingObjectsPerArchivedObjects.archivedObjectID';

                } else if ($itemTypeID == 7){

                 $select = 'cemeteryDetails.friendlyName, cemeteryDetails.CemeteryId,cemeteryDetails.cultureID';
                    $innerjoin ='INNER JOIN cemeteryDetails
                                ON cemeteryDetails.CemeteryId = accompanyingObjectsPerArchivedObjects.archivedObjectID';

                } else if ($itemTypeID == 13){

                   $select = 'archeologicalReligiousMonumentsDetails.friendlyName, archeologicalReligiousMonumentsDetails.ArchReligiousId,archeologicalReligiousMonumentsDetails.cultureID';
                    $innerjoin ='INNER JOIN archeologicalReligiousMonumentsDetails
                                ON archeologicalReligiousMonumentsDetails.ArchReligiousId = accompanyingObjectsPerArchivedObjects.archivedObjectID';

                } else if ($itemTypeID == 14){

                   $select = 'archeologicalSiteDetails.friendlyName, archeologicalSiteDetails.ArchSiteID,archeologicalSiteDetails.cultureID';
                    $innerjoin ='INNER JOIN archeologicalSiteDetails
                                ON archeologicalSiteDetails.ArchSiteID = accompanyingObjectsPerArchivedObjects.archivedObjectID';

                 } else if ($itemTypeID == 15){

                   $select = 'fortressesDetails.friendlyName, fortressesDetails.FortressId,fortressesDetails.cultureID';
                    $innerjoin ='INNER JOIN fortressesDetails
                                ON fortressesDetails.FortressId = accompanyingObjectsPerArchivedObjects.archivedObjectID';

                 } else if ($itemTypeID == 16){

                   $select = 'tombsDetails.name, tombsDetails.TombId,tombsDetails.cultureID';
                    $innerjoin ='INNER JOIN tombsDetails
                                ON tombsDetails.TombId = accompanyingObjectsPerArchivedObjects.archivedObjectID';

                 } else if ($itemTypeID == 17){

                   $select = 'museumsDetails.friendlyName, museumsDetails.MuseumId,museumsDetails.cultureID';
                    $innerjoin ='INNER JOIN museumsDetails
                                ON museumsDetails.MuseumId = accompanyingObjectsPerArchivedObjects.archivedObjectID';

                 } else if ($itemTypeID == 18){

                   $select = 'exhibitionDetails.friendlyName, exhibitionDetails.ExhibitionId,exhibitionDetails.cultureID';
                    $innerjoin ='INNER JOIN exhibitionDetails
                                ON exhibitionDetails.ExhibitionId = accompanyingObjectsPerArchivedObjects.archivedObjectID';

                 } else if ($itemTypeID == 19){

                   $select = 'administrationBuildingsDetails.friendlyName, administrationBuildingsDetails.AdminBuildingId,administrationBuildingsDetails.cultureID';
                    $innerjoin ='INNER JOIN administrationBuildingsDetails
                                ON administrationBuildingsDetails.AdminBuildingId = accompanyingObjectsPerArchivedObjects.archivedObjectID';

                 } else if($itemTypeID == 20){

                    $select = 'welfareBuildingsDetails.friendlyName, welfareBuildingsDetails.WelfareBuildingId,welfareBuildingsDetails.cultureID';
                    $innerjoin ='INNER JOIN welfareBuildingsDetails
                                ON welfareBuildingsDetails.WelfareBuildingId = accompanyingObjectsPerArchivedObjects.archivedObjectID';

                 } else if($itemTypeID == 21){

                    $select = 'infrastructureBuildingsDetails.friendlyName, infrastructureBuildingsDetails.InfrastructureBuildingId,infrastructureBuildingsDetails.cultureID';
                    $innerjoin ='INNER JOIN infrastructureBuildingsDetails
                                ON infrastructureBuildingsDetails.InfrastructureBuildingId = accompanyingObjectsPerArchivedObjects.archivedObjectID';

                } else if($itemTypeID == 22){

                    $select = 'socialResidentialBuildingDetails.friendlyName, socialResidentialBuildingDetails.ResidentialBuildingId,socialResidentialBuildingDetails.cultureID';
                    $innerjoin ='INNER JOIN welfareBuildinsocialResidentialBuildingDetailsgsDetails
                                ON socialResidentialBuildingDetails.ResidentialBuildingId = accompanyingObjectsPerArchivedObjects.archivedObjectID';

                } else if($itemTypeID == 23){

                    $select = 'coins_details.frontView, coins_details.coinID,coins_details.CultureID';
                    $innerjoin ='INNER JOIN coins_details
                                ON coins_details.coinID = accompanyingObjectsPerArchivedObjects.archivedObjectID';

                } else if($itemTypeID == 24){

                    $select = 'persons_details.fullName, persons_details.personID,persons_details.cultureID';
                    $innerjoin ='INNER JOIN persons_details
                                ON persons_details.personID = accompanyingObjectsPerArchivedObjects.archivedObjectID';

                } else {

                    $select = 'religiousEventsDetails.title, religiousEventsDetails.religiousEventID,religiousEventsDetails.cultureID';
                    $innerjoin ='INNER JOIN religiousEventsDetails
                                ON religiousEventsDetails.religiousEventID = accompanyingObjectsPerArchivedObjects.archivedObjectID';

                }






        $query = 'SELECT items.*, accompanyingObjectsPerArchivedObjects.*,itemtypes.* , ' . $select . '
                                  FROM accompanyingObjectsPerArchivedObjects
                                  LEFT JOIN items
                                  ON accompanyingObjectsPerArchivedObjects.archivedObjectID = items.itemID
                                  INNER JOIN itemtypes
                                  ON items.itemTypeID = itemtypes.itemTypeID
                                  ' . $innerjoin . ' 
                                  where `accompanyingObjectsPerArchivedObjects`.`accompanyingObjectID` =:item_id AND itemtypes.itemTypeID=:itemTypeID AND
                                  CultureID =:CultureID AND itemtypes.itemTypeID NOT IN (8,9,10,11,12)';         

        $stmt = $this->pdo->prepare($query);                     
        $stmt->execute( array('item_id' => $item_id,'itemTypeID' => $itemTypeID, 'CultureID' => $CultureID));
         

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->accompanyingObjectID = $row['accompanyingObjectID'];
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->StandardName = $row['StandardName'];
            $itm->SingularDesc = $row['SingularDesc'];
            $itm->title = $row['title'];  
            $itm->Title = $row['Title']; 
            $itm->CultureID = $row['CultureID']; 
            $itm->friendlyName = $row['friendlyName'];

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;


         } 

                    catch (Exception $e) {
                         echo $e->getMessage();
                    }

    }



     public function GetAllRelationsAccToRegionsCount($archivedObjectID) {   //fortonei tin lista twn topwn pou sisxetizonati me kapoio accompaning item

        $stmt = $this->pdo->prepare('SELECT archivedobjects.*, accompanyingObjectsPerArchivedObjects.*, count(*) as rowsum
                                  FROM accompanyingObjectsPerArchivedObjects
                                  LEFT JOIN archivedobjects
                                  ON accompanyingObjectsPerArchivedObjects.archivedObjectID = archivedobjects.ArchivedObjectID
                                  where `accompanyingObjectsPerArchivedObjects`.`accompanyingObjectID` =:archivedObjectID AND IsRegion = 1');

        $stmt->execute(array('archivedObjectID' => $archivedObjectID));
         

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->accompanyingObjectID = $row['accompanyingObjectID'];
            $itm->ArchivedObjectID = $row['ArchivedObjectID'];
            $itm->SingularDesc = $row['SingularDesc'];
            $itm->UniqueName = $row['UniqueName'];
            $itm->archivedObjectID = $row['archivedObjectID'];
            $itm->rowsum = $row['rowsum'];       
            array_push($items, $itm);

        }

          

        return $items;

 }






     public function GetAllRelationsAccToRegions($archivedObjectID ,$CultureID) {   //fortonei tin lista twn topwn pou sisxetizonati me kapoio accompanaying item

        $stmt = $this->pdo->prepare('SELECT archivedobjects.*, accompanyingObjectsPerArchivedObjects.*,regionsdetails.FriendlyName,regionsdetails.RegionID, regionsdetails.CultureID
                                  FROM accompanyingObjectsPerArchivedObjects
                                  LEFT JOIN archivedobjects
                                  ON accompanyingObjectsPerArchivedObjects.archivedObjectID = archivedobjects.ArchivedObjectID
                                  INNER JOIN regionsdetails  
                                  ON regionsdetails.RegionID = accompanyingObjectsPerArchivedObjects.archivedObjectID
                                  where `accompanyingObjectsPerArchivedObjects`.`accompanyingObjectID` =:archivedObjectID AND IsRegion = 1 AND CultureID =:CultureID');

        $stmt->execute(array('archivedObjectID' => $archivedObjectID,'CultureID' => $CultureID));
        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->accompanyingObjectID = $row['accompanyingObjectID'];
            $itm->ArchivedObjectID = $row['ArchivedObjectID'];
            $itm->SingularDesc = $row['SingularDesc'];
            $itm->UniqueName = $row['UniqueName'];
            $itm->archivedObjectID = $row['archivedObjectID'];
            $itm->FriendlyName = $row['FriendlyName'];
            $itm->CultureID = $row['CultureID'];
            array_push($items, $itm);

        }

         
        return $items;

 }





}
