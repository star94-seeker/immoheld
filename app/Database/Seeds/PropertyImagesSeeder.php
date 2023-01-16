<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;
use App\Models\PropertyModel as PropertyModel;

class PropertyImagesSeeder extends Seeder
{
    public function run()
    {
        $propertyModel = new PropertyModel();
        $properties = $propertyModel->selectAll();
        $data = [];
        foreach($properties as $property)
        {
            $image_data = [
                'property_id' => $property['id'],
                'image_name' => 'image'.$property['id'].'.jpg',
                'is_main' => 1,
                ];

            array_push($data, $image_data);
        }
        // Using Query Builder
        $this->db->table('property_images')->insertBatch($data);
    }
}
