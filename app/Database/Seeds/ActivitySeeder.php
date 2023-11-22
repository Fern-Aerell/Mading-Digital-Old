<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ActivitySeeder extends Seeder
{
    private $table = "activity";

    public function run()
    {
        $data = [
            "image" => "1.png",
            "title" => "JadwalApp",
            "text" => "Upcara bendera",
            "text_its_time" => "Sudah saat nya upacara.",
            "date" => "2023-11-20 07:00:00",
        ];

        $this->db->table($this->table)->insert($data);
    }
}
