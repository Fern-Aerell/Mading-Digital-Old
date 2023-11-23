<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ActivityModel;
use App\Models\MarqueeTextModel;
use App\Models\QrCodeModel;
use App\Models\VideoModel;
use App\Models\TompelModel;

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

class ApiController extends BaseController {
    // Marquee Text API
    public function get_marquee_text() {
        $this->response->setHeader('Content-Type', 'application/json');
        $model = new MarqueeTextModel();
        $data = $model->findAll();
        if (empty($data)) {
            return $this->response->setJSON([]);
        } else {
            return $this->response->setJSON($data);
        }
    }
    public function add_marquee_text() {
        $this->response->setHeader('Content-Type', 'application/json');
        if(isset($_POST["text"]))
        {
            $model = new MarqueeTextModel();
            $text = $_POST["text"];
            $data = [
                "text" => $text
            ];
            if($model->allowEmptyInserts()->insert($data, false))
            {
                return $this->response->setJSON(["success" => "Berhasil menambahkan marquee text"]);
            }else{
                return $this->response->setJSON(["failed" => "Gagal menambahkan marquee text"]);
            }
        }else{
            return $this->response->setJSON(["error" => "text tidak terdefinisi."]);
        }
    }
    public function remove_marquee_text($no) {
        $this->response->setHeader('Content-Type', 'application/json');
        $model = new MarqueeTextModel();
        if($model->delete($no))
        {
            return $this->response->setJSON(["success" => "Berhasil menghapus marquee text no $no"]);
        }else{
            return $this->response->setJSON(["failed" => "Gagal menghapus marquee text no $no"]);
        }
    }
    // QrCode API
    public function get_qrcode() {
        $this->response->setHeader('Content-Type', 'application/json');
        $model = new QrCodeModel();
        $data = $model->findAll();
        if (empty($data)) {
            return $this->response->setJSON([]);
        } else {
            return $this->response->setJSON($data);
        }
    }
    public function get_use_qrcode() {
        $this->response->setHeader('Content-Type', 'application/json');
        $model = new QrCodeModel();
        $data = $model->where("use", 1)->first();
        if (empty($data)) {
            return $this->response->setJSON([]);
        } else {
            return $this->response->setJSON($data);
        }
    }
    public function add_qrcode() {
        $this->response->setHeader('Content-Type', 'application/json');
        if(isset($_POST["value"]) && isset($_POST["description"]))
        {
            $model = new QrCodeModel();
            $result = $model->orderBy('id','desc')->first();

            if(empty($result)) {
                $id = 1;
            }else{
                $id = $result["id"] + 1;
            }

            $image = "$id.png";
            $value = $_POST["value"];
            $description = $_POST["description"];

            $writer = new PngWriter();

            $qrCode = QrCode::create($value)
            ->setEncoding(new Encoding('UTF-8'))
            ->setErrorCorrectionLevel(ErrorCorrectionLevel::Low)
            ->setSize(300)
            ->setMargin(10)
            ->setRoundBlockSizeMode(RoundBlockSizeMode::Margin)
            ->setForegroundColor(new Color(0, 0, 0))
            ->setBackgroundColor(new Color(255, 255, 255));

            $result = $writer->write($qrCode);

            $writer->validateResult($result, $value);

            $result->saveToFile("assets/qrcodes/$image");

            $data = [
                "image" => $image,
                "value" => $value,
                "description" => $description
            ];

            if($model->allowEmptyInserts()->insert($data, false))
            {
                return $this->response->setJSON(["success" => "Berhasil menambahkan qrcode"]);
            }else{
                return $this->response->setJSON(["failed" => "Gagal menambahkan qrcode"]);
            }
        }else{
            return $this->response->setJSON(["error" => "value dan description tidak terdefinisi."]);
        }
    }
    public function set_use_qrcode() {
        $this->response->setHeader('Content-Type', 'application/json');
        if(isset($_POST["id"]))
        {
            $model = new QrCodeModel();
            $id = $_POST["id"];

            $result = $model->find($id);

            if(empty($result))
            {
                return $this->response->setJSON(["error" => "Qrcode dengan id $id tidak ada"]);
            }

            $model->where("use", 1)->set(["use" => 0])->update();
            $model->update($id, ["use" => 1]);

            return $this->response->setJSON(["success" => "Berhasil menggunakan qrcode dengan id $id"]);
        }else{
            return $this->response->setJSON(["error" => "id tidak terdefinisi."]);
        }
    }
    public function remove_qrcode($id) {
        $this->response->setHeader('Content-Type', 'application/json');
        $model = new QrCodeModel();
        $result = $model->find($id);
        if(empty($result)) return $this->response->setJSON(["failed" => "Qrcode dengan id $id tidak ada"]);
        $file_path = "assets/qrcodes/".$result["image"];
        if(file_exists($file_path))
        {
            unlink($file_path);
        }
        if($model->delete($id))
        {
            return $this->response->setJSON(["success" => "Berhasil menghapus qrcode dengan id $id"]);
        }else{
            return $this->response->setJSON(["failed" => "Gagal menghapus qrcode dengan id $id"]);
        }
    }
    // Video API
    public function get_video() {
        $this->response->setHeader('Content-Type', 'application/json');
        $model = new VideoModel();
        $data = $model->findAll();
        if (empty($data)) {
            return $this->response->setJSON([]);
        } else {
            return $this->response->setJSON($data);
        }
    }
    public function add_video() {
        $this->response->setHeader('Content-Type', 'application/json');
        var_dump($_FILES);
        var_dump($_POST);
        if(isset($_FILES["file_video"]) && isset($_POST["title"]))
        {
            $model = new VideoModel();
            $result = $model->orderBy('id','desc')->first();

            if(empty($result)) {
                $id = 1;
            }else{
                $id = $result["id"] + 1;
            }

            $video = "$id.mp4";
            $title = $_POST["title"];

            $data = [
                "video" => $video,
                "title" => $title
            ];

            if(move_uploaded_file($_FILES["file_video"]["tmp_name"], "assets/videos/$video"))
            {
                if($model->allowEmptyInserts()->insert($data, false))
                {
                    return $this->response->setJSON(["success" => "Berhasil menambahkan video"]);
                }else{
                    return $this->response->setJSON(["failed" => "Gagal menambahkan video"]);
                }
            }else{
                return $this->response->setJSON(["failed" => "Gagal menupload video"]);
            }
        }else{
            return $this->response->setJSON(["error" => "file_video dan title tidak terdefinisi."]);
        }
    }
    public function remove_video($id) {
        $this->response->setHeader('Content-Type', 'application/json');
        $model = new VideoModel();
        $result = $model->find($id);
        if(empty($result)) return $this->response->setJSON(["failed" => "Video dengan id $id tidak ada"]);
        $file_path = "assets/videos/".$result["video"];
        if(file_exists($file_path))
        {
            unlink($file_path);
        }
        if($model->delete($id))
        {
            return $this->response->setJSON(["success" => "Berhasil menghapus video dengan id $id"]);
        }else{
            return $this->response->setJSON(["failed" => "Gagal menghapus video dengan id $id"]);
        }
    }
    // Activity API
    public function get_activity($day) {
        $this->response->setHeader('Content-Type', 'application/json');
        $model = new ActivityModel();
        $data = $model->where("DAYOFWEEK(date)", $day)->findAll();
        if (empty($data)) {
            return $this->response->setJSON([]);
        } else {
            return $this->response->setJSON($data);
        }
    }
    public function add_activity() {
        $this->response->setHeader('Content-Type', 'application/json');
        if(isset($_FILES["file_image"]) && isset($_POST["title"]) && isset($_POST["text"]) && isset($_POST["text_its_time"]) && isset($_POST["date"]))
        {
            $model = new ActivityModel();
            $result = $model->orderBy('id','desc')->first();

            if(empty($result)) {
                $id = 1;
            }else{
                $id = $result["id"] + 1;
            }

            $image = "$id.png";
            $title = $_POST["title"];
            $text = $_POST["text"];
            $text_its_time = $_POST["text_its_time"];
            $date = $_POST["date"];

            $data = [
                "image" => $image,
                "title" => $title,
                "text" => $text,
                "text_its_time" => $text_its_time,
                "date" => $date
            ];

            if(move_uploaded_file($_FILES["file_image"]["tmp_name"], "assets/images/$image"))
            {
                if($model->allowEmptyInserts()->insert($data, false))
                {
                    return $this->response->setJSON(["success" => "Berhasil menambahkan activity"]);
                }else{
                    return $this->response->setJSON(["failed" => "Gagal menambahkan activity"]);
                }
            }else{
                return $this->response->setJSON(["failed" => "Gagal menupload image"]);
            }
        }else{
            return $this->response->setJSON(["error" => "file_image, title, text, text_its_time dan date tidak terdefinisi."]);
        }
    }
    public function remove_activity($id) {
        $this->response->setHeader('Content-Type', 'application/json');
        $model = new ActivityModel();
        $result = $model->find($id);
        if(empty($result)) return $this->response->setJSON(["failed" => "Activity dengan id $id tidak ada"]);
        $file_path = "assets/images/".$result["image"];
        if(file_exists($file_path))
        {
            unlink($file_path);
        }
        if($model->delete($id))
        {
            return $this->response->setJSON(["success" => "Berhasil menghapus activity dengan id $id"]);
        }else{
            return $this->response->setJSON(["failed" => "Gagal menghapus activity dengan id $id"]);
        }
    }

