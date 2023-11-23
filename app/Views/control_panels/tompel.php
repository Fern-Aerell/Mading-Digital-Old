<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mading Digital Control Panel - Tompel</title>
    <link rel="stylesheet" href="<?= base_url("control_panels/css/tompel.css") ?>">
</head>
<body>
    <?php require_once "../app/Views/control_panels/templates/sidebar.php" ?>

    <div class="container">
        <h1>TOMPEL</h1>
        <div>
            <?php if(isset($tompel_list) && count($tompel_list) > 0) { ?>
                <form action="" method="post">
                    <input type="text" name="id" id="id" value="<?= $tompel_list[0]["id"] ?>" hidden>
                    <input type="text" name="text" id="text" value="<?= $tompel_list[0]["text"] ?>">
                    <div>
                        <button class="edit-button" type="submit">Edit</button>
                        <a class="reset-button" href="?reset=<?= $tompel_list[0]["id"] ?>">Reset</a>
                    </div>
                </form>
            <?php } ?>
        </div>
    </div>

    <script src="<?= base_url("control_panels/javascripts/tompel.js") ?>"></script>
</body>
</html>