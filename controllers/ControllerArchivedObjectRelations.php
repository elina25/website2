<?php

class ControllerArchivedObjectRelations {

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        
    }



    public function ViewArchivedObjectRelation($archivedObjectID, $accompanyingItemTypeID) {

        $stmt = $this->pdo->prepare('SELECT aoa.ID, accompanyingItemTypes.accompanyingItemTypeID, aco.accompanyingItemTypeID, aoa.accompanyingObjectID, aoa.archivedObjectID, aoa.privateData, aco.uniqueName acc_uniqueName, 
                                            ar.UniqueName arch_uniqueName, aoad1.comments comments_gr, aoad2.comments comments_en, aoad1.smallText1 pages_gr, aoad2.smallText1 pages_en, aoad1.ID detailGR, aoad2.ID detailEN 
                                    FROM accompanyingObjectsPerArchivedObjects aoa
                                    left join accompanyingObjects aco on aco.accompanyingObjectID =aoa.accompanyingObjectID                          
                                    left join archivedobjects ar on ar.ArchivedObjectID =aoa.archivedObjectID                        
                                    left join accompanyingObjectsPerArchivedObjects_details aoad1 on aoad1.relationID =aoa.ID and aoad1.cultureID=1
                                    left join accompanyingObjectsPerArchivedObjects_details aoad2 on aoad2.relationID =aoa.ID and aoad2.cultureID=2
                                    inner join accompanyingItemTypes on aco.accompanyingItemTypeID = accompanyingItemTypes.accompanyingItemTypeID
                                    where ar.archivedObjectID = :archivedObjectID AND aco.accompanyingItemTypeID = :accompanyingItemTypeID');



//        $result = $stmt->execute(array('archivedObjectID' => $ArchivedObjectID, 'accompanyingItemTypeID' => $accompanyingItemTypeID));
        $stmt->execute(array('archivedObjectID' => $archivedObjectID, 'accompanyingItemTypeID' => $accompanyingItemTypeID));

//        $result = $stmt->execute(array('arch_id' => $arch_id, 'acc_id' => $acc_id));

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->ID = $row['ID'];

            $itm->archivedObjectID = $row['archivedObjectID'];
            $itm->arch_uniqueName = $row['arch_uniqueName'];
            $itm->accompanyingObjectID = $row['accompanyingObjectID'];
            $itm->acc_uniqueName = $row['acc_uniqueName'];
            $itm->privateData = $row['privateData'];
            $itm->detailGR = $row['detailGR'];
            $itm->comments_gr = $row['comments_gr'];
            $itm->pages_gr = $row['pages_gr'];
            $itm->detailEN = $row['detailEN'];
            $itm->comments_en = $row['comments_en'];
            $itm->accompanyingItemTypeID = $row['accompanyingItemTypeID'];
            $itm->pages_en = $row['pages_en'];
            
            
            array_push($items, $itm);
        }

        return $items;

    }


    public function ViewRelatedItemsToPhoto($archivedObjectID,$itemTypeID,$CultureID) { //sti lista tou fotografikou ulikou fortonei to sindeete me 

          try {
                if ($itemTypeID == 1) {

                    $select = 'religiousMonumentsDetails.friendlyName, religiousMonumentsDetails.ReligiousMonumentId,religiousMonumentsDetails.cultureID';
                    $innerjoin ='INNER JOIN religiousMonumentsDetails
                                ON religiousMonumentsDetails.ReligiousMonumentId = items.itemID';

                } else if ($itemTypeID == 2) {

                    $select = 'christianorthodoxMonumentsDetails.friendlyName, christianorthodoxMonumentsDetails.ChristianorthodoxMonumentId,christianorthodoxMonumentsDetails.cultureID';
                    $innerjoin ='INNER JOIN christianorthodoxMonumentsDetails
                                ON christianorthodoxMonumentsDetails.ChristianorthodoxMonumentId = items.itemID';

                } else if  ($itemTypeID == 3){

                    $select = 'artworks_details.FriendlyName, artworks_details.ArtworkID,artworks_details.CultureID';
                    $innerjoin ='INNER JOIN artworks_details
                                ON artworks_details.ArtworkID = items.itemID';

                } else if ($itemTypeID == 4){

                   $select = 'educationalFoundationDetails.friendlyName, educationalFoundationDetails.EducationFoundationId,educationalFoundationDetails.cultureID';
                    $innerjoin ='INNER JOIN educationalFoundationDetails
                                ON educationalFoundationDetails.EducationFoundationId = items.itemID';

                }  else if ($itemTypeID == 5){

                    $select = 'epigraphsDetails.friendlyName, epigraphsDetails.EpigraphId,epigraphsDetails.cultureID';
                    $innerjoin ='INNER JOIN epigraphsDetails
                                ON epigraphsDetails.EpigraphId = items.itemID';

                } else if ($itemTypeID == 6){

                 $select = 'communityDetails.friendlyName, communityDetails.CommunityId,communityDetails.cultureID';
                    $innerjoin ='INNER JOIN communityDetails
                                ON communityDetails.CommunityId = items.itemID';

                } else if ($itemTypeID == 7){

                 $select = 'cemeteryDetails.friendlyName, cemeteryDetails.CemeteryId,cemeteryDetails.cultureID';
                    $innerjoin ='INNER JOIN cemeteryDetails
                                ON cemeteryDetails.CemeteryId = items.itemID';

                } else if ($itemTypeID == 13){

                   $select = 'archeologicalReligiousMonumentsDetails.friendlyName, archeologicalReligiousMonumentsDetails.ArchReligiousId,archeologicalReligiousMonumentsDetails.cultureID';
                    $innerjoin ='INNER JOIN archeologicalReligiousMonumentsDetails
                                ON archeologicalReligiousMonumentsDetails.ArchReligiousId = items.itemID';

                }    else if ($itemTypeID == 14){

                   $select = 'archeologicalSiteDetails.friendlyName, archeologicalSiteDetails.ArchSiteID,archeologicalSiteDetails.cultureID';
                    $innerjoin ='INNER JOIN archeologicalSiteDetails
                                ON archeologicalSiteDetails.ArchSiteID = items.itemID';

                 } else if ($itemTypeID == 15){

                   $select = 'fortressesDetails.friendlyName, fortressesDetails.FortressId,fortressesDetails.cultureID';
                    $innerjoin ='INNER JOIN fortressesDetails
                                ON fortressesDetails.FortressId = items.itemID';

                 } else if ($itemTypeID == 16){

                   $select = 'tombsDetails.name, tombsDetails.TombId,tombsDetails.cultureID';
                    $innerjoin ='INNER JOIN tombsDetails
                                ON tombsDetails.TombId = items.itemID';

                 } else if ($itemTypeID == 17){

                   $select = 'museumsDetails.friendlyName, museumsDetails.MuseumId,museumsDetails.cultureID';
                    $innerjoin ='INNER JOIN museumsDetails
                                ON museumsDetails.MuseumId = items.itemID';

                 } else if ($itemTypeID == 18){

                   $select = 'exhibitionDetails.title, exhibitionDetails.ExhibitionId,exhibitionDetails.cultureID';
                    $innerjoin ='INNER JOIN exhibitionDetails
                                ON exhibitionDetails.ExhibitionId = items.itemID';

                 }else if ($itemTypeID == 19){

                   $select = 'administrationBuildingsDetails.friendlyName, administrationBuildingsDetails.AdminBuildingId,administrationBuildingsDetails.cultureID';
                    $innerjoin ='INNER JOIN administrationBuildingsDetails
                                ON administrationBuildingsDetails.AdminBuildingId = items.itemID';

                 } else if($itemTypeID == 20){

                    $select = 'welfareBuildingsDetails.friendlyName, welfareBuildingsDetails.WelfareBuildingId,welfareBuildingsDetails.cultureID';
                    $innerjoin ='INNER JOIN welfareBuildingsDetails
                                ON welfareBuildingsDetails.WelfareBuildingId = items.itemID';

                 } else if($itemTypeID == 21){

                    $select = 'infrastructureBuildingsDetails.friendlyName, infrastructureBuildingsDetails.InfrastructureBuildingId,infrastructureBuildingsDetails.cultureID';
                    $innerjoin ='INNER JOIN infrastructureBuildingsDetails
                                ON infrastructureBuildingsDetails.InfrastructureBuildingId = items.itemID';

                } else if($itemTypeID == 22){

                    $select = 'socialResidentialBuildingDetails.friendlyName, socialResidentialBuildingDetails.ResidentialBuildingId,socialResidentialBuildingDetails.cultureID';
                    $innerjoin ='INNER JOIN welfareBuildinsocialResidentialBuildingDetailsgsDetails
                                ON socialResidentialBuildingDetails.ResidentialBuildingId = items.itemID';

                } else if($itemTypeID == 23){

                    $select = 'coins_details.frontView, coins_details.coinID,coins_details.CultureID';
                    $innerjoin ='INNER JOIN coins_details
                                ON coins_details.coinID = items.itemID';

                }

                    else if($itemTypeID == 24){

                    $select = 'persons_details.fullName, persons_details.personID,persons_details.cultureID';
                    $innerjoin ='INNER JOIN persons_details
                                ON persons_details.personID = items.itemID';

                }
                     else {

                    $select = 'religiousEventsDetails.title, religiousEventsDetails.religiousEventID,religiousEventsDetails.cultureID';
                    $innerjoin ='INNER JOIN religiousEventsDetails
                                ON religiousEventsDetails.religiousEventID = items.itemID';

                }

            $query ='SELECT accompanyingObjectsPerArchivedObjects.accompanyingObjectID,items.itemID,items.itemTypeID,items.UniqueName,itemtypes.SingularDesc,itemtypes.StandardName,' . $select . '
                        FROM items
                        INNER JOIN itemtypes
                        ON items.itemTypeID = itemtypes.itemTypeID
                        ' . $innerjoin . '
                        where parentID = :itemID AND items.itemTypeID = :itemTypeID AND CultureID=:CultureID'; 

                                        
        //echo $query;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('itemID' => $itemID,'itemTypeID' => $itemTypeID,'CultureID' => $CultureID));
         

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->ID = $row['ID'];
            $itm->archivedObjectID = $row['archivedObjectID'];
            $itm->arch_uniqueName = $row['arch_uniqueName'];
            $itm->accompanyingObjectID = $row['accompanyingObjectID'];
            $itm->title = $row['title'];
            $itm->accompanyingItemTypeID = $row['accompanyingItemTypeID'];
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





    public function checkArchivedObjectRelationExists($firstObjectID, $secondObjectID) {

        $stmt = $this->pdo->prepare('SELECT ID FROM accompanyingObjectsPerArchivedObjects                                    

                                    where archivedObjectID=:archivedObjectID and accompanyingObjectID=:accompanyingObjectID

                                    ');



        $result = $stmt->execute(array('archivedObjectID' => $firstObjectID, 'accompanyingObjectID' => $secondObjectID));



        //$array = array();

        //$ind = 0;

        foreach ($stmt as $row) {

            return $row['relationID'];;

        }

        return FALSE;

        //return $array;

    }



    public function GetArchivedPerArchivedRelation($itemID, $itemTypeID) {

        $stmt = $this->pdo->prepare('SELECT *, (SELECT count(*) from items WHERE `parentID` = :archivedObjectID) as rowsum
                                    FROM items
                                    where itemID=:itemID and itemTypeID=:itemTypeID

                                    ');

            $result = $stmt->execute(array('itemID' => $itemID, 'itemTypeID' => $itemTypeID));



     
        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->itemID = $row['itemID'];
            $itm->itemTypeID = $row['itemTypeID'];
           
            
                 
           
            $array[$ind] = $itm;
            $ind++;
        }

        return $items;

 }




 public function GetArchivedPerArchivedlist($itemID,$itemTypeID,$CultureID) {   //this is for region.php fortonei  ti lista  pou sisxetizontai me tis kiries ontotites kai ta emfanizei me to friendlyname kai oxi to uniquename

      try {
                if ($itemTypeID == 1) {

                    $select = 'religiousMonumentsDetails.friendlyName, religiousMonumentsDetails.ReligiousMonumentId,religiousMonumentsDetails.cultureID';
                    $innerjoin ='INNER JOIN religiousMonumentsDetails
                                ON religiousMonumentsDetails.ReligiousMonumentId = items.itemID';

                } else if ($itemTypeID == 2) {

                    $select = 'christianorthodoxMonumentsDetails.friendlyName, christianorthodoxMonumentsDetails.ChristianorthodoxMonumentId,christianorthodoxMonumentsDetails.cultureID';
                    $innerjoin ='INNER JOIN christianorthodoxMonumentsDetails
                                ON christianorthodoxMonumentsDetails.ChristianorthodoxMonumentId = items.itemID';

                } else if  ($itemTypeID == 3){

                    $select = 'artworks_details.FriendlyName, artworks_details.ArtworkID,artworks_details.CultureID';
                    $innerjoin ='INNER JOIN artworks_details
                                ON artworks_details.ArtworkID = items.itemID';

                } else if ($itemTypeID == 4){

                   $select = 'educationalFoundationDetails.friendlyName, educationalFoundationDetails.EducationFoundationId,educationalFoundationDetails.cultureID';
                    $innerjoin ='INNER JOIN educationalFoundationDetails
                                ON educationalFoundationDetails.EducationFoundationId = items.itemID';

                }  else if ($itemTypeID == 5){

                    $select = 'epigraphsDetails.friendlyName, epigraphsDetails.EpigraphId,epigraphsDetails.cultureID';
                    $innerjoin ='INNER JOIN epigraphsDetails
                                ON epigraphsDetails.EpigraphId = items.itemID';

                } else if ($itemTypeID == 6){

                 $select = 'communityDetails.friendlyName, communityDetails.CommunityId,communityDetails.cultureID';
                    $innerjoin ='INNER JOIN communityDetails
                                ON communityDetails.CommunityId = items.itemID';

                } else if ($itemTypeID == 7){

                 $select = 'cemeteryDetails.friendlyName, cemeteryDetails.CemeteryId,cemeteryDetails.cultureID';
                    $innerjoin ='INNER JOIN cemeteryDetails
                                ON cemeteryDetails.CemeteryId = items.itemID';

                } else if ($itemTypeID == 13){

                   $select = 'archeologicalReligiousMonumentsDetails.friendlyName, archeologicalReligiousMonumentsDetails.ArchReligiousId,archeologicalReligiousMonumentsDetails.cultureID';
                    $innerjoin ='INNER JOIN archeologicalReligiousMonumentsDetails
                                ON archeologicalReligiousMonumentsDetails.ArchReligiousId = items.itemID';

                }    else if ($itemTypeID == 14){

                   $select = 'archeologicalSiteDetails.friendlyName, archeologicalSiteDetails.ArchSiteID,archeologicalSiteDetails.cultureID';
                    $innerjoin ='INNER JOIN archeologicalSiteDetails
                                ON archeologicalSiteDetails.ArchSiteID = items.itemID';

                 } else if ($itemTypeID == 15){

                   $select = 'fortressesDetails.friendlyName, fortressesDetails.FortressId,fortressesDetails.cultureID';
                    $innerjoin ='INNER JOIN fortressesDetails
                                ON fortressesDetails.FortressId = items.itemID';

                 } else if ($itemTypeID == 16){

                   $select = 'tombsDetails.name, tombsDetails.TombId,tombsDetails.cultureID';
                    $innerjoin ='INNER JOIN tombsDetails
                                ON tombsDetails.TombId = items.itemID';

                 } else if ($itemTypeID == 17){

                   $select = 'museumsDetails.friendlyName, museumsDetails.MuseumId,museumsDetails.cultureID';
                    $innerjoin ='INNER JOIN museumsDetails
                                ON museumsDetails.MuseumId = items.itemID';

                 } else if ($itemTypeID == 18){

                   $select = 'exhibitionDetails.friendlyName, exhibitionDetails.ExhibitionId,exhibitionDetails.cultureID';
                    $innerjoin ='INNER JOIN exhibitionDetails
                                ON exhibitionDetails.ExhibitionId = items.itemID';

                 }else if ($itemTypeID == 19){

                   $select = 'administrationBuildingsDetails.friendlyName, administrationBuildingsDetails.AdminBuildingId,administrationBuildingsDetails.cultureID';
                    $innerjoin ='INNER JOIN administrationBuildingsDetails
                                ON administrationBuildingsDetails.AdminBuildingId = items.itemID';

                 } else if($itemTypeID == 20){

                    $select = 'welfareBuildingsDetails.friendlyName, welfareBuildingsDetails.WelfareBuildingId,welfareBuildingsDetails.cultureID';
                    $innerjoin ='INNER JOIN welfareBuildingsDetails
                                ON welfareBuildingsDetails.WelfareBuildingId = items.itemID';

                 } else if($itemTypeID == 21){

                    $select = 'infrastructureBuildingsDetails.friendlyName, infrastructureBuildingsDetails.InfrastructureBuildingId,infrastructureBuildingsDetails.cultureID';
                    $innerjoin ='INNER JOIN infrastructureBuildingsDetails
                                ON infrastructureBuildingsDetails.InfrastructureBuildingId = items.itemID';

                } else if($itemTypeID == 22){

                    $select = 'socialResidentialBuildingDetails.friendlyName, socialResidentialBuildingDetails.ResidentialBuildingId,socialResidentialBuildingDetails.cultureID';
                    $innerjoin ='INNER JOIN welfareBuildinsocialResidentialBuildingDetailsgsDetails
                                ON socialResidentialBuildingDetails.ResidentialBuildingId = items.itemID';

                } else if($itemTypeID == 23){

                    $select = 'coins_details.frontView, coins_details.coinID,coins_details.CultureID';
                    $innerjoin ='INNER JOIN coins_details
                                ON coins_details.coinID = items.itemID';

                }

                    else if($itemTypeID == 24){

                    $select = 'persons_details.fullName, persons_details.personID,persons_details.cultureID';
                    $innerjoin ='INNER JOIN persons_details
                                ON persons_details.personID = items.itemID';

                }
                     else {

                    $select = 'religiousEventsDetails.title, religiousEventsDetails.religiousEventID,religiousEventsDetails.cultureID';
                    $innerjoin ='INNER JOIN religiousEventsDetails
                                ON religiousEventsDetails.religiousEventID = items.itemID';

                }


        $query = 'SELECT items.itemID,items.itemTypeID,items.UniqueName,itemtypes.SingularDesc,itemtypes.StandardName,' . $select . '
                                  FROM items
                                  INNER JOIN itemtypes
                                  ON items.itemTypeID = itemtypes.itemTypeID
                                  ' . $innerjoin . '
                                  where parentID = :itemID AND items.itemTypeID = :itemTypeID AND  itemtypes.itemTypeID NOT IN (8,9,10,11,12) AND CultureID=:CultureID
                                    '; 
        //echo $query;
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array('itemID' => $itemID,'itemTypeID' => $itemTypeID,'CultureID' => $CultureID));
         

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->itemID = $row['itemID'];
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->SingularDesc = $row['SingularDesc'];
            $itm->StandardName = $row['StandardName']; 
            $itm->UniqueName = $row['UniqueName'];  
            $itm->title = $row['title'];  
            $itm->Title = $row['Title']; 
            $itm->CultureID = $row['CultureID']; 
            $itm->friendlyName = $row['friendlyName']; 
            $itm->FriendlyName = $row['FriendlyName'];
            $itm->fullName = $row['fullName']; 
  
            
              
            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
     } 

                    catch (Exception $e) {
                         echo $e->getMessage();
                    }

    }




    public function getArchivedPerArchivedListCount($itemID,$itemTypeID) {

        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM items
            INNER JOIN itemtypes
            ON items.itemTypeID = itemtypes.itemTypeID
            where parentID = :itemID AND items.itemTypeID = :itemTypeID AND  itemtypes.itemTypeID NOT IN (8,9,10,11,12) '); 
        

        $result = $stmt->execute( array('itemID' => $itemID,'itemTypeID' => $itemTypeID));

        //print_r($stmt);
        foreach ($stmt as $row) {
            //print_r($row);
            return $row[0];
        }

        return null;
    }





 
public function getLstArchivedPerGeoRelation($ArchivedObjectID,$itemTypeID,$CultureID)  {  //GET ALL  list GEOPHYSICAL UNITIES in region.php




     try{


                            if ($itemTypeID == 8) {

                                $select = 'mountains_details.friendlyName,mountains_details.cultureID';
                                $innerjoin ='INNER JOIN mountains_details
                                            ON mountains_details.mountainID = references.ArchivedObjectID';

                            } else if ($itemTypeID == 9) {

                                $select = 'landareas_details.friendlyName,landareas_details.cultureID';
                                $innerjoin ='INNER JOIN landareas_details
                                            ON landareas_details.landAreaID = references.ArchivedObjectID';

                            } else if  ($itemTypeID == 10) {

                                $select = 'seas_details.friendlyName,seas_details.CultureID';
                                $innerjoin ='INNER JOIN seas_details
                                            ON seas_details.seaID = references.ArchivedObjectID';

                            } else if ($itemTypeID == 11) {

                               $select = 'lakes_details.friendlyName,lakes_details.CultureID';
                                $innerjoin ='INNER JOIN lakes_details
                                            ON lakes_details.lakeID = references.ArchivedObjectID';

                            } else {

                                $select = 'rivers_details.friendlyName,rivers_details.CultureID';
                                $innerjoin ='INNER JOIN rivers_details
                                            ON rivers_details.riverID = references.ArchivedObjectID';
                            }

    

        $query = 'SELECT   items.itemID,items.itemTypeID,items.UniqueName,`references`.`PointsTo`, `references`.`ArchivedObjectID`, ' . $select . '
                                  FROM `references`
                                  INNER JOIN items 
                                  ON `references`.`PointsTo` = `items`.`itemID`
                                  INNER JOIN itemtypes
                                  ON items.itemTypeID = itemtypes.itemTypeID
                                   ' . $innerjoin . '
                                  where ArchivedObjectID=:ArchivedObjectID AND CultureID=:CultureID AND items.itemTypeID=:itemTypeID AND itemtypes.itemTypeID IN (8,9,10,11,12) ';


           //echo $query;
            $stmt = $this->pdo->prepare($query);  
            $stmt->execute(array('ArchivedObjectID' => $ArchivedObjectID, 'itemTypeID' => $itemTypeID, 'CultureID' => $CultureID));
         

        $items = array();
        $ind = 0;
            

        foreach ($stmt as $row) {

            $itm = new stdClass();
            $itm->itemID = $row['itemID'];
            $itm->PointsTo = $row['PointsTo'];
            $itm->ArchivedObjectID = $row['ArchivedObjectID'];
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->UniqueName = $row['UniqueName'];  
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


    public function getPointToRegion($ArchivedObjectID)  {  

        $query = 'SELECT items.*, `references`.`PointsTo`,itemtypes.*
                                  FROM `references`
                                  INNER JOIN items 
                                  ON `references`.`PointsTo` = `items`.`itemID`
                                  INNER JOIN itemtypes
                                  ON items.itemTypeID = itemtypes.itemTypeID
                                  where ArchivedObjectID=:ArchivedObjectID ';


           //echo $query;
            $stmt = $this->pdo->prepare($query);  
            $stmt->execute(array('ArchivedObjectID' => $ArchivedObjectID));
         

        $items = array();
        $ind = 0;
            

        foreach ($stmt as $row) {

            $itm = new stdClass();
            $itm->itemID = $row['itemID'];
            $itm->PointsTo = $row['PointsTo'];
            //$itm->ArchivedObjectID = $row['ArchivedObjectID'];
            $itm->UniqueName = $row['UniqueName']; 
            $itm->itemTypeID = $row['itemTypeID']; 
            //$itm->CultureID = $row['CultureID'];    
            //$itm->friendlyName = $row['friendlyName']; 
            $itm->StandardName = $row['StandardName'];
            $itm->SingularDesc = $row['SingularDesc'];
            
            $array[$ind] = $itm;
            $ind++;

            } 
                return $array;
            } 



public function getReferencesForArchivedObjectID($archivedObjectID, $itemTypeID = NULL, $CultureID) {

     try {

                if ($itemTypeID == 1) {
                    $select = 'religiousMonumentsDetails.cultureID';
                    $innerjoin ='INNER JOIN religiousMonumentsDetails
                                ON religiousMonumentsDetails.ReligiousMonumentId = ao.ArchivedObjectID';

                } else if ($itemTypeID == 2) {

                    $select = 'christianorthodoxMonumentsDetails.cultureID';
                    $innerjoin ='INNER JOIN christianorthodoxMonumentsDetails
                                ON christianorthodoxMonumentsDetails.ChristianorthodoxMonumentId = ao.ArchivedObjectID';

                } else if  ($itemTypeID == 3) {

                    $select = 'artworks_details.CultureID';
                    $innerjoin ='INNER JOIN artworks_details
                                ON artworks_details.ArtworkID = ao.ArchivedObjectID';

                } else if ($itemTypeID == 4) {

                    $select = 'educationalFoundationDetails.cultureID';
                    $innerjoin ='INNER JOIN educationalFoundationDetails
                                ON educationalFoundationDetails.EducationFoundationId = ao.ArchivedObjectID';

                } else if ($itemTypeID == 5) {

                    $select = 'epigraphsDetails.cultureID';
                    $innerjoin ='INNER JOIN epigraphsDetails
                                ON epigraphsDetails.EpigraphId = ao.ArchivedObjectID';

                } else if ($itemTypeID == 6) {

                    $select = 'communityDetails.cultureID';
                    $innerjoin ='INNER JOIN communityDetails
                                ON communityDetails.CommunityId = ao.ArchivedObjectID';

                } else if ($itemTypeID == 7) {

                    $select = 'cemeteryDetails.cultureID';
                    $innerjoin ='INNER JOIN cemeteryDetails
                                ON cemeteryDetails.CemeteryId = ao.ArchivedObjectID';

                } else if ($itemTypeID == 13) {

                    $select = 'archeologicalReligiousMonumentsDetails.cultureID';
                    $innerjoin ='INNER JOIN archeologicalReligiousMonumentsDetails
                                ON archeologicalReligiousMonumentsDetails.ArchReligiousId = ao.ArchivedObjectID';

                }  else if ($itemTypeID == 14) {

                    $select = 'archeologicalSiteDetails.cultureID';
                    $innerjoin ='INNER JOIN archeologicalSiteDetails
                                ON archeologicalSiteDetails.ArchSiteID = ao.ArchivedObjectID';

                } else if ($itemTypeID == 15) {

                    $select = 'fortressesDetails.cultureID';
                    $innerjoin ='INNER JOIN fortressesDetails
                                ON fortressesDetails.FortressId = ao.ArchivedObjectID';

                } else if ($itemTypeID == 16) {

                    $select = 'tombsDetails.cultureID';
                    $innerjoin ='INNER JOIN tombsDetails
                                ON tombsDetails.TombId = ao.ArchivedObjectID';

                } else if ($itemTypeID == 17) {


                    $select = 'museumsDetails.cultureID';
                    $innerjoin ='INNER JOIN museumsDetails
                                ON museumsDetails.MuseumId = ao.ArchivedObjectID';

                } else if ($itemTypeID == 18) {

                    $select = 'exhibitionDetails.cultureID';

                   $innerjoin ='INNER JOIN exhibitionDetails
                                ON exhibitionDetails.ExhibitionId = ao.ArchivedObjectID';

                } else if ($itemTypeID == 19) {

                    $select = 'administrationBuildingsDetails.cultureID';
                    $innerjoin ='INNER JOIN administrationBuildingsDetails
                                ON administrationBuildingsDetails.AdminBuildingId = ao.ArchivedObjectID';

                } else if($itemTypeID == 20) {

                    $select = 'welfareBuildingsDetails.cultureID';
                    $innerjoin ='INNER JOIN welfareBuildingsDetails
                                ON welfareBuildingsDetails.WelfareBuildingId = ao.ArchivedObjectID';

                } else if($itemTypeID == 21) {

                    $select = 'infrastructureBuildingsDetails.cultureID';
                    $innerjoin ='INNER JOIN infrastructureBuildingsDetails
                                ON infrastructureBuildingsDetails.InfrastructureBuildingId = ao.ArchivedObjectID';

                } else if($itemTypeID == 22) {

                    $select = 'socialResidentialBuildingDetails.cultureID';
                    $innerjoin ='INNER JOIN socialResidentialBuildingDetails
                                ON socialResidentialBuildingDetails.ResidentialBuildingId = ao.ArchivedObjectID';

                } else if($itemTypeID == 23) {

                    $select = 'coins_details.CultureID';

                    $innerjoin ='INNER JOIN coins_details
                                ON coins_details.coinID = ao.ArchivedObjectID';

                } else if($itemTypeID == 24) {

                    $select = 'persons_details.cultureID';
                    $innerjoin ='INNER JOIN persons_details
                                ON persons_details.personID = ao.ArchivedObjectID';

                } else if ($itemTypeID == 25){   

                    $select = 'religiousEventsDetails.cultureID';
                    $innerjoin ='INNER JOIN religiousEventsDetails
                                ON religiousEventsDetails.religiousEventID = ao.ArchivedObjectID';

                }

                // else if ($itemTypeID == NULL){ 

                //     $select = 'regionsdetails.RegionID,regionsdetails.FriendlyName,regionsdetails.CultureID';
                //     $innerjoin ='INNER JOIN regionsdetails ON regionsdetails.RegionID = ao.ArchivedObjectID';


                // }

                else { 

                    $select = 'regionsdetails.RegionID,regionsdetails.FriendlyName,regionsdetails.CultureID';
                    $innerjoin ='INNER JOIN regionsdetails ON regionsdetails.RegionID = ao.ArchivedObjectID';



                }



                    $query = 'SELECT r.*,ao.* ,it.SingularDesc,items.itemTypeID, ' . $select . ' 

                                        FROM `references` as r 

                                        INNER JOIN `archivedobjects` as ao ON `r`.`PointsTo` = `ao`.`ArchivedObjectID`

                                        LEFT JOIN `items` ON `r`.`PointsTo` = `items`.`itemID`

                                        LEFT JOIN `itemtypes` as it ON `items`.`itemTypeID` = `it`.`itemTypeID`

                                        ' . $innerjoin . '

                                        WHERE `r`.`ArchivedObjectID`=:arch_id AND items.itemTypeID=:itemTypeID AND CultureID=:CultureID ';




            //echo $query;
            $stmt = $this->pdo->prepare($query);  
            $stmt->execute(array('arch_id' => $ArchivedObjectID, 'itemTypeID' => $itemTypeID, 'CultureID' => $CultureID));



            $array = array();

            $ind = 0;

            foreach ($stmt as $row) {

            // do something with $row

                $itm = new ArchivedObject();

                $itm->archivedObjectID = $row['ArchivedObjectID'];

                $itm->uniqueName = $row['UniqueName'];

                $itm->FriendlyName = $row['FriendlyName'];

                $itm->RegionID = $row['RegionID'];

                $itm->archiveCode = $row['ArchiveCode'];

                $itm->itemType = $row['SingularDesc'];

                $itm->ReferenceID = $row['ReferenceID'];

                $itm->CultureID = $row['CultureID'];

                $itm->itemTypeID = isset($row['itemTypeID']) ? $row['itemTypeID'] : '0';

               // $itm->itemTypeID = empty($row['itemTypeID']) ? $row['itemTypeID'] : 'NULL';

                $itm->PointsTo = $row['PointsTo'];



                    
            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    
         } 

                    catch (Exception $e) {
                         echo $e->getMessage();
                    }

    }

   





public function getReferencestoRegions($ArchivedObjectID,$CultureID)  {



    $query='SELECT r.*,ao.* ,it.SingularDesc,items.itemTypeID,regionsdetails.RegionID,regionsdetails.FriendlyName,regionsdetails.CultureID

                                        FROM `references` as r 

                                        INNER JOIN `archivedobjects` as ao ON `r`.`PointsTo` = `ao`.`ArchivedObjectID`
                                        LEFT JOIN regionsdetails ON regionsdetails.RegionID = ao.ArchivedObjectID

                                        LEFT JOIN `items` ON `r`.`PointsTo` = `items`.`itemID`

                                        LEFT JOIN `itemtypes` as it ON `items`.`itemTypeID` = `it`.`itemTypeID`

                                        WHERE `r`.`ArchivedObjectID`=:ArchivedObjectID AND regionsdetails.CultureID =:CultureID';

                                         //echo $query;
                                        $stmt = $this->pdo->prepare($query);  
                                        $stmt->execute(array('ArchivedObjectID' => $ArchivedObjectID, 'CultureID' => $CultureID));
                                     

                                        $array = array();
                                        $ind = 0;
                                        foreach ($stmt as $row) {

                                        $itm = new stdClass();
                                        $itm->ArchivedObjectID = $row['ArchivedObjectID'];
                                        $itm->itemID = $row['itemID'];
                                        $itm->RegionID = $row['RegionID'];
                                        $itm->itemTypeID = $row['itemTypeID'];
                                        $itm->UniqueName = $row['UniqueName']; 
                                        $itm->FriendlyName = $row['FriendlyName']; 
                                        $itm->CultureID = $row['CultureID']; 


                                        $array[$ind] = $itm;
                                        $ind++;

                                        } 
                                            return $array;
                                 }






     public function getLstArchivedPerGeoRelationn($ArchivedObjectID, $itemTypeID, $CultureID)  { //GET ALL  list GEOPHYSICAL UNITIES in region.php with friendly name


     try{


                            if ($itemTypeID == 8) {

                                $select = 'mountains_details.friendlyName,mountains_details.cultureID';
                                $innerjoin ='INNER JOIN mountains_details
                                            ON mountains_details.mountainID = g.geophysicalObjectID';

                            } else if ($itemTypeID == 9) {

                                $select = 'landareas_details.friendlyName,landareas_details.cultureID';
                                $innerjoin ='INNER JOIN landareas_details
                                            ON landareas_details.landAreaID = g.geophysicalObjectID';

                            } else if  ($itemTypeID == 10) {

                                $select = 'seas_details.friendlyName,seas_details.CultureID,seas_details.seaID';
                                $innerjoin ='INNER JOIN seas_details
                                            ON seas_details.seaID = g.geophysicalObjectID';

                            } else if ($itemTypeID == 11) {

                               $select = 'lakes_details.friendlyName,lakes_details.CultureID';
                                $innerjoin ='INNER JOIN lakes_details
                                            ON lakes_details.lakeID = g.geophysicalObjectID';

                            } else {

                                $select = 'rivers_details.friendlyName,rivers_details.CultureID';
                                $innerjoin ='INNER JOIN rivers_details
                                            ON rivers_details.riverID = g.geophysicalObjectID';
                            }

               
                                     $query = 'SELECT i.itemTypeID,g.geophysicalObjectID, ' . $select . ' 
                                      FROM geophysicalReferences g
                                      inner join items i on i.itemID = g.geophysicalObjectID
                                      inner join itemtypes it on it.itemTypeID=i.itemTypeID
                                      ' . $innerjoin . '
                                      where g.referencedObjectID =:ArchivedObjectID AND it.itemTypeID =:itemTypeID AND CultureID=:CultureID';


                                     // $query = 'SELECT ao.ArchivedObjectID,ao.UniqueName,ao.ArchiveCode,i.itemTypeID,it.SingularDesc , ' . $select . '
                                     // FROM geophysicalReferences g

                                     // inner join archivedobjects ao on g.geophysicalObjectID=ao.ArchivedObjectID

                                     // inner join items i on i.itemID = ao.ArchivedObjectID

                                     // inner join itemtypes it on it.itemTypeID=i.itemTypeID

                                     // ' . $innerjoin . '

                                     // where g.referencedObjectID =:id AND CultureID=:CultureID AND it.itemTypeID =:itemTypeID';




            //echo $query;
            $stmt = $this->pdo->prepare($query);  
            $stmt->execute(array('ArchivedObjectID' => $ArchivedObjectID, 'itemTypeID' => $itemTypeID, 'CultureID' => $CultureID));
         

            $array = array();
            $ind = 0;
            foreach ($stmt as $row) {

            $itm = new stdClass();
            $itm->ArchivedObjectID = $row['ArchivedObjectID'];
            $itm->geophysicalObjectID = $row['geophysicalObjectID'];
            $itm->itemID = $row['itemID'];
            $itm->RegionID = $row['RegionID'];
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->UniqueName = $row['UniqueName']; 
            $itm->friendlyName = $row['friendlyName']; 
            $itm->CultureID = $row['CultureID']; 
            $itm->seaID = $row['seaID'];   


            $array[$ind] = $itm;
            $ind++;

            } 
                return $array;
            } 

            catch (Exception $e) {
             echo $e->getMessage();
        }

    }

  public function getArchivedPerGeoRelation($id,$itemTypeID,$CultureID)  { 

     try{
                            if ($itemTypeID == 8) {

                                $select = 'mountains_details.friendlyName,mountains_details.cultureID';
                                $innerjoin ='INNER JOIN mountains_details
                                            ON mountains_details.mountainID = g.geophysicalObjectID';

                            } else if ($itemTypeID == 9) {

                                $select = 'landareas_details.friendlyName,landareas_details.cultureID';
                                $innerjoin ='INNER JOIN landareas_details
                                            ON landareas_details.landAreaID = g.geophysicalObjectID';

                            } else if  ($itemTypeID == 10) {

                                $select = 'seas_details.friendlyName,seas_details.CultureID';
                                $innerjoin ='INNER JOIN seas_details
                                            ON seas_details.seaID = g.geophysicalObjectID';

                            } else if ($itemTypeID == 11) {

                               $select = 'lakes_details.friendlyName,lakes_details.CultureID';
                                $innerjoin ='INNER JOIN lakes_details
                                            ON lakes_details.lakeID = g.geophysicalObjectID';

                            } else {

                                $select = 'rivers_details.friendlyName,rivers_details.CultureID';
                                $innerjoin ='INNER JOIN rivers_details
                                            ON rivers_details.riverID = g.geophysicalObjectID';
                            }

                                $query = 'SELECT ao.*, count(*) as rowsum,' . $select . '
                                     FROM geophysicalReferences g

                                     inner join archivedobjects ao on g.geophysicalObjectID=ao.ArchivedObjectID

                                     inner join items i on i.itemID = ao.ArchivedObjectID

                                     inner join itemtypes it on it.itemTypeID=i.itemTypeID

                                     ' . $innerjoin . '

                                     where g.referencedObjectID =:id AND CultureID=:CultureID AND it.itemTypeID =:itemTypeID';
    

                                // $query = 'SELECT count(*) as rowsum
                                //   FROM `references`
                                //   INNER JOIN items 
                                //   ON `references`.`PointsTo` = `items`.`itemID`
                                //   where ArchivedObjectID=:ArchivedObjectID AND items.itemTypeID=:itemTypeID AND itemtypes.itemTypeID IN (8,9,10,11,12) ';

        //echo $query;
        $stmt = $this->pdo->prepare($query); 
        $stmt->execute(array('id' => $id, 'itemTypeID' => $itemTypeID, 'CultureID' => $CultureID));


            $items = array();

            $ind = 0;
            foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->itemID = $row['itemID'];
            //$itm->PointsTo = $row['PointsTo'];
            $itm->id = $row['ArchivedObjectID'];
          
            $itm->rowsum = $row['rowsum'];       
            return $itm;

            }

            } 

            catch (Exception $e) {
             echo $e->getMessage();
        }

    }

 public function getGeoItemsRelatedToGeoItemsOnly($id, $itemTypeID, $CultureID)  { //GET ALL  list GEOPHYSICAL UNITIES in region.php with friendly name


     try{


                            if ($itemTypeID == 8) {

                                $select = 'mountains_details.friendlyName,mountains_details.cultureID';
                                $innerjoin ='INNER JOIN mountains_details
                                            ON mountains_details.mountainID = g.geophysicalObjectID';

                            } else if ($itemTypeID == 9) {

                                $select = 'landareas_details.friendlyName,landareas_details.cultureID';
                                $innerjoin ='INNER JOIN landareas_details
                                            ON landareas_details.landAreaID = g.geophysicalObjectID';

                            } else if  ($itemTypeID == 10) {

                                $select = 'seas_details.friendlyName,seas_details.CultureID,seas_details.seaID';
                                $innerjoin ='INNER JOIN seas_details
                                            ON seas_details.seaID = g.geophysicalObjectID';

                            } else if ($itemTypeID == 11) {

                               $select = 'lakes_details.friendlyName,lakes_details.CultureID';
                                $innerjoin ='INNER JOIN lakes_details
                                            ON lakes_details.lakeID = g.geophysicalObjectID';

                            } else {

                                $select = 'rivers_details.friendlyName,rivers_details.CultureID';
                                $innerjoin ='INNER JOIN rivers_details
                                            ON rivers_details.riverID = g.geophysicalObjectID';
                            }

               
                                     $query = 'SELECT i.itemTypeID,g.geophysicalObjectID, ' . $select . ' 
                                      FROM geophysicalReferences g
                                      inner join items i on i.itemID = g.geophysicalObjectID
                                      inner join itemtypes it on it.itemTypeID=i.itemTypeID
                                      ' . $innerjoin . '
                                      where g.referencedObjectID =:id AND it.itemTypeID =:itemTypeID AND CultureID=:CultureID';


                                     // $query = 'SELECT ao.ArchivedObjectID,ao.UniqueName,ao.ArchiveCode,i.itemTypeID,it.SingularDesc , ' . $select . '
                                     // FROM geophysicalReferences g

                                     // inner join archivedobjects ao on g.geophysicalObjectID=ao.ArchivedObjectID

                                     // inner join items i on i.itemID = ao.ArchivedObjectID

                                     // inner join itemtypes it on it.itemTypeID=i.itemTypeID

                                     // ' . $innerjoin . '

                                     // where g.referencedObjectID =:id AND CultureID=:CultureID AND it.itemTypeID =:itemTypeID';




            //echo $query;
            $stmt = $this->pdo->prepare($query);  
            $stmt->execute(array('id' => $id, 'itemTypeID' => $itemTypeID, 'CultureID' => $CultureID));
         

            $array = array();
            $ind = 0;
            foreach ($stmt as $row) {

            $itm = new stdClass();
            $itm->id = $row['ArchivedObjectID'];
            $itm->geophysicalObjectID = $row['geophysicalObjectID'];
            $itm->itemID = $row['itemID'];
            $itm->RegionID = $row['RegionID'];
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->UniqueName = $row['UniqueName']; 
            $itm->friendlyName = $row['friendlyName']; 
            $itm->CultureID = $row['CultureID']; 
            $itm->seaID = $row['seaID'];   


            $array[$ind] = $itm;
            $ind++;

            } 
                return $array;
            } 

            catch (Exception $e) {
             echo $e->getMessage();
        }

    }

    public function GetArchivedPerArchived($item_id, $itemTypeID, $CultureID) {   //fortonei ton arithmo ton sisxetizomenon kirion ontotiton me ena region

                try {

                if ($itemTypeID == 1) {
                    $select = 'religiousMonumentsDetails.cultureID';
                    $innerjoin ='INNER JOIN religiousMonumentsDetails
                                ON religiousMonumentsDetails.ReligiousMonumentId = items.itemID';

                } else if ($itemTypeID == 2) {

                    $select = 'christianorthodoxMonumentsDetails.cultureID';
                    $innerjoin ='INNER JOIN christianorthodoxMonumentsDetails
                                ON christianorthodoxMonumentsDetails.ChristianorthodoxMonumentId = items.itemID';

                } else if  ($itemTypeID == 3) {

                    $select = 'artworks_details.CultureID';
                    $innerjoin ='INNER JOIN artworks_details
                                ON artworks_details.ArtworkID = items.itemID';

                } else if ($itemTypeID == 4) {

                    $select = 'educationalFoundationDetails.cultureID';
                    $innerjoin ='INNER JOIN educationalFoundationDetails
                                ON educationalFoundationDetails.EducationFoundationId = items.itemID';

                } else if ($itemTypeID == 5) {

                    $select = 'epigraphsDetails.cultureID';
                    $innerjoin ='INNER JOIN epigraphsDetails
                                ON epigraphsDetails.EpigraphId = items.itemID';

                } else if ($itemTypeID == 6) {

                    $select = 'communityDetails.cultureID';
                    $innerjoin ='INNER JOIN communityDetails
                                ON communityDetails.CommunityId = items.itemID';

                } else if ($itemTypeID == 7) {

                    $select = 'cemeteryDetails.cultureID';
                    $innerjoin ='INNER JOIN cemeteryDetails
                                ON cemeteryDetails.CemeteryId = items.itemID';

                } else if ($itemTypeID == 13) {

                    $select = 'archeologicalReligiousMonumentsDetails.cultureID';
                    $innerjoin ='INNER JOIN archeologicalReligiousMonumentsDetails
                                ON archeologicalReligiousMonumentsDetails.ArchReligiousId = items.itemID';

                }  else if ($itemTypeID == 14) {

                    $select = 'archeologicalSiteDetails.cultureID';
                    $innerjoin ='INNER JOIN archeologicalSiteDetails
                                ON archeologicalSiteDetails.ArchSiteID = items.itemID';

                } else if ($itemTypeID == 15) {

                    $select = 'fortressesDetails.cultureID';
                    $innerjoin ='INNER JOIN fortressesDetails
                                ON fortressesDetails.FortressId = items.itemID';

                } else if ($itemTypeID == 16) {

                    $select = 'tombsDetails.cultureID';
                    $innerjoin ='INNER JOIN tombsDetails
                                ON tombsDetails.TombId = items.itemID';

                } else if ($itemTypeID == 17) {


                    $select = 'museumsDetails.cultureID';
                    $innerjoin ='INNER JOIN museumsDetails
                                ON museumsDetails.MuseumId = items.itemID';

                } else if ($itemTypeID == 18) {

                    $select = 'exhibitionDetails.cultureID';

                   $innerjoin ='INNER JOIN exhibitionDetails
                                ON exhibitionDetails.ExhibitionId = items.itemID';

                } else if ($itemTypeID == 19) {

                    $select = 'administrationBuildingsDetails.cultureID';
                    $innerjoin ='INNER JOIN administrationBuildingsDetails
                                ON administrationBuildingsDetails.AdminBuildingId = items.itemID';

                } else if($itemTypeID == 20) {

                    $select = 'welfareBuildingsDetails.cultureID';
                    $innerjoin ='INNER JOIN welfareBuildingsDetails
                                ON welfareBuildingsDetails.WelfareBuildingId = items.itemID';

                } else if($itemTypeID == 21) {

                    $select = 'infrastructureBuildingsDetails.cultureID';
                    $innerjoin ='INNER JOIN infrastructureBuildingsDetails
                                ON infrastructureBuildingsDetails.InfrastructureBuildingId = items.itemID';

                } else if($itemTypeID == 22) {

                    $select = 'socialResidentialBuildingDetails.cultureID';
                    $innerjoin ='INNER JOIN socialResidentialBuildingDetails
                                ON socialResidentialBuildingDetails.ResidentialBuildingId = items.itemID';

                } else if($itemTypeID == 23) {

                    $select = 'coins_details.CultureID';

                    $innerjoin ='INNER JOIN coins_details
                                ON coins_details.coinID = items.itemID';

                } else if($itemTypeID == 24) {

                    $select = 'persons_details.cultureID';
                    $innerjoin ='INNER JOIN persons_details
                                ON persons_details.personID = items.itemID';

                } else {   

                    $select = 'religiousEventsDetails.cultureID';
                    $innerjoin ='INNER JOIN religiousEventsDetails
                                ON religiousEventsDetails.religiousEventID = items.itemID';

                }





            $query = 'SELECT  count(*) as rowsum,' . $select . '
                                  FROM items
                                  ' . $innerjoin . '
                                  WHERE parentID=:itemID AND items.itemTypeID NOT IN (8,9,10,11,12) AND items.itemTypeID=:itemTypeID AND CultureID=:CultureID' ;
           //echo $query;
            $stmt = $this->pdo->prepare($query);  
            $stmt->execute(array('itemID' => $item_id, 'itemTypeID' => $itemTypeID, 'CultureID' => $CultureID));
             


            $ind = 0;
            foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->CultureID = $row['CultureID'];

            $itm->itemID = $row['itemID'];
            $itm->itemTypeID = $row['itemTypeID'];
             
            $itm->rowsum = $row['rowsum'];   //exo valei na diairei me to 2 giati fernei kai ta aglika kai ta elinika mazi     
            
            return $itm;

            }

            } 

            catch (Exception $e) {
             echo $e->getMessage();
        }

    }





 



    public function ViewArchivedObjectRelationss($archivedObjectID, $accompanyingItemTypeID, $CultureID) {  

try { 

                 if ($accompanyingItemTypeID == 1) {

                    $select = 'Photos_Details.CultureID';
                    $innerjoin ='INNER JOIN Photos_Details
                                ON Photos_Details.PhotoID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID';


                } else if ($accompanyingItemTypeID == 2) {

                    $select = 'PrintedOrHandWrittenDocs_Details.CultureID';
                    $innerjoin ='INNER JOIN PrintedOrHandWrittenDocs_Details
                                ON PrintedOrHandWrittenDocs_Details.PrintedOrHandwrittenDocID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID';

                } else if  ($accompanyingItemTypeID == 3){

                    $select = 'biographies_details.CultureID';
                    $innerjoin ='INNER JOIN biographies_details
                                ON biographies_details.biographyID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID';


                } else if ($accompanyingItemTypeID == 4){

                    $select = 'bibliographies_details.cultureID';
                    $innerjoin ='INNER JOIN bibliographies
                                ON bibliographies.bibliographyID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID
                                INNER JOIN bibliographies_details ON bibliographies.bibliographyID = bibliographies_details.bibliographyID 
                                  ';

                }  else if ($accompanyingItemTypeID == 5){

                    $select = 'audioVisuals_details.cultureID';
                    $innerjoin ='INNER JOIN audioVisuals_details
                                ON audioVisuals_details.audioVisualID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID';

                } else if ($accompanyingItemTypeID == 6){

                    $select = 'Documents_Details.CultureID';
                    $innerjoin ='INNER JOIN Documents_Details
                                ON Documents_Details.DocumentID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID';  

                } else if ($accompanyingItemTypeID == 7){

                    $select = 'Notes_Details.CultureID';
                    $innerjoin ='INNER JOIN Notes_Details
                                ON Notes_Details.NoteID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID'; 

                } else if ($accompanyingItemTypeID == 8){

                    $select = 'Maps_Details.CultureID';
                    $innerjoin ='INNER JOIN Maps_Details
                                ON Maps_Details.MapID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID';
               } else {

                    $select = 'Sponsors_Details.CultureID';
                    $innerjoin = 'INNER JOIN Sponsors_Details
                                  ON Sponsors_Details.SponsorID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID';
                 }
      $query = 'SELECT count(*) as rowsum, count(*) as SUM, ' . $select . '
      FROM accompanyingObjectsPerArchivedObjects
      left join accompanyingObjects on accompanyingObjects.accompanyingObjectID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID
      left join accompanyingItemTypes on accompanyingItemTypes.accompanyingItemTypeID = accompanyingObjects.accompanyingItemTypeID
      ' . $innerjoin . '
      where accompanyingObjectsPerArchivedObjects.archivedObjectID = :archivedObjectID AND accompanyingItemTypes.accompanyingItemTypeID=:accompanyingItemTypeID AND CultureID=:CultureID' ;


        //echo $query;
        $stmt = $this->pdo->prepare($query); 
        $stmt->execute(array('archivedObjectID' => $archivedObjectID, 'accompanyingItemTypeID' => $accompanyingItemTypeID, 'CultureID' => $CultureID));


            $items = array();

            $ind = 0;
            foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            //$itm->ID = $row['ID'];
            //$itm->archivedObjectID = $row['archivedObjectID'];
           // $itm->accompanyingObjectID = $row['accompanyingObjectID'];
            $itm->rowsum = $row['rowsum'];
            $itm->SUM = $row['rowsum'];
            //$itm->CultureID = $row['CultureID'];
            
     
          return $itm;

            }

            } 

            catch (Exception $e) {
             echo $e->getMessage();
        }

    }





    public function ViewArchivedObjectlist($archivedObjectID, $accompanyingItemTypeID, $PageSize = NULL, $RecordOffest = NULL, $CultureID) { 

        try { 

                 if ($accompanyingItemTypeID == 1) {

                    $select = 'Photos_Details.Title, Photos_Details.PhotoID,Photos_Details.CultureID';
                    $innerjoin ='INNER JOIN Photos_Details
                                ON Photos_Details.PhotoID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID';


                } else if ($accompanyingItemTypeID == 2) {

                    $select = 'PrintedOrHandWrittenDocs_Details.Title, PrintedOrHandWrittenDocs_Details.PrintedOrHandwrittenDocID,PrintedOrHandWrittenDocs_Details.CultureID';
                    $innerjoin ='INNER JOIN PrintedOrHandWrittenDocs_Details
                                ON PrintedOrHandWrittenDocs_Details.PrintedOrHandwrittenDocID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID';

                } else if  ($accompanyingItemTypeID == 3){

                    $select = 'biographies_details.FullName, biographies_details.biographyID,biographies_details.CultureID';
                    $innerjoin ='INNER JOIN biographies_details
                                ON biographies_details.biographyID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID';


                } else if ($accompanyingItemTypeID == 4){

                    $select = 'bibliographies.title,bibliographies.titlePlainText,bibliographies.bibliographyID,bibliographies.abbreviation,bibliographies_details.cultureID,bibliographies_details.bibliographyID';
                    $innerjoin ='INNER JOIN bibliographies
                                ON bibliographies.bibliographyID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID
                                INNER JOIN bibliographies_details ON bibliographies.bibliographyID = bibliographies_details.bibliographyID  ';

                }  else if ($accompanyingItemTypeID == 5){

                    $select = 'audioVisuals_details.title, audioVisuals_details.audioVisualID,audioVisuals_details.cultureID';
                    $innerjoin ='INNER JOIN audioVisuals_details
                                ON audioVisuals_details.audioVisualID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID';

                } else if ($accompanyingItemTypeID == 6){

                    $select = 'Documents_Details.Title, Documents_Details.DocumentID,Documents_Details.CultureID';
                    $innerjoin ='INNER JOIN Documents_Details
                                ON Documents_Details.DocumentID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID';  

                } else if ($accompanyingItemTypeID == 7){
                    $select = 'Notes_Details.Title, Notes_Details.NoteID,Notes_Details.CultureID';
                    $innerjoin ='INNER JOIN Notes_Details
                                ON Notes_Details.NoteID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID'; 

                } else if ($accompanyingItemTypeID == 8){

                    $select = 'Maps_Details.Title, Maps_Details.MapID,Maps_Details.CultureID';
                    $innerjoin ='INNER JOIN Maps_Details
                                ON Maps_Details.MapID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID';
               } else {

                    $select = 'Sponsors_Details.FriendlyName, Sponsors_Details.SponsorID,Sponsors_Details.CultureID';
                    $innerjoin = 'INNER JOIN Sponsors_Details
                                  ON Sponsors_Details.SponsorID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID';
                 }

        

        $query ='SELECT `accompanyingObjectsPerArchivedObjects`.`accompanyingObjectID`,`accompanyingObjectsPerArchivedObjects`.`archivedObjectID`,`accompanyingObjectsPerArchivedObjects`.`ID` , `accompanyingObjects`.`uniqueName`,
                  `accompanyingItemTypes`.`accompanyingItemTypeID`, `accompanyingItemTypes`.`StandardName`, `accompanyingItemTypes`.`SingularDesc`, `accompanyingObjects`.`accompanyingObjectID`,
                   `accompanyingObjects`.`accompanyingItemTypeID`,`accompanyingObjects`.`documentPath`,' . $select . '
                  FROM accompanyingObjectsPerArchivedObjects
                  left join accompanyingObjects on accompanyingObjects.accompanyingObjectID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID
                  left join archivedobjects on archivedobjects.ArchivedObjectID = accompanyingObjectsPerArchivedObjects.archivedObjectID
                  left join accompanyingItemTypes on accompanyingItemTypes.accompanyingItemTypeID = accompanyingObjects.accompanyingItemTypeID
                   ' . $innerjoin . ' 
                  WHERE accompanyingObjectsPerArchivedObjects.archivedObjectID =:archivedObjectID and accompanyingObjects.accompanyingItemTypeID =:accompanyingItemTypeID AND CultureID =:CultureID';


        if(is_numeric($PageSize) && is_numeric($RecordOffest))
        {
            //echo '2:' . $PageSize . ' ' . $RecordOffest ;
            $query .= " LIMIT " .  $RecordOffest . "," . $PageSize;
        }

        $stmt = $this->pdo->prepare($query);  

        //echo $query;
        $stmt->execute(array('archivedObjectID' => $archivedObjectID, 'accompanyingItemTypeID' => $accompanyingItemTypeID, 'CultureID' => $CultureID));


        $array = array();
        $ind = 0;

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->ID = $row['ID'];
            $itm->archivedObjectID = $row['archivedObjectID'];
            $itm->accompanyingObjectID = $row['accompanyingObjectID'];
            $itm->StandardName = $row['StandardName'];
            $itm->uniqueName = $row['uniqueName'];
            $itm->SingularDesc = $row['SingularDesc'];
            $itm->accompanyingItemTypeID = $row['accompanyingItemTypeID'];
            $itm->documentPath = $row['documentPath'];
            $itm->Title = $row['Title'];
            $itm->title = $row['title'];
            $itm->FullName = $row['FullName'];
            $itm->FriendlyName = $row['FriendlyName'];
            $itm->titlePlainText = $row['titlePlainText'];
            $itm->abbreviation = $row['abbreviation'];
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



        public function ViewArchivedObjectlistCount($archivedObjectID, $accompanyingItemTypeID) { //this is for region.php  load ti lista tou sinodeutikou ilikou

        $stmt = $this->pdo->prepare('SELECT COUNT(*)  FROM  accompanyingObjectsPerArchivedObjects
          left join accompanyingObjects on accompanyingObjects.accompanyingObjectID = accompanyingObjectsPerArchivedObjects.accompanyingObjectID
          left join archivedobjects on archivedobjects.ArchivedObjectID = accompanyingObjectsPerArchivedObjects.archivedObjectID
          left join accompanyingItemTypes on accompanyingItemTypes.accompanyingItemTypeID = accompanyingObjects.accompanyingItemTypeID
           where accompanyingObjectsPerArchivedObjects.archivedObjectID =:archivedObjectID and accompanyingObjects.accompanyingItemTypeID =:accompanyingItemTypeID');


        $result = $stmt->execute( array('archivedObjectID' => $archivedObjectID, 'accompanyingItemTypeID' => $accompanyingItemTypeID));

 //print_r($stmt);
        foreach ($stmt as $row) {
            //print_r($row);
            return $row[0];
        }

        return null;
    }







}