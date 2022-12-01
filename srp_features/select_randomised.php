<?php
if(session_status() == PHP_SESSION_NONE) { session_start(['read_and_close' => true]); }
include "connect.php";
$rand_name="rando_" . $_SESSION["username"];

$stmt1=$conn->prepare("SELECT * FROM $rand_name WHERE id=1");
$stmt1->execute();
$result=$stmt1->get_result();
if($result){
    $all=mysqli_fetch_all($result, MYSQLI_ASSOC);
    foreach($all as $row){
        $native=$row["native"];
        $target=$row["target"];
        $tier_r=$row["tier"];
    }
}
?>