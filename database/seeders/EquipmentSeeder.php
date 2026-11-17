<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class EquipmentSeeder extends Seeder
{
    /**
     * Seed the admin user and sample equipment.
     */
    public function run(): void
    {
        $admin = User::create([
            'name'              => 'Administrator',
            'username'          => 'admin',
            'email'             => 'admin@pickleball.test',
            'email_verified_at' => now(),
            'password'          => Hash::make('Admin@12345'),
        ]);

        $items = [
            ['Carbon Fiber Paddle',       'Paddles',     3500, 'Carbon fiber face, 16mm polymer core', 'available'],
            ['Fiberglass Paddle',         'Paddles',     2200, 'Fiberglass face, 13mm core',           'unavailable'],
            ['Indoor Pickleball Pack',    'Balls',        650, 'Pack of 6 indoor balls, 26 holes',     'available'],
            ['Outdoor Pickleball Pack',   'Balls',        700, 'Pack of 6 outdoor balls, 40 holes',    'available'],
            ['Portable Pickleball Net',   'Nets',        5800, '22 ft portable net with carry bag',    'available'],
            ['Replacement Net',           'Nets',        1500, 'Standard replacement net, 22 ft',      'unavailable'],
            ['Paddle Grip Tape',          'Accessories',  150, 'Overgrip tape, pack of 3',             'available'],
            ['Pickleball Equipment Bag',  'Accessories', 1200, 'Holds 4 paddles and balls',            'unavailable'],
        ];

        foreach ($items as [$name, $cat, $price, $desc, $status]) {
            $admin->equipment()->create([
                'equipment_name'      => $name,
                'category'            => $cat,
                'unit_price'          => $price,
                'description'         => $desc,
                'availability_status' => $status,
            ]);
        }
    }
}