<?php require_once '../include/init.php';

$session->is_logged_in() ? null : redirect_to('index.php');
//var_dump($session);

?>

<?php require_once 'notifications.view.php'; ?>
