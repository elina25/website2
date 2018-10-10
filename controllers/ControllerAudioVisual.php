<?php

class ControllerAudioVisual {

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        
    }

    public function getAudioVisualWithID($audioVisualID, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT * FROM `audioVisuals_details`
        WHERE audioVisualID = :audioVisualID AND CultureID = :CultureID; ');

        $result = $stmt->execute(array('audioVisualID' => $audioVisualID, 'CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new AudioVisual();
            $itm->audioVisualID = $row['audioVisualID'];
            $itm->cultureID = $row['cultureID'];
            $itm->ID = $row['ID'];
            $itm->title = $row['title'];
            $itm->subtitle = $row['subtitle'];
            $itm->language = $row['language'];
            $itm->director = $row['director'];
            $itm->composer = $row['composer'];
            $itm->direction = $row['direction'];
            $itm->synopsis = $row['synopsis'];
            $itm->occassion = $row['occassion'];
            $itm->duration = $row['duration'];
            $itm->format = $row['format'];
            $itm->digitizationform = $row['digitizationform'];
            $itm->interviewData = $row['interviewData'];
            $itm->textsBy = $row['textsBy'];
            $itm->musicBy = $row['musicBy'];
            $itm->researchBy = $row['researchBy'];
            $itm->producedBy = $row['producedBy'];
            $itm->otherInfo = $row['otherInfo'];
            $itm->cinematographer = $row['cinematographer'];
            $itm->othersInvolved = $row['othersInvolved'];
            $itm->comments = $row['commentsPlainText'];
            $itm->createdOn = $row['createdOn'];
            $itm->uniqueName = $row['uniqueName'];



            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getAllAudiovisual($cultureID, $PageSize = NULL, $RecordOffest = NULL) {

        $query = 'SELECT audioVisualID,title,cultureID  
        FROM audioVisuals_details 
        WHERE cultureID = :cultureID';

        if (is_numeric($PageSize) && is_numeric($RecordOffest)) {
            //echo '2:' . $PageSize . ' ' . $RecordOffest ;
            $query .= " LIMIT " . $RecordOffest . "," . $PageSize;
        }

        $stmt = $this->pdo->prepare($query);

        $result = $stmt->execute(array('cultureID' => $cultureID));
        $array = array();

        $ind = 0;

        foreach ($stmt as $row) {

            $itm = new AudioVisual();



            $itm->audioVisualID = $row['audioVisualID'];
            $itm->cultureID = $row['cultureID'];
            $itm->title = $row['title'];


            $array[$ind] = $itm;

            $ind++;
        }

        return $array;
    }

    public function getAllAudiovisualCount($CultureID) {

        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM audioVisuals_details WHERE CultureID = :CultureID;');
        $result = $stmt->execute(array('CultureID' => $CultureID));

        //print_r($stmt);
        foreach ($stmt as $row) {
            //print_r($row);
            return $row[0];
        }

        return null;
    }

    public function getAudioVisualDetailsWithID($audioVisualID) {

        $stmt = $this->pdo->prepare('SELECT *
        FROM `audioVisuals`
       
        WHERE audioVisualID = :audioVisualID  ');

        $result = $stmt->execute(array('audioVisualID' => $audioVisualID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new AudioVisual();
            $itm->audioVisualID = $row['audioVisualID'];
            $itm->kindID = $row['kindID'];
            $itm->copyrightHeldByApan = $row['copyrightHeldByApan'];
            $itm->copyrightHeldBy = $row['copyrightHeldBy'];
            $itm->privateData = $row['privateData'];
            $itm->recordingTimeID = $row['recordingTimeID'];
            $itm->Video = $row['Video'];



            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getKeywordForAllAudiovisual($CultureID) {   //GET KEYWORDS FOR ACCOMPANYING OBJECT
        $stmt = $this->pdo->prepare("SELECT distinct keywords_per_record.KeywordID, keywords_per_record.TableName,
                             keywords_details.KeywordTranslation, keywords_details.KeywordID, keywords_details.CultureID
                            FROM `keywords_per_record` 
                            INNER JOIN keywords_details
                            ON `keywords_per_record`.`KeywordID` = `keywords_details`.`KeywordID`
                            WHERE TableName LIKE 'tAudioVisuals'  AND CultureID =:CultureID ;");

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

    public function getKindOfAudioVisualWithID($audioVisualID, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT * FROM `audioVisuals`
        LEFT OUTER JOIN visualKinds_details
        ON audioVisuals.kindID = visualKinds_details.audioVisualKindID
        WHERE audioVisualID = :audioVisualID AND CultureID = :CultureID; ');

        $result = $stmt->execute(array('audioVisualID' => $audioVisualID, 'CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new AudioVisual();
            $itm->audioVisualID = $row['audioVisualID'];
            $itm->audioVisualKindID = $row['audioVisualKindID'];
            $itm->cultureID = $row['cultureID'];
            $itm->lookupValue = $row['lookupValue'];
            $itm->kindID = $row['kindID'];

            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getAllKindsOfAudioVisuals($CultureID) {

        $stmt = $this->pdo->prepare('SELECT * FROM `visualKinds_details`
               WHERE CultureID = :CultureID; ');

        $result = $stmt->execute(array('CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new AudioVisual();
            $itm->audioVisualKindID = $row['audioVisualKindID'];
            $itm->cultureID = $row['cultureID'];
            $itm->lookupValue = $row['lookupValue'];
//            $itm->kindID = $row['kindID'];

            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getCharacterizationOfAudioVisualWithID($audioVisualID, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT * FROM `audioVisuals` 
            LEFT OUTER JOIN accObjectsToCharacterization ON audioVisuals.audioVisualID = accObjectsToCharacterization.ItemID 
            INNER JOIN accObjectsCharacterization_details ON accObjectsToCharacterization.ChoiceID = accObjectsCharacterization_details.accompanyingObjectCharactID 
            WHERE audioVisualID = :audioVisualID AND CultureID = :CultureID ');

        $result = $stmt->execute(array('audioVisualID' => $audioVisualID, 'CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new AudioVisual();
            $itm->audioVisualID = $row['audioVisualID'];
            $itm->ItemID = $row['ItemID'];
            $itm->cultureID = $row['cultureID'];
            $itm->ChoiceID = $row['ChoiceID'];
            $itm->characterization = $row['lookupValue'];

            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getAllCharacterizationOfAudioVisual($CultureID) {

        $stmt = $this->pdo->prepare('SELECT accObjectsCharacterization_details.*,accObjectsCharacterization.*
        FROM `accObjectsCharacterization` 
            INNER JOIN accObjectsCharacterization_details 
            ON accObjectsCharacterization.accObjCharacterizationID = accObjectsCharacterization_details.accompanyingObjectCharactID 
            WHERE CultureID = :CultureID AND accObjectsCharacterization.itemTypeID = 5');

        $result = $stmt->execute(array('CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new AudioVisual();
            $itm->accObjCharacterizationID = $row['accObjCharacterizationID'];
            $itm->cultureID = $row['cultureID'];
//            $itm->ChoiceID = $row['ChoiceID'];
            $itm->lookupValue = $row['lookupValue'];

            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
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
            $itm = new AudioVisual();
            $itm->RecordID = $row['RecordID'];
            $itm->KeywordID = $row['KeywordID'];
            $itm->CultureID = $row['CultureID'];
            $itm->KeywordTranslation = $row['KeywordTranslation'];


            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getUsageFromAudioVisualID($accompanyingObjectID) {

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
            $itm = new AudioVisual();
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

    public function getUsageDetailsFromAudioVisualID($accompanyingObjectID, $cultureID) {

        $stmt = $this->pdo->prepare('SELECT accompanyingUsage.* ,accompanyingUsage_details.*

            FROM accompanyingUsage
            LEFT OUTER JOIN accompanyingUsage_details
            ON accompanyingUsage.accompanyingUsageID = accompanyingUsage_details.accompanyingUsageID

            WHERE  accompanyingObjectID = :accompanyingObjectID AND cultureID = :cultureID;  ');

        $stmt->execute(array('accompanyingObjectID' => $accompanyingObjectID, 'cultureID' => $cultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new AudioVisual();
            $itm->accompanyingObjectID = $row['accompanyingObjectID'];
            $itm->accompanyingUsageID = $row['accompanyingUsageID'];
            $itm->cultureID = $row['cultureID'];
            $itm->occasion = $row['occasion'];
            $itm->comments = $row['comments'];
            $itm->usageTypeID = $row['usageTypeID'];

            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getSearchAudiovisual($cultureID, $search_peram, $PageSize = NULL, $RecordOffest = NULL) {

        $query = 'SELECT ad.audioVisualID,title,cultureID  
        FROM audioVisuals_details ad
        INNER JOIN audioVisuals 
        ON `ad`.`audioVisualID` = `audioVisuals`.`audioVisualID`
        LEFT JOIN generalized_time gt
        ON gt.GeneralizedTimeID = audioVisuals.recordingTimeID ';

        $where = " WHERE ad.cultureID = :cultureID";

        //for character all match
        if (isset($search_peram['characters']) && !empty($search_peram['characters'])) {
            if ($search_peram['character_search_type'] == 'and') {
                $character_count = count($search_peram['characters']);
                $query .= sprintf(" JOIN (SELECT ItemID FROM accObjectsToCharacterization WHERE  accObjectsToCharacterization.ChoiceID IN (%s) ", implode(",", $search_peram['characters']));
                $query .= " GROUP BY accObjectsToCharacterization.ItemID HAVING COUNT(*) = $character_count) ch ON ch.ItemID = audioVisuals.audioVisualID ";
            } else if ($search_peram['character_search_type'] == 'or') {
                $query .= ' LEFT JOIN accObjectsToCharacterization ON `ad`.`audioVisualID` = accObjectsToCharacterization.ItemID ';
                $where .= sprintf(" AND accObjectsToCharacterization.ChoiceID IN (%s)", implode(",", $search_peram['characters']));
            }
        }

        //for keywords all match
        if (isset($search_peram['keywords']) && !empty($search_peram['keywords'])) {
            $keyword_search_type = (isset($_POST['keyword_search_type']) && $_POST['keyword_search_type']) ? $_POST['keyword_search_type'] : '';
            if ($keyword_search_type == "and") {
                $keyword_count = count($search_peram['keywords']);
                $query .= sprintf(" JOIN (SELECT RecordID FROM keywords_per_record WHERE keywords_per_record.TableName = 'tAudioVisuals' AND keywords_per_record.KeywordID IN (%s) ", implode(",", $search_peram['keywords']));
                $query .= " GROUP BY keywords_per_record.RecordID HAVING COUNT(*) = $keyword_count)k ON k.RecordID = audioVisuals.audioVisualID ";
            } else if($keyword_search_type == "or"){
                $query .= ' LEFT JOIN keywords_per_record ON keywords_per_record.TableName = "tAudioVisuals" AND keywords_per_record.RecordID = ad.audioVisualID ';
                $where .= sprintf(" AND keywords_per_record.KeywordID IN (%s) ", implode(",", $search_peram['keywords']));
            }
        }

        //for objects which have relation with archived object
        if (isset($search_peram['MainUnities']) && $search_peram['MainUnities']) {
            $query .= " LEFT JOIN accompanyingObjectsPerArchivedObjects 
                        ON accompanyingObjectsPerArchivedObjects.accompanyingObjectID = ad.audioVisualID
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
        // where conditions added to query
        $query .= $where;

        if (isset($search_peram['title']) && $search_peram['title']) {
            $title_type = (isset($_POST['title_type']) && $_POST['title_type']) ? $_POST['title_type'] : '';
            $t = $search_peram['title'];
//            $words = explode(" ", trim($t));
            $words = preg_split('/\s+/', $t);
            if ($title_type == "or") {
                $query .= sprintf(" AND ad.title REGEXP '%s' ", implode("|", $words));
            } else if ($title_type == "and") {
                $query .= " AND ad.title like '%" . implode("%", $words) . "%'";
            } else if ($title_type == "exact") {
                $query .= " AND ad.title like '%$t%' ";
            }
        }

        if (isset($search_peram['kinds']) && $search_peram['kinds']) {
            $query .= " AND audioVisuals.kindId = " . $search_peram['kinds'];
        }

        if (isset($search_peram['date']) && $search_peram['date']) {
            $query .= ' AND CAST(CONCAT(gt.YearInfo,"-",gt.MonthInfo,"-",gt.DayInfo) AS DATE) ';
            if ($search_peram['date_search_type'] == "equal")
                $query .= ' = ';
            else if ($search_peram['date_search_type'] == "bigger")
                $query .= ' >= ';
            else if ($search_peram['date_search_type'] == "smaller")
                $query .= ' <= ';
            else if ($search_peram['date_search_type'] == "btw")
                $query .= ' between "' . $search_peram['from_date'] . '" AND ';
            $query .= '"' . $search_peram['date'] . '"';
        }

        $query .= ' GROUP BY ad.audioVisualID';
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

            $itm = new AudioVisual();

            $itm->audioVisualID = $row['audioVisualID'];
            $itm->cultureID = $row['cultureID'];
            $itm->title = $row['title'];

            $array[$ind] = $itm;
            $ind++;
        }
        return $array;
    }

}
