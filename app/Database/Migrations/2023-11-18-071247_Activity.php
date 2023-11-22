<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Activity extends Migration
{
    private $table = "activity";
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
            'title' => [
                'type'=> 'VARCHAR',
                'constraint' => '255'
            ],
            'text' => [
                'type'=> 'VARCHAR',
                'constraint' => '255'
            ],
            'text_its_time' => [
                'type'=> 'VARCHAR',
                'constraint' => '255'
            ],
            'date' => [
                'type'=> 'DATETIME'
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
