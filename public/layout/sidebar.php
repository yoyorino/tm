<!-- Navigation -->
<nav role="navigation" style="margin-bottom: 0">

    <!-- /.navbar-header -->


    <!-- /.navbar-top-links -->


    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav">
            <ul class="nav" id="side-menu">

                <li>
                    <a href="dashboard.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                </li>
                <li class="">
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Charts<span class="fa arrow"></span></a>
                    <ul style="height: 0px;" aria-expanded="false" class="nav nav-second-level">
                        <li>
                            <a href="flot.php">Flot Charts</a>
                        </li>
                        <li>
                            <a href="morris.php">Morris.js Charts</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="tables.php"><i class="fa fa-table fa-fw"></i> Tables</a>
                </li>
                <li>
                    <a href="forms.php"><i class="fa fa-edit fa-fw"></i> Forms</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> UI Elements<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="panels-wells.php">Panels and Wells</a>
                        </li>
                        <li>
                            <a href="buttons.php">Buttons</a>
                        </li>
                        <li>
                            <a href="notifications.php">Notifications</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="#">Second Level Item</a>
                        </li>
                        <li>
                            <a href="#">Second Level Item</a>
                        </li>
                        <li>
                            <a href="#">Third Level <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li>
                                <li>
                                    <a href="#">Third Level Item</a>
                                </li>
                            </ul>
                            <!-- /.nav-third-level -->
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-files-o fa-fw"></i> Sample Pages<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="blank.php">Blank Page</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            </ul>
        </div>

        <br>

        <div class="panel panel-primary">
            <div class="panel-heading">
                <i class="fa fa-list fa-fw"></i> My Products
            </div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="list-group">
                    <?php

                    

                    $my_product = new DBProducts();
                    $products = $my_product->readContent($session->user_id);


                    ?>
                    <?php foreach ($products as $ps): ?>
                    <a href="#" class="list-group-item">
                        <i class="fa fa-comment fa-fw"></i> <?php echo $ps->prIme; ?>
                    </a>
                    <?php endforeach; ?>
                </div>
                <!-- /.list-group -->
                <a href="#" class="btn btn-default btn-block">View All Alerts</a>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.sidebar-collapse -->
    </div><!-- /.navbar-static-side -->
</nav>