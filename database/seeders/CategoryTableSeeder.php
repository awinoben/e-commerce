<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = array(
            'Parts and Accessories' => array(
                'Parts Upgrades and Parts Replacement' => array(),
                'Storage Devices' => array(
                    'Flash drives',
                    'External Hard drives',
                    'Internal Hard Drives',
                    'Memory'
                ),
                'Cables' => array(
                    'Cat 5e',
                    'Cat 6e',
                    'Fibre Optic (Indoor)',
                    'Fibre Optic (Out Door)'
                ),
                'Power Supply Units' => array(
                    'Servers',
                    'Computers',
                    'Laptops',
                    'Printers'
                ),
                'Mouse and Keyboards' => array(),
                'Laptop Parts and Accessories' => array(
                    'Screens',
                    'Key Board',
                    'Motherboard',
                    'Memory',
                    'Power supply Unit',
                    'Adaptors',
                    'Docking Stations'
                ),
                'Server Parts and Accessories' => array(
                    'Processors',
                    'Hard disks',
                    'Memory',
                    'Power Supply Units',
                    'Rack Mount Keyboards',
                    'Monitors',
                    'Motherboards',
                    'Server Cabinets',
                    'Cables'
                ),
                'Computer Parts and Accessories' => array(
                    'Processors',
                    'Hard disks',
                    'Memory',
                    'Power Supply Units',
                    'Motherboards',
                    'Monitors'
                ),
                'Printer Parts and accessories' => array(
                    'Toner and ink cartridges (Genuine)',
                    'Toner and ink cartridges (Refurbished)'
                )
            ),
            'Software' => array(),
            'Servers and Storage' => array(
                'Rack Mount' => array(),
                'Tower' => array()
            ),
            'Desktop Computers' => array(
                'For Business' => array(),
                'For Home' => array(),
                'For Architects' => array(),
                'For Engineers' => array()
            ),
            'Laptops' => array(
                'For Business' => array(),
                'For Home' => array(),
                'For Architects' => array(),
                'For Engineers' => array()
            ),
            'Printers' => array(
                'LaserJet' => array(
                    'For Home',
                    'For Office (Workgroup Printer)',
                    'For Office (Individual)',
                ),
                'Inkjet Printers' => array(
                    'For Home',
                    'For Office (Workgroup Printer)',
                    'For Office (Individual)',
                )
            ),
            'Networking' => array(
                'Switches' => array(
                    'Ethernet',
                    'Fiber'
                ),
                'Networking accessories' => array(
                    'Patch Pannel',
                    'Face plates',
                    'Patch Cables',
                    'RJ45',
                    'Trunks',
                    'Cable Ties'
                ),
            ),
            'Server and Switch Cabinets' => array(),
            'Conferencing' => array(
                'Projectors' => array(),
                'Audio Visual Equipment' => array(),
                'Cables' => array()
            ),
            'Phones' => array(
                'Mobile Phones' => array(),
                'Office Phones' => array()
            ),
        );

        foreach ($items as $item => $value) {
            $category = Category::query()->create([
                'name' => $item,
                'is_special' => $item === 'Parts and Accessories'
            ]);

            if (is_array($value)) {
                if (count($value)) {
                    foreach ($value as $subcategory => $datum) {
                        $sub_category = SubCategory::query()->create([
                            'category_id' => $category->id,
                            'name' => $subcategory
                        ]);

                        if (is_array($datum)) {
                            if (count($datum)) {
                                foreach ($datum as $sub_sub_category) {
                                    SubSubCategory::query()->create([
                                        'category_id' => $category->id,
                                        'sub_category_id' => $sub_category->id,
                                        'name' => $sub_sub_category
                                    ]);
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
