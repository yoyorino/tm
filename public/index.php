<?php
require_once '../include/init.php';

//var_dump($session);

//if ($session->is_logged_in()) { redirect_to('dashboard.php'); }
//require_once '../include/content.php';
$blog = DBContent::GetBlog();
//var_dump($blog);
// form has been submitted
//var_dump($_SERVER['REQUEST_METHOD']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['email']);
    $password = trim($_POST['password']);

    // check db to see if username/password exist
    $found_user = User::authenticate($username, $password);
    if ($found_user) {
        $session->login($found_user);
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
<?php require_once 'layout/html_head.php'; ?>
<?php require_once 'layout/html_navbar.php'; ?>



    <div class="container" style="background: url(images/page-bg.png);; border: solid 1px #ddd; border-top: none;"> <!-- PAGE -->
        <div class="row" style=""> <!-- BANNER -->
            <div class="col-md-12" style="padding: 20px;">
                <img src="../public/images/banner.png" alt="banner" class="img-thumbnail center-block" style="box-shadow: 0px 1px 2px 1px rgba(0,0,0,0.1); padding: 10px;">
            </div>
        </div> <!-- END OF BANNER -->



        <div class="container"> <!-- MAIN CONTENT -->
            <div class="row" style="margin-bottom: 20px">
                <div class="col-md-offset-1 col-md-3"> <!-- LEFT COLUMN -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12" style="background: url(images/panel-bg.png); padding-bottom: 15px; box-shadow: 0px 1px 2px 1px rgba(0,0,0,0.3);">
                                <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" role="form">
                                    <legend>
                                        <h1 style="color: white;">Consecte oura</h1>
                                        <p style="color: white;">Mauris molestie iaculis tellus ino.</p>
                                    </legend>
                                    <fieldset class="form-group">
                                        <label for="email" class="sr-only" hidden>Email address</label>
                                        <input id="email" name="email" type="text" class="form-control" placeholder="Email address" required autofocus>
                                    </fieldset>
                                    <fieldset class="form-group">
                                        <label for="password" class="sr-only" hidden>Password</label>
                                        <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                                    </fieldset>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div> <!-- .col-md-12 -->
                        </div> <!-- .row -->

                        <div class="row">
                            <div class="col-md-12" style="margin-top: 15px; box-shadow: 0px 1px 2px 1px rgba(0,0,0,0.3);">
                                <h1>Quisque egetari</h1>
                                <ul>
                                    <li><a href="#">+ Etiam nec neque nisiorn fauci</a></li>
                                    <li><a href="#">+ Proin suscipit justo euismod ino</a></li>
                                    <li><a href="#">+ Integer nec mi non elit gra</a></li>
                                    <li><a href="#">+ Nunc a massa nulla, quis elem</a></li>
                                    <li><a href="#">+ Cras iaculis felis ut quam</a></li>
                                    <li><a href="#">+ Suspendisse sollicitudin enim</a></li>
                                    <li><a href="#">+ Proin tempor magna vel sap</a></li>
                                </ul>
                            </div> <!-- .col-md-12 -->
                        </div> <!-- .row -->

                        <div class="row">
                            <div class="col-md-12" style="margin-top: 15px; background: url(images/panel-bg.png); padding-bottom: 15px; box-shadow: 0px 1px 2px 1px rgba(0,0,0,0.3);">
                                <h1 style="color: white">Aenean euctus</h1>
                                <dl>
                                    <dt style="color: #2aabd2;">06-23-2012</dt>
                                    <dd style="color: #8b8b8b">Ut quis nibh nibh, eu interdum tiam nec orci ut dui tincidunt hend.</dd>
                                </dl>
                                <dl>
                                    <dt style="color: #2aabd2;">06-17-2012</dt>
                                    <dd style="color: #8b8b8b">Nam curus nunet velit molis elem erat ut enimfrin pretium.</dd>
                                </dl>
                                <dl>
                                    <dt style="color: #2aabd2;">06-08-2012</dt>
                                    <dd style="color: #8b8b8b">Donec estin convallis slolicit cun duis est trupis ligula.</dd>
                                </dl>
                            </div> <!-- .col-md-12 -->
                        </div> <!-- .row -->

                    </div> <!-- .container-fluid -->
                </div> <!-- .col-md-offset-1 .col-md-3 --> <!-- END OF LEFT COLUMN -->

                <div class="col-md-7 col-md-offset-right-1"> <!-- RIGHT COLUMN -->
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h1 style="color: #1b6d85">Mauris volutpat nulla sit amet ante</h1>
                                            <h2>Pellentesque nec massa at massa condimentum rutrum quis sit amet ante. </h2>
                                            <hr>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <img src="images/img-1.png" alt="banner" class="img-thumbnail">
                                        </div>
                                        <div class="col-md-8">
                                            <p>Cras non ante eu ligula bibendum elementum vel vitae lectus. Cras eu risus eu enim semper vulputate. Integer a lorem lorem, nec convallis elit.</p>
                                            <p>Nam metus justo, consequat at lacinia sit amet, adipiscing at dui. Quisque eu velit at velit accumsan suscipit sit amet ac velit. Pellentesque tempus, dolor ac tincidunt ma.</p>
                                            <a href="#">More Info</a>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- .col-md-12 -->

                        </div> <!-- .row -->
                    </div> <!-- .container-fluid -->

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12">
                                <h1 style="color: #1b6d85">Sed hendrerit elit in dignissim molestie</h1>
                                <h2>Aenean vitae eros odio, eu ultricies turpis. Sed pretium nibh id diam bla. </h2>
                                <hr>
                            </div> <!-- .col-md-12 -->
                        </div> <!-- .row -->

                        <div class="row">
                            <div class="col-md-8">
                                <p>Nam cursus nunc et velit egestas mollis. Nullam elementum hendrerit molestie. Aliquam in velit ut libero viverra eleifend lacinia sagittis tellus. Etiam eleifend nisl liquam accumsan erat ut enim fringilla pretium.</p>
                                <a href="#">More Info</a>
                            </div>
                            <div class="col-md-4">
                                <img src="images/img-2.png" alt="banner" class="img-thumbnail">
                            </div>
                        </div> <!-- .row -->


                        <div class="row">
                            <div class="col-md-8">
                                <p>Etiam posuere, magna volutpat auctor ultricies, est quam convallis nunc, a vehicula felis turpis vitae tellus. Donec eros arcu, sollicitudin non ultricies ut, ultrices ut lorem. Duis est turpis, porta nec porta eget, sit amet ligula. </p>
                                <a href="#">More Info</a>
                            </div>
                            <div class="col-md-4">
                                <img src="images/img-3.png" alt="banner" class="img-thumbnail">
                            </div>
                        </div>

                    </div> <!-- .container-fluid -->
                </div> <!-- .col-md-offset-1 .col-md-3 --> <!-- END OF RIGHT COLUMN -->


            </div>
        </div> <!-- MAIN CONTENT -->

    </div> <!-- END OF PAGE -->



<?php require_once 'layout/html_aboutus_copyright.php'; ?>
<?php require_once 'layout/html_tail.php'; ?>