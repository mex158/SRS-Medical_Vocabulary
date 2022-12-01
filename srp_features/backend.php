<?php
include "select_randomised.php";
$table_name="words_" . $_SESSION["username"];
$rand_name="rando_" . $_SESSION["username"];

if(isset($_POST["dont_know"])){
    $stmt2=$conn->prepare("UPDATE $table_name SET correct=0, tier=tier-? WHERE native=?");
    if($tier_r>0){
        $minus_tier=1;
    } else {
        $minus_tier=0;
    }
    
    $stmt2->bind_param("is",  $minus_tier, $native);
    $stmt2->execute();

    $stmt_tx=$conn->prepare("SELECT tier FROM $table_name WHERE native=?");
    $stmt_tx->bind_param("s", $native);
    $stmt_tx->execute();
    $result=$stmt_tx->get_result();
    if($result){
        $show=mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach($show as $row){
            $tierx=$row["tier"];
        }
    }

    $stmt3=$conn->prepare("SELECT * FROM algo WHERE tier=?");
    $stmt3->bind_param("i", $tierx);
    $stmt3->execute();
    $result=$stmt3->get_result();
    if($result){
        $algor=mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach($algor as $row){
            $days_algo=$row["days"];
        }
    }


    $stmt4=$conn->prepare("UPDATE $table_name SET days_repeat=? WHERE tier=?");
    $stmt4->bind_param("ii", $days_algo, $tierx);
    $stmt4->execute();

    include "random_word.php";
    if(!empty($word)){
    $stmt=$conn->prepare("UPDATE $rand_name SET native=?, target=?, tier=?");
    $stmt->bind_param("ssi", $word, $trans, $tier);
    $stmt->execute();
    include "select_randomised.php";
    }

}



if(isset($_POST["knew"])){
    $stmt2=$conn->prepare("UPDATE $table_name SET correct=1, tier=tier+?, date_last=NOW() WHERE native=?");
    if($tier_r>19){
        $plus_tier=0;
    } else {
        $plus_tier=1;
    }
    $stmt2->bind_param("is", $plus_tier, $native);
    $stmt2->execute();

    $stmt_tx=$conn->prepare("SELECT tier FROM $table_name WHERE native=?");
    $stmt_tx->bind_param("s", $native);
    $stmt_tx->execute();
    $result=$stmt_tx->get_result();
    if($result){
        $show=mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach($show as $row){
            $tierx=$row["tier"];
        }
    } 

    $stmt3=$conn->prepare("SELECT * FROM algo WHERE tier=?");
    $stmt3->bind_param("i", $tierx);
    $stmt3->execute();
    $result=$stmt3->get_result();
    if($result){
        $algor=mysqli_fetch_all($result, MYSQLI_ASSOC);
        foreach($algor as $row){
            $days_algo=$row["days"];
        }
    }


    $stmt4=$conn->prepare("UPDATE $table_name SET days_repeat=? WHERE tier=?");
    $stmt4->bind_param("ii", $days_algo, $tierx);
    $stmt4->execute();
    include "random_word.php";
    if(!empty($word)){
    $stmt=$conn->prepare("UPDATE $rand_name SET native=?, target=?, tier=?");
    $stmt->bind_param("ssi", $word, $trans, $tier);
    $stmt->execute();
    include "select_randomised.php";
    }

}
?>