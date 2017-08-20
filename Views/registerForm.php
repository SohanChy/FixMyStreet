<?php
    $activeBar="Register";
    require 'Import/header.php';
?>

    <h2 style="margin-bottom: 5%; text-align:center">Registration Form</h2>
    <form class="form-horizontal" action="UserController.php" method="POST">
        <div class="form-group">
            <label class="control-label col-sm-4" for="name">Name:</label>
            <div class="col-sm-4 <?php echo $error == 'name' ? 'has-error' : '';?>">
                <input type="text" class="form-control" id="name" maxlength="50" placeholder="Enter Name"
                        name="name" value = "<?php echo $_POST["name"] ?? "";?>">
                <?php
                    if ($error == "name") {
                        echo "<span class='help-block'>
                                <strong>{$errorMessage}</strong>
                                </span>";
                    }
                ?>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-4" for="mobile">Mobile No:</label>
            <div class="col-sm-4 <?php echo $error == 'mobile' ? 'has-error' : '';?>">
                <input type="text" class="form-control" id="mobile" maxlength="50" placeholder="Enter Mobile No"
                        name="mobile" value = "<?php echo $_POST["mobile"] ?? "";?>">
                <?php
                    if ($error == "mobile") {
                        echo "<span class='help-block'>
                                <strong>{$errorMessage}</strong>
                                </span>";
                    }
                ?>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4" for="email">Email:</label>
            <div class="col-sm-4 <?php echo $error == 'email' ? 'has-error' : '';?>">
                <input type="text" class="form-control" id="email" maxlength="50" placeholder="Enter Email"
                        name="email" value = "<?php echo $_POST["email"] ?? "";?>">
                <?php
                    if ($error == "email") {
                        echo "<span class='help-block'>
                                <strong>{$errorMessage}</strong>
                                </span>";
                    }
                ?>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4" for="address">Address:</label>
            <div class="col-sm-4 <?php echo $error == 'address' ? 'has-error' : '';?>">
                <input type="text" class="form-control" id="address" maxlength="100" placeholder="Enter Address"
                        name="address" value = "<?php echo $_POST["address"] ?? "";?>">
                <?php
                    if ($error == "address") {
                        echo "<span class='help-block'>
                                <strong>{$errorMessage}</strong>
                                </span>";
                    }
                ?>
            </div>
        </div>
        
        <div class="form-group">
            <label class="control-label col-sm-4" for="pass">Password:</label>
            <div class="col-sm-4 <?php echo $error == 'pass' ? 'has-error' : '';?>">
                <input type="password" class="form-control" id="pass" maxlength="50" placeholder="Enter Password"
                        name="pass">
                <?php
                    if ($error == "pass") {
                        echo "<span class='help-block'>
                                <strong>{$errorMessage}</strong>
                                </span>";
                    }
                ?>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4" for="conPass">Confirm Password:</label>
            <div class="col-sm-4 <?php echo $error == 'conPass' ? 'has-error' : '';?>">
                <input type="password" class="form-control" id="conPass" maxlength="50" placeholder="Confirm Password"
                        name="conPass">
                <?php
                    if ($error == "conPass") {
                        echo "<span class='help-block'>
                                <strong>{$errorMessage}</strong>
                                </span>";
                    }
                ?>
            </div>
        </div>
        
        <div class="form-group">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <input type="submit" class="btn btn-primary" value="Sign Up" name="action">
                <input type="reset" class="btn btn-danger">
            </div>
        </div>
    </form>

<?php
    require 'Import/footer.php';
?>
