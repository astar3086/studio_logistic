<!DOCTYPE html>
<html>
<head>
    <title>Mobile API</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=1280">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo $blocks['api']['design']; ?>/css/main.css" >

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" crossorigin="anonymous"></script>
    <script src="<?php echo $blocks['api']['design']; ?>/js/main.js"></script>


</head>
<body>

    <div class="content">
        <section class="left">
            <?php echo $blocks['left_menu']; ?>
        </section>

        <section class="right">
            <div class="panel panel-info">
                <div class="panel-heading">Request Data</div>
                <div class="panel-body">

                    <div class="request">
                        <?php echo $blocks['request']; ?>
                    </div>

                    <div class="panel-heading">Response::</div>
                    <div class="panel-body response">
                        <?php echo $blocks['content']; ?>
                    </div>

                </div>
            </div>
        </section>


    </div>

</body>
</html>
