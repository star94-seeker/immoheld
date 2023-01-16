<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Properties extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'price' => [
                'type'       => 'DECIMAL',
                'constraint' => '10',
            ],
            'size' => [
                'type'       => 'DECIMAL',
                'constraint' => '10',
            ],
            'address' => [
                'type'       => 'VARCHAR',
                'constraint' => '200',
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'status' =>  [
                'type' => 'tinyint', 
                'constraint' => '1',
                'default' => '1',
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp default current_timestamp',
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('properties');
    }

    public function down()
    {
        $this->forge->dropTable('properties');
    }
}
