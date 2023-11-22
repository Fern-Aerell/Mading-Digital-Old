<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mading Digital Control Panel - Qrcode</title>
    <link rel="stylesheet" href="<?= base_url("control_panels/css/qrcode.css") ?>">
</head>
<body>
    <?php require_once "../app/Views/control_panels/templates/sidebar.php" ?>

    <div class="container">
        <h1>QRCODE</h1>
        <div>

            <?php 
            
            if(isset($qrcode_list) && count($qrcode_list) > 0) {
                foreach($qrcode_list as $qrcode) {
                    echo '<div class="qrcode-container">';
                    echo '  <img src="'.base_url("assets/qrcodes/".$qrcode["image"]).'" alt="qrcode image">';
                    echo '  <p>'.$qrcode["description"].'</p>';
                    echo '  <div>';
                    if($qrcode["use"] == 0) {
                        echo '      <a class="use-button" href="?use='.$qrcode["id"].'">Gunakan</a>';
                    }else{
                        echo '      <a class="used-button">Digunakan</a>';
                    }
                    echo '      <a class="trash-button" href="?delete='.$qrcode["id"].'"><img src="'.base_url("control_panels/icon/trash.png").'" alt="trash icon"></a>';
                    echo '  </div>';
                    echo '</div>';
                }
            }
            
            ?>

            <a class="add-qrcode-container" href="?add_popup=true">
                <img src="<?= base_url("control_panels/icon/add.png") ?>" alt="add image">
            </a>

        </div>
    </div>

    <?php if(isset($_GET["add_popup"]) && $_GET["add_popup"] == "true") { ?>
    <div class="add-popup-background">
        <form class="add-popup-container" action="" method="POST">
            <h1>Tambah Qrcode Baru</h1>
            <br>
            <label for="link">Link</label>
            <input type="text" name="link" id="link" placeholder="Masukkan link yang ingin dijadikan qrcode.">
            <label for="description">Description</label>
            <input type="text" name="description" id="description" placeholder="Masukkan text yang akan ditampilkan dibawah qrcode.">
            <br>
            <div>
                <button class="add-button" type="submit">Tambah</button>
                <a href="?add_popup=false" class="cancel-button">Batal</a>
            </div>
        </form>
    </div>
    <?php } ?>

    <script src="<?= base_url("control_panels/javascripts/qrcode.js") ?>"></script>
</body>
</html>