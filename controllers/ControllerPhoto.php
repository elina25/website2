<?php

class ControllerPhoto {

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        
    }

    public function getAllPhotos($CultureID, $PageSize = NULL, $RecordOffest = NULL) {

        $query = 'SELECT pd.PhotoID,pd.Title,documentPath,pd.CultureID  FROM Photos_Details pd
            INNER JOIN Photos p ON p.PhotoID = pd.PhotoID
            INNER JOIN accompanyingObjects ON accompanyingObjects.accompanyingObjectID = pd.PhotoID
            WHERE CultureID = :CultureID ';

        if (is_numeric($PageSize) && is_numeric($RecordOffest)) {
            //echo '2:' . $PageSize . ' ' . $RecordOffest ;
            $query .= " LIMIT " . $RecordOffest . "," . $PageSize;
        }

        $stmt = $this->pdo->prepare($query);


        $result = $stmt->execute(array('CultureID' => $CultureID));
        $array = array();

        $ind = 0;

        foreach ($stmt as $row) {

            $itm = new Photo();

            $itm->photoID = $row['PhotoID'];
            $itm->CultureID = $row['CultureID'];
            $itm->title = $row['Title'];
            $itm->documentPath = $row['documentPath'];


            $array[$ind] = $itm;

            $ind++;
        }

        return $array;
    }

    public function getPhotosWithID($PhotoID) {

        $query = 'SELECT * FROM Photos
            WHERE PhotoID = :PhotoID ';



        $stmt = $this->pdo->prepare($query);


        $result = $stmt->execute(array('PhotoID' => $PhotoID));
        $array = array();

        $ind = 0;

        foreach ($stmt as $row) {

            $itm = new Photo();

            $itm->photoID = $row['PhotoID'];
            $itm->SourceID = $row['SourceID'];
            $itm->CopyrightHeldByApan = $row['CopyrightHeldByApan'];
            $itm->copyrightHeldBy = $row['copyrightHeldBy'];
            $itm->IsOriginal = $row['IsOriginal'];
            $itm->kindID = $row['kindID'];
            $itm->QualityID = $row['QualityID'];
            $itm->Location = $row['Location'];
            $itm->PPI = $row['PPI'];
            $itm->ShootingTimeID = $row['ShootingTimeID'];
            $itm->IsColored = $row['IsColored'];


            $array[$ind] = $itm;

            $ind++;
        }

        return $array;
    }

    public function getPhotosDetailsWithID($PhotoID, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT * FROM Photos_Details 
             INNER JOIN accompanyingObjects ON accompanyingObjects.accompanyingObjectID = Photos_Details.PhotoID
            WHERE PhotoID = :PhotoID  AND CultureID = :CultureID; ');


        $result = $stmt->execute(array('PhotoID' => $PhotoID, 'CultureID' => $CultureID));
        $array = array();

        $ind = 0;

        foreach ($stmt as $row) {
            $itm = new Photo();
            $itm->photoID = $row['PhotoID'];
            $itm->title = $row['Title'];
            $itm->CultureID = $row['CultureID'];
            $itm->documentPath = $row['documentPath'];
            $itm->Photographer = $row['Photographer'];
            $itm->SourceDetails = $row['SourceDetails'];
            $itm->KindDetails = $row['KindDetails'];
            $itm->QualityDetails = $row['QualityDetails'];
            $itm->DayHour = $row['DayHour'];
            $itm->Occasion = $row['Occasion'];
            $itm->PhotoDescription = $row['PhotoDescription'];
            $itm->OtherInfo = $row['OtherInfo'];
            $itm->Comments = $row['Comments'];
            $itm->CreatedOn = $row['CreatedOn'];
            $itm->CommentsPlainText = $row['CommentsPlainText'];



            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }

    public function getAllPhotoCount($CultureID) {

        $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM Photos_Details WHERE CultureID = :CultureID;');
        $result = $stmt->execute(array('CultureID' => $CultureID));

        //print_r($stmt);
        foreach ($stmt as $row) {
            //print_r($row);
            return $row[0];
        }

        return null;
    }

    public function GetAllRelationsWithfriendlyNameFromPhotosToReligiousMonument($item_id, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT religiousMonumentsDetails.friendlyName, religiousMonumentsDetails.ReligiousMonumentId,religiousMonumentsDetails.cultureID
                                  FROM religiousMonumentsDetails
                                  where `ReligiousMonumentId` =:item_id AND CultureID =:CultureID');

        $stmt->execute(array('item_id' => $item_id, 'CultureID' => $CultureID));

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->friendlyName = $row['friendlyName'];
            array_push($items, $itm);
        }



        return $items;
    }

    public function GetAllRelationsWithfriendlyNameFromPhotosTochristianorthodoxMonumentsDetails($item_id, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT christianorthodoxMonumentsDetails.friendlyName, christianorthodoxMonumentsDetails.ChristianorthodoxMonumentId,christianorthodoxMonumentsDetails.cultureID
                                  FROM christianorthodoxMonumentsDetails
                                  where `ChristianorthodoxMonumentId` =:item_id AND CultureID =:CultureID');

        $stmt->execute(array('item_id' => $item_id, 'CultureID' => $CultureID));

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->friendlyName = $row['friendlyName'];
            array_push($items, $itm);
        }



        return $items;
    }

    public function GetAllRelationsWithfriendlyNameFromPhotosToArtworks_details($item_id, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT artworks_details.friendlyName, artworks_details.ArtworkID, artworks_details.cultureID
                    FROM artworks_details
                    where `ArtworkID` =:item_id AND CultureID =:CultureID');

        $stmt->execute(array('item_id' => $item_id, 'CultureID' => $CultureID));

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->friendlyName = $row['friendlyName'];
            array_push($items, $itm);
        }



        return $items;
    }

    public function GetAllRelationsWithfriendlyNameFromPhotosToEducationalFoundationDetails($item_id, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT educationalFoundationDetails.friendlyName, educationalFoundationDetails.EducationFoundationId, educationalFoundationDetails.cultureID
                    FROM educationalFoundationDetails
                    where `EducationFoundationId` =:item_id AND CultureID =:CultureID');

        $stmt->execute(array('item_id' => $item_id, 'CultureID' => $CultureID));

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->friendlyName = $row['friendlyName'];
            array_push($items, $itm);
        }



        return $items;
    }

    public function GetAllRelationsWithfriendlyNameFromPhotosToEpigraphsDetails($item_id, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT epigraphsDetails.friendlyName, epigraphsDetails.EpigraphId, epigraphsDetails.cultureID
                    FROM epigraphsDetails
                    where `EpigraphId` =:item_id AND CultureID =:CultureID');

        $stmt->execute(array('item_id' => $item_id, 'CultureID' => $CultureID));

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->friendlyName = $row['friendlyName'];
            array_push($items, $itm);
        }



        return $items;
    }

    public function GetAllRelationsWithfriendlyNameFromPhotosTocommunityDetails($item_id, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT communityDetails.friendlyName, communityDetails.CommunityId, communityDetails.cultureID
                    FROM epigraphsDetails
                    where `CommunityId` =:item_id AND CultureID =:CultureID');

        $stmt->execute(array('item_id' => $item_id, 'CultureID' => $CultureID));

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->friendlyName = $row['friendlyName'];
            array_push($items, $itm);
        }



        return $items;
    }

    public function GetAllRelationsWithfriendlyNameFromPhotosTocemeteryDetails($item_id, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT cemeteryDetails.friendlyName, cemeteryDetails.CemeteryId, cemeteryDetails.cultureID
                    FROM cemeteryDetails
                    where `CemeteryId` =:item_id AND CultureID =:CultureID');

        $stmt->execute(array('item_id' => $item_id, 'CultureID' => $CultureID));

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->friendlyName = $row['friendlyName'];
            array_push($items, $itm);
        }



        return $items;
    }

    public function GetAllRelationsWithfriendlyNameFromPhotosToArchRel($item_id, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT archeologicalReligiousMonumentsDetails.friendlyName, archeologicalReligiousMonumentsDetails.ArchReligiousId, archeologicalReligiousMonumentsDetails.cultureID
                    FROM archeologicalReligiousMonumentsDetails
                    where `ArchReligiousId` =:item_id AND CultureID =:CultureID');

        $stmt->execute(array('item_id' => $item_id, 'CultureID' => $CultureID));

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->friendlyName = $row['friendlyName'];
            array_push($items, $itm);
        }



        return $items;
    }

    public function GetAllRelationsWithfriendlyNameFromPhotosToArchSite($item_id, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT archeologicalSiteDetails.friendlyName, archeologicalSiteDetails.ArchSiteID, archeologicalSiteDetails.cultureID
                    FROM archeologicalSiteDetails
                    where `ArchSiteID` =:item_id AND CultureID =:CultureID');

        $stmt->execute(array('item_id' => $item_id, 'CultureID' => $CultureID));

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->friendlyName = $row['friendlyName'];
            array_push($items, $itm);
        }



        return $items;
    }

    public function GetAllRelationsWithfriendlyNameFromPhotosToFortress($item_id, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT fortressesDetails.friendlyName, fortressesDetails.FortressId, fortressesDetails.cultureID
                    FROM fortressesDetails
                    where `ArchSiteID` =:item_id AND CultureID =:CultureID');

        $stmt->execute(array('item_id' => $item_id, 'CultureID' => $CultureID));

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->friendlyName = $row['friendlyName'];
            array_push($items, $itm);
        }



        return $items;
    }

    public function GetAllRelationsWithfriendlyNameFromPhotosToTomb($item_id, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT tombsDetails.name, tombsDetails.TombId, tombsDetails.cultureID
                    FROM tombsDetails
                    where `TombId` =:item_id AND CultureID =:CultureID');

        $stmt->execute(array('item_id' => $item_id, 'CultureID' => $CultureID));

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->name = $row['name'];
            array_push($items, $itm);
        }



        return $items;
    }

    public function GetAllRelationsWithfriendlyNameFromPhotosToMuseums($item_id, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT museumsDetails.friendlyName, museumsDetails.MuseumId, museumsDetails.cultureID
                    FROM museumsDetails
                    where `MuseumId` =:item_id AND CultureID =:CultureID');

        $stmt->execute(array('item_id' => $item_id, 'CultureID' => $CultureID));

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->friendlyName = $row['friendlyName'];
            array_push($items, $itm);
        }



        return $items;
    }

    public function GetAllRelationsWithfriendlyNameFromPhotosToExhibition($item_id, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT exhibitionDetails.friendlyName, exhibitionDetails.ExhibitionId, exhibitionDetails.cultureID
                    FROM exhibitionDetails
                    where `ExhibitionId` =:item_id AND CultureID =:CultureID');

        $stmt->execute(array('item_id' => $item_id, 'CultureID' => $CultureID));

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->friendlyName = $row['friendlyName'];
            array_push($items, $itm);
        }



        return $items;
    }

    public function GetAllRelationsWithfriendlyNameFromPhotosToAdminBuildings($item_id, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT administrationBuildingsDetails.friendlyName, administrationBuildingsDetails.AdminBuildingId, administrationBuildingsDetails.cultureID
                    FROM administrationBuildingsDetails
                    where `AdminBuildingId` =:item_id AND CultureID =:CultureID');

        $stmt->execute(array('item_id' => $item_id, 'CultureID' => $CultureID));

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->friendlyName = $row['friendlyName'];
            array_push($items, $itm);
        }



        return $items;
    }

    public function GetAllRelationsWithfriendlyNameFromPhotosToWelfareBuilding($item_id, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT welfareBuildingsDetails.friendlyName, welfareBuildingsDetails.WelfareBuildingId, welfareBuildingsDetails.cultureID
                    FROM welfareBuildingsDetails
                    where `WelfareBuildingId` =:item_id AND CultureID =:CultureID');

        $stmt->execute(array('item_id' => $item_id, 'CultureID' => $CultureID));

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->friendlyName = $row['friendlyName'];
            array_push($items, $itm);
        }



        return $items;
    }

    public function GetAllRelationsWithfriendlyNameFromPhotosToInfrastructureBuilding($item_id, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT infrastructureBuildingsDetails.friendlyName, infrastructureBuildingsDetails.InfrastructureBuildingId, infrastructureBuildingsDetails.cultureID
                    FROM infrastructureBuildingsDetails
                    where `InfrastructureBuildingId` =:item_id AND CultureID =:CultureID');

        $stmt->execute(array('item_id' => $item_id, 'CultureID' => $CultureID));

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->friendlyName = $row['friendlyName'];
            array_push($items, $itm);
        }



        return $items;
    }

    public function GetAllRelationsWithfriendlyNameFromPhotosToResidentialBuildingId($item_id, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT socialResidentialBuildingDetails.friendlyName, socialResidentialBuildingDetails.ResidentialBuildingId, socialResidentialBuildingDetails.cultureID
                    FROM socialResidentialBuildingDetails
                    where `InfrastructureBuildingId` =:item_id AND CultureID =:CultureID');

        $stmt->execute(array('item_id' => $item_id, 'CultureID' => $CultureID));

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->friendlyName = $row['friendlyName'];
            array_push($items, $itm);
        }



        return $items;
    }

    public function GetAllRelationsWithfriendlyNameFromPhotosToCoin($item_id, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT coins_details.frontView, coins_details.coinID, coins_details.cultureID
                    FROM coins_details
                    where `coinID` =:item_id AND CultureID =:CultureID');

        $stmt->execute(array('item_id' => $item_id, 'CultureID' => $CultureID));

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->frontView = $row['frontView'];
            array_push($items, $itm);
        }



        return $items;
    }

    public function GetAllRelationsWithfriendlyNameFromPhotosToPersonDetails($item_id, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT persons_details.fullName, persons_details.personID, persons_details.cultureID
                    FROM persons_details
                    where `personID` =:item_id AND CultureID =:CultureID');

        $stmt->execute(array('item_id' => $item_id, 'CultureID' => $CultureID));

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->fullName = $row['fullName'];
            array_push($items, $itm);
        }



        return $items;
    }

    public function GetAllRelationsWithfriendlyNameFromPhotosToReligiousEvent($item_id, $CultureID) {

        $stmt = $this->pdo->prepare('SELECT religiousEventsDetails.title, religiousEventsDetails.religiousEventID, religiousEventsDetails.cultureID
                    FROM religiousEventsDetails
                    where `religiousEventID` =:item_id AND CultureID =:CultureID');

        $stmt->execute(array('item_id' => $item_id, 'CultureID' => $CultureID));

        $items = array();

        foreach ($stmt as $row) {

            // do something with $row
            $itm = new stdClass();
            $itm->title = $row['title'];
            array_push($items, $itm);
        }



        return $items;
    }

    public function GetAllPhotosSources($CultureID) {

        $stmt = $this->pdo->prepare('SELECT * FROM `photoSources_details`
               WHERE cultureID =:CultureID; ');

        $result = $stmt->execute(array('CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            //do something with $row
            $itm = new Photo();
            $itm->photoSourceID = $row['photoSourceID'];
            $itm->CultureID = $row['cultureID'];
            $itm->lookupValue = $row['lookupValue'];

            $array[$ind] = $itm;
            $ind++;
        }

        return $array;
    }
    
    //function called when user search with their filters in photo list page.
    public function getSearchPhotos($CultureID, $search_peram, $PageSize = NULL, $RecordOffest = NULL) {

        $query = 'SELECT pd.PhotoID,pd.Title,documentPath,CultureID  FROM Photos_Details pd
                  INNER JOIN Photos p ON p.PhotoID = pd.PhotoID
                  INNER JOIN accompanyingObjects acc ON acc.accompanyingObjectID = pd.PhotoID ';
        
        $where = " WHERE pd.CultureID = :CultureID ";

        //for keywords filter
        if (isset($search_peram['keywords']) && !empty($search_peram['keywords'])) {
            $keyword_search_type = (isset($search_peram['keyword_search_type']) && $search_peram['keyword_search_type']) ? $search_peram['keyword_search_type'] : '';
            if ($keyword_search_type == "and") {
                $keyword_count = count($search_peram['keywords']);
                $query .= sprintf(" JOIN (SELECT RecordID FROM keywords_per_record WHERE keywords_per_record.TableName = 'tPhotos' AND keywords_per_record.KeywordID IN (%s) ", implode(",", $search_peram['keywords']));
                $query .= " GROUP BY keywords_per_record.RecordID HAVING COUNT(*) = $keyword_count)k ON k.RecordID = pd.PhotoID ";
            } else {
                $query .= ' LEFT JOIN keywords_per_record ON keywords_per_record.TableName = "tPhotos" AND keywords_per_record.RecordID = pd.PhotoID ';
                $where .= sprintf(" AND keywords_per_record.KeywordID IN (%s) ", implode(",", $search_peram['keywords']));
            }
        }

        //for objects which have relation with archived object
        if (isset($search_peram['MainUnities']) && $search_peram['MainUnities']) {
            $query .= "LEFT JOIN accompanyingObjectsPerArchivedObjects 
                      ON accompanyingObjectsPerArchivedObjects.accompanyingObjectID = pd.PhotoID
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
                $where .= sprintf(" AND pd.Title REGEXP '%s' ", implode("|", $words));
            } else if ($title_type == "and") {
                $where .= " AND pd.Title like '%" . implode("%", $words) . "%'";
            } else if ($title_type == "exact") {
                $where .= " AND pd.Title like '%$t%' ";
            }
        }
        
        if (isset($search_peram['photo_source']) && $search_peram['photo_source']) {
            $where .= " AND p.SourceID = " . $search_peram['photo_source'];
        }
        
        // where conditions added to query
        $query .= $where.' GROUP BY pd.PhotoID ';
        
        if (is_numeric($PageSize) && is_numeric($RecordOffest)) {
            //echo '2:' . $PageSize . ' ' . $RecordOffest ;
            $query .= " LIMIT " . $RecordOffest . "," . $PageSize;
        }
        
//        echo $query;
        $stmt = $this->pdo->prepare($query);
        $result = $stmt->execute(array('CultureID' => $CultureID));
        $array = array();
        $ind = 0;
        foreach ($stmt as $row) {
            $itm = new Photo();
            $itm->photoID = $row['PhotoID'];
            $itm->CultureID = $row['CultureID'];
            $itm->title = $row['Title'];
            $itm->documentPath = $row['documentPath'];
            $array[$ind] = $itm;
            $ind++;
        }
        return $array;
    }
}
