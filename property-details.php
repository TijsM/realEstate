<?php
require_once(__DIR__ . '/components/top.php');
?>

<?php
$sPropertyId = $_GET['id'];
// echo "<div>$sPropertyId</div>";

$sData = file_get_contents('data.json');
$jData = json_decode($sData);

$jProperty = $jData->properties->$sPropertyId;
// print_r($jProperty);
?>
<a class="btn btn-outline-secondary" id="goBackToProperties" onclick="window.history.back()" role="button">go back to properties</a>
<!-- <button type="button" class="btn btn-secondary" id="goBackToProperties">go back to properties</button> -->
<div class="jumbotron ol col-lg-8  offset-lg-2 jumboPropertyDetails">
    <h1 class="text-center"><?= $jProperty->name ?></h1>
    <div id="carouselImages" class="carousel slide carousel-fade" data-ride="carousel">
        <div class="carousel-inner">
            <?php
            $index = 0;
            foreach ($jProperty->images as $image) {
                // the firt picture needs to have the active class
                if ($index == 0) {
                    echo '
                    <div class="carousel-item active">
                    <img src="assets/uploadedProperties/' . $image . '" class="d-block w-100" alt="image of property">
                    </div>
                    ';
                } else {
                    echo '
                    <div class="carousel-item">
                    <img src="assets/uploadedProperties/' . $image . '" class="d-block w-100" alt="image of property">
                    </div>
                    ';
                }

                $index++;
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#carouselImages" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselImages" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <!-- END OF CARROUSEL -->


    <h3>€ <?= $jProperty->price ?></h3>
    <h5><?= $jProperty->size ?>m² - <?= $jProperty->bedrooms ?> bedrooms</h5>

    <hr class="my-4">

    <strong>location: </strong>
    <div class="propertyDetailsBlock">
        <p>country: <?= $jProperty->location->country ?></p>
        <p>city: <?= $jProperty->location->zipCode ?> - <?= $jProperty->location->city ?></p>
        <p>country: <?= $jProperty->location->street ?> - <?= $jProperty->location->houseNumber ?></p>
    </div>

    <strong>description</strong>
    <div class="propertyDetailsBlock">
        <p>
            <p><?= $jProperty->description ?></p>
        </p>
    </div>

    <hr class="my-4">

    <h3>contact the landlord</h3>
    <?php 
        $sAgentId = $jProperty->agentId;
        $sAgentMail = $jData->users->$sAgentId->email;
        // echo $sAgentMail;
    ?>
    <form id="frmSendMail">
        <input type="text" name="mailAddress" class="d-none" value="<?= $sAgentMail ?>">  
        <textarea class="form-control" name="content" id="exampleFormControlTextarea1" rows="7" id="txtContactLandlord">

        </textarea>
        <button type="button"  class="btn btn-primary btn-lg btn-block" id="btnSendEmail">send mail</button>
    </form>

    <div id="emailStatus"></div>


</div>




<?php
require_once(__DIR__ . '/components/bottom.php');
?>