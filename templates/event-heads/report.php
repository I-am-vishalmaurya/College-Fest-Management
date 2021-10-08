<?php
$eventManager = new EventManager();
$subeventManager = new SubEvents();
$headID = $data['id'];
try {
    $getEvent = $eventManager->getEventBasedOnHeadID($headID);
    $arrayOfEvents = mysqli_fetch_all($getEvent);
    
} catch (Exception $e) {
    $error = $e->getMessage();
}


$subevent = null;

?>


<?php
$title = "Report - Eventers";
$bodyColor = 'bg-white';
include 'header.php';
include 'navbar.php';
?>

<div class="container-fluid">
    <div class="row">
        <h3 class="my-4 text-center fs-3 fw-bold h3 text-primary 600">Event Report</h3>
    </div>
    <div class="row">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Event name</th>
                    <th scope="col">Sub event name</th>
                    <th scope="col">Date</th>
                    <th scope="col">Responses</th>
                    <th scope="col">Details</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($j = 0; $j < count($arrayOfEvents); $j++) {
                    $ids = ($arrayOfEvents[$j]);
                    $getSubEvents = $eventManager->getSubEventDetailsBasedOnEventID($ids[0]);
                    $arrayofSubevents[] = mysqli_fetch_all($getSubEvents);
                    if($arrayofSubevents === null){
                        echo "Null";
                    }
                    else{
                        for ($i = 0; $i < count($arrayofSubevents[$j]); $i++) {
                            $subevent = $arrayofSubevents[$j][$i];
                            echo "<tr>";
                            echo "<td>".$subevent[1]."</td>";
                            echo "<td>".$subevent[2]."</td>";
                            echo "<td>".$subevent[3]."</td>";
                            echo "<td>".$subevent[4]."</td>";
                            echo "<td><a href='report-details.php?id=".$subevent[0]."' class='btn btn-primary'>Details</a></td>";
                            echo "</tr>";
                        }
                    }
                }
                
                
                ?>


            </tbody>
        </table>
    </div>
</div>

<?php

include 'footer.php';
?>