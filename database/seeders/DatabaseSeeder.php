<?php

namespace Database\Seeders;

use App\Models\Property;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $property = Property::query()->create([
            'name' => '317 Freedom Park',
            'address_line' => '317 Freedom Park',
            'city' => 'Liberty Hill',
            'state' => 'TX',
            'postal_code' => '78642',
            'type' => 'Single Family Home',
            'image_path' => 'images/property-hero.jpg',
            'manager_name' => 'Angie Ojeda',
            'manager_title' => 'Property Manager',
            'manager_email' => 'manager@llinternationalventures.com',
            'manager_phone' => '(512) 806-3630',
            'office_hours' => 'Mon - Fri | 9:00 AM - 5:00 PM',
        ]);

        Setting::query()->insert([
            ['key' => 'zelle_handle', 'value' => '@LLInternationalVentures', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'wire_instructions', 'value' => 'Wire details are provided after you sign in, or by email from property management.', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'office_hours', 'value' => 'Mon - Fri | 9:00 AM - 5:00 PM', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'rent_amount', 'value' => '2375.00', 'created_at' => now(), 'updated_at' => now()],
            ['key' => 'next_due_date', 'value' => 'May 1, 2025', 'created_at' => now(), 'updated_at' => now()],
        ]);

        User::factory()->admin()->create([
            'name' => 'Angie Ojeda',
            'email' => 'manager@llinternationalventures.com',
            'phone' => '(512) 806-3630',
            'property_id' => $property->id,
        ]);

        User::factory()->create([
            'name' => 'Tenant',
            'email' => 'tenant@example.com',
            'phone' => '(512) 555-0100',
            'property_id' => $property->id,
            'role' => User::ROLE_TENANT,
            'status' => User::STATUS_ACTIVE,
        ]);
    }
}
