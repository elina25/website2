<?php

class ControllerDocument {

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        
    }

    public function getDetailsDocumentWithID($DocumentID, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT * FROM `Documents_Details`
        WHERE DocumentID = :DocumentID AND CultureID = :CultureID; ');

        $result = $stmt->execute(array('DocumentID' => $DocumentID, 'CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new Document();
            $itm->DocumentID = $row['DocumentID'];
            $itm->cultureID = $row['cultureID'];
            $itm->ID = $row['ID'];
            $itm->title = $row['Title'];
            $itm->subtitle = $row['Subtitle'];
            $itm->Abbreviation = $row['Abbreviation'];
            $itm->Authors = $row['Authors'];
            $itm->Translators = $row['Translators'];
            $itm->SubmissionInfo = $row['SubmissionInfo'];
            $itm->UsageInfo = $row['UsageInfo'];
            $itm->Notes = $row['Notes'];
            $itm->DatesMentioned = $row['DatesMentioned'];
            $itm->Comments = $row['Comments'];
            $itm->CreatedOn = $row['CreatedOn'];
            $itm->Theme = $row['Theme'];
            $itm->CommentsPlainText = $row['CommentsPlainText'];
            $itm->AbbreviationPlainText = $row['AbbreviationPlainText'];
            $itm->TitlePlainText = $row['TitlePlainText'];
            $itm->SubtitlePlainText = $row['SubtitlePlainText'];

            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getAllDocuments($CultureID, $PageSize = NULL, $RecordOffest = NULL) {

        $query = 'SELECT DocumentID,Title,cultureID  FROM Documents_Details
        WHERE CultureID = :CultureID';

        if (is_numeric($PageSize) && is_numeric($RecordOffest)) {
            //echo '2:' . $PageSize . ' ' . $RecordOffest ;
            $query .= " LIMIT " . $RecordOffest . "," . $PageSize;
        }

        $stmt = $this->pdo->prepare($query);

        $result = $stmt->execute(array('CultureID' => $CultureID));
        $array = array();

        $ind = 0;

        foreach ($stmt as $row) {

            $itm = new Document();



            $itm->DocumentID = $row['DocumentID'];
            $itm->CultureID = $row['cultureID'];
            $itm->title = $row['Title'];


            $array[$ind] = $itm;

            $ind++;
        }

        return $array;
    }

    public function getAllDocumentCount($CultureID) {

        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM Documents_Details WHERE CultureID = :CultureID;');
        $result = $stmt->execute(array('CultureID' => $CultureID));

        //print_r($stmt);
        foreach ($stmt as $row) {
            //print_r($row);
            return $row[0];
        }

        return null;
    }

    public function getDocumentWithID($DocumentID) {

        $stmt = $this->pdo->prepare('SELECT *
        FROM `Documents`
        INNER JOIN DocumentLanguages_Details 
        ON DocumentLanguages_Details.DocumentLanguageID = Documents.DocumentLanguageID
       
        WHERE DocumentID = :DocumentID  ');

        $result = $stmt->execute(array('DocumentID' => $DocumentID));

        $array = array();

        foreach ($stmt as $row) {
            //do something with $row
            $itm = new Document();
            $itm->DocumentID = $row['DocumentID'];
            $itm->IsPublished = $row['IsPublished'];
            $itm->PublicationName = $row['PublicationName'];
            $itm->IssueNo = $row['IssueNo'];
            $itm->Pages = $row['Pages'];
            $itm->WebAddress = $row['WebAddress'];
            $itm->WritingYear = $row['WritingYear'];
            $itm->PageNumber = $row['PageNumber'];
            $itm->IsExpert = $row['IsExpert'];
            $itm->CopyrightHeldByApan = $row['CopyrightHeldByApan'];
            $itm->CopyrightHeldBy = $row['CopyrightHeldBy'];
            $itm->PrivateData = $row['PrivateData'];
            $itm->DocumentLanguageID = $row['DocumentLanguageID'];
            $itm->PublicationNamePlainText = $row['PublicationNamePlainText'];
            $itm->CopyrightHeldByPlainText = $row['CopyrightHeldByPlainText'];
            $itm->LookupValue = $row['LookupValue'];
        }

        return $itm;
    }

    public function getKeywordFromAudioVisualID($KeywordPerRecordID, $CultureID) {   //DISPLAY KEYWORDS FOR AUDIOVISUAL
        $stmt = $this->pdo->prepare('SELECT `keywords_per_record`.`RecordID`,
             `keywords_per_record`.`KeywordID`,`keywords_details`.`KeywordID`,
             `keywords_details`.`KeywordTranslation`,`keywords_details`.`CultureID`
            FROM `keywords_per_record` 
            INNER JOIN `keywords_details`
            ON `keywords_per_record`.`KeywordID` = `keywords_details`.`KeywordID`
            WHERE `keywords_per_record`.`RecordID` = :KeywordPerRecordID AND `keywords_details`.`CultureID` = :CultureID;');

        $stmt->execute(array('KeywordPerRecordID' => $KeywordPerRecordID, 'CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new Document();
            $itm->RecordID = $row['RecordID'];
            $itm->KeywordID = $row['KeywordID'];
            $itm->CultureID = $row['CultureID'];
            $itm->KeywordTranslation = $row['KeywordTranslation'];


            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getDocumentSourceWithID($ItemID, $CultureID) { //Get source of documents
        $stmt = $this->pdo->prepare('SELECT DocumentToSources.*, DocumentSources_Details.*
        FROM `DocumentToSources`
        INNER JOIN DocumentSources_Details 
        ON DocumentToSources.ChoiceID = DocumentSources_Details.DocumentSourceID
        WHERE ItemID = :ItemID AND CultureID =:CultureID');

        $stmt->execute(array('ItemID' => $ItemID, 'CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new Document();
            $itm->ChoiceID = $row['ChoiceID'];
            $itm->DocumentSourceID = $row['DocumentSourceID'];
            $itm->CultureID = $row['CultureID'];
            $itm->LookupValue = $row['LookupValue'];




            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getDocumentFormWithID($ItemID, $CultureID) { //Get source of documents
        $stmt = $this->pdo->prepare('SELECT DocumentToForms.*, DocumentForms_Details.*
        FROM `DocumentToForms`
        INNER JOIN DocumentForms_Details 
        ON DocumentToForms.ChoiceID = DocumentForms_Details.DocumentFormID
        WHERE ItemID = :ItemID AND CultureID =:CultureID');

        $stmt->execute(array('ItemID' => $ItemID, 'CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new Document();
            $itm->ChoiceID = $row['ChoiceID'];
            $itm->DocumentFormID = $row['DocumentFormID'];
            $itm->CultureID = $row['CultureID'];
            $itm->LookupValue = $row['LookupValue'];




            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getDocumentOriginWithID($ItemID, $CultureID) {


        $stmt = $this->pdo->prepare('SELECT DocumentToOrigins.*, DocumentOrigins_Details.*
        FROM `DocumentToOrigins`
        INNER JOIN DocumentOrigins_Details 
        ON DocumentToOrigins.ChoiceID = DocumentOrigins_Details.DocumentOriginID
        WHERE ItemID = :ItemID AND CultureID =:CultureID');

        $stmt->execute(array('ItemID' => $ItemID, 'CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new Document();
            $itm->ChoiceID = $row['ChoiceID'];
            $itm->DocumentOriginID = $row['DocumentOriginID'];
            $itm->CultureID = $row['CultureID'];
            $itm->LookupValue = $row['LookupValue'];




            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getDocumentTypeContentWithID($ItemID, $CultureID) { //Get source of documents
        $stmt = $this->pdo->prepare('SELECT DocumentContentToTypes.*, DocumentContentTypes_Details.*
        FROM `DocumentContentToTypes`
        INNER JOIN DocumentContentTypes_Details 
        ON DocumentContentToTypes.ChoiceID = DocumentContentTypes_Details.DocumentContentTypeID
        WHERE ItemID = :ItemID AND CultureID =:CultureID');

        $stmt->execute(array('ItemID' => $ItemID, 'CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new Document();
            $itm->ChoiceID = $row['ChoiceID'];
            $itm->DocumentContentTypeID = $row['DocumentContentTypeID'];
            $itm->CultureID = $row['CultureID'];
            $itm->LookupValue = $row['LookupValue'];

            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getDocumentCharactWithID($ItemID, $CultureID) {


        $stmt = $this->pdo->prepare('SELECT accObjectsToCharacterization.*, accObjectsCharacterization_details.*
        FROM `accObjectsToCharacterization`
        INNER JOIN accObjectsCharacterization_details 
        ON accObjectsToCharacterization.ChoiceID = accObjectsCharacterization_details.accompanyingObjectCharactID
        WHERE ItemID = :ItemID AND CultureID = :CultureID');

        $stmt->execute(array('ItemID' => $ItemID, 'CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new Document();
            $itm->ChoiceID = $row['ChoiceID'];
            $itm->accompanyingObjectCharactID = $row['accompanyingObjectCharactID'];
            $itm->CultureID = $row['CultureID'];
            $itm->LookupValue = $row['lookupValue'];

            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getAllDocumentSources($CultureID) {

        $stmt = $this->pdo->prepare('SELECT * FROM `DocumentSources_Details`
               WHERE CultureID =:CultureID; ');

        $result = $stmt->execute(array('CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new Document();
            $itm->DocumentSourceID = $row['DocumentSourceID'];
            $itm->CultureID = $row['CultureID'];
            $itm->LookupValue = $row['LookupValue'];

            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getAllDocumentContentTypes($CultureID) {

        $stmt = $this->pdo->prepare('SELECT * FROM `DocumentContentTypes_Details`
               WHERE CultureID =:CultureID; ');

        $result = $stmt->execute(array('CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new Document();
            $itm->DocumentContentTypeID = $row['DocumentContentTypeID'];
            $itm->CultureID = $row['CultureID'];
            $itm->LookupValue = $row['LookupValue'];

            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getAllCharacterizationOfDocuments($CultureID) {



        $stmt = $this->pdo->prepare('SELECT accObjectsCharacterization_details.*,accObjectsCharacterization.*

        FROM `accObjectsCharacterization` 

            INNER JOIN accObjectsCharacterization_details 

            ON accObjectsCharacterization.accObjCharacterizationID = accObjectsCharacterization_details.accompanyingObjectCharactID 

            WHERE CultureID = :CultureID AND accObjectsCharacterization.itemTypeID = 6');



        $result = $stmt->execute(array('CultureID' => $CultureID));



        $array = array();

        $ind = 0;

        foreach ($stmt as $row) {


            $itm = new Document();

            $itm->accObjCharacterizationID = $row['accObjCharacterizationID'];

            $itm->cultureID = $row['cultureID'];

            $itm->lookupValue = $row['lookupValue'];



            $array[$ind] = $itm;

            $ind++;
        }
        return $array;
    }

    //function called when user search with their filters in biography list page.
    public function getSearchDocuments($cultureID, $search_peram, $PageSize = NULL, $RecordOffest = NULL) {

        $query = 'SELECT dd.DocumentID,Title,cultureID  FROM Documents_Details dd
                  JOIN Documents d ON (d.DocumentID = dd.DocumentID) ';

        $where = " WHERE dd.cultureID = :CultureID";
        
        //for objects which have relation with archived object
        if (isset($search_peram['MainUnities']) && $search_peram['MainUnities']) {
            $query .= "LEFT JOIN accompanyingObjectsPerArchivedObjects 
                      ON accompanyingObjectsPerArchivedObjects.accompanyingObjectID = dd.DocumentID
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
        
        //for DocumentToSources all match
        if (isset($search_peram['sources']) && !empty($search_peram['sources'])) {
            if ($search_peram['source_search_type'] == 'and') {
                $source_count = count($search_peram['sources']);
                $query .= sprintf(" JOIN (SELECT ItemID FROM DocumentToSources WHERE  DocumentToSources.ChoiceID IN (%s) ", implode(",", $search_peram['sources']));
                $query .= " GROUP BY DocumentToSources.ItemID HAVING COUNT(*) = $source_count) ch ON ch.ItemID = dd.DocumentID ";
            } else if ($search_peram['source_search_type'] == 'or') {
                $query .= ' LEFT JOIN DocumentToSources ON dd.DocumentID = DocumentToSources.ItemID ';
                $where .= sprintf(" AND DocumentToSources.ChoiceID IN (%s)", implode(",", $search_peram['sources']));
            }
        }
        
        //for character all match
        if (isset($search_peram['characters']) && !empty($search_peram['characters'])) {
            if ($search_peram['character_search_type'] == 'and') {
                $character_count = count($search_peram['characters']);
                $query .= sprintf(" JOIN (SELECT ItemID FROM accObjectsToCharacterization WHERE  accObjectsToCharacterization.ChoiceID IN (%s) ", implode(",", $search_peram['characters']));
                $query .= " GROUP BY accObjectsToCharacterization.ItemID HAVING COUNT(*) = $character_count) ch ON ch.ItemID = dd.DocumentID ";
            } else if ($search_peram['character_search_type'] == 'or') {
                $query .= ' LEFT JOIN accObjectsToCharacterization ON dd.DocumentID = accObjectsToCharacterization.ItemID ';
                $where .= sprintf(" AND accObjectsToCharacterization.ChoiceID IN (%s)", implode(",", $search_peram['characters']));
            }
        }
        
        //for DocumentContentToTypes all match
        if (isset($search_peram['content_types']) && !empty($search_peram['content_types'])) {
            if ($search_peram['content_type_search_type'] == 'and') {
                $content_type_count = count($search_peram['content_types']);
                $query .= sprintf(" JOIN (SELECT ItemID FROM DocumentContentToTypes WHERE  DocumentContentToTypes.ChoiceID IN (%s) ", implode(",", $search_peram['content_types']));
                $query .= " GROUP BY DocumentContentToTypes.ItemID HAVING COUNT(*) = $content_type_count) ch ON ch.ItemID = dd.DocumentID ";
            } else if ($search_peram['content_type_search_type'] == 'or') {
                $query .= ' LEFT JOIN DocumentContentToTypes ON dd.DocumentID = DocumentContentToTypes.ItemID ';
                $where .= sprintf(" AND DocumentContentToTypes.ChoiceID IN (%s)", implode(",", $search_peram['content_types']));
            }
        }

        //for keywords all match
        if (isset($search_peram['keywords']) && !empty($search_peram['keywords'])) {
            $keyword_search_type = (isset($_POST['keyword_search_type']) && $_POST['keyword_search_type']) ? $_POST['keyword_search_type'] : '';
            if ($keyword_search_type == "and") {
                $keyword_count = count($search_peram['keywords']);
                $query .= sprintf(" JOIN (SELECT RecordID FROM keywords_per_record WHERE keywords_per_record.TableName = 'tDocuments' AND keywords_per_record.KeywordID IN (%s) ", implode(",", $search_peram['keywords']));
                $query .= " GROUP BY keywords_per_record.RecordID HAVING COUNT(*) = $keyword_count)k ON k.RecordID = dd.DocumentID ";
            } else {
                $query .= ' LEFT JOIN keywords_per_record ON keywords_per_record.TableName = "tDocuments" AND keywords_per_record.RecordID = dd.DocumentID ';
                $where .= sprintf(" AND keywords_per_record.KeywordID IN (%s) ", implode(",", $search_peram['keywords']));
            }
        }        

        // where conditions added to query
        $query .= $where;

        if (isset($search_peram['title']) && $search_peram['title']) {
            $title_type = (isset($_POST['title_type']) && $_POST['title_type']) ? $_POST['title_type'] : '';
            $t = $search_peram['title'];
            $words = preg_split('/\s+/', $t);
            if ($title_type == "or") {
                $query .= sprintf(" AND dd.Title RLIKE '%s' ", implode("|", $words));
            } else if ($title_type == "and") {
                $query .= " AND dd.Title like '%" . implode("%", $words) . "%'";
            } else if ($title_type == "exact") {
                $query .= " AND dd.Title like '%$t%' ";
            }
        }

        $query .= ' GROUP BY dd.DocumentID ';
        if (is_numeric($PageSize) && is_numeric($RecordOffest)) {
            //echo '2:' . $PageSize . ' ' . $RecordOffest ;
            $query .= " LIMIT " . $RecordOffest . "," . $PageSize;
        }
        $stmt = $this->pdo->prepare($query);

        $result = $stmt->execute(array('CultureID' => $cultureID));
        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            $itm = new Document();
            $itm->DocumentID = $row['DocumentID'];
            $itm->CultureID = $row['cultureID'];
            $itm->title = $row['Title'];
            $array[$ind] = $itm;
            $ind++;
        }
        return $array;
    }

}
