<?php require_once 'layout/top_html.php'; ?>
<body>
<?php require_once 'layout/top_header.php'; ?>
<?php require_once 'layout/top_navigation.php'; ?>

<div id="wrapper">

    <?php require_once 'layout/sidebar.php'; ?>

    <div id="page-wrapper">
        <?php if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $product = null;

            var_dump($_SESSION);
            foreach ($_SESSION['products'] as $p){
                if ($p->prId == $id)
                    $product = $p;

            }
            if (!is_null($product))
                require_once 'layout/dashboard_product.php';
            else
                require_once 'layout/dashboard_global.php';

        } else {
            require_once 'layout/dashboard_global.php';
        }
        ?>
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->



<?php require_once 'layout/bot_about_us.php'; ?>
<?php require_once 'layout/bot_copyright.php'; ?>
<?php require_once 'layout/bot_html.php'; ?>
</body>
</html>
