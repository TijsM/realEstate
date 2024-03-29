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


<div class="alert alert-primary" role="alert" id="allertSaved">

</div>


<div id="propertiesPage">
    <div id="mapContainer">
        <div id='map'></div>

    </div>
    <div id="rigth">
        <div class="card" id="filterCard">
            <div class="card-body">
                <form id="frmSearch">
                    <input type="text" class="form-control" name="search" id="txtSearch" placeholder="SEARCH FOR PROPERTIES">
                </form>
            </div>
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
                    <div class="card propertyCard" id="prop' . $jProp->propertyId . '">
                        <img src="' . $firstImage . '" class="card-img-top" alt="img house">
                        <div class="card-body">
                            <h3 class="card-title">' . $jProp->name . '</h3>
                            <h5>€' . $jProp->price . '</h5>
                            <p> bedrooms: ' . $jProp->bedrooms . '</p>
                            <p>' . $jProp->location->city . ' - ' . $jProp->location->street . '</p>
                            <div id="propertyCardButtonGroup">
                            <a class="btn btn-primary" href="property-details.php?id=' . $jProp->propertyId . '" role="button">
                                view details
                            </a>
                            <a class="btn btn-secondary" role="button" onclick="saveProperty(\'' . $jProp->propertyId . '\')" class="save">
                                <i class="far fa-save saveico"></i>
                            </a>
                            </div>
                        </div>
                    </div> 
                    
                    <script>
                    card = document.getElementById("prop' . $jProp->propertyId . '")
                    console.log("' . $jProp->propertyId . '")
                    console.log(card);
                    card.addEventListener("click", function(){
                        removeActiveClassFromProperty()
            
                    
                        document.getElementById("marker"+"' . $jProp->propertyId . '").classList.add("active")
                        document.getElementById("prop"+"' . $jProp->propertyId . '").classList.add("active")
                    })
                    </script>
                    ';
            }
            ?>


        </div>
    </div>
</div>


<script>
    txtSearch.addEventListener('keyup', function() {
        $.ajax({
                url: 'api/api-search-properties.php',
                data: $('#frmSearch').serialize(),
                method: 'GET',
                dataType: 'JSON'
            })
            .done(function(matches) {
                console.log('in search');
                $('.propertyCard').hide();
                $('.marker').hide();

                $(matches).each(function(index, propId) {
                    propertyIdHtml = 'prop' + propId
                    markerIdHtml = 'marker' + propId
                    console.log(propertyIdHtml);
                    $(`#${propertyIdHtml}`).show();
                    $(`#${markerIdHtml}`).show();
                })
            })
    })
</script>




<script>
    //creating the map
    mapboxgl.accessToken = 'pk.eyJ1IjoidGlqc21hcnRlbnMiLCJhIjoiY2pweWNiMHF4MHJ0NTN5bXZzNnFqYjAxbSJ9.on7oKIYiOGKo2sK4qnXqag';
    var map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [12.555050, 55.70], // starting position
        zoom: 12, // starting zoom
    });
    map.addControl(new mapboxgl.NavigationControl());


    const sjProperties = '<?php echo json_encode($jProperties); ?>'
    //creating an array of json objects
    ajProperties = JSON.parse(sjProperties) // convert text into an object
    console.log(ajProperties)


    //looping over the json file
    for (let propertyId in ajProperties) {
        var el = document.createElement('a');

        // console.log(propertyId);
        // console.log(ajProperties);
        // console.log(ajProperties[propertyId].propertyId);
        el.href = '#prop' + ajProperties[propertyId].propertyId;
        el.className = 'fas fa-home fa-2x';
        el.style.color = 'black';
        el.classList.add("marker");
        el.id = 'marker' + ajProperties[propertyId].propertyId;


        let cords = [parseFloat(ajProperties[propertyId].location.longtitude), parseFloat(ajProperties[propertyId].location.latitude)]
        new mapboxgl.Marker(el).setLngLat(cords).addTo(map);

        el.addEventListener('click', function() {
            removeActiveClassFromProperty()

            console.log(document.getElementById('marker' + ajProperties[propertyId].propertyId))
            document.getElementById('marker' + ajProperties[propertyId].propertyId).classList.add('active')
            document.getElementById('prop' + ajProperties[propertyId].propertyId).classList.add('active')
        })
    }

    function removeActiveClassFromProperty() {
        let properties = document.querySelectorAll('.active')
        properties.forEach(function(oPropertyDiv) {
            oPropertyDiv.classList.remove('active')
        })
    }
</script>

<?php
require_once(__DIR__ . '/components/bottom.php');
?>