<?php
    $activeBar="Home";
    require 'Import/header.php';
?>

    <!-- Row For Search Box -->
    <div class="row">
        <div class="col-lg-8"> <!-- Pushing Search Box to right -->
        </div>

        <div class="col-lg-4">
            <form action="search.php" method="get">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search by Street Name...">
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default" type="button">Go!</button>
                    </span>
                </div>
            </form>
        </div>
    </div>

    <div style="text-align: center;">
        <h2>Welcome to Fix My Street</h2>
        <?php if (isset($message)) echo "<p>{$message}</p>"; ?>
    </div>

    <!-- Row For Areas and Streets -->
    <div class="row">

        <!-- Areas -->
        <div class="col-md-3" style="border: 0.2px solid #e2e2e2;">
            <?php
                require 'Import/areas.php';
            ?>
        </div>
        
        <!-- Streets -->
        <div class="col-md-9">
            <?php
                foreach ($streets as $street) {
                    $defaultImg = json_decode($street->imageJson, true)["images"][0];
                    $link = "{$rootFolder}/{$streetPhp}?streetid={$street->id}";
                    echo "
                        <div class=\"col-md-4\">
                            <div class=\"thumbnail\">
                                <a href=\"/{$link}\" target=\"_blank\">
                                    <img src=\"{$defaultImg}\" alt=\"Street Picture\" style=\"width:100%\">
                                    <div class=\"caption\">
                                        <p>{$street->name}</p>
                                    </div>
                                </a>
                            </div>
                        </div>
                    ";
                }
            ?>
        </div>
    </div>

<?php
    require 'Import/footer.php';
?>