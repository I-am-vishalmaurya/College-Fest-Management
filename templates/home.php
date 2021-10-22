<?php
$eventManager = new EventManager();
try {
    $limit = 3;
    $CATEGORY_ID = 3;
    $CATEGORY_ID_gamesthon = 2;
    $result1 = $eventManager->subEventsDetailsCategory($limit, $CATEGORY_ID);
    $result2 = $eventManager->subEventsDetailsCategory($limit, $CATEGORY_ID_gamesthon);
} catch (Exception $e) {
    echo $e->getMessage();
}

?>

<?php
include 'templates/includes/header.php';
include 'templates/includes/navbar.php';
?>
<div class="container-fluid p-0">
    <section class="background__hero">
        <svg class="wave" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#fff" fill-opacity="1" d="M0,64L34.3,101.3C68.6,139,137,213,206,250.7C274.3,288,343,288,411,272C480,256,549,224,617,224C685.7,224,754,256,823,245.3C891.4,235,960,181,1029,144C1097.1,107,1166,85,1234,101.3C1302.9,117,1371,171,1406,197.3L1440,224L1440,320L1405.7,320C1371.4,320,1303,320,1234,320C1165.7,320,1097,320,1029,320C960,320,891,320,823,320C754.3,320,686,320,617,320C548.6,320,480,320,411,320C342.9,320,274,320,206,320C137.1,320,69,320,34,320L0,320Z"></path>
        </svg>
    </section>
    <div class="card hero__card p-3" style="max-width: 30rem;">

        <div class="card-body">
            <h4 class="hero-card-header text-white">GET READY!</h4>
            <p class="hero-card-text text-white">DISCOVER THE BEST EVENTS HAPPENING IN THE CITY</p>
        </div>
        <button class="btn btn-block btn-primary w-100" onclick="location.href='#'">Learn More</button>
    </div>
</div>
<!-- featured event -->
<div class="container-fluid py-4" style="background-color: #ff7900;">
    <div class="container my-5">
        <div class="row">
            <div class="col-3">
                <h4 class="text-left title-staff-picks">STAFF PICKS</h4>
                <h2>FEATURED - Entertainment</h2>
                <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio pariatur qui, laborum harum natus aspernatur maiores similique enim? Assumenda impedit similique nam doloribus dolorem cumque sint adipisci ex quo placeat?</P>
            </div>
            <?php 
   
        if ($result1->num_rows > 0) {
            // output data of each row
            while($row = $result1->fetch_assoc()) {
                ?>
                <!-- featured event -->
    
                    <div class="col-3">
                        <div class="card h-100 card--radius">
                        <img class="subevent-images card--radius" src="<?php
                            if ($row['THUMBNAIL']) {
                                echo $row['THUMBNAIL'];
                            } else {
                                echo 'assets/images/placeholder.jpg';
                            }
                            ?>" alt="event thumbnail">
                        <div class="card-body bg-white card--radius">
                            <p class="card-text text-primary">Entertainment</p>
                            <h3><?php echo $row['SUB_EVENT_NAME'] ?></h3>
                            <div class="row">
                                
                                <p><?php echo date('d F Y', strtotime($row['SUB_EVENT_DATE']))?></p>
                                
                            </div>
                            <div class="row">
                                <p class="text-start"><?php echo $row['SUB_EVENT_LOCATION']; ?></p>
                            </div>
                            <button class="btn btn-block btn-primary" onclick="location.href='joiners/pages/joiners_login.php'">Details and Join</button>
                        </div>
                        </div>
                    </div>
                    <?php
            }
        } else {
            echo "0 results";
        }
    ?>
                    
                </div>

            </div>
        </div>
    </div>         
    <!-- end of featured event -->
</div>

<div class="container-fluid py-4">
    <div class="container my-5">
        <div class="row">
            <div class="col-4">
                <h4 class="text-left title-staff-picks">STAFF PICKS</h4>
                <h2>FEATURED - GAMESathon</h2>
                <P>Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio pariatur qui, laborum harum natus aspernatur maiores similique enim? Assumenda impedit similique nam doloribus dolorem cumque sint adipisci ex quo placeat?</P>
            </div>
            <?php 
   
        if ($result2->num_rows > 0) {
            // output data of each row
            while($row = $result2->fetch_assoc()) {
                ?>
                <!-- featured event -->
    
                <div class="col-4">
                        <div class="card h-100 card--radius">
                        <img class="subevent-images card--radius" src="<?php
                            if ($row['THUMBNAIL']) {
                                echo $row['THUMBNAIL'];
                            } else {
                                echo 'assets/images/placeholder.jpg';
                            }
                            ?>" alt="event thumbnail">
                        <div class="card-body bg-white card--radius">
                            <p class="card-text text-primary">Entertainment</p>
                            <h3><?php echo $row['SUB_EVENT_NAME'] ?></h3>
                            <div class="row">
                                
                                <p><?php echo date('d F Y', strtotime($row['SUB_EVENT_DATE']))?></p>
                                
                            </div>
                            <div class="row">
                                <p class="text-start"><?php echo $row['SUB_EVENT_LOCATION']; ?></p>
                            </div>
                            <button class="btn btn-block btn-primary" onclick="location.href='joiners/pages/joiners_login.php'">Details and Join</button>
                        </div>
                        </div>
                    </div>
                    <?php
            }
        } else {
            echo "0 results";
        }
    ?>
                    
                </div>

            </div>
        </div>
    </div>         
    <!-- end of featured event -->
</div>


<!-- Banner for event heads to post -->
<div class="container-fluid event--head--banner  bg-light">
    <div class="container p-5">
        <div class="row my-5">
            <div class="col-12">
                <div class="row">
                    <div class="col">
                        <h2 class="text-center event--head--title">Want to host a event</h2>
                    </div>
                    <p class="text-center event--head--subtitle">Let eventers handle your work, <a href="#">Learn more</a></p>
                </div>


                <div class="row">
                    <div class="col">
                        <button class="btn btn-primary mx-auto w-100 btn-sm btn-event-head-banner">Host a event</button>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary w-100 mx-auto btn-sm btn-event-head-banner">Get Help</button>
                    </div>
                </div>
                <div class="col-6"></div>
            </div>

        </div>
    </div>
</div>
</div>
<?php
include 'templates/includes/footer.php';
?>