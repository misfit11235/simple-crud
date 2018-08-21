<?php
    include "autoload.php";

    if(isset($_POST["action"])) {
        if($_POST["action"] === "deleteAddress") {
            $address = new Address();
            $address->deleteAddress($_POST["id"], $address->getTable());
        }
        if($_POST["action"] === "editAddress") {
            $currentAddress = new Address();
            $currentAddress = $currentAddress->getAddressById($_POST["id"], $currentAddress->getTable());
            echo json_encode($currentAddress);
        }
    }