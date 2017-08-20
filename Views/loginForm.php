<?php
    $activeBar="Login";
    require 'Import/header.php';
?>

    <?php
        if ($message) {
            echo "<center><h2><span class='label label-primary'>{$message}</span></h2></center>";
        }
    ?>
    <form class="form-horizontal" action="UserController.php" method="POST">
        <h2 style='margin-bottom: 5%; text-align:center'>Log In Form</h2>
        <div class="form-group">
            <label class="control-label col-sm-4" for="data">Email or Mobile No:</label>
            <div class="col-sm-4 <?php echo $error == 'data' ? 'has-error' : '';?>">
                <input type="text" class="form-control" id="data" maxlength="50" placeholder="Enter Email or Mobile No"
                        name="data" value = "<?php echo $_POST["data"] ?? "";?>">
                <?php
                    if ($error == "data") {
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
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <input type="submit" class="btn btn-primary" value="Log In" name="action">
                <input type="reset" class="btn btn-danger">
            </div>
        </div>
    </form>

<?php
    require 'Import/footer.php';
?>
