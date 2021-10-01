<?php 
 
    $message = null;
    $errors = null;
    $eventManager = new EventManager();
    $filterTags = $eventManager->getTags();
    try{
        $filterQuery = $eventManager->filterSubEvents($filter_data);
    }
    catch(Exception $e){
        $errors = $e->getMessage();
    }
    try{
        $subevents = $eventManager->getSubEventDetails();
    }
    catch(Exception $e){
        $errors = $e->getMessage();
    }
    
?>


<?php
include 'templates/includes/header.php';
include 'templates/includes/navbar.php';
?>
<div class="row">
    <div class="container-fluid">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Events</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="container">
        <div class="container mt-3">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card h-100">
                            <form action="" method="GET">
                                <div class="card border-0">
                                    <div class="card-header">
                                        <h5>Filter
                                            <button type="submit" class="btn btn-primary btn-sm float-end">Search</button>
                                        </h5>
                                    </div>
                                    <div class="card-body">
                                        <h6>Category List</h6>
                                        <hr>
                                        <?php
                                        if (mysqli_num_rows($filterTags) > 0) {
                                            foreach ($filterTags as $filterlist) {
                                                $checked = [];
                                                if (isset($_GET['filters'])) {
                                                    $checked = $_GET['filters'];
                                                }
                                        ?>
                                                <div>
                                                    <input type="checkbox" name="filters[]" value="<?= $filterlist['ID']; ?>" <?php if (in_array($filterlist['ID'], $checked)) {
                                                                                                                                    echo "checked";
                                                                                                                                } ?> />
                                                    <?php echo $filterlist['TAG_NAME']; ?>
                                                </div>
                                        <?php
                                            }
                                        } else {
                                            echo "No Events Found";
                                        }
                                        ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <?php
                    if (isset($_GET['filters'])) {
                        $filterchecked = [];
                        $filterchecked = $_GET['filters'];
                        foreach ($filterchecked as $filter_data) {
                            
                            if (mysqli_num_rows($filterQuery) > 0) {
                                foreach ($filterQuery as $filter_data_2) :
                    ?>
                                    <div class="col-3 col-lg-4 col-md-6 mb-4">
                                        <div class="card h-100">

                                            <img class="img card-img-top" width="250px" height="200px" src="<?php
                                                                                                            if ($filter_data_2['THUMBNAIL']) {
                                                                                                                echo $filter_data_2['THUMBNAIL'];
                                                                                                            } else {
                                                                                                                echo 'images/placeholder.jpg';
                                                                                                            }
                                                                                                            ?>" alt="">

                                            <div class="card-footer bg-white">
                                                <h3><?php echo $filter_data_2['SUB_EVENT_NAME'] ?></h3>
                                                <p><?= date('d F Y', strtotime($filter_data_2['SUB_EVENT_DATE'])); ?></p>
                                                <form action="joined_the_event.php" method="get">

                                                    <input type="hidden" name="eventjoin" value=<?php //echo $filter_data_2["ID"]; ?>>
                                                    <button type="submit" class="btn btn-outline-primary btn-sm btn-block w-50">Join</button>
                                                    <a href="joined-event.php" class="btn btn-outline-primary btn-sm btn-block w-30">
                                                        Read more
                                                    </a>
                                                    <a href="#" class="btn btn-outline-secondary btn-sm">
                                                        <i class='bx bx-heart'></i>
                                                    </a>
                                                </form>
                                            </div>

                                        </div>
                                    </div>

                                <?php
                                endforeach;
                            }
                        }
                    } else {
                        
                       
                        if (mysqli_num_rows($subevents) > 0) {
                            foreach ($subevents as $sql_all_data) :
                                ?>
                                <div class="col-3 col-lg-4 col-md-6 mb-4">
                                    <div class="card h-100 p-0">
                                        <img class="img card-img-top" width="250px" height="200px" src="<?php
                                                                                                        if ($sql_all_data['THUMBNAIL']) {
                                                                                                            echo $sql_all_data['THUMBNAIL'];
                                                                                                        } else {
                                                                                                            echo 'images/placeholder.jpg';
                                                                                                        }
                                                                                                        ?>" alt="">

                                        <div class="card-footer bg-white">
                                            <h3><?php echo $sql_all_data['SUB_EVENT_NAME'] ?></h3>
                                            <p><?= date('d F Y', strtotime($sql_all_data['SUB_EVENT_DATE'])); ?></p>
                                            <form action="joined_the_event.php" method="get">

                                                <input type="hidden" name="eventjoin" value=<?php //echo $sql_all_data["ID"]; ?>>
                                                <button type="submit" class="btn btn-outline-primary btn-sm btn-block w-50">Join</button>
                                                <a href="joined-event.php" class="btn btn-outline-primary btn-sm btn-block w-30">
                                                    Read more
                                                </a>
                                                <a href="#" class="btn btn-outline-secondary btn-sm">
                                                    <i class='bx bx-heart'></i>
                                                </a>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                    <?php
                            endforeach;
                        } else {
                            echo "No Events Found";
                        }
                    }


                    ?>



                </div>
            </div>
        </div>
    </div>
</div>
<?php
include 'templates/includes/footer.php';
?>