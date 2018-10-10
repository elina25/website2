<?php 

$currentPage = 1;
$offset = 0;
$num_of_pages = 0;

if(isset($_GET['page']) && is_numeric($_GET['page']))
{
	$currentPage = $_GET['page'];
}
$offset = ($currentPage - 1)  * $PAGE_SIZE;
$num_of_pages = ceil($countOfRecords / $PAGE_SIZE); 

?>