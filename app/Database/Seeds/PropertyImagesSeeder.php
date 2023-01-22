<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\PropertyModel as PropertyModel;

class PropertyImagesSeeder extends Seeder
{
    public function run()
    {
        $properties = $this->db->query("SELECT id FROM properties WHERE status = 1")->getResultArray();
        $data = [];

        foreach ($properties as $property) {
            $image_data = [
                'property_id' => $property['id'],
                'image_name' => 'image.jpg',
                'is_main' => 1,
            ];

            array_push($data, $image_data);
        }

        $this->db->table('property_images')->insertBatch($data);
    }
}
