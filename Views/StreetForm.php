<?php
    $activeBar="Add Street";
    require 'Import/header.php';
?>

    <form class="form-horizontal" action="StreetController.php" method="POST">
        <h2 style="margin-bottom: 5%; text-align:center">Add New Street</h2>
        <div class="form-group">
            <label class="control-label col-sm-4" for="name">Street Name:</label>
            <div class="col-sm-4 <?php echo $error == 'name' ? 'has-error' : '';?>">
                <input type="text" class="form-control" id="name" maxlength="50" placeholder="Enter Street name"
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
            <label class="control-label col-sm-4" for="txt">Details:</label>
            <div class="col-sm-4 <?php echo $error == 'details' ? 'has-error' : '';?>">
                <textarea class="form-control" rows="5" placeholder="Describe here..Max(50 characters)" id="txt"
                            name="details"><?php echo $_POST["details"] ?? "";?></textarea>
                <?php
                    if ($error == "details") {
                        echo "<span class='help-block'>
                                <strong>{$errorMessage}</strong>
                                </span>";
                    }
                ?>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4" for="button">
                <input type="radio" name="area" value="old" checked>
                Select Area:
            </label>
            <div class="col-sm-4">
                <div class="input-group">
                    <div class="dropdown">
                        <button id="dropdownBtn" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                            Area List
                            <span class="caret"></span>
                        </button>
                        <ul id= "select-area" class="dropdown-menu">
                            <?php
                                $areas = Area::getAll();
                                foreach ($areas as $area) {
                                    echo "
                                        <li><a href=\"#\">{$area->name}</a></li>
                                        <li role=\"separator\" class=\"divider\"></li>
                                    ";
                                }
                            ?>
                        </ul>
                    </div>
                    <input id="oldArea" type="hidden" name="oldArea" value="">
                    <?php
                    if ($error == "oldArea") {
                        echo "<span class='help-block'>
                                <strong>{$errorMessage}</strong>
                                </span>";
                    }
                ?>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4" for="button">
                <input type="radio" name="area" value="new"
                    <?php
                        if (isset($_POST["area"]))
                            echo $_POST["area"] == "new" ? "checked" : "";
                    ?>>
                Create Area:
            </label>
            <div class="col-sm-4 <?php echo $error == 'newArea' ? 'has-error' : '';?>">
                <input type="text" style="max-width: 200px" class="form-control" placeholder="Enter Area name"
                        name="newArea" value = "<?php echo $_POST["newArea"] ?? "";?>">
                <?php
                    if ($error == "newArea") {
                        echo "<span class='help-block'>
                                <strong>{$errorMessage}</strong>
                                </span>";
                    }
                ?>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-sm-4">Upload Picture:</label>
            <div class="col-sm-4">
                <input type="file" name="pic1">
                <input type="file" name="pic2">
                <input type="file" name="pic3">
                <?php
                    if ($error == "picture") {
                        echo "<span class='help-block'>
                                <strong>{$errorMessage}</strong>
                                </span>";
                    }
                ?>
            </div>
        </div>

        <div class="form-group">
            <div class="col-sm-4 col-sm-offset-4">
                <input type="submit" class="btn btn-primary" value="Submit" name="action">
                <input type="reset" class="btn btn-danger">
            </div>
        </div>
    </form>

    <script>
         $( function() {
            $("#select-area li a").click( function() {
                $("#dropdownBtn").text($(this).text());
                $("#oldArea").val($(this).text());
            });
        });
    </script>

<?php
    require 'Import/footer.php';
?>
