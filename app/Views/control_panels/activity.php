<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mading Digital Control Panel - Activity</title>
    <link rel="stylesheet" href="<?= base_url("control_panels/css/activity.css") ?>">
</head>
<body>
    <?php require_once "../app/Views/control_panels/templates/sidebar.php" ?>

    <div class="container">
        <h1>Jadwal</h1>
        <div>

            <?php 
            
                if(isset($activity_list) && count($activity_list) > 0) { 
                    foreach($activity_list as $activity) {
            ?>
                <div class="activity-container">
                    <div class="activity-head">
                        <div>
                            <img src="<?= base_url("assets/images/".$activity["image"]) ?>" alt="activity icon"> 
                            <h1><?= $activity["title"] ?></h1>
                        </div>
                        <span><?php
                        $indonesianDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                        $dateTime = new DateTime($activity["date"]);
                        $englishDayIndex = (int)$dateTime->format('w');
                        $indonesianDay = $indonesianDays[$englishDayIndex];
                        $formattedDateTime = strftime('%A, %H:%M', $dateTime->getTimestamp());
                        $formattedDateTime = $indonesianDay . ', ' . $dateTime->format('H:i');
                        echo $formattedDateTime;
                        ?></span>
                    </div>
                    <div class="activity-body">
                        <p><?= $activity["text"] ?></p>
                        <p><?= $activity["text_its_time"] ?></p>
                        <div>
                            <a class="edit-button" href="?edit_popup=true&edit_id=<?= $activity["id"] ?>&edit_image=false">Edit</a>
                            <a class="delete-button" href="?delete=<?= $activity["id"] ?>"><img src="<?= base_url("control_panels/icon/trash.png") ?>" alt="delete icon"></a>
                        </div>
                    </div>
                </div>
            <?php }} ?>

            <a href="?add_popup=true" class="add-activity-container">
                <img src="<?= base_url("control_panels/icon/add.png") ?>" alt="add icon">
            </a>
        </div>
    </div>

    <?php if(isset($_GET["add_popup"]) && $_GET["add_popup"] == "true") { ?>
    <div class="add-popup-background">
        <form class="add-popup-container" action="" method="POST" enctype="multipart/form-data">
            <h1>Tambah Jadwal</h1>
            <br>
            <label for="image">Image</label>
            <input type="file" name="image" id="image" accept="image/png" required>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" placeholder="Masukkan title" required>
            <label for="text">Text</label>
            <input type="text" name="text" id="text" placeholder="Masukkan text" required>
            <label for="text_its_time">Text Dynamic Island</label>
            <input type="text" name="text_its_time" id="text_its_time" placeholder="Masukkan text untuk dynamic island" required>
            <label for="date">Datetime</label>
            <input type="datetime-local" name="date" id="date" required>
            <br>
            <div>
                <button class="add-button" type="submit">Tambah</button>
                <a href="?add_popup=false" class="cancel-button">Batal</a>
            </div>
        </form>
    </div>
    <?php } ?>

    <?php if(isset($_GET["edit_popup"]) && isset($edit_result) && $_GET["edit_popup"] == "true") { ?>
    <div class="add-popup-background">
        <form class="add-popup-container" action="" method="POST" enctype="multipart/form-data">
            <h1>Edit Jadwal</h1>
            <br>
            <label for="image">Image</label>
            <?php if(isset($_GET["edit_image"]) && $_GET["edit_image"] == "false"){?>
                <img src="<?= base_url("assets/images/".$edit_result["image"]) ?>" alt="image">
                <a href="<?= $_SERVER['REQUEST_URI'] ?>&edit_image=true">Ubah foto</a>
            <?php } else { ?>
                <input type="file" name="image" id="image" accept="image/png" required>
            <?php } ?>
            <label for="title">Title</label>
            <input type="text" name="title" id="title" placeholder="Masukkan title" required value="<?= $edit_result["title"] ?>">
            <label for="text">Text</label>
            <input type="text" name="text" id="text" placeholder="Masukkan text" required value="<?= $edit_result["text"] ?>">
            <label for="text_its_time">Text Dynamic Island</label>
            <input type="text" name="text_its_time" id="text_its_time" placeholder="Masukkan text untuk dynamic island" required value="<?= $edit_result["text_its_time"] ?>">
            <label for="date">Datetime</label>
            <input type="datetime-local" name="date" id="date" required value="<?= $edit_result["date"] ?>">
            <br>
            <div>
                <button class="add-button" type="submit">Edit</button>
                <a href="?edit_popup=false" class="cancel-button">Batal</a>
            </div>
        </form>
    </div>
    <?php } ?>

    <script src="<?= base_url("control_panels/javascripts/activity.js") ?>"></script>
</body>
</html>