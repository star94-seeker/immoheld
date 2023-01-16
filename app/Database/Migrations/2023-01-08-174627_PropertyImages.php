<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PropertyImages extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'property_id' => [
                'type'       => 'int',
            ],
            'image_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'is_main' =>  [
                'type' => 'tinyint', 
                'constraint' => '1',
                'default' => '0',
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
        $this->forge->addForeignKey('property_id', 'properties', 'id');
        $this->forge->createTable('property_images');
    }

    public function down()
    {
        $this->forge->dropTable('property_images');
    }
}
