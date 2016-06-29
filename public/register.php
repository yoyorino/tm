<?php
require_once '../include/init.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    var_dump($_POST);
    extract($_POST);
    var_dump($fname);
    User::register($fname, $lname, $email, $password, $actcode);

}
?>

<?php require_once 'layout/top_html.php'; ?>
<?php require_once 'layout/top_header.php'; ?>
<?php require_once 'layout/top_navigation.php'; ?>

<?php require_once 'register.view.php'; ?>

<?php require_once 'layout/bot_about_us.php'; ?>
<?php require_once 'layout/bot_copyright.php'; ?>
<?php require_once 'layout/bot_html.php'; ?>