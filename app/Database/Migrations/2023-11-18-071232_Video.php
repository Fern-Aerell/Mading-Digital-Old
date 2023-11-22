<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Video extends Migration
{
    private $table = "video";
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'=> 'INT',
                'auto_increment' => true,
            ],
            'video' => [
                'type'=> 'VARCHAR',
                'constraint' => '255'
            ],
            'title' => [
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
