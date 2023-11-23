<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Tompel extends Migration
{
    private $table = "tompel";
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'=> 'INT',
                'auto_increment' => true,
            ],
            'text' => [
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