    // Tompel API
    public function get_tompel() {
        $this->response->setHeader('Content-Type', 'application/json');
        $model = new TompelModel();
        $data = $model->find();
        if (empty($data)) {
            return $this->response->setJSON([]);
        } else {
            return $this->response->setJSON($data);
        }
    }

    public function set_tompel() {
        $this->response->setHeader('Content-Type', 'application/json');
        if(isset($_POST["id"]) && isset($_POST["text"]))
        {
            $model = new TompelModel();
            $id = $_POST["id"];
            $text = $_POST["text"];

            $result = $model->find($id);

            if(empty($result))
            {
                return $this->response->setJSON(["error" => "Tompel dengan id $id tidak ada"]);
            }

            $model->update($id, ["text" => $text]);

            return $this->response->setJSON(["success" => "Berhasil mengset tompel dengan id $id"]);
        }else{
            return $this->response->setJSON(["error" => "id dan text tidak terdefinisi."]);
        }
    }

    public function reset_tompel() {
        $this->response->setHeader('Content-Type', 'application/json');
        if(isset($_POST["id"]))
        {
            $model = new TompelModel();
            $id = $_POST["id"];

            $result = $model->find($id);

            if(empty($result))
            {
                return $this->response->setJSON(["error" => "Tompel dengan id $id tidak ada"]);
            }

            $model->update($id, ["text" => "DDS"]);

            return $this->response->setJSON(["success" => "Berhasil mereset tompel dengan id $id"]);
        }else{
            return $this->response->setJSON(["error" => "id tidak terdefinisi."]);
        }
    }
}

?>