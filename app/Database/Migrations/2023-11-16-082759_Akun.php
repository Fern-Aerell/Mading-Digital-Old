<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Akun extends Migration
{
    private $table = "akun";

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'=> 'INT',
                'auto_increment' => true,
            ],
            'username' => [
                'type'=> 'VARCHAR',
                'constraint' => '255'
            ],
            'pass' => [
                'type'=> 'VARCHAR',
                'constraint' => '255'
            ]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable($this->table);
    }

    public function down()
    {
        $this->forge->dropTable($this->table);
    }
}
