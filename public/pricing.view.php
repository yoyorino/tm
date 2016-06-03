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
            <div class="row">
                <div class="col-md-offset-1 col-md-11" style="margin-bottom: 20px; background-color: white; border: 10px solid #e9e9e9; padding: 10px;">
                    <div class="col-md-3"  style="background-color: #347AB8; height: 400px; border: 5px solid white;">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center" style="color: white; padding-top: 15px; font-size: 35px">BASIC</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div style="width: 20px; height: 20px; background-color: white;">

                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- BASIC -->

                    <div class="col-md-3" style="background-color: #82A841; height: 400px; border: 5px solid white;">

                    </div>
                    <div class="col-md-3" style="background-color: #E2AD2B; height: 400px; border: 5px solid white;">

                    </div>
                    <div class="col-md-3" style="background-color: #2A2A2A; height: 400px; border: 5px solid white;">

                    </div>
                </div>
            </div>
        </div>
        <!-- END OF RIGHT COLUMN -->

    </div>
    <!-- END OF CONTENT -->

</div>
<!-- END OF PAGE -->