<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TompelSeeder extends Seeder
{
    private $table = "tompel";
    public function run()
    {
        $data = [
            "text" => "DDS"
        ];

        $this->db->table($this->table)->insert($data);
    }
}
