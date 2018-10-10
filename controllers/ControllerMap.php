<?php

class ControllerMap {

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        
    }

    public function getAllMapsKindDetails($CultureID)
{
    $stmt = $this->pdo->prepare('SELECT * FROM `MapKinds_Details`
         WHERE `MapKinds_Details`.`CultureID` = :CultureID');

        $stmt->execute( array('CultureID' => $CultureID ) );

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Map();
            $itm->ID = $row['ID'];
            $itm->MapKindID = $row['MapKindID'];
            $itm->CultureID = $row['CultureID'];
            $itm->LookupValue = $row['LookupValue'];
           
            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }





        public function getAllMapDetailWithID($MapID, $CultureID)  //Get all maps details from Maps_Details Table
    {
        $stmt = $this->pdo->prepare('SELECT * FROM `Maps_Details`
         INNER JOIN accompanyingObjects ON
         accompanyingObjects.accompanyingObjectID = Maps_Details.MapID
         WHERE MapID = :MapID AND CultureID = :CultureID ');

        $stmt->execute( array('MapID' => $MapID, 'CultureID' => $CultureID ) );

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Map();
            $itm->ID = $row['ID'];
            $itm->MapID = $row['MapID'];
            $itm->CultureID = $row['CultureID'];
            $itm->BelongsTo = $row['BelongsTo'];
            $itm->Title = $row['Title'];
            $itm->Description = $row['Description'];
            $itm->Chartographer = $row['Chartographer'];
            $itm->Publisher = $row['Publisher'];
            $itm->Languages = $row['Languages'];
            $itm->PublicationPlace = $row['PublicationPlace'];
            $itm->PublicationCountry = $row['PublicationCountry'];
            $itm->PublicationYear = $row['PublicationYear'];
            $itm->OtherInfo = $row['OtherInfo'];
            $itm->Verso = $row['Verso'];
            $itm->Corrections = $row['Corrections'];
            $itm->Comments = $row['Comments'];
            $itm->CreatedOn = $row['CreatedOn'];
            $itm->Source = $row['Source'];
            $itm->SourcePlainText = $row['SourcePlainText'];
            $itm->documentPath = $row['documentPath'];
            $itm->webAccess = $row['webAccess'];
            $itm->webAccessEN = $row['webAccessEN'];
            $itm->imprimatur = $row['imprimatur'];
            
            
           
            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }


        public function getAllMapsWithID($MapID)  //Get all map details from Maps Table
    {
        $stmt = $this->pdo->prepare('SELECT * FROM `Maps`
         WHERE MapID = :MapID');

        $stmt->execute( array('MapID' => $MapID ) );

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Map();
            $itm->ID = $row['ID'];
            $itm->Series = $row['Series'];
            $itm->PublicationYear = $row['PublicationYear'];
            $itm->Scale = $row['Scale'];
            $itm->Dimensions = $row['Dimensions'];
            $itm->ExistSlides = $row['ExistSlides'];
            $itm->ExistPhotos = $row['ExistPhotos'];
            $itm->IsShrinked = $row['IsShrinked'];
            $itm->IsMagnified = $row['IsMagnified'];
            $itm->RightToUse = $row['RightToUse'];
            $itm->CopyrightHeldByApan = $row['CopyrightHeldByApan'];
            $itm->CopyrightHeldBy = $row['CopyrightHeldBy'];
            $itm->Location = $row['Location'];
            // $itm->PrivateData = $row['PrivateData'];
            $itm->SeriesPlainText = $row['SeriesPlainText'];
            $itm->CopyrightHeldByPlainText = $row['CopyrightHeldByPlainText'];
           
           
            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }



      public function getAllMaps($CultureID,$PageSize = NULL, $RecordOffest = NULL) {

        $query = 'SELECT MapID,Title,CultureID  FROM Maps_Details 
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

            $itm = new Map();



            $itm->MapID = $row['MapID'];
            $itm->CultureID = $row['CultureID'];
            $itm->Title = $row['Title'];

          
            $array[$ind] = $itm;

            $ind++;


        }

        return $array;

    }

           public function getAllMapCount($CultureID) {

        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM Maps_Details WHERE CultureID = :CultureID;');
        $result = $stmt->execute( array('CultureID' => $CultureID ));

        //print_r($stmt);
        foreach ($stmt as $row) {
            //print_r($row);
            return $row[0];
        }

        return null;
    }
    
    
    //function called when user search with their filters in Map list page.
    public function getSearchMaps($CultureID,$search_peram,$PageSize = NULL, $RecordOffest = NULL) {
        $query = 'SELECT MapID,Title,CultureID  FROM Maps_Details md ';
        $where = " WHERE md.CultureID = :CultureID ";

        //for keywords filter
        if (isset($search_peram['keywords']) && !empty($search_peram['keywords'])) {
            $keyword_search_type = (isset($search_peram['keyword_search_type']) && $search_peram['keyword_search_type']) ? $search_peram['keyword_search_type'] : '';
            if ($keyword_search_type == "and") {
                $keyword_count = count($search_peram['keywords']);
                $query .= sprintf(" JOIN (SELECT RecordID FROM keywords_per_record WHERE keywords_per_record.TableName = 'tMaps' AND keywords_per_record.KeywordID IN (%s) ", implode(",", $search_peram['keywords']));
                $query .= " GROUP BY keywords_per_record.RecordID HAVING COUNT(*) = $keyword_count)k ON k.RecordID = md.MapID ";
            } else {
                $query .= ' LEFT JOIN keywords_per_record ON keywords_per_record.TableName = "tMaps" AND keywords_per_record.RecordID = md.MapID ';
                $where .= sprintf(" AND keywords_per_record.KeywordID IN (%s) ", implode(",", $search_peram['keywords']));
            }
        }
        
        //for map kind filter
        if (isset($search_peram['maps_kinds']) && !empty($search_peram['maps_kinds'])) {
            if ($search_peram['maps_kinds_type'] == "and") {
                $kinds_count = count($search_peram['maps_kinds']);
                $query .= sprintf(" JOIN (SELECT ItemID FROM MapToKinds WHERE MapToKinds.ChoiceID IN (%s) ", implode(",", $search_peram['maps_kinds']));
                $query .= " GROUP BY MapToKinds.ItemID HAVING COUNT(*) = $kinds_count)k ON k.ItemID = md.MapID ";
            } else if ($search_peram['maps_kinds_type'] == "or") {
                $query .= ' LEFT JOIN MapToKinds ON MapToKinds.ItemID = md.MapID ';
                $where .= sprintf(" AND MapToKinds.ChoiceID IN (%s) ", implode(",", $search_peram['maps_kinds']));
            }
        }

        //for objects which have relation with archived object
        if (isset($search_peram['MainUnities']) && $search_peram['MainUnities']) {
            $query .= "LEFT JOIN accompanyingObjectsPerArchivedObjects 
                      ON accompanyingObjectsPerArchivedObjects.accompanyingObjectID = md.MapID
                      LEFT JOIN archivedobjects 
                      ON accompanyingObjectsPerArchivedObjects.archivedObjectID = archivedobjects.ArchivedObjectID
                      LEFT JOIN items 
                      ON items.itemID = archivedobjects.ArchivedObjectID
                      LEFT JOIN itemtypes 
                      ON items.itemTypeID = itemtypes.itemTypeID ";
            $_mainUnities = implode(",", $search_peram['MainUnities']);
            if (strpos($_mainUnities, 'REGIONS') !== false) {
                $where .= "  AND archivedobjects.IsRegion = 1";

                $_mainUnities = str_replace("REGIONS,", "", $_mainUnities);
                $_mainUnities = str_replace("REGIONS", "", $_mainUnities);
            }
            if (!IsNullOrEmpty($_mainUnities)) {
                $where .= sprintf(" AND items.itemTypeID IN (%s) ", $_mainUnities);
            }
        }
        
        if (isset($search_peram['title']) && $search_peram['title']) {
            $title_type = (isset($search_peram['title_type']) && $search_peram['title_type']) ? $search_peram['title_type'] : '';
            $t =addslashes(preg_quote($search_peram['title']));
            $words = preg_split('/\s+/', $t);
            if ($title_type == "or") {
                $where .= sprintf(" AND md.Title REGEXP '%s' ", implode("|", $words));
            } else if ($title_type == "and") {
                $where .= " AND md.Title like '%" . implode("%", $words) . "%'";
            } else if ($title_type == "exact") {
                $where .= " AND md.Title like '%$t%' ";
            }
        }
        
        // where conditions added to query
        $query .= $where.' GROUP BY md.MapID ';
            if(is_numeric($PageSize) && is_numeric($RecordOffest))
        {
            $query .= " LIMIT " .  $RecordOffest . "," . $PageSize;
        }
        
//        echo $query;
        $stmt = $this->pdo->prepare($query);
        $result = $stmt->execute( array('CultureID' => $CultureID ));
        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            $itm = new Map();
            $itm->MapID = $row['MapID'];
            $itm->CultureID = $row['CultureID'];
            $itm->Title = $row['Title'];
            $array[$ind] = $itm;
            $ind++;
        }
        return $array;
    }
}