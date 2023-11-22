<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AkunSeeder extends Seeder
{
    private $table = "akun";

    public function run()
    {
        $data = [
            "username" => "admin",
            "pass" => password_hash("Admingodok", PASSWORD_DEFAULT)
        ];

        $this->db->table($this->table)->insert($data);
    }
}
