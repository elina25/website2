
<?php 
if (isset($_GET['lang']) === false){ 
    include 'lang/gr/language.php';
    $CultureID = 1;

}else{
    include 'lang/'.$_GET['lang'].'/language.php';
    if ($_GET['lang'] == "en") $CultureID = 2;
}

?>

