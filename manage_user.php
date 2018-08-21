<?php
    require_once 'vendor/autoload.php';
    use Symfony\Component\Translation\Translator;
    include 'autoload.php';
    session_start();

    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader);
    
    $address = new Address();
    $data = $address->showAddresses($_GET["targetId"]);;
    
    $_SESSION["targetId"] = $_GET["targetId"];

    $currentUser = new User();
    $currentUser = $currentUser->getUserById($_SESSION["targetId"], $currentUser->getTable());
        
    $twig->addGlobal('addresses', $data);

    if(isset($_POST["deleteUser"])) {
        $user = new User();
        $user->ormDeleteById($_SESSION["targetId"], $user->getTable());
    }
    if(isset($_POST["updateUser"])) {
        $user = new User();
        $user->ormUpdateById($_SESSION["targetId"], $_POST["newUser"], $_POST["newPass"], $_POST["newEmail"], $user->getTable());
    }
    if(isset($_POST["addAddress"])) {
        $address = new Address();
        $address->addAddress($_SESSION["targetId"], $_POST["city"], $_POST["street"], $_POST["zipcode"]);
    }
    if(isset($_POST["updateAddress"])) {
        $address = new Address();
        $address->updateAddress($_POST["hiddenAddressId"], $_POST["newCity"], $_POST["newStreet"], $_POST["newZipcode"], $address->getTable());
    }

    echo $twig->render('manage_user.html');