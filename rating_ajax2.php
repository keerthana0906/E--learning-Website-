<?php
session_start();
include "config2.php";

$userid = $_SESSION["pid"];
$postid = $_POST['postid'];
$rating = $_POST['rating'];
echo $rating;

// Check entry within table
$query = "SELECT COUNT(*) AS cntpost FROM map WHERE courseid=".$postid." and personid=".$userid;

$result = mysqli_query($con,$query);
$fetchdata = mysqli_fetch_array($result);
$count = $fetchdata['cntpost'];

if($count == 1){
    $updatequery = "UPDATE map SET rating=" . $rating . " where personid=" . $userid . " and courseid=" . $postid;
    mysqli_query($con,$updatequery);
}


// get average
$query = "SELECT ROUND(AVG(rating),1) as averageRating FROM map WHERE courseid=".$postid;
$result = mysqli_query($con,$query) or die(mysqli_error());
$fetchAverage = mysqli_fetch_array($result);
$averageRating = $fetchAverage['averageRating'];

$return_arr = array("averageRating"=>$averageRating);

echo json_encode($return_arr);