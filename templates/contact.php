<?php
include 'templates/includes/header.php';
include 'templates/includes/navbar.php';
?>

<div class="container mt-4">
    <div class="row">
        <div class="col-3">
            <div class="row">
                <div class="col-12">
                    
                </div>
            </div>
        </div>
        <div class="col-6">
            <form class="text-dark" data-bss-recipient="12223ac6677c1d072c3a5614f27bf1e1">
                <h2 class="text-center">Contact us</h2>
                <div class="form-group"><input class="form-control" type="text" name="name" placeholder="Name" required=""></div>
                <div class="form-group"><input class="form-control" type="email" name="email" placeholder="Email" required=""></div>
                <div class="form-group"><textarea class="form-control" name="message" placeholder="Message" rows="8" required="" minlength="10"></textarea></div>
                <div class="form-group text-center"><button class="btn btn-primary w-100" type="submit">send </button></div>
            </form>
        </div>
        <div class="col-3">
            <div class="row">
                <div class="col-12">
                    
                </div>
            </div>
        </div>
    </div>


</div>

<?php
include 'templates/includes/footer.php';
?>