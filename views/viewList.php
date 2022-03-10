<?php
define("TITLE", "Product List");
define("BUTTON_1", 'id="add-product-btn" href="./add-product">ADD');
define("BUTTON_2", 'id="delete-product-btn" onclick="">MASS DELETE');
// Lai būtu iespējams ievietot mainīgos paraugā
ob_start();
require(dirname(__DIR__, 1) . "/html/pageHead.html");
require(dirname(__DIR__, 1) . "/html/viewRibbon.html");
ob_end_flush();
?>

<div id="content" class="container">
    <div class="row row-cols-auto"><?php
    // Nolasām produktu sarakstu no datubāzes
    $connectDB = new database();
    $inventory = $connectDB->getProductList();

    for ($i=0; $i < sizeof($inventory); $i++) {
        // Card, kuras info tiek aizpildīts ar klases pasniegtajiem datiem
        // Echo atdalīts tukšā rindā, lai kad lietotājs skatās mājaslapas kodu, nav briesmīgs noformējums
        echo '
        <div class="col card border-dark">
            <input class="form-check-input delete-checkbox" type="checkbox" value="" aria-label="Select for deletion">
            <div class="cardContents text-center">
                <p class="sku text-muted">' . $inventory[$i]->readSKU() . '</p>
                <p class="name">' . $inventory[$i]->readName() . '</p>
                <p class="price">' . $inventory[$i]->readPrice() . '</p>
                <p class="attributes">
                    <span class="attributeType">' . $inventory[$i]->readType() . ': </span>
                    <span class="attributeValue">' . $inventory[$i]->readValue() . '</span>
                    <span class="attributeMeasure">' . $inventory[$i]->getValueMeasure() . '</span>
                </p>
            </div>
        </div>';
    };
    echo "\n";?>
    </div>
</div>
<?= require(dirname(__DIR__, 1) . "/html/viewFooter.html"); ?>