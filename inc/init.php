<?php
//if (session_id() == '')
//    session_start();
//$path = realpath(__DIR__ . "/../..");
$path = realpath(__DIR__ . "/..");

//Paging Parameters
$PAGE_SIZE = 20;


require_once ($path . "/application/Config.php");
require_once ($path . "/application/DB_Connect.php");
require_once ($path . "/application/Globals.php");

require_once ($path . "/controllers/ControllerAccompanyingObject.php");
require_once ($path . "/controllers/ControllerMainUnities.php");
require_once ($path . "/controllers/ControllerMuseum.php");
require_once ($path . "/controllers/ControllerArtwork.php");
require_once ($path . "/controllers/ControllerArchaeologicalReligiousMonument.php");
require_once ($path . "/controllers/ControllerArchivedObjectRelations.php");
require_once ($path . "/controllers/ControllerReligiousEvent.php");
require_once ($path . "/controllers/ControllerSea.php");
require_once ($path . "/controllers/ControllerLake.php");
require_once ($path . "/controllers/ControllerMountain.php");
require_once ($path . "/controllers/ControllerLandarea.php");
require_once ($path . "/controllers/ControllerRiver.php");
require_once ($path . "/controllers/ControllerArchivedObject.php");
require_once ($path . "/controllers/ControllerPhoto.php");
require_once ($path . "/controllers/ControllerPerson.php");
require_once ($path . "/controllers/ControllerKeyword.php");
require_once ($path . "/controllers/ControllerAudioVisual.php");
require_once ($path . "/controllers/ControllerBibliography.php");
require_once ($path . "/controllers/ControllerBiography.php");
require_once ($path . "/controllers/ControllerPrintedHandwrittenDoc.php");
require_once ($path . "/controllers/ControllerNote.php");
require_once ($path . "/controllers/ControllerDocument.php");
require_once ($path . "/controllers/ControllerRegion.php");
require_once ($path . "/controllers/ControllerMap.php");
require_once ($path . "/controllers/ControllerSponsor.php");
require_once ($path . "/controllers/ControllerGeophysical.php");






require_once ($path . "/models/AccompanyingItemType.php");
require_once ($path . "/models/AccompanyingObject.php");
require_once ($path . "/models/Person.php");
require_once ($path . "/models/ArchivedObject.php");
require_once ($path . "/models/Artwork.php");
require_once ($path . "/models/ChristianorthodoxMonument.php");
require_once ($path . "/models/Museum.php");
require_once ($path . "/models/ArchaeologicalReligiousMonument.php");
//require_once ($path . "/models/ReligiousEvent.php");
require_once ($path . "/models/Sea.php");
require_once ($path . "/models/Lake.php");
require_once ($path . "/models/Mountain.php");
require_once ($path . "/models/Landarea.php");
require_once ($path . "/models/River.php");
require_once ($path . "/models/ItemType.php");
require_once ($path . "/models/Photo.php");
require_once ($path . "/models/Keyword.php");
require_once ($path . "/models/AudioVisual.php");
require_once ($path . "/models/Bibliography.php");
require_once ($path . "/models/Biography.php");
require_once ($path . "/models/PrintedHandwrittenDoc.php");
require_once ($path . "/models/Note.php");
require_once ($path . "/models/Document.php");
require_once ($path . "/models/Region.php");
require_once ($path . "/models/Map.php");
require_once ($path . "/models/Sponsor.php");

function NotShowItem($item) {
    if (IsNullOrEmpty($item))
        return "not-show";
    else
        return "";
}

function IsNullOrEmpty($text) {
    if ($text == NULL)
        return true;
    if ($text == "")
        return true;
    return false;
}

function MakeItemList($dataObj, $prop, $langObj, $langProp = NULL) {

    if ($langProp == NULL)
        $langProp = $prop;

    $data = (array) $dataObj;
    if (!IsNullOrEmpty($data[$prop])) {
        $line = '<p style="color: #7f7f7f; font-size: 14px; text-align:justify;" class="entry-content listing-line">';
        $line .= '<span style="color: #000; font-size: 14px; text-align:left;">' . $langObj[$langProp] . ':' . '</span>';
        $line .= '&nbsp;&nbsp;';
        $line .= $data[$prop];
        $line .= '</p>';

        echo $line;
    }
}

//pagination
function IsNeighbourPage($curPage, $idx, $allPages) { //$curPage = h selida pou vriskomai kathe fora  $allPages = h teleutea selida kathe fora
    $visibleChoices = 7;
    //Eimaste sto prwto stoixeio
    if ($curPage == 1)
        if ($idx <= $visibleChoices)
            return true;

    //Eimaste sto telefteo stoixeio
    if ($allPages == $curPage)
        if ($idx >= ($allPages - $visibleChoices) + 1)
            return true;

    //Eimaste sto kapou anamesa
    if ($curPage > $visibleChoices && $curPage < $allPages - $visibleChoices)
        if (($idx >= $curPage - $visibleChoices / 2 && $idx <= $curPage) || ($idx <= $curPage + $visibleChoices / 2) && $idx >= $curPage)
            return true;

    //Eimaste sta geitonika tis arxis
    if ($curPage <= $visibleChoices)
        if ($idx >= $curPage - $visibleChoices / 2 && $idx <= $curPage + ($visibleChoices - $curPage ) || $idx <= $curPage + $visibleChoices / 2 && $idx >= $curPage)
            return true;

    //if ($curPage <= $visibleChoices )
    //if($idx >= $curPage - $visibleChoices/2 && $idx <= $curPage + $visibleChoices/2)
    //return true;
    //Eimaste sta geitonika tou telous
    if ($curPage >= $allPages - $visibleChoices) {
        if ($idx >= (($curPage - ($visibleChoices - ($allPages - $curPage))) + 1) || $idx >= ($curPage - ($visibleChoices - ($allPages - $curPage) )) && $idx >= $curPage)
            return true;


        //if ($curPage <= $visibleChoices)
        //if($idx >= $curPage - $visibleChoices/2 && $idx <= $curPage + ($visibleChoices - $curPage ) || $idx <= $curPage + $visibleChoices/2 && $idx >= $curPage)
        //return true;
        //if($idx >= ($curPage - ($visibleChoices - ($allPages - $curPage) ))) 
        //return true;
        //else if($curPage <= $allPages - $visibleChoices/2 && $idx >= $allPages - $visibleChoices)
        //return true;
        //if($idx >= ($allPages - $visibleChoices ) + ($visibleChoices - ($allPages - $curPage)))
        //	return true;
    }

    return false;
}

//functions for geting url and manipulating it
function strip_param_from_url($url, $param) {
    $base_url = strtok($url, '?');              // Get the base url
    $parsed_url = parse_url($url);              // Parse it 
    $query = $parsed_url['query'];              // Get the query string
    parse_str($query, $parameters);           // Convert Parameters into array
    unset($parameters[$param]);               // Delete the one you want
    $new_query = http_build_query($parameters); // Rebuilt query string
    if ($new_query == null)
        return $base_url; // Delete ? if new query is empty
    return $base_url . '?' . $new_query;            // Finally url is ready
}

function GetPageUrl($strip_param) {
    return strip_param_from_url('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], $strip_param);
}
?>


        <!--<script type="text/javascript">   //hide the accompanying object tab when you click the general details tab
                $("#first_tab").click(function() {
                    $("#not").toggle();
                });
   </script>-->