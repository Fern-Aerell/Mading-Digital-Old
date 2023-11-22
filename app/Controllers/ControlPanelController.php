<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AkunModel;
use App\Models\ActivityModel;
use App\Models\MarqueeTextModel;
use App\Models\QrCodeModel;
use App\Models\VideoModel;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

class ControlPanelController extends BaseController {
    private $akunModel;

    private function isLogin(): array {

        $data = [];
        $data["status"] = false;
        
        $username = null;
        $password = null;

        if($this->session->get("username") != null && $this->session->get("pass") != null)
        {
            $username = $this->session->get("username");
            $password = $this->session->get("pass");
        }else{
            if(isset($_POST["username"]) && isset($_POST["pass"]))
            {
                $username = $_POST["username"];
                $password = $_POST["pass"];
            }
        }

        if($username != null && $password != null) {
            $this->akunModel = new AkunModel();

            $result = $this->akunModel->where("username", $username)->first();
            
            if($result != null) {
                if(password_verify($password, $result["pass"])) {
                    $this->session->set("username", $username);
                    $this->session->set("pass", $password);
                    $data["status"] = true;
                }else{
                    $data["msg"] = "Password Salah!";
                }
            }else{
                $data["msg"] = "Username Tidak Terdaftar.";
            }
        }

        return $data;
    }

    public function login() {
        return redirect()->to(base_url("control_panel/qrcode"));
    }

    public function logout() {
        $this->session->destroy();
        return $this->login();
    }

    public function qrcode() {
        $data = $this->isLogin();
        if($data["status"] == true)
        {
            $data["sidebar_select"] = "qrcode";

            $model = new QrCodeModel();
            
            if(isset($_POST["link"]) && isset($_POST["description"]) && strlen($_POST["link"]) > 0 && strlen($_POST["description"]) > 0) {
                
                $result = $model->orderBy('id','desc')->first();
                
                if(empty($result)) {
                    $id = 1;
                }else{
                    $id = $result["id"] + 1;
                }

                $link = $_POST["link"];
                $description = $_POST["description"];
                $image = "$id.png";
                $_GET["add_popup"] = false;

                $writer = new PngWriter();

                $qrCode = QrCode::create($link)
                ->setEncoding(new Encoding('UTF-8'))
                ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
                ->setSize(300)
                ->setMargin(10)
                ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin)
                ->setForegroundColor(new Color(0, 0, 0))
                ->setBackgroundColor(new Color(255, 255, 255));

                $result = $writer->write($qrCode);

                $writer->validateResult($result, $link);

                $result->saveToFile("assets/qrcodes/$image");

                $data_query = [
                    "image" => $image,
                    "value" => $link,
                    "description" => $description
                ];

                $model->allowEmptyInserts()->insert($data_query, false);
            }

            if(isset($_GET["use"])){
                $id = $_GET["use"];
                $result = $model->find($id);
                $model->where("use", 1)->set(["use" => 0])->update();
                $model->update($id, ["use" => 1]);
            }

            if(isset($_GET["delete"])){
                $id = $_GET["delete"];
                $result = $model->find($id);
                $file_path = "assets/qrcodes/".$result["image"];
                if(file_exists($file_path))
                {
                    unlink($file_path);
                }
                $model->delete($id);
            }

            $data["qrcode_list"] = $model->findAll();

            return view("control_panels/qrcode", $data);
        }else{
            return view("control_panels/login", $data);
        }
    }
    public function marquee_text() {
        $data = $this->isLogin();
        if($data["status"] == true)
        {
            $data["sidebar_select"] = "marquee_text";

            $model = new MarqueeTextModel();
            
            if(isset($_GET["delete"]))
            {
                $no = $_GET["delete"];
                $model->delete($no);
            }

            if(isset($_POST["text"]))
            {
                $text = $_POST["text"];
                if(strlen($text) > 0) {
                    $model->allowEmptyInserts()->insert(["text" => $text], false);
                }
            }
            
            $data["marquee_text_list"] = $model->findAll();

            return view("control_panels/marquee_text", $data);
        }else{
            return view("control_panels/login", $data);
        }
    }
    public function video() {
        $data = $this->isLogin();
        if($data["status"] == true)
        {
            $data["sidebar_select"] = "video";

            $model = new VideoModel();

            if(isset($_FILES["video"]) && isset($_POST["title"]))
            {
                $result = $model->orderBy('id','desc')->first();
                
                if(empty($result)) {
                    $id = 1;
                }else{
                    $id = $result["id"] + 1;
                }
                
                $file_video = $_FILES["video"];
                $video = "$id.mp4";
                $title = $_POST["title"];
                $_GET["add_popup"] = false;

                $data_query = [
                    "video" => $video,
                    "title" => $title
                ];

                move_uploaded_file($file_video["tmp_name"], "assets/videos/$video");
                $model->allowEmptyInserts()->insert($data_query, false);
            }

            if(isset($_GET["delete"])){
                $id = $_GET["delete"];
                $result = $model->find($id);
                $file_path = "assets/videos/".$result["video"];
                if(file_exists($file_path))
                {
                    unlink($file_path);
                }
                $model->delete($id);
            }

            $data["video_list"] = $model->findAll();

            return view("control_panels/video", $data);
        }else{
            return view("control_panels/login", $data);
        }
    }
    public function activity() {
        $data = $this->isLogin();
        if($data["status"] == true)
        {
            $data["sidebar_select"] = "activity";

            $model = new ActivityModel();

            if(isset($_GET["add_popup"]) && isset($_FILES["image"]) && isset($_POST["title"]) && isset($_POST["text"]) && isset($_POST["text_its_time"]) && isset($_POST["date"]))
            {
                $result = $model->orderBy('id','desc')->first();

                if(empty($result)) {
                    $id = 1;
                }else{
                    $id = $result["id"] + 1;
                }

                $file_image = $_FILES["image"];
                $image = "$id.png";
                $title = $_POST["title"];
                $text = $_POST["text"];
                $text_its_time = $_POST["text_its_time"];
                $date = $_POST["date"];
                $_GET["add_popup"] = false;

                $data_query = [
                    "image" => $image,
                    "title" => $title,
                    "text" => $text,
                    "text_its_time" => $text_its_time,
                    "date" => $date
                ];

                move_uploaded_file($file_image["tmp_name"], "assets/images/$image");
                $model->allowEmptyInserts()->insert($data_query, false);
            }

            if(isset($_GET["edit_popup"]) && isset($_GET["edit_id"]))
            {
                $id = $_GET["edit_id"];
                $data["edit_result"] = $model->find($id);
            }

            if(isset($_GET["edit_popup"]) && isset($_GET["edit_id"]) && isset($_POST["title"]) && isset($_POST["text"]) && isset($_POST["text_its_time"]) && isset($_POST["date"]))
            {
                $id = $_GET["edit_id"];
                $image = "$id.png";
                $title = $_POST["title"];
                $text = $_POST["text"];
                $text_its_time = $_POST["text_its_time"];
                $date = $_POST["date"];

                $data_query = [
                    "title" => $title,
                    "text" => $text,
                    "text_its_time" => $text_its_time,
                    "date" => $date
                ];              

                if(isset($_FILES["image"]))
                {
                    $file_image = $_FILES["image"];
                    move_uploaded_file($file_image["tmp_name"], "assets/images/$image");
                }
                
                $model->update($id, $data_query);

                unset($_GET["edit_popup"]);
                unset($_GET["edit_id"]);
            }

            if(isset($_GET["delete"])){
                $id = $_GET["delete"];
                $result = $model->find($id);
                $file_path = "assets/images/".$result["image"];
                if(file_exists($file_path))
                {
                    unlink($file_path);
                }
                $model->delete($id);
            }

            $data["activity_list"] = $model->findAll();

            return view("control_panels/activity", $data);
        }else{
            return view("control_panels/login", $data);
        }
    }
}

?>
