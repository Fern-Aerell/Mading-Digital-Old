<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Qrcode extends Migration
{
    private $table = "qrcode";
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'=> 'INT',
                'auto_increment' => true,
            ],
            'image' => [
                'type'=> 'VARCHAR',
                'constraint' => '255'
            ],
            'value' => [
                'type'=> 'VARCHAR',
                'constraint' => '255'
            ],
            'description' => [
                'type'=> 'VARCHAR',
                'constraint' => '255'
            ],
            'use' => [
                'type'=> 'BOOLEAN',
                'default'=> 0
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
