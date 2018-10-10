<?php

class ControllerPrintedHandwrittenDoc {

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        
    }

    public function getPrintedOrHandwrittenDocWithID($PrintedOrHandwrittenDocID, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT * FROM `PrintedOrHandWrittenDocs_Details`
        WHERE PrintedOrHandwrittenDocID = :PrintedOrHandwrittenDocID AND CultureID = :CultureID; ');

        $result = $stmt->execute(array('PrintedOrHandwrittenDocID' => $PrintedOrHandwrittenDocID, 'CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new PrintedHandwrittenDoc();
            $itm->PrintedOrHandwrittenDocID = $row['PrintedOrHandwrittenDocID'];
            $itm->cultureID = $row['CultureID'];
            $itm->Kind = $row['Kind'];
            $itm->title = $row['Title'];
            $itm->subtitle = $row['subtitle'];
            $itm->SourceDetails = $row['SourceDetails'];
            $itm->Creator = $row['Creator'];
            $itm->Legende = $row['Legende'];
            $itm->Description = $row['Description'];
            $itm->BackView = $row['BackView'];
            $itm->Sponsor = $row['Sponsor'];
            $itm->CommentsPlainText = $row['CommentsPlainText'];
            $itm->SourceDetailsPlainText = $row['SourceDetailsPlainText'];
            $itm->SourceDetails = $row['SourceDetails'];
            $itm->Comments = $row['Comments'];

            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getAllPrintedOrHandWrittenDoc($CultureID, $PageSize = NULL, $RecordOffest = NULL) {

        $query = 'SELECT PrintedOrHandwrittenDocID,Title,CultureID  FROM PrintedOrHandWrittenDocs_Details 
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

            $itm = new PrintedHandwrittenDoc();



            $itm->PrintedOrHandwrittenDocID = $row['PrintedOrHandwrittenDocID'];
            $itm->CultureID = $row['CultureID'];
            $itm->title = $row['Title'];


            $array[$ind] = $itm;

            $ind++;
        }

        return $array;
    }

    public function getAllPrintedOrHandWrittenDocCount($CultureID) {

        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM PrintedOrHandWrittenDocs_Details WHERE CultureID = :CultureID;');
        $result = $stmt->execute(array('CultureID' => $CultureID));

        //print_r($stmt);
        foreach ($stmt as $row) {
            //print_r($row);
            return $row[0];
        }

        return null;
    }

    public function getHandPrintedWithID($PrintedOrHandwrittenDocID) {

        $stmt = $this->pdo->prepare('SELECT *
        	FROM PrintedOrHandWrittenDocs
            
        	WHERE PrintedOrHandwrittenDocID = :PrintedOrHandwrittenDocID ');

        $result = $stmt->execute(array('PrintedOrHandwrittenDocID' => $PrintedOrHandwrittenDocID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new PrintedHandwrittenDoc();
            $itm->PrintedOrHandwrittenDocID = $row['PrintedOrHandwrittenDocID'];
            $itm->SourceID = $row['SourceID'];
            $itm->CopyrightHeldByApan = $row['CopyrightHeldByApan'];
            $itm->copyrightHeldBy = $row['copyrightHeldBy'];
            $itm->IsOriginal = $row['IsOriginal'];
            $itm->Location = $row['Location'];
            $itm->PPI = $row['PPI'];
            $itm->IsColored = $row['IsColored'];
            $itm->OriginalCreationDate = $row['OriginalCreationDate'];
            $itm->CopyrightHeldByPlainText = $row['CopyrightHeldByPlainText'];




            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getHandPrintedSourceWithID($PrintedOrHandwrittenDocID, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT PrintedOrHandWrittenDocs.*, PrintedOrHandwrittenSources_Details.*
            FROM PrintedOrHandWrittenDocs
            INNER JOIN PrintedOrHandwrittenSources_Details
            ON `PrintedOrHandWrittenDocs`.`SourceID` =  `PrintedOrHandwrittenSources_Details`.`PrintedOrHandwrittenSourceID`
            WHERE  PrintedOrHandwrittenDocID = :PrintedOrHandwrittenDocID AND CultureID = :CultureID');

        $result = $stmt->execute(array('PrintedOrHandwrittenDocID' => $PrintedOrHandwrittenDocID, 'CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new PrintedHandwrittenDoc();
            $itm->PrintedOrHandwrittenSourceID = $row['PrintedOrHandwrittenSourceID'];
            $itm->PrintedOrHandwrittenDocID = $row['PrintedOrHandwrittenDocID'];
            $itm->CultureID = $row['CultureID'];
            $itm->LookupValue = $row['LookupValue'];
            $itm->SourceID = $row['SourceID'];

            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getHandPrintedDateWithID($PrintedOrHandwrittenDocID) {

        $stmt = $this->pdo->prepare('SELECT PrintedOrHandWrittenDocs.*, generalized_time.*
            FROM PrintedOrHandWrittenDocs
            INNER JOIN generalized_time
            ON `PrintedOrHandWrittenDocs`.`OriginalCreationDate` =  `generalized_time`.`GeneralizedTimeID`
            WHERE  PrintedOrHandwrittenDocID = :PrintedOrHandwrittenDocID');

        $result = $stmt->execute(array('PrintedOrHandwrittenDocID' => $PrintedOrHandwrittenDocID));

        $array = array();
        //$ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new PrintedHandwrittenDoc();
            $itm->OriginalCreationDate = $row['OriginalCreationDate'];
            $itm->GeneralizedTimeID = $row['GeneralizedTimeID'];
            $itm->IsPoint = $row['IsPoint'];
            $itm->PrintedOrHandwrittenDocID = $row['PrintedOrHandwrittenDocID'];
            $itm->YearInfo = $row['YearInfo'];
            $itm->MonthInfo = $row['MonthInfo'];
            $itm->DayInfo = $row['DayInfo'];
            $itm->ca = $row['ca'];

            //$array[$ind] = $itm;
            //$ind++;
        }

        return $itm;
    }

    public function getKeywordFromPrintedHandwrittenDoc($KeywordPerRecordID, $CultureID) {   //DISPLAY KEYWORDS FOR AUDIOVISUAL
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
            $itm = new PrintedHandwrittenDoc();
            $itm->RecordID = $row['RecordID'];
            $itm->KeywordID = $row['KeywordID'];
            $itm->CultureID = $row['CultureID'];
            $itm->KeywordTranslation = $row['KeywordTranslation'];


            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getUsageFromHandWtitten($accompanyingObjectID) {

        $stmt = $this->pdo->prepare('SELECT accompanyingUsage.* , item_usage_types.* , generalized_time.* 

            FROM accompanyingUsage
            INNER JOIN item_usage_types
            ON  `accompanyingUsage`.`usageTypeID` = `item_usage_types`.`UsageTypeID`
            LEFT OUTER JOIN generalized_time
            ON generalized_time.GeneralizedTimeID = accompanyingUsage.timeID
           

            WHERE  accompanyingObjectID = :accompanyingObjectID;  ');

        $stmt->execute(array('accompanyingObjectID' => $accompanyingObjectID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new PrintedHandwrittenDoc();
            $itm->timeID = $row['timeID'];
            $itm->usageTypeID = $row['usageTypeID'];
            $itm->accompanyingObjectID = $row['accompanyingObjectID'];
            $itm->accompanyingUsageID = $row['accompanyingUsageID'];
            $itm->UsageTypeID = $row['UsageTypeID'];
            $itm->use = $row['StandardValue'];
            $itm->PeriodID = $row['PeriodID'];
            $itm->YearInfo = $row['YearInfo'];
            $itm->MonthInfo = $row['MonthInfo'];
            $itm->DayInfo = $row['DayInfo'];
            $itm->ca = $row['ca'];
            $itm->IsPoint = $row['IsPoint'];
            $itm->Info = $row['Info'];
            $itm->CreatedOn = $row['CreatedOn'];
            $itm->minus = $row['minus'];
            $itm->plus = $row['plus'];


            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getUsageDetailsFromHandWrittenPrinted($accompanyingObjectID, $cultureID) {

        $stmt = $this->pdo->prepare('SELECT accompanyingUsage.* ,accompanyingUsage_details.*

            FROM accompanyingUsage
            LEFT OUTER JOIN accompanyingUsage_details
            ON accompanyingUsage.accompanyingUsageID = accompanyingUsage_details.accompanyingUsageID

            WHERE  accompanyingObjectID = :accompanyingObjectID AND cultureID = :cultureID;  ');

        $stmt->execute(array('accompanyingObjectID' => $accompanyingObjectID, 'cultureID' => $cultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            $itm = new PrintedHandwrittenDoc();
            $itm->accompanyingObjectID = $row['accompanyingObjectID'];
            $itm->accompanyingUsageID = $row['accompanyingUsageID'];
            $itm->cultureID = $row['cultureID'];
            $itm->occasion = $row['occasion'];
            $itm->comments = $row['comments'];

            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getAllHandPrintedSources($CultureID) {

        $stmt = $this->pdo->prepare('SELECT * FROM `PrintedOrHandwrittenSources_Details`
               WHERE CultureID =:CultureID;');

        $result = $stmt->execute(array('CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            $itm = new PrintedHandwrittenDoc();
            $itm->PrintedOrHandwrittenSourceID = $row['PrintedOrHandwrittenSourceID'];
            $itm->CultureID = $row['CultureID'];
            $itm->LookupValue = $row['LookupValue'];

            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getSearchPrintedOrHandWrittenDoc($cultureID, $search_peram, $PageSize = NULL, $RecordOffest = NULL) {

        $query = 'SELECT pd.PrintedOrHandwrittenDocID,Title,CultureID FROM PrintedOrHandWrittenDocs_Details pd 
                    INNER JOIN PrintedOrHandWrittenDocs 
                    ON pd.PrintedOrHandwrittenDocID = `PrintedOrHandWrittenDocs`.`PrintedOrHandwrittenDocID`
                    LEFT JOIN accompanyingObjectsPerArchivedObjects 
                    ON accompanyingObjectsPerArchivedObjects.accompanyingObjectID = PrintedOrHandWrittenDocs.PrintedOrHandwrittenDocID
                    LEFT JOIN archivedobjects 
                    ON accompanyingObjectsPerArchivedObjects.archivedObjectID = archivedobjects.ArchivedObjectID
                    LEFT JOIN items 
                    ON items.itemID = archivedobjects.ArchivedObjectID
                    LEFT JOIN itemtypes 
                    ON items.itemTypeID = itemtypes.itemTypeID
                    LEFT JOIN 	PrintedOrHandwrittenSources
                    ON 	PrintedOrHandwrittenSources.PrintedOrHandwrittenSourceID = PrintedOrHandWrittenDocs.SourceID
                    ';

        $where = " WHERE pd.cultureID = :cultureID";

        //for keywords all match
        if (isset($search_peram['keywords']) && !empty($search_peram['keywords'])) {
            $keyword_search_type = (isset($_POST['keyword_search_type']) && $_POST['keyword_search_type']) ? $_POST['keyword_search_type'] : '';
            if ($keyword_search_type == "and") {
                $keyword_count = count($search_peram['keywords']);
                $query .= sprintf(" JOIN (SELECT RecordID FROM keywords_per_record WHERE keywords_per_record.TableName = 'tPrintedOrHandwrittenDocs' AND keywords_per_record.KeywordID IN (%s) ", implode(",", $search_peram['keywords']));
                $query .= " GROUP BY keywords_per_record.RecordID HAVING COUNT(*) = $keyword_count)k ON k.RecordID = PrintedOrHandWrittenDocs.PrintedOrHandwrittenDocID ";
            } else {
                $query .= ' LEFT JOIN keywords_per_record ON keywords_per_record.TableName = "tPrintedOrHandwrittenDocs" AND keywords_per_record.RecordID = pd.PrintedOrHandwrittenDocID ';
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

        if (isset($search_peram['sourceForms']) && !IsNullOrEmpty($search_peram['sourceForms'])) {
            $query .= sprintf(" AND PrintedOrHandwrittenSources.PrintedOrHandwrittenSourceID IN (%s) ", implode(",", $search_peram['sourceForms']));
        }

        if (isset($search_peram['title']) && $search_peram['title']) {
            $title_type = (isset($_POST['title_type']) && $_POST['title_type']) ? $_POST['title_type'] : '';
            $t = $search_peram['title'];
            $words = preg_split('/\s+/', $t);
            if ($title_type == "or") {
                $query .= sprintf(" AND pd.Title RLIKE '%s' ", implode("|", $words));
            } else if ($title_type == "and") {
                $query .= " AND pd.Title like '%" . implode("%", $words) . "%'";
            } else if ($title_type == "exact") {
                $query .= " AND pd.Title like '%$t%' ";
            }
        }

        $query .= ' GROUP BY pd.PrintedOrHandwrittenDocID';
        if (is_numeric($PageSize) && is_numeric($RecordOffest)) {
            $query .= " LIMIT " . $RecordOffest . "," . $PageSize;
        }

        $stmt = $this->pdo->prepare($query);
        $result = $stmt->execute(array('cultureID' => $cultureID));
        $array = array();

        $ind = 0;
        foreach ($stmt as $row) {
            $itm = new PrintedHandwrittenDoc();
            $itm->PrintedOrHandwrittenDocID = $row['PrintedOrHandwrittenDocID'];
            $itm->CultureID = $row['CultureID'];
            $itm->title = $row['Title'];
            $array[$ind] = $itm;
            $ind++;
        }
        return $array;
    }

}
