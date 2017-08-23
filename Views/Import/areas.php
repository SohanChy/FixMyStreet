<h2>Areas</h2>
<ul>
    <!-- Area loop here -->
    <?php
        $areas = Area::getAll();
        if ($areas)
            foreach ($areas as $area) {
                $link = "{$areaPhp}?areaid={$area->id}";
                echo "<li><a href='{$link}'>{$area->name}</a></li>";
            }
    ?>
</ul>