<?php
/**
 * Created by PhpStorm.
 * User: stanoja
 * Date: 6/3/16
 * Time: 11:57 AM
 */
?>

<!-- PAGE -->
<div class="container" style="background: url(images/page-bg.png);; border: solid 1px #ddd; border-top: none;">
    <!-- BANNER -->
    <div class="row">
        <div class="col-md-12" style="padding: 20px;">
            <img src="images/banner.png" alt="banner" class="img-thumbnail center-block" style="box-shadow: 0px 1px 2px 1px rgba(0,0,0,0.1); padding: 10px;">
        </div>
    </div>
    <!-- END OF BANNER -->

    <!-- CONTENT -->
    <div class="row">
        <!-- LEFT COLUMN -->
        <div class="col-md-offset-1 col-md-3">


            <?php if (!$session->is_logged_in()): ?>
    <div class="row">
        <div class="col-md-12" style="background: url(images/panel-bg.png); padding-bottom: 15px; box-shadow: 0px 1px 2px 1px rgba(0,0,0,0.3);">
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" role="form">
                <legend>
                    <h1 style="color: white;">Log In</h1>
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
    </div>
<?php endif; ?>


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
</div>
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
</div>
</div>
<!-- END OF LEFT COLUMN -->

<!-- RIGHT COLUMN -->
<div class="col-md-7 col-md-offset-right-1">
    <?php $content = (new DBBlog())->readContent();
    //var_dump($content);
    foreach ($content as $c):?>
    <div class="row">
        <div class="col-md-offset-1 col-md-11" style="margin-bottom: 20px; background-color: white; border: 10px solid #e9e9e9; padding-bottom: 10px;">
            <h1 style="color: #1b6d85"><?=$c->blHeader; ?></h1>
            <br />
            <div class="row">
                <div class="col-md-8">
                    <p><?=$c->blText; ?></p>
                </div>
            </div>
            <hr />
            <div class="col-md-4">
            <h4><?=$c->usName . ' ' . $c->usSurname; ?></h4>
            </div>
            <div class="pull-right text-muted small">
                <h4><?=$c->blDateAdded; ?></h4>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <div class="row">
        <div class="col-md-offset-1 col-md-11" style="margin-bottom: 20px; background-color: white; border: 10px solid #e9e9e9; padding-bottom: 10px;">
            <h1 style="color: #1b6d85">Mauris volutpat nulla sit amet ante</h1>
            <h4>Pellentesque nec massa at massa condimentum rutrum quis sit amet ante. </h4>
            <hr>
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
    </div>
</div>
<!-- END OF RIGHT COLUMN -->

</div>
<!-- END OF CONTENT -->

</div>
<!-- END OF PAGE -->