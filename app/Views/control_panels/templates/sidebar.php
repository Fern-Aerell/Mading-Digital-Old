<link rel="stylesheet" href="<?= base_url("control_panels/css/sidebar.css")?>">
<div class="sidebar-container">
    <div class="sidebar-body">
        <div class="icon-container">
            <div class="layar-abuabu"></div>
            <div id="layar-merah" class="layar-merah <?= "sidebar_select_".$sidebar_select ?>"></div>
            <a href="qrcode"><img class="icon" src="<?= base_url("control_panels/icon/sidebar_qr_code_icon 1.png")?>" alt="qrcode_icon"></a>
            <a href="marquee_text"><img class="icon" src="<?= base_url("control_panels/icon/sidebar_marquee_text_icon.png")?>" alt="marquee_text_icon"></a>
            <a href="video"><img class="icon" src="<?= base_url("control_panels/icon/sidebar_video_icon.png")?>" alt="video_icon"></a>
            <a href="activity"><img class="icon" src="<?= base_url("control_panels/icon/sidebar_jadwal_icon.png")?>" alt="jadwal_icon"></a>
            <a href="tompel"><img class="icon" src="<?= base_url("control_panels/icon/sidebar_tompel_icon.png")?>" alt="tompel_icon"></a>
        </div>
    </div>
    <a class="logout-button" href="logout"><img src="<?= base_url("control_panels/icon/logout.png") ?>" alt="logout_icon"></a>
</div>