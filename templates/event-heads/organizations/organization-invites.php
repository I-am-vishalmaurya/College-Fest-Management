<div class="container">
    <div class="row">
        <div class="container">
        <div class="col-12">
            <div class="card border-primary mb-3" style="max-width: 100%;">
                <div class="card-header">Invite to Organization</div>
                <?php
            if (isset($message)) {
                echo '<div class="alert alert-success">' . $messageInvitation . '</div>';
            }
            if (isset($error)) {
                echo '<div class="alert alert-danger">' . $error . '</div>';
            }
            ?>
                <div class="card-body">
                    <h4 class="card-title">Add the email of user you want to invite as your sub event head</h4>
                    <form method="POST">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email of person you want to invite.">
                        </div>
                        <div class="form-group">
                        <button type="submit" name="invitemembertorganization" class="btn btn-primary btn-sm w-25">Invite</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        </div>
        
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="text-center">
            <div class="card">
                <div class="card-header">
                    <h4>Organization Members</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $i = 0;
                            for($i = 0; $i < count($orgDetails); $i++) {
                                echo '<tr>';
                                echo '<th scope="row">' . $i + 1 . '</th>';
                                echo '<td>' . $orgDetails[$i]['EH_NAME'] . '</td>';
                                echo '<td>' . $orgDetails[$i]['EH_EMAIL'] . '</td>';
                                echo '<td>' . $orgDetails[$i]['ORG_STATUS']. '</td>';
                                echo '<td>';
                                echo '<form method="post">';
                                echo '<input type="hidden" name="id" value="' . $orgDetails[$i]['ID'] . '">';
                                echo '<button type="submit" name="deleteOrgHead" class="btn btn-danger btn-sm">Delete</button>';
                                echo '</form>';
                                echo '</td>';
                                echo '</tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>