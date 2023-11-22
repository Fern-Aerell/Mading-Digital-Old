<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class MarqueeTextSeeder extends Seeder
{
    private $table = "marquee_text";

    public function run()
    {
        $data = [
            "text" => "Tidak ada berita"
        ];

        $this->db->table($this->table)->insert($data);
    }
}
