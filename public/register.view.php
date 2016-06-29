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
        <div class="col-md-offset-2 col-md-8">
            <form action="<?= $_SERVER['PHP_SELF']; ?>" method="post" role="form" id="registration-form">
                <div class="form-group">
                    <label for="fname">First name</label>
                    <input name="fname" type="text" class="form-control" id="fname" placeholder="Enter first name" required>
                </div>
                <div class="form-group">
                    <label for="lname">Last name</label>
                    <input name="lname" type="text" class="form-control" id="lname" minlength="2" placeholder="Enter last name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Enter password" required>
                </div>
                <div class="form-group">
                    <label for="password2">Confirm Password</label>
                    <input name="password2" type="password" class="form-control" id="password2" placeholder="Re-enter password" required>
                </div>
                <div class="form-group">
                    <label for="actcode">Activation Code</label>
                    <input name="actcode" type="text" class="form-control" id="actcode" placeholder="Enter activation code" required>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div>

    </div>
    <!-- END OF CONTENT -->

</div>
<!-- END OF PAGE -->
