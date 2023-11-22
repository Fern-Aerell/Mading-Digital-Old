<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class MarqueeText extends Migration
{
    private $table = "marquee_text";
    public function up()
    {
        $this->forge->addField([
            'no' => [
                'type'=> 'INT',
                'auto_increment' => true,
            ],
            'text' => [
                'type'=> 'VARCHAR',
                'constraint' => '255'
            ]
        ]);
        $this->forge->addKey('no', true);
        $this->forge->createTable($this->table);
    }

    public function down()
    {
        $this->forge->dropTable($this->table);
    }
}
