<?php

class ControllerRegion{

    private $db;
    private $pdo;

    function __construct() {
        // connecting to database
        $this->db = new DB_Connect();
        $this->pdo = $this->db->connect();
    }

    function __destruct() {
        


        }






        public function getRegionDetailsWithID($RegionID, $CultureID)
        {

    	 $stmt = $this->pdo->prepare('SELECT * 
            FROM `regionsdetails` WHERE RegionID = :RegionID AND CultureID = :CultureID;
            ');

        $stmt->execute( array('RegionID' => $RegionID ,'CultureID' => $CultureID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
        {
            //do something with $row
            $itm = new Region();
            $itm->RegionID = $row['RegionID'];
            $itm->CultureID = $row['CultureID'];
            $itm->OfficialName = $row['OfficialName'];
            $itm->GeographicalData = $row['GeographicalData'];
            $itm->PhoneticTranscription = $row['PhoneticTranscription'];
            $itm->StatisticalData = $row['StatisticalData'];
            $itm->HistoricalData = $row['HistoricalData'];
            $itm->GeneralInfo = $row['GeneralInfo'];
            $itm->ReligiousPopulations = $row['ReligiousPopulations'];
            $itm->ReligiousStructure = $row['ReligiousStructure'];
            $itm->Comments = $row['Comments'];
            $itm->FriendlyName = $row['FriendlyName'];
            $itm->LocalName = $row['LocalName'];
            $itm->CommentsPlainText = $row['CommentsPlainText'];
            $itm->HistoricalDataPlainText = $row['HistoricalDataPlainText'];
            $itm->Summary = $row['Summary'];
            $itm->SummaryPlainText = $row['SummaryPlainText'];
            $itm->MapDocument = $row['MapDocument'];
         
                
           
            $array[$ind] = $itm;
            $ind++;
        }

        return $array;

 }

      public function getRegionsWithID($RegionID)
        {

         $stmt = $this->pdo->prepare('SELECT * 
            FROM `regions` WHERE RegionID = :RegionID');

        $stmt->execute( array('RegionID' => $RegionID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
        {
            //do something with $row
            $itm = new Region();
            $itm->RegionID = $row['RegionID'];
            $itm->Longitude = $row['Longitude'];
            $itm->Latitude = $row['Latitude'];
            
            $array[$ind] = $itm;
            $ind++;
        }

        return $array;

        }





    public function getCountOfGeophysicalObjectsRelatedOfRegions($RegionID, $itemTypeID) {


        try{


                            if ($itemTypeID == 8) {

                                $innerjoin ='INNER JOIN mountains_details
                                            ON mountains_details.mountainID = g.geophysicalObjectID';

                            } else if ($itemTypeID == 9) {

                                $innerjoin ='INNER JOIN landareas_details
                                            ON landareas_details.landAreaID = g.geophysicalObjectID';

                            } else if  ($itemTypeID == 10) {

                                $innerjoin ='INNER JOIN seas_details
                                            ON seas_details.seaID = g.geophysicalObjectID';

                            } else if ($itemTypeID == 11) {

                                $innerjoin ='INNER JOIN lakes_details
                                            ON lakes_details.lakeID = g.geophysicalObjectID';

                            } else {

                                $innerjoin ='INNER JOIN rivers_details
                                            ON rivers_details.riverID = g.geophysicalObjectID';
                            }


                                    $query = 'SELECT count(*) as rowsum 
                                    FROM geophysicalReferences g
                                    inner join items i on i.itemID = g.geophysicalObjectID
                                      ' . $innerjoin . '
                                     WHERE g.referencedObjectID =:RegionID AND i.itemTypeID=:itemTypeID ' ;




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







public function getKeywordFromRegion($KeywordPerRecordID, $CultureID) {   //DISPLAY KEYWORDS FOR BIOGRAPHY
        $stmt = $this->pdo->prepare('SELECT `keywords_per_record`.`RecordID`,
            `keywords_per_record`.`KeywordID`,`keywords_details`.`KeywordID`,
            `keywords_details`.`KeywordTranslation`,`keywords_details`.`CultureID`
            FROM `keywords_per_record` 
            INNER JOIN `keywords_details`
            ON `keywords_per_record`.`KeywordID` = `keywords_details`.`KeywordID`
            WHERE `keywords_per_record`.`RecordID` = :KeywordPerRecordID AND `keywords_details`.`CultureID` = :CultureID
            ORDER BY keywords_details.KeywordTranslation ');

        $stmt->execute( array('KeywordPerRecordID' => $KeywordPerRecordID , 'CultureID' => $CultureID ));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
         {
            //do something with $row
            $itm = new Region();
            $itm->RecordID = $row['RecordID'];
            $itm->KeywordID = $row['KeywordID'];
            $itm->CultureID = $row['CultureID'];
            $itm->KeywordTranslation = $row['KeywordTranslation'];
           

            $array[$ind] = $itm;
            $ind++;

          }

        return $array;
    }  



	public function getCharacterizationWithRegionID($RegionID){


 		$stmt = $this->pdo->prepare('SELECT regiontocharacter.* ,regioncharacters.*
            FROM `regiontocharacter` 
            INNER JOIN regioncharacters
            ON `regiontocharacter`.`CharacterID` = `regioncharacters`.`RegionCharacterID`
            WHERE RegionID = :RegionID;
            ');

        $stmt->execute( array('RegionID' => $RegionID));

        $array = array();
        $ind = 0;
        foreach ($stmt as $row)
        {
            //do something with $row
            $itm = new Region();
            $itm->RegionID = $row['RegionID'];
            $itm->CharacterID = $row['CharacterID'];
            $itm->RegionCharacterName = $row['RegionCharacterName'];
            $itm->RegionCharacterNameEN = $row['RegionCharacterName_EN'];
            
         	$array[$ind] = $itm;
            $ind++;
        }

        return $array;

	} 


    public function getEventsForArchivedObjectID($ArchivedObjectID) {

        $stmt = $this->pdo->prepare('SELECT  e.EventID,e.UniqueName,e.StartTimeID,e.EndTimeID,e.EventTypeID,e.PrivateData,et.EventTypeDesc,

                                        gt.YearInfo startYearInfo,gt.MonthInfo startMonthInfo,gt.DayInfo startDayInfo,

                                        gt2.YearInfo endYearInfo,gt2.MonthInfo endMonthInfo,gt2.DayInfo endDayInfo

                                        FROM `events` e

                                        INNER JOIN `event_types` et ON `e`.`EventTypeID` = `et`.`EventTypeID`

                                        LEFT JOIN generalized_time gt ON (gt.GeneralizedTimeID = e.startTimeID)

                                        LEFT JOIN generalized_time gt2 ON (gt2.GeneralizedTimeID = e.EndTimeID)

                                        WHERE e.ArchivedObjectID=:ArchivedObjectID ORDER BY startYearInfo DESC, startMonthInfo DESC,startDayInfo DESC

                                        ');



        $result = $stmt->execute(array('ArchivedObjectID' => $ArchivedObjectID));

        $array = array();

        $ind = 0;

        foreach ($stmt as $row) {

            // do something with $row

            $itm = new Region();

            $itm->eventID = $row['EventID'];

            $itm->eventTypeID = $row['EventTypeID'];

            $itm->privateData = $row['PrivateData'];

            $itm->startTimeID = $row['StartTimeID'];

            $itm->endTimeID = $row['EndTimeID'];

            $itm->uniqueName = $row['UniqueName'];

            $itm->eventTypeDesc = $row['EventTypeDesc'];

            $itm->startYearInfo = $row['startYearInfo'];

            $itm->startMonthInfo = $row['startMonthInfo'];

            $itm->startDayInfo = $row['startDayInfo'];

            $itm->endYearInfo = $row['endYearInfo'];

            $itm->endMonthInfo = $row['endMonthInfo'];

            $itm->endDayInfo = $row['endDayInfo'];

            



//return $itm;

            $array[$ind] = $itm;

            $ind++;

        }

        return $array;

    }


        public function getHistoricNamesForArchivedObjectID($archivedID) {

        $stmt = $this->pdo->prepare('SELECT h.*,r.rangeStart,r.rangeEnd FROM `historicnames` h

                                    left join ranges r on h.rangeID=r.rangeID

                                    WHERE `ArchivedObjectID`=:arch_id

                                        ');



        $result = $stmt->execute(array('arch_id' => $archivedID));



        $array = array();

        $ind = 0;

        foreach ($stmt as $row) {

// do something with $row

            $itm = new Region();

            $itm->historicNameID = $row['HistoricNameID'];

            $itm->uniqueName = $row['UniqueName'];

            $itm->privateData = $row['PrivateData'];

            $itm->createdOn = $row['CreatedOn'];

            $itm->archivedObjectID = $row['ArchivedObjectID'];

            $itm->accompanyingObjectID = $row['AccompanyingObjectID'];

            $itm->rangeID = $row['RangeID'];

            $itm->rangeStart = $row['rangeStart'];

            $itm->rangeEnd = $row['rangeEnd'];

            $itm->isContemporary = $row['isContemporary'];



//return $itm;

            $array[$ind] = $itm;

            $ind++;

        }

        return $array;

    }

















    }
