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
        
        <!-- Street -->
        <div class="col-md-9">
            <?php
                echo "
                    <div>
                        <h1>{$street->name}</h1>
                        <h5>Posted By : {$user->name}</h5>
                        <h3>Details : {$street->details}</h3>
                    </div> 
                ";

                $images = json_decode($street->imageJson, true);
                foreach ($images as $image) {
                    echo "
                        <div>
                            <img src='pictures/{$image}' alt='Street Picture' style='width:100%'>
                        <div>
                    ";
                }
            ?>
        </div>
    </div>

<?php
    require 'Import/footer.php';
?>