<!-- TOP HEADER -->
<div id="top-header" class="container-fluid">
    <div class="row">
        <div class="col-md-offset-1 col-md-5">
            <a href="index.php"><img id="logo" src="images/logo.png" alt="logo" style="padding-top: 20px"></a>
        </div>
        <?php if ($session->is_logged_in()): ?>
        <div id="navigation" class="col-md-5 col-md-offset-right-1">
            <ul class="list-inline pull-right">
                <li><a href="dashboard.php"><img src="images/dashboard.png" alt="dashboard" width="50" height="50"></a></li>
                <li><a href="#"><img src="images/settings.png" alt="settings" width="50" height="50"></a></li>
                <li><a href="logout.php"><img src="images/logout.png" alt="logout" width="50" height="50"></a></li>
            </ul>
        </div>
        <?php endif; ?>
    </div>
</div>
<!-- END OF TOP HEADER -->
