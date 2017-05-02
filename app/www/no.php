<?php


require_once __DIR__ . "/../boot.php";
require_once __DIR__ . "/../init.php";


use Kamille\Services\XConfig;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <script src="/theme/nullosAdmin/vendors/jquery/dist/jquery.min.js"></script>
    <script src="/datatable.js"></script>
    <link rel="stylesheet" href="/datatable.css">
    <style>
        .datatable_view{
            margin: 50px auto 0 auto;
        }
    </style>
</head>

<body>

<div id="kk" class="datatable_view" data-id="test"></div>
<div class="datatable_view" data-id="test2"></div>



<script>
    $(document).ready(function () {
        function initDataTable() {
            console.log("init datatable");
            $('.datatable_view').dataTable({
                uri: "<?php echo XConfig::get("DataTable.uriAjaxHandler"); ?>"
            });





        }
        initDataTable();
    });
</script>

</body>
</html>
