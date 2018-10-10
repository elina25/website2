<?php

class ControllerBibliography {

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        
    }

    public function getBibliographyWithID($bibliographyID) {

        $stmt = $this->pdo->prepare('SELECT * FROM `bibliographies`
            WHERE bibliographyID = :bibliographyID; ');

        $result = $stmt->execute(array('bibliographyID' => $bibliographyID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new Bibliography();
            $itm->bibliographyID = $row['bibliographyID'];
            $itm->abbreviation = $row['abbreviation'];
            $itm->authors = $row['authors'];
            $itm->title = $row['title'];
            $itm->subtitle = $row['subtitle'];
            $itm->firstPublisher = $row['firstPublisher'];
            $itm->originalTitle = $row['originalTitle'];
            $itm->ISBN_ISDN = $row['ISBN_ISDN'];
            $itm->documentFormID = $row['documentFormID'];
            $itm->volume = $row['volume'];
            $itm->scientificEditor = $row['scientificEditor'];
            $itm->translator = $row['translator'];
            $itm->pages = $row['pages'];
            $itm->publisher = $row['publisher'];
            $itm->issue = $row['issue'];
            $itm->editionNumber = $row['editionNumber'];
            $itm->collectiveWork = $row['collectiveWork'];
            $itm->publicationPlace = $row['publicationPlace'];
            $itm->publicationYear = $row['publicationYear'];
            $itm->firstPublicationPlace = $row['firstPublicationPlace'];
            $itm->firstPublicationYear = $row['firstPublicationYear'];
            $itm->abbreviationPlainText = $row['abbreviationPlainText'];
            $itm->titlePlainText = $row['titlePlainText'];
            $itm->originalTitlePlainText = $row['originalTitlePlainText'];
            $itm->journalPlainText = $row['journalPlainText'];
            $itm->isSource = $row['isSource'];





            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getDocumentFormIDWithID($bibliographyID, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT bibliographiesDocumentForms_details.*, bibliographies.*
            FROM `bibliographies`
            LEFT OUTER JOIN bibliographiesDocumentForms_details
            ON `bibliographies`.`documentFormID` = `bibliographiesDocumentForms_details`.`bibliographyDocumentFormID`
            WHERE bibliographyID = :bibliographyID AND bibliographiesDocumentForms_details.CultureID =:CultureID');

        $result = $stmt->execute(array('bibliographyID' => $bibliographyID, 'CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new Bibliography();
            $itm->CultureID = $row['CultureID'];
            $itm->lookupValue = $row['lookupValue'];





            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getBibliographyDetailsWithID($bibliographyID, $cultureID) {

        $stmt = $this->pdo->prepare('SELECT * FROM `bibliographies_details`
        WHERE bibliographyID = :bibliographyID AND cultureID = :cultureID; ');

        $result = $stmt->execute(array('bibliographyID' => $bibliographyID, 'cultureID' => $cultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new Bibliography();
            $itm->bibliographyID = $row['bibliographyID'];
            $itm->cultureID = $row['cultureID'];
            $itm->comments = $row['comments'];
            $itm->elements = $row['elements'];
            $itm->elementsPlainText = $row['elementsPlainText'];
            $itm->commentsPlainText = $row['commentsPlainText'];

            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getAllBibliography($CultureID, $PageSize = NULL, $RecordOffest = NULL) {

        $query = 'SELECT bibliographies_details.bibliographyID,title,cultureID  FROM bibliographies_details
                    INNER JOIN bibliographies ON `bibliographies_details`.`bibliographyID` = `bibliographies`.`bibliographyID`
                    WHERE CultureID = :CultureID';

        //echo '1:' . $PageSize . ' ' . $RecordOffest ;

        if (is_numeric($PageSize) && is_numeric($RecordOffest)) {
            //echo '2:' . $PageSize . ' ' . $RecordOffest ;
            $query .= " LIMIT " . $RecordOffest . "," . $PageSize;
        }

        $stmt = $this->pdo->prepare($query);

        $result = $stmt->execute(array('CultureID' => $CultureID));
        $array = array();

        $ind = 0;

        foreach ($stmt as $row) {

            $itm = new Bibliography();

            $itm->bibliographyID = $row['bibliographyID'];
            $itm->CultureID = $row['cultureID'];
            $itm->title = $row['title'];


            $array[$ind] = $itm;

            $ind++;
        }

        return $array;
    }

//QUERY FOR FILTERS BIBLIOGRAPHY LIST
    public function getAllBibliography2($CultureID, $FilterObject, $PageSize = NULL, $RecordOffest = NULL) {

        $query = 'SELECT DISTINCT bibliographies_details.bibliographyID,bibliographies.authors,bibliographies.title,bibliographies_details.cultureID  FROM bibliographies_details
                    INNER JOIN bibliographies 
                    ON `bibliographies_details`.`bibliographyID` = `bibliographies`.`bibliographyID`
                    LEFT JOIN accompanyingObjectsPerArchivedObjects 
                    ON accompanyingObjectsPerArchivedObjects.accompanyingObjectID = bibliographies.bibliographyID
                    LEFT JOIN archivedobjects 
                    ON accompanyingObjectsPerArchivedObjects.archivedObjectID = archivedobjects.ArchivedObjectID
                    LEFT JOIN items 
                    ON items.itemID = archivedobjects.ArchivedObjectID
                    LEFT JOIN itemtypes 
                    ON items.itemTypeID = itemtypes.itemTypeID
                    LEFT JOIN bibliographiesDocumentForms_details
                    ON bibliographiesDocumentForms_details.bibliographyDocumentFormID = bibliographies.documentFormID
                    LEFT JOIN keywords_per_record 
                    ON keywords_per_record.TableName = "tBibliographies" AND keywords_per_record.RecordID = bibliographies.bibliographyID
                    WHERE bibliographies_details.CultureID = :CultureID';


        if (isset($FilterObject) && $FilterObject != null) {
//                    echo json_encode($FilterObject);
            if ($FilterObject->abbreviation)
                $query .= sprintf(" AND bibliographies.abbreviation LIKE '%s' ", $FilterObject->abbreviation);
            if ($FilterObject->Title)
                $query .= sprintf(" AND bibliographies.title LIKE '%s' ", $FilterObject->Title);
            if ($FilterObject->authors)
                $query .= sprintf(" AND bibliographies.authors LIKE '%s' ", $FilterObject->authors);

            if (!IsNullOrEmpty($FilterObject->MainUnities)) {
                $_mainUnities = $FilterObject->MainUnities;
                if (strpos($FilterObject->MainUnities, 'REGIONS') !== false) {
                    $query .= "  AND archivedobjects.IsRegion = 1";

                    $_mainUnities = str_replace("REGIONS,", "", $_mainUnities);
                    $_mainUnities = str_replace("REGIONS", "", $_mainUnities);
                }
                if (!IsNullOrEmpty($_mainUnities)) {
                    $query .= sprintf(" AND items.itemTypeID IN (%s) ", $_mainUnities);
                }
            }

            if (!IsNullOrEmpty($FilterObject->documentForms)) {
                $query .= sprintf(" AND bibliographiesDocumentForms_details.bibliographyDocumentFormID IN (%s) ", $FilterObject->documentForms);
            }
            if (!IsNullOrEmpty($FilterObject->Keywords)) {
                $keyword_search_type = (isset($_POST['keyword_search_type']) && $_POST['keyword_search_type']) ? $_POST['keyword_search_type'] : '';
                if ($keyword_search_type == "or")
                    $query .= sprintf(" AND keywords_per_record.KeywordID IN (%s) ", $FilterObject->Keywords);
                else if ($keyword_search_type == "and")
                    $query .= sprintf(" AND keywords_per_record.KeywordID IN (%s) ", $FilterObject->Keywords);
            }
        }

        if (is_numeric($PageSize) && is_numeric($RecordOffest)) {
            //echo '2:' . $PageSize . ' ' . $RecordOffest ;
            $query .= " LIMIT " . $RecordOffest . "," . $PageSize;
        }
//        echo isset($FilterObject) ? $FilterObject->MainUnities : '';
        $stmt = $this->pdo->prepare($query);

        error_log($query);

//        print_r($stmt);exit;

        $stmt->execute(array('CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new Bibliography();
            $itm->bibliographyID = $row['bibliographyID'];
            $itm->CultureID = $row['cultureID'];
            $itm->title = $row['title'];


            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getAllBibliographyCount($CultureID) {

        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM bibliographies_details WHERE CultureID = :CultureID;');
        $result = $stmt->execute(array('CultureID' => $CultureID));

        //print_r($stmt);
        foreach ($stmt as $row) {
            //print_r($row);
            return $row[0];
        }

        return null;
    }

    public function getAllBibliographyDocumentForms($CultureID) {

        $query = 'SELECT *  FROM bibliographiesDocumentForms_details
                   
                    WHERE CultureID = :CultureID';



        $stmt = $this->pdo->prepare($query);

        $result = $stmt->execute(array('CultureID' => $CultureID));
        $array = array();

        $ind = 0;

        foreach ($stmt as $row) {

            $itm = new Bibliography();

            $itm->bibliographyDocumentFormID = $row['bibliographyDocumentFormID'];
            $itm->CultureID = $row['CultureID'];
            $itm->lookupValue = $row['lookupValue'];


            $array[$ind] = $itm;

            $ind++;
        }

        return $array;
    }

    public function getKeywordForAllBibliographies($CultureID) {   //GET KEYWORDS FOR ACCOMPANYING OBJECT
        $stmt = $this->pdo->prepare("SELECT distinct keywords_per_record.KeywordID, keywords_per_record.TableName,
                             keywords_details.KeywordTranslation, keywords_details.KeywordID, keywords_details.CultureID
                            FROM `keywords_per_record` 
                            INNER JOIN keywords_details
                            ON `keywords_per_record`.`KeywordID` = `keywords_details`.`KeywordID`
                            WHERE TableName LIKE 'tBibliographies'  AND CultureID =:CultureID ;");

        $stmt->execute(array('CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new Keyword();
            $itm->KeywordID = $row['KeywordID'];
            $itm->TableName = $row['TableName'];
            $itm->CultureID = $row['CultureID'];
            $itm->KeywordTranslation = $row['KeywordTranslation'];



            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getSearchBibliography($cultureID, $search_peram, $PageSize = NULL, $RecordOffest = NULL) {

        $query = 'SELECT bd.bibliographyID,bibliographies.authors,bibliographies.title,bd.cultureID  FROM bibliographies_details bd
                    INNER JOIN bibliographies 
                    ON `bd`.`bibliographyID` = `bibliographies`.`bibliographyID`
                    LEFT JOIN accompanyingObjectsPerArchivedObjects 
                    ON accompanyingObjectsPerArchivedObjects.accompanyingObjectID = bibliographies.bibliographyID
                    LEFT JOIN archivedobjects 
                    ON accompanyingObjectsPerArchivedObjects.archivedObjectID = archivedobjects.ArchivedObjectID
                    LEFT JOIN items 
                    ON items.itemID = archivedobjects.ArchivedObjectID
                    LEFT JOIN itemtypes 
                    ON items.itemTypeID = itemtypes.itemTypeID
                    LEFT JOIN bibliographiesDocumentForms
                    ON bibliographiesDocumentForms.documentFormID = bibliographies.documentFormID                    
                    ';
        $where=" WHERE bd.cultureID = :cultureID";

        //for keywords all match
        if (isset($search_peram['keywords']) && !empty($search_peram['keywords'])) {
            $keyword_search_type = (isset($_POST['keyword_search_type']) && $_POST['keyword_search_type']) ? $_POST['keyword_search_type'] : '';
            if ($keyword_search_type == "and") {
                $keyword_count = count($search_peram['keywords']);
                $query .= sprintf(" JOIN (SELECT RecordID FROM keywords_per_record WHERE keywords_per_record.TableName = 'tBibliographies' AND keywords_per_record.KeywordID IN (%s) ", implode(",", $search_peram['keywords']));
                $query .= " GROUP BY keywords_per_record.RecordID HAVING COUNT(*) = $keyword_count)k ON k.RecordID = bibliographies.bibliographyID ";
            } else {
                $query .= ' LEFT JOIN keywords_per_record ON keywords_per_record.TableName = "tBibliographies" AND keywords_per_record.RecordID = bd.bibliographyID ';
                $where .= sprintf(" AND keywords_per_record.KeywordID IN (%s) ", implode(",", $search_peram['keywords']));
            }
        }

        $query .= $where;

        //for objects which have relation with archived object
        if (isset($search_peram['MainUnities']) && $search_peram['MainUnities']) {
            $_mainUnities = implode(",", $_POST['MainUnities']);
            if (strpos($_mainUnities, 'REGIONS') !== false) {
                $query .= "  AND archivedobjects.IsRegion = 1";

                $_mainUnities = str_replace("REGIONS,", "", $_mainUnities);
                $_mainUnities = str_replace("REGIONS", "", $_mainUnities);
            }
            if (!IsNullOrEmpty($_mainUnities)) {
                $query .= sprintf(" AND items.itemTypeID IN (%s) ", $_mainUnities);
            }
        }
        
        if (isset($search_peram['abbreviation']) && $search_peram['abbreviation']) {
            $abbreviation_type = (isset($_POST['abbreviation_type']) && $_POST['abbreviation_type']) ? $_POST['abbreviation_type'] : '';
            $ab = $search_peram['abbreviation'];
            $words = preg_split('/\s+/', $ab);
            if ($abbreviation_type == "or") {
                $query .= sprintf(" AND bibliographies.abbreviation RLIKE '%s' ", implode("|", $words));
            } else if ($abbreviation_type == "and") {
                $query .= " AND bibliographies.abbreviation like '%" . implode("%", $words) . "%'";
            } else if ($abbreviation_type == "exact") {
                $query .= " AND bibliographies.abbreviation like '%$ab%' ";
            }
        }
        
        if (isset($search_peram['documentForms']) && !IsNullOrEmpty($search_peram['documentForms'])) {
            $query .= sprintf(" AND bibliographiesDocumentForms.documentFormID IN (%s) ", implode(",", $search_peram['documentForms']));
        }
        
        if (isset($search_peram['authors']) && $search_peram['authors']) {
            $author_type = (isset($_POST['author_type']) && $_POST['author_type']) ? $_POST['author_type'] : '';
            $at = $search_peram['authors'];
            $words = preg_split('/\s+/', $at);
            if ($author_type == "or") {
                $query .= sprintf(" AND bibliographies.authors RLIKE '%s' ", implode("|", $words));
            } else if ($author_type == "and") {
                $query .= " AND bibliographies.authors like '%" . implode("%", $words) . "%'";
            } else if ($author_type == "exact") {
                $query .= " AND bibliographies.authors like '%$at%' ";
            }
        }
        
        if (isset($search_peram['title']) && $search_peram['title']) {
            $title_type = (isset($_POST['title_type']) && $_POST['title_type']) ? $_POST['title_type'] : '';
            $t = $search_peram['title'];
            $words = preg_split('/\s+/', $t);
            if ($title_type == "or") {
                $query .= sprintf(" AND bibliographies.title RLIKE '%s' ", implode("|", $words));
            } else if ($title_type == "and") {
                $query .= " AND bibliographies.title like '%" . implode("%", $words) . "%'";
            } else if ($title_type == "exact") {
                $query .= " AND bibliographies.title like '%$t%' ";
            }
        }

//        //for characters any of the match
//        if (isset($search_peram['characters']) && $search_peram['characters'] && $search_peram['character_search_type'] == 'or') {
//            $query .= sprintf(" AND accObjectsToCharacterization.ChoiceID IN (%s)", implode(",", $search_peram['characters']));
//        }
//        //for keywords any of the match
//        if (isset($search_peram['keywords']) && !empty($search_peram['keywords']) && $_POST['keyword_search_type'] == "or") {
//            $query .= sprintf(" AND keywords_per_record.KeywordID IN (%s) ", implode(",", $search_peram['keywords']));
//        }

        

        $query .= ' GROUP BY bd.bibliographyID';
        if (is_numeric($PageSize) && is_numeric($RecordOffest)) {
            //echo '2:' . $PageSize . ' ' . $RecordOffest ;
            $query .= " LIMIT " . $RecordOffest . "," . $PageSize;
        }
//        print_r($search_peram);
//        echo $query;
        $stmt = $this->pdo->prepare($query);

        $result = $stmt->execute(array('cultureID' => $cultureID));
        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {

            $itm = new Bibliography();

            $itm->bibliographyID = $row['bibliographyID'];
            $itm->cultureID = $row['cultureID'];
            $itm->title = $row['title'];

            $array[$ind] = $itm;
            $ind++;
        }
        return $array;
    }

}

?>