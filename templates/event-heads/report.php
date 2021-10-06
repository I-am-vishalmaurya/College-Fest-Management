<?php
$subeventManager = new SubEvents();
$headID = $data['id'];
$subevent = $subeventManager->getSubEvents($headID);

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
                $serial_count = 0;

                while ($row = mysqli_fetch_assoc($subevent)) {
                    $serial_count += 1;

                ?>

                    <tr>
                        <th scope="row"><?php echo $serial_count ?></th>
                        <td><?php echo $row['EVENT_NAME']; ?></td>
                        <td><?php echo $row['SUB_EVENT_NAME']; ?></td>
                        <td><?php echo date('d F Y', strtotime($row['SUB_EVENT_DATE'])); ?></td>
                        <!-- <td><?php //numberOfJoiners($row['ID']); 
                                    ?></td> -->
                        <form action="eventJoinersDetails.php" method="get">
                            <td><button class="btn btn-block btn-outline-primary" name="buttoneventID" value=<?php echo $row['ID'] ?> onclick="location.href='eventJoinersDetails.php'">View</button></td>
                        </form>
                    </tr>
                <?php
                }


                ?>
            </tbody>
        </table>
    </div>
</div>

<?php

include 'footer.php';
?>