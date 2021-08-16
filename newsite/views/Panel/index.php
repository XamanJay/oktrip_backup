<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Panel administrativo Oktrip! </title>
    <?php include("views/partialViews/_adminPanelStyles.html"); ?>

</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">

            <!-- sidebar -->
            <?php include("views/partialViews/_adminPanelSidebar.php"); ?>

            <!-- top navigation -->
            <?php include("views/partialViews/_adminPanelTopNav.php"); ?>

            <!-- page content -->
            <div class="right_col" role="main">
                <div class="clear"></div>

            </div>

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Gentelellaaaa - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
                </div>
                <div class="clearfix"></div>
            </footer>
        </div>
    </div>

    <?php include("views/partialViews/_adminPanelScripts.html"); ?>

</body>
</html>
