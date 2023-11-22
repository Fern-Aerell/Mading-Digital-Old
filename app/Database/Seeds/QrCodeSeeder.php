<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class QrCodeSeeder extends Seeder
{
    private $table = "qrcode";

    public function run()
    {
        $data = [
            "image" => "1.png",
            "value" => "https://smkpgripekanbaru.sch.id/",
            "description" => "SMK PGRI PEKANBARU",
            "use" => 1
        ];

        $this->db->table($this->table)->insert($data);
    }
}
