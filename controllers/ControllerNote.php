<?php

class ControllerNote {

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        
    }




    public function getNotesDetailsWithID($NoteID, $CultureID) 
    {

        $stmt = $this->pdo->prepare('SELECT * FROM `Notes_Details`
        WHERE NoteID = :NoteID AND CultureID = :CultureID; ');

        $result = $stmt->execute( array('NoteID' => $NoteID , 'CultureID' => $CultureID ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Note();
            $itm->NoteID = $row['NoteID'];
            $itm->cultureID = $row['cultureID'];
            $itm->Abbreviation = $row['Abbreviation'];
            $itm->title = $row['Title'];
            $itm->subtitle = $row['Subtitle'];
            $itm->Authors = $row['Authors'];
            $itm->Translators = $row['Translators'];
            $itm->Content = $row['Content'];
            $itm->SubmissionInfo = $row['SubmissionInfo'];
            $itm->UsageInfo = $row['UsageInfo'];
            $itm->OtherOwners = $row['OtherOwners'];
            $itm->Notes = $row['Notes'];
            $itm->CommentsPlainText = $row['CommentsPlainText'];

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }

       public function getAllNoteCount($CultureID) {

        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM Notes_Details WHERE CultureID = :CultureID;');
        $result = $stmt->execute( array('CultureID' => $CultureID ));

        //print_r($stmt);
        foreach ($stmt as $row) {
            //print_r($row);
            return $row[0];
        }

        return null;
    }



      public function getAllNotes($CultureID,$PageSize = NULL, $RecordOffest = NULL) {

       $query = 'SELECT NoteID,title,CultureID  FROM Notes_Details WHERE CultureID = :CultureID';
       
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

            $itm = new Note();



            $itm->NoteID = $row['NoteID'];
            $itm->CultureID = $row['CultureID'];
            $itm->title = $row['title'];

          
            $array[$ind] = $itm;

            $ind++;


        }

        return $array;

    }






    public function getNotesWithID($NoteID) 
    {

        $stmt = $this->pdo->prepare('SELECT * FROM `Notes`
        WHERE NoteID = :NoteID; ');

        $result = $stmt->execute( array('NoteID' => $NoteID ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Note();
            $itm->NoteID = $row['NoteID'];
            $itm->PageNumber = $row['PageNumber'];
            $itm->IsExcerpt = $row['IsExcerpt'];
            $itm->ExcerptPages = $row['ExcerptPages'];
            $itm->Location = $row['Location'];
            $itm->CopyrightHeldByApan = $row['CopyrightHeldByApan'];
            $itm->CopyrightHeldBy = $row['CopyrightHeldBy'];
            $itm->PrivateData = $row['PrivateData'];
            $itm->CopyrightHeldByPlainText = $row['CopyrightHeldByPlainText'];
        

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }




    public function getKeywordForNotes($KeywordPerRecordID, $CultureID){   

        $stmt = $this->pdo->prepare('SELECT `keywords_per_record`.`RecordID`,
             `keywords_per_record`.`KeywordID`,`keywords_details`.`KeywordID`,
             `keywords_details`.`KeywordTranslation`,`keywords_details`.`CultureID`
            FROM `keywords_per_record` 
            INNER JOIN `keywords_details`
            ON `keywords_per_record`.`KeywordID` = `keywords_details`.`KeywordID`
            WHERE `keywords_per_record`.`RecordID` = :KeywordPerRecordID AND `keywords_details`.`CultureID` = :CultureID;');

        $stmt->execute( array('KeywordPerRecordID' => $KeywordPerRecordID , 'CultureID' => $CultureID ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Note();
            $itm->RecordID = $row['RecordID'];
            $itm->KeywordID = $row['KeywordID'];
            $itm->CultureID = $row['CultureID'];
            $itm->KeywordTranslation = $row['KeywordTranslation'];
           

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }  


   public function getCharacterizationOfNote($ItemID, $CultureID)  
    {

        $stmt = $this->pdo->prepare('SELECT * FROM `accObjectsToCharacterization` 
            INNER JOIN accObjectsCharacterization_details ON accObjectsToCharacterization.ChoiceID = accObjectsCharacterization_details.accompanyingObjectCharactID 
            WHERE ItemID = :ItemID AND CultureID = :CultureID ');

        $result = $stmt->execute( array('ItemID' => $ItemID , 'CultureID' => $CultureID ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Note();
            $itm->ItemID = $row['ItemID'];
            $itm->cultureID = $row['cultureID'];
            $itm->ChoiceID = $row['ChoiceID'];
            $itm->characterization = $row['lookupValue'];
            
            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }


          public function getAllCharacterizationOfNotes($CultureID)  
    {

        $stmt = $this->pdo->prepare('SELECT accObjectsCharacterization_details.*,accObjectsCharacterization.*
        FROM `accObjectsCharacterization` 
            INNER JOIN accObjectsCharacterization_details 
            ON accObjectsCharacterization.accObjCharacterizationID = accObjectsCharacterization_details.accompanyingObjectCharactID 
            WHERE CultureID = :CultureID AND accObjectsCharacterization.itemTypeID = 7');

        $result = $stmt->execute( array('CultureID' => $CultureID ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Note();
            $itm->accObjCharacterizationID = $row['accObjCharacterizationID'];
            $itm->cultureID = $row['cultureID'];
//            $itm->ChoiceID = $row['ChoiceID'];
            $itm->lookupValue = $row['lookupValue'];
            
            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }






          public function getAllPublicationsTypeNotes($CultureID)  
    {

        $stmt = $this->pdo->prepare('SELECT *
        FROM `NotePublicationTypes_Details` WHERE CultureID = :CultureID');

        $result = $stmt->execute( array('CultureID' => $CultureID ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Note();
            $itm->NotePublicationTypeID = $row['NotePublicationTypeID'];
            $itm->CultureID = $row['CultureID'];
            $itm->LookupValue = $row['LookupValue'];
            
            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }

   public function getPublicationTypeOfNote($ItemID, $CultureID)  
    {

        $stmt = $this->pdo->prepare('SELECT * FROM `NotePublicationTypesToObjects` 
            INNER JOIN NotePublicationTypes_Details ON NotePublicationTypesToObjects.ChoiceID = NotePublicationTypes_Details.NotePublicationTypeID 
            WHERE ItemID = :ItemID AND CultureID = :CultureID; ');

        $result = $stmt->execute( array('ItemID' => $ItemID , 'CultureID' => $CultureID ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Note();
            $itm->ItemID = $row['ItemID'];
            $itm->cultureID = $row['cultureID'];
            $itm->ChoiceID = $row['ChoiceID'];
            $itm->NotePublicationTypeID = $row['NotePublicationTypeID'];
            $itm->publicationType = $row['LookupValue'];

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }
    
    //function called when user search with their filters in Note list page.
    public function getSearchNotes($CultureID,$search_peram,$PageSize = NULL, $RecordOffest = NULL) {

       $query = 'SELECT nd.NoteID,nd.title,nd.CultureID  FROM Notes_Details nd ';
       $where = " WHERE nd.cultureID = :cultureID ";
        
        //for character filter
        if (isset($search_peram['characters']) && !empty($search_peram['characters'])) {
            if ($search_peram['character_search_type'] == 'and') {
                $character_count = count($search_peram['characters']);
                $query .= sprintf(" JOIN (SELECT ItemID FROM accObjectsToCharacterization WHERE  accObjectsToCharacterization.ChoiceID IN (%s) ", implode(",", $search_peram['characters']));
                $query .= " GROUP BY accObjectsToCharacterization.ItemID HAVING COUNT(*) = $character_count) ch ON ch.ItemID = nd.NoteID ";
            } else if ($search_peram['character_search_type'] == 'or') {
                $query .= ' LEFT JOIN accObjectsToCharacterization ON nd.NoteID = accObjectsToCharacterization.ItemID ';
                $where .= sprintf(" AND accObjectsToCharacterization.ChoiceID IN (%s)", implode(",", $search_peram['characters']));
            }
        }
        
        //for keywords filter
        if (isset($search_peram['keywords']) && !empty($search_peram['keywords'])) {
            $keyword_search_type = (isset($_POST['keyword_search_type']) && $_POST['keyword_search_type']) ? $_POST['keyword_search_type'] : '';
            if ($keyword_search_type == "and") {
                $keyword_count = count($search_peram['keywords']);
                $query .= sprintf(" JOIN (SELECT RecordID FROM keywords_per_record WHERE keywords_per_record.TableName = 'tNotes' AND keywords_per_record.KeywordID IN (%s) ", implode(",", $search_peram['keywords']));
                $query .= " GROUP BY keywords_per_record.RecordID HAVING COUNT(*) = $keyword_count)k ON k.RecordID = nd.NoteID ";
            } else {
                $query .= ' LEFT JOIN keywords_per_record ON keywords_per_record.TableName = "tNotes" AND keywords_per_record.RecordID = nd.NoteID ';
                $where .= sprintf(" AND keywords_per_record.KeywordID IN (%s) ", implode(",", $search_peram['keywords']));
            }
        }
        
        //for publicationTypes filter
        if (isset($search_peram['publicationTypes']) && !empty($search_peram['publicationTypes'])) {
            if ($search_peram['publication_search_type'] == 'and') {
                $publication_count = count($search_peram['publicationTypes']);
                $query .= sprintf(" JOIN (SELECT ItemID FROM NotePublicationTypesToObjects WHERE ChoiceID IN (%s) ", implode(",", $search_peram['publicationTypes']));
                $query .= " GROUP BY ItemID HAVING COUNT(*) = $publication_count) npt ON npt.ItemID = nd.NoteID ";
            } else if ($search_peram['publication_search_type'] == 'or') {
                $query .= ' LEFT JOIN NotePublicationTypesToObjects npt ON nd.NoteID = npt.ItemID ';
                $where .= sprintf(" AND npt.ChoiceID IN (%s)", implode(",", $search_peram['publicationTypes']));
            }
        }

        //for objects which have relation with archived object
        if (isset($search_peram['MainUnities']) && $search_peram['MainUnities']) {
            $query .= "LEFT JOIN accompanyingObjectsPerArchivedObjects 
                      ON accompanyingObjectsPerArchivedObjects.accompanyingObjectID = nd.NoteID
                      LEFT JOIN archivedobjects 
                      ON accompanyingObjectsPerArchivedObjects.archivedObjectID = archivedobjects.ArchivedObjectID
                      LEFT JOIN items 
                      ON items.itemID = archivedobjects.ArchivedObjectID
                      LEFT JOIN itemtypes 
                      ON items.itemTypeID = itemtypes.itemTypeID ";
            $_mainUnities = implode(",", $_POST['MainUnities']);
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
            $title_type = (isset($_POST['title_type']) && $_POST['title_type']) ? $_POST['title_type'] : '';
            $t =addslashes(preg_quote($search_peram['title']));
            $words = preg_split('/\s+/', $t);
            if ($title_type == "or") {
                $where .= sprintf(" AND nd.title REGEXP '%s' ", implode("|", $words));
            } else if ($title_type == "and") {
                $where .= " AND nd.title like '%" . implode("%", $words) . "%'";
            } else if ($title_type == "exact") {
                $where .= " AND nd.title like '%$t%' ";
            }
        }
        
        if (isset($search_peram['abbreviation']) && $search_peram['abbreviation']) {
            $abbr_type = (isset($search_peram['abbreviation_search_type']) && $search_peram['abbreviation_search_type']) ? $search_peram['abbreviation_search_type'] : '';
            $abbr = addslashes(preg_quote($search_peram['abbreviation']));
            $abbr_words = preg_split('/\s+/', $abbr);
            if ($abbr_type == "or") {
                $where .= sprintf(" AND nd.abbreviation REGEXP '%s' ", implode("|", $abbr_words));
            } else if ($abbr_type == "and") {
                $where .= " AND nd.abbreviation like '%" . implode("%", $abbr_words) . "%'";
            } else if ($abbr_type == "exact") {
                $where .= " AND nd.abbreviation like '%$abbr%' ";
            }
        }
        
        // where conditions added to query
        $query .= $where;
        $query .= ' GROUP BY nd.NoteID ';
        if (is_numeric($PageSize) && is_numeric($RecordOffest)) {
            //echo '2:' . $PageSize . ' ' . $RecordOffest ;
            $query .= " LIMIT " . $RecordOffest . "," . $PageSize;
        }
//        print_r($search_peram);
//        echo $query;

        $stmt = $this->pdo->prepare($query);
        $result = $stmt->execute( array('cultureID' => $CultureID ));
        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            $itm = new Note();
            $itm->NoteID = $row['NoteID'];
            $itm->CultureID = $row['CultureID'];
            $itm->title = $row['title'];
            $array[$ind] = $itm;
            $ind++;
        }
        return $array;

    }

}