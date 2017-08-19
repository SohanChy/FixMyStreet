<?php
    $activeBar="Register";
    require 'Import/header.php';
?>

    <div style="text-align:center">
        <h2 style="margin-bottom: 5%">Registration Form</h2>
        <form class="form-horizontal" action="UserController.php" method="POST">
            <div class="form-group">
                <label class="control-label col-sm-4" for="name">Name:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="name" maxlength="50" placeholder="Enter Name"
                           name="name">
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-4" for="email">Email:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="email" maxlength="50" placeholder="Enter Email"
                           name="email">
                </div>
            </div>
            
            <div class="form-group">
                <label class="control-label col-sm-4" for="pass">Password:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="pass" maxlength="50" placeholder="Enter Password"
                           name="pass">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-4" for="conPass">Confirm Password:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="conPass" maxlength="50" placeholder="Confirm Password"
                           name="conPass">
                </div>
            </div>
            
            <div class="form-group">
                <div >
                    <input type="submit" class="btn btn-primary" value="Sign Up" name="action">
                    <input type="reset" class="btn btn-danger">
                </div>
            </div>
        </form>
    </div>

<?php
    require 'Import/footer.php';
?>
