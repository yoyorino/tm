<?php require_once '../include/init.php';

$session->is_logged_in() ? null : redirect_to('index.php');
//var_dump($session);

?>

<?php require_once 'forms.view.php'; ?>






<!-- jQuery -->
<script src="jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="metisMenu/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="js/sb-admin-2.js"></script>

</body>

</html>
