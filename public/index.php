<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Widgets</title>
    <link rel="stylesheet" href="../assets/css/index.css">
</head>
<body>
    
    <div class="container-main">
        <div class="container-w">
            <div class="iframe-class">
                <p>Iframe Widget 1</p>
                <span>
                    <?=
                        nl2br(
                            htmlentities(
                                '<iframe src="http://ec2-18-225-36-175.us-east-2.compute.amazonaws.com/widget-players.php" style="width:100%; height: 450px" frameborder="0"></iframe>'
                            )
                        );
                    ?>
                </span>
            </div>

            <div class="embed-class">
                <p>Embed Widget 1</p>
                <span>
                    <?=
                        nl2br(
                            htmlentities(
                                '<embed src="http://ec2-18-225-36-175.us-east-2.compute.amazonaws.com/widget-players.php" style="width:100%; height: 450px" frameborder="0">'
                            )
                        );
                    ?>
                </span>
            </div>
        </div>

        <div class="container-w">
            <div class="iframe-class">
                <p>Iframe Widget 2</p>
                <span>
                    <?=
                        nl2br(
                            htmlentities(
                                '<iframe src="http://ec2-18-225-36-175.us-east-2.compute.amazonaws.com/widget-results.php" style="width:100%; height: 450px" frameborder="0"></iframe>'
                            )
                        );
                    ?>
                </span>
            </div>

            <div class="embed-class">
                <p>Embed Widget 2</p>
                <span>
                    <?=
                        nl2br(
                            htmlentities(
                                '<embed src="http://ec2-18-225-36-175.us-east-2.compute.amazonaws.com/widget-results.php" style="width:100%; height: 450px" frameborder="0">'
                            )
                        );
                    ?>
                </span>
        </div>
    </div>

</body>
</html>