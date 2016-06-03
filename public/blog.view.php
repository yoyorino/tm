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
            

</div>
<!-- END OF LEFT COLUMN -->

<!-- RIGHT COLUMN -->
<div class="col-md-10  col-md-offset-1">
    <?php $content = (new DBBlog())->readContent();
    //var_dump($content);
    foreach ($content as $c):?>
    <div class="row">
        <div class="col-md-12" style="margin-bottom: 20px; background-color: white; border: 10px solid #e9e9e9; padding-bottom: 10px;">
            <h1 style="color: #1b6d85"><?=$c->blHeader; ?></h1>
            <br />
            <div class="row">
                <div class="col-md-12">
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
        <div class="col-md-12" style="margin-bottom: 20px; background-color: white; border: 10px solid #e9e9e9; padding-bottom: 10px;">
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