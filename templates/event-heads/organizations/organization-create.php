<div class="row text-center">
    <div class="col-6 ">
        <div class="card mx-auto h-100" style="width: 26rem; ">
            <?php
            if (isset($message)) {
                echo '<div class="alert alert-success">' . $message . '</div>';
            }
            if (isset($error)) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
            ?>
            <img src="templates/assets/images/Create-bro.png" class="card-img-top" alt="...">
            <div class="card-body">
                <h5 class="card-title">Create your organization</h5>
                <p class="card-text">You can create your own organization and invite your friends to join</p>
                <button type="button" class="btn btn-primary w-25" data-toggle="modal" data-target="#createOrganization">Create</button>
            </div>
        </div>
    </div>
    
</div>


<div class="modal fade" id="createOrganization" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Organization</h5>

                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="post">
                <div class="modal-body">

                    <div class="form-group">
                        <label for="exampleInputEmail1">Organization Name</label>
                        <input type="text" name="organization" class="form-control" placeholder="Enter Organization Name">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="addorganization" class="btn btn-primary">Create Organization</button>
                </div>
            </form>
        </div>
    </div>
</div>
