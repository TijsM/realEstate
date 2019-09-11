<?php
require_once(__DIR__ . '/components/top.php');
?>


<?php
$sData = file_get_contents('data.json');
$jData = json_decode($sData);
// print_r($jProperties);
$jProperties = $jData->properties;
// print_r($jProperties);
?>

<div id="propertiesPage">
    <div id="mapContainer">
        <div id='map'></div>
        <script>
            mapboxgl.accessToken = 'pk.eyJ1IjoidGlqc21hcnRlbnMiLCJhIjoiY2pweWNiMHF4MHJ0NTN5bXZzNnFqYjAxbSJ9.on7oKIYiOGKo2sK4qnXqag';
            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v11'
            });
        </script>
    </div>
    <div id="propertiesContainer">
        <!-- 
        <div class="card propertyCard">
                <img src="assets/uploadedProperties/house.png" class="card-img-top" alt="img house">
                <div class="card-body">
                    <h3 class="card-title">Property Name</h3>
                    <h5> Price</h5>
                    <p>bedrooms</p>
                    <p>city - street</p>
                </div>
            </div> 
    -->



        <?php
        foreach ($jProperties as $jProp) {
            $firstImage = "assets/uploadedProperties/{$jProp->images[0]}";
            echo '
            <div class="card propertyCard">
                <img src="' . $firstImage . '" class="card-img-top" alt="img house">
                <div class="card-body">
                    <h3 class="card-title">' . $jProp->name . '</h3>
                    <h5>' . $jProp->price . '</h5>
                    <p>' . $jProp->bedrooms . '</p>
                    <p>' . $jProp->location->city . ' - ' . $jProp->location->street . '</p>
                </div>
            </div> 
            ';
        }
        ?>
    </div>
</div>
</div>


<?php
require_once(__DIR__ . '/components/bottom.php');
?>