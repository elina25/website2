<?php

class ControllerGeophysical{

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        
    }

public function getKindOfGeophysical($ItemID, $CultureID)
{
    $stmt = $this->pdo->prepare('SELECT item_to_kind.ItemID,item_to_kind.ChoiceID,item_kinds_detail.ItemKindID,item_kinds_detail.CultureID,item_kinds_detail.LookupValue
        FROM `item_to_kind`
        INNER JOIN item_kinds_detail
        ON item_to_kind.ChoiceID = item_kinds_detail.ItemKindID
        WHERE ItemID = :ItemID AND CultureID = :CultureID');

    $result = $stmt->execute(array('ItemID' => $ItemID, 'CultureID' => $CultureID ) );

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new stdClass();
            $itm->ItemID = $row['ItemID'];
            $itm->ChoiceID = $row['ChoiceID'];
            $itm->ItemKindID = $row['ItemKindID'];
            $itm->CultureID = $row['CultureID'];
            $itm->LookupValue = $row['LookupValue'];
            
           
           
            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }



     public function getTheGeophysicalObjectsRelatedToGeo($RegionID, $itemTypeID) {


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

                                    $query = 'SELECT ao.ArchivedObjectID,ao.UniqueName,ao.ArchiveCode,i.itemTypeID,it.SingularDesc FROM geophysicalReferences g

                                     inner join archivedobjects ao on g.geophysicalObjectID=ao.ArchivedObjectID

                                     inner join items i on i.itemID = ao.ArchivedObjectID

                                     inner join itemtypes it on it.itemTypeID=i.itemTypeID

                                     where g.referencedObjectID =:referencedObjectID AND i.itemTypeID =:itemTypeID' ;




        //echo $query;
        $stmt = $this->pdo->prepare($query);  
        $stmt->execute(array('RegionID' => $RegionID, 'itemTypeID' => $itemTypeID));

        $ind = 0;

        foreach ($stmt as $row) {

            // do something with $row

            $itm = new Region();

            $itm->referencedObjectID = $row['referencedObjectID'];
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->rowsum = $row['rowsum']/2;

            return $itm;

            }

            } 

            catch (Exception $e) {
             echo $e->getMessage();
        }

    }




    public function getCountOfGeophysicalObjectsRelatedToGeo($RegionID, $itemTypeID, $CultureID) {


        try{


                            if ($itemTypeID == 8) {
                                $select = 'mountains_details.cultureID';
                                $innerjoin ='INNER JOIN mountains_details
                                            ON mountains_details.mountainID = g.geophysicalObjectID';

                            } else if ($itemTypeID == 9) {
                                 $select = 'landareas_details.CultureID';
                                $innerjoin ='INNER JOIN landareas_details
                                            ON landareas_details.landAreaID = g.geophysicalObjectID';

                            } else if  ($itemTypeID == 10) {
                                 $select = 'seas_details.CultureID';
                                $innerjoin ='INNER JOIN seas_details
                                            ON seas_details.seaID = g.geophysicalObjectID';

                            } else if ($itemTypeID == 11) {
                                 $select = 'lakes_details.CultureID';
                                $innerjoin ='INNER JOIN lakes_details
                                            ON lakes_details.lakeID = g.geophysicalObjectID';

                            } else {
                                $select = 'rivers_details.CultureID';
                                $innerjoin ='INNER JOIN rivers_details
                                            ON rivers_details.riverID = g.geophysicalObjectID';
                            }


                                    $query = 'SELECT count(*) as rowsum, ' . $select . '
                                     FROM geophysicalReferences g

                                     inner join archivedobjects ao on g.geophysicalObjectID=ao.ArchivedObjectID

                                     inner join items i on i.itemID = ao.ArchivedObjectID

                                     inner join itemtypes it on it.itemTypeID=i.itemTypeID

                                     ' . $innerjoin . '

                                     where g.referencedObjectID =:referencedObjectID AND i.itemTypeID =:itemTypeID AND CultureID =:CultureID' ;




        //echo $query;
        $stmt = $this->pdo->prepare($query);  
        $stmt->execute(array('RegionID' => $RegionID, 'itemTypeID' => $itemTypeID, 'CultureID' => $CultureID));

        $ind = 0;

        foreach ($stmt as $row) {

            // do something with $row

            $itm = new Region();

            $itm->referencedObjectID = $row['referencedObjectID'];
            $itm->itemTypeID = $row['itemTypeID'];
            $itm->rowsum = $row['rowsum']/2;

            return $itm;

            }

            } 

            catch (Exception $e) {
             echo $e->getMessage();
        }

    }

}