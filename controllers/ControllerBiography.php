<?php

class ControllerBiography {

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        
    }

    public function getBiographyWithID($biographyID, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT * FROM `biographies_details`
        WHERE biographyID = :biographyID AND CultureID = :CultureID; ');

        $result = $stmt->execute(array('biographyID' => $biographyID, 'CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new Biography();
            $itm->biographyID = $row['biographyID'];
            $itm->CultureID = $row['CultureID'];
            $itm->FullName = $row['FullName'];
            $itm->Office = $row['Office'];
            $itm->HonorTitle = $row['HonorTitle'];
            $itm->Nickname = $row['Nickname'];
            $itm->CareerPlainText = $row['CareerPlainText'];
            $itm->Education = $row['Education'];
            $itm->ServiceDetails = $row['ServiceDetails'];
            $itm->DeathLocation = $row['DeathLocation'];
            $itm->BurialLocation = $row['BurialLocation'];
            $itm->HistoricalData = $row['HistoricalData'];
            $itm->BirthLocation = $row['BirthLocation'];
            $itm->Profession = $row['Profession'];
            $itm->CommentsPlainText = $row['CommentsPlainText'];
            $itm->HistoricalDataPlainText = $row['HistoricalDataPlainText'];




            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getAllBiography($CultureID, $PageSize = NULL, $RecordOffest = NULL) {   //$PageSize = items per page  ,  $RecordOffset = 
        $query = 'SELECT biographyID,FullName,CultureID 
         FROM biographies_details 
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


            $itm = new Biography();

            $itm->biographyID = $row['biographyID'];
            $itm->CultureID = $row['CultureID'];
            $itm->FullName = $row['FullName'];


            $array[$ind] = $itm;

            $ind++;
        }

        return $array;
    }

    public function getAllBiographyCount($CultureID) {

        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM biographies_details WHERE CultureID = :CultureID;');
        $result = $stmt->execute(array('CultureID' => $CultureID));

        //print_r($stmt);
        foreach ($stmt as $row) {
            //print_r($row);
            return $row[0];
        }

        return null;
    }

    public function getKeywordFromBiographyID($KeywordPerRecordID, $CultureID) {   //DISPLAY KEYWORDS FOR BIOGRAPHY
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
            $itm = new Biography();
            $itm->RecordID = $row['RecordID'];
            $itm->KeywordID = $row['KeywordID'];
            $itm->CultureID = $row['CultureID'];
            $itm->KeywordTranslation = $row['KeywordTranslation'];


            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    //function called when user search with their filters in biography list page.
    public function getSearchBiography($cultureID, $search_peram, $PageSize = NULL, $RecordOffest = NULL) {
        $query = 'SELECT bd.biographyID,bd.FullName,bd.CultureID 
                  FROM biographies_details bd 
                  LEFT JOIN biographies b ON (b.biographyID = bd.biographyID) ';

        $where = " WHERE bd.cultureID = :cultureID ";

        //for keywords all match
        if (isset($search_peram['keywords']) && !empty($search_peram['keywords'])) {
            $keyword_search_type = (isset($_POST['keyword_search_type']) && $_POST['keyword_search_type']) ? $_POST['keyword_search_type'] : '';
            if ($keyword_search_type == "and") {
                $keyword_count = count($search_peram['keywords']);
                $query .= sprintf(" JOIN (SELECT RecordID FROM keywords_per_record WHERE keywords_per_record.TableName = 'tBiographies' AND keywords_per_record.KeywordID IN (%s) ", implode(",", $search_peram['keywords']));
                $query .= " GROUP BY keywords_per_record.RecordID HAVING COUNT(*) = $keyword_count)k ON k.RecordID = bd.biographyID ";
            } else {
                $query .= ' LEFT JOIN keywords_per_record ON keywords_per_record.TableName = "tBiographies" AND keywords_per_record.RecordID = bd.biographyID ';
                $where .= sprintf(" AND keywords_per_record.KeywordID IN (%s) ", implode(",", $search_peram['keywords']));
            }
        }

        //for objects which have relation with archived object
        if (isset($search_peram['MainUnities']) && $search_peram['MainUnities']) {
            $query .= "LEFT JOIN accompanyingObjectsPerArchivedObjects 
                      ON accompanyingObjectsPerArchivedObjects.accompanyingObjectID = bd.biographyID
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
        
        if (isset($search_peram['birth_date']) && $search_peram['birth_date']) {
            $query .= " LEFT JOIN generalized_time gt ON gt.GeneralizedTimeID = b.birthTimeID ";
            $where .= ' AND CAST(CONCAT(gt.YearInfo,"-",gt.MonthInfo,"-",gt.DayInfo) AS DATE) ';
            if ($search_peram['birth_search_type'] == "equal")
                $where .= ' = ';
            else if ($search_peram['birth_search_type'] == "bigger")
                $where .= ' >= ';
            else if ($search_peram['birth_search_type'] == "smaller")
                $where .= ' <= ';
            else if ($search_peram['birth_search_type'] == "btw")
                $where .= ' between "' . $search_peram['birth_from'] . '" AND ';
            $where .= '"' . $search_peram['birth_date'] . '"';
        }
        if (isset($search_peram['death_date']) && $search_peram['death_date']) {
            $query .= " LEFT JOIN generalized_time gt2 ON gt2.GeneralizedTimeID = b.deathTimeID ";
            $where .= ' AND CAST(CONCAT(gt2.YearInfo,"-",gt2.MonthInfo,"-",gt2.DayInfo) AS DATE) ';
            if ($search_peram['death_search_type'] == "equal")
                $where .= ' = ';
            else if ($search_peram['death_search_type'] == "bigger")
                $where .= ' >= ';
            else if ($search_peram['death_search_type'] == "smaller")
                $where .= ' <= ';
            else if ($search_peram['death_search_type'] == "btw")
                $where .= ' between "' . $search_peram['death_from'] . '" AND ';
            $where .= '"' . $search_peram['death_date'] . '"';
        }
        
        // where conditions added to query
        $query .= $where;

        if (isset($search_peram['fullname']) && $search_peram['fullname']) {
            $type = (isset($_POST['fullname_search_type']) && $_POST['fullname_search_type']) ? $_POST['fullname_search_type'] : '';
            $t = $search_peram['fullname'];
            $words = preg_split('/\s+/', $t);
            if ($type == "or") {
                $query .= sprintf(" AND bd.FullName REGEXP '%s' ", implode("|", $words));
            } else if ($type == "and") {
                $query .= " AND bd.FullName like '%" . implode("%", $words) . "%'";
            } else if ($type == "exact") {
                $query .= " AND bd.FullName like '%$t%' ";
            }
        }

        $query .= ' GROUP BY bd.biographyID ';
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
            // do something with $row
            $itm = new Biography();
            $itm->biographyID = $row['biographyID'];
            $itm->CultureID = $row['CultureID'];
            $itm->FullName = $row['FullName'];
            $array[$ind] = $itm;
            $ind++;
        }
        return $array;
    }

}
