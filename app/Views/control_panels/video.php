<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mading Digital Control Panel - Video</title>
    <link rel="stylesheet" href="<?= base_url("control_panels/css/video.css") ?>">
</head>
<body>
    <?php require_once "../app/Views/control_panels/templates/sidebar.php" ?>

    <div class="container">
        <h1>VIDEO</h1>
        <div>
            <?php if(isset($video_list) && count($video_list) > 0) { ?>
                <?php foreach($video_list as $video) { ?>
                <div class="video-container">
                    <video src="<?= base_url("assets/videos/".$video["video"]) ?>" width="100%" height="100%" controls></video>
                    <p><?= $video["title"] ?></p>
                    <a class="delete-button" href="?delete=<?= $video["id"] ?>">Hapus</a>
                </div>
            <?php }} ?>

            <a href="?add_popup=true" class="add-video-container">
                <img src="<?= base_url("control_panels/icon/add.png") ?>" alt="add image">
            </a>
        </div>
    </div>

    <?php if(isset($_GET["add_popup"]) && $_GET["add_popup"] == "true") { ?>
        <div class="add-popup-background">
            <form class="add-popup-container" action="" method="POST" enctype="multipart/form-data">
                <h1>Tambah Video</h1>
                <br>
                <label for="video">Video</label>
                <input type="file" name="video" id="video" accept="video/mp4" required>
                <label for="title">Title</label>
                <input type="text" name="title" id="title" placeholder="Masukkan title video" required>
                <br>
                <div>
                    <button class="add-button" type="submit">Tambah</button>
                    <a href="?add_popup=false" class="cancel-button">Batal</a>
                </div>
            </form>
        </div>
    <?php } ?>

    <script src="<?= base_url("control_panels/javascripts/video.js") ?>"></script>
</body>
</html>