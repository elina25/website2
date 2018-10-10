<?php 

require_once("website2/inc/init.php");
require_once("website2/inc/lang.php");

//session_start();

$ControllerSea = new ControllerSea();
$ControllerMainUnities = new ControllerMainUnities();
$ControllerGeophysical = new ControllerGeophysical();

$seas = $ControllerSea-> getSeaWithIDandCulture($_GET['id'], $CultureID)
$geos = $ControllerMainUnities->getAllGeoUnities();
$kinds = $ControllerGeophysical->$getKindOfGeophysical($_GET['id'], $CultureID);
print_r($seas);



?>

