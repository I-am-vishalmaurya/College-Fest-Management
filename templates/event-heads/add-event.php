<?php
    $title = "Dashboard - Eventers";
    $bodyColor = 'bg-white';
    include 'templates/event-heads/header.php';
    include 'templates/event-heads/navbar.php';
    

?>
<div class="row ml-4">
    <div class="text-start">
        <h3 class="h3 text-gray-700 text-bold">Host Event</h3>
    </div>
    <div class="row">
        <div class="text-start">
            <p class="text-gray" style="color:orange">
                Terms and conditions for hosting events.
            </p>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui delectus, amet nostrum exercitationem sunt voluptates iure rem. Suscipit neque eveniet distinctio natus ex tempora, harum, delectus id odit quis cupiditate.
            Unde hic pariatur minus nisi exercitationem obcaecati esse quisquam laboriosam non vitae, doloremque fugiat cum qui eum eligendi? Dolor eius voluptates magnam, fugiat voluptatem doloribus cupiditate illo! Atque, repellendus quas.
            Amet quidem accusamus animi repudiandae facilis blanditiis consequuntur natus expedita non esse! Laborum voluptate dolore impedit eveniet delectus. Facilis beatae provident adipisci non similique voluptatibus unde dignissimos ullam. Nisi, vero?
            Incidunt quaerat ipsam magnam inventore soluta nesciunt, minima quasi officia perferendis corporis aspernatur dicta quae, eum doloribus neque sit? Fugiat reprehenderit illo quisquam sit, tempore in omnis corporis eos commodi?
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Labore aliquam adipisci dolor neque unde obcaecati, cum, possimus quaerat exercitationem harum incidunt soluta? Eos accusamus fuga voluptate pariatur exercitationem quas fugit?
            Pariatur dolores suscipit odio fugiat omnis optio quas cupiditate eos officia! Magnam esse nobis dolorem repellat, ducimus vitae, consequatur iure corrupti asperiores porro maxime vero aliquam explicabo culpa. Magni, consectetur!
            Illum, sunt delectus molestiae omnis tenetur veritatis in et consectetur temporibus architecto placeat maxime rem quasi deserunt ut. Quod, atque dolorem! Mollitia iste debitis blanditiis dolor numquam pariatur tenetur harum?
        </div>
    </div>
    <form action="add-event.php?confirm" method="get">
        <div class="form-check my-4">
            <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
            <label class="form-check-label" for="invalidCheck">
                Agree to terms and conditions
            </label>
            <div class="invalid-feedback">
                You must agree before submitting.
            </div>
            
        </div>
        <button type="submit" class="btn btn-primary">Host new event</button>
    </form>


<?php 
    include_once 'templates/event-heads/footer.php';
?>