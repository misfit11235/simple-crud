<?php
    require_once 'vendor/autoload.php';
    use Symfony\Component\Translation\Translator;
    include 'autoload.php';
    session_start();

    $loader = new Twig_Loader_Filesystem('templates');
    $twig = new Twig_Environment($loader);
    $twig->addExtension(new Twig_Extensions_Extension_I18n());

    

    $user = new User();
    $data = $user->ormRetrieve($user->getTable());
    
    $twig->addGlobal('users', $data);
    
    //locale path&settings
    
    //locale end


    if(isset($_POST["create"])) {
        $user = new User();
        $user->ormCreate($_POST["username"], $_POST["password"], $_POST["email"]);
    }
    
    if(isset($_POST["update"])) {
        $user = new User();
        $user->ormUpdateById($_SESSION["targetId"], $_POST["newUsername"], $_POST["newPassword"], $_POST["newEmail"], $user->getTable());
    }


    echo $twig->render('index.html');