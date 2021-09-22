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
<?php 
    include 'templates/includes/footer.php';
?>