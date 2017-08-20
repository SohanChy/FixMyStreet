<?php
    $activeBar="Add Street";
    require 'Import/header.php';
?>

    <div style="text-align:center">
        <h2 style="margin-bottom: 5%">Add New Street</h2>
        <form class="form-horizontal" action="StreetController.php" method="POST">
            <div class="form-group">
                <label class="control-label col-sm-4" for="name">Street Name:</label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" id="name" maxlength="50" placeholder="Enter Street name"
                           name="name">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="txt">Details:</label>
                <div class="col-sm-4">
                    <textarea class="form-control" rows="5" placeholder="Describe here..Max(50 characters)" id="txt"
                              name="details"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-4" for="button">
                    <input type="radio" title="Select Area" name="area" value="old" checked>
                    Select Area:
                </label>
                <div class="col-sm-4">
                    <div class="input-group">
                        <div class="dropdown">
                            <button id="dropdownBtn" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                                Area List
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu">
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
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-4" for="button">
                    <label><input type="radio" name="area" value="new"></label>
                    Create Area:
                </label>
                <div class="col-sm-4">
                    <input type="text" style="max-width: 200px" class="form-control" placeholder="Enter Area name"
                           name="newArea">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-4">Upload Picture:</label>
                <div class="col-sm-4">
                    <input type="file" name="streetPic1">
                    <input type="file" name="streetPic2">
                    <input type="file" name="streetPic3">
                </div>
            </div>

            <div class="form-group">
                <div >
                    <button type="submit" class="btn btn-danger">Submit</button>
                </div>
            </div>
        </form>
    </div>

    <script>
         $( function() {
            $(".dropdown-menu li a").click( function() {
                $("#dropdownBtn").text($(this).text());
                $("#oldArea").val($(this).text());
            });
        });
    </script>

<?php
    require 'Import/footer.php';
?>
