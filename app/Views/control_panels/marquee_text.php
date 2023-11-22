<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mading Digital Control Panel - Marquee Text</title>
    <link rel="stylesheet" href="<?= base_url("control_panels/css/marquee_text.css") ?>">
</head>
<body>
    <?php require_once "../app/Views/control_panels/templates/sidebar.php" ?>

    <div class="container">
        <h1>MARQUEE TEXT</h1>
        <?php
            if(isset($marquee_text_list) && count($marquee_text_list) > 0) {
                $marquee_text_join = "";
                foreach ($marquee_text_list as $marquee_text) {
                    if(strlen($marquee_text_join) > 0) {
                        $marquee_text_join .= " | " . $marquee_text["text"];
                    }else{
                        $marquee_text_join .= $marquee_text["text"];
                    }
                }
                echo '<marquee>'.$marquee_text_join.'</marquee>';
            }else{
                echo '<marquee>Tidak ada marquee text yang ditampilkan</marquee>';
            }
        ?>
        <div>
            <?php
                if(isset($marquee_text_list) && count($marquee_text_list) > 0) {
                    $i = 1;
                    foreach ($marquee_text_list as $marquee_text) {
                        echo "<div>";
                        echo '  <span class="number">'.$i.'.</span>';
                        echo '  <span class="text">'.$marquee_text["text"].'</span>';
                        echo '  <a href="?delete='.$marquee_text["no"].'"><img src="'.base_url("control_panels/icon/trash.png").'" alt="delete icon"></a>';
                        echo "</div>";
                        $i++;
                    }
                }
            ?>
        </div>
        <form action="" method="post">
            <input type="text" name="text" id="text">
            <button type="submit">Tambah</button>
        </form>
    </div>

    <script src="<?= base_url("control_panels/javascripts/marquee_text.js") ?>"></script>
</body>
</html>