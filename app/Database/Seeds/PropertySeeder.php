<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run()
    {
        $data = [];
        for($i=1;$i<=50;$i++)
        {
            $property_data = [
                'title' => 'House no. '.$i,
                'price' => 1000 + $i,
                'size' => 80 + $i * 2,
                'address' => '9051'.$i.' Zirndorf (Bronnamberg)',
                'description' => 'The property is in a small and quiet street in an ideal location with very good connections. Here you live centrally, but still in a quiet location. In a few minutes by car you can reach all facilities for daily needs, kindergartens, primary and secondary schools also ensure a high quality of life in Zirndorf and Fürth. For a short trip to Fürth you only need to get on the train. The train station is only 4 km away from the property and takes you to downtown Fürth in just 10 minutes. Last but not least, it is not far to the center of Nuremberg and Erlangen. If you want to go a little further away, Nuremberg Airport can be reached in 30 minutes by car. This connects you to almost all European cities, perfect for a relaxing holiday.',
            ];

            array_push($data, $property_data);
        }
        
        // Using Query Builder
        $this->db->table('properties')->insertBatch($data);
    }
}
