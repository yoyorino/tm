<?php
require_once '../include/init.php';

//var_dump($session);

//if ($session->is_logged_in()) { redirect_to('dashboard.php'); }
//require_once '../include/content.php';
//$blog = DBContent::GetBlog();
//var_dump($blog);

// form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['email']);
    $password = trim($_POST['password']);

    // check db to see if username/password exist
    $found_user = User::authenticate($username, $password);
    if ($found_user) {
        $session->login($found_user);
        log_action('Login', "{$found_user->usEmail} logged in.");
        $_SESSION['products'] = (new DBProducts())->readContent($session->user_id);
        redirect_to('dashboard.php');
    } else {
        // username/password combo was not found in database
        $message = 'Username/password combination incorrect';
    }
} else { // form was not submitted
    $username = '';
    $password = '';
}

?>

<?php require_once 'layout/top_html.php'; ?>
<?php require_once 'layout/top_header.php'; ?>
<?php require_once 'layout/top_navigation.php'; ?>

<?php require_once 'pricing.view.php'; ?>

<?php require_once 'layout/bot_about_us.php'; ?>
<?php require_once 'layout/bot_copyright.php'; ?>
<?php require_once 'layout/bot_html.php'; ?>