<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class VideoSeeder extends Seeder
{
    private $table = "video";

    public function run()
    {
        $data = [
            "video" => "1.mp4",
            "title" => "Intro"
        ];

        $this->db->table($this->table)->insert($data);
    }
}
