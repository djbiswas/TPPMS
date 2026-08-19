<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        Page::query()->updateOrCreate(
            ['slug' => 'privacy'],
            [
                'title' => 'Privacy Policy',
                'body' => '<p>L&amp;L International Ventures LLC uses this portal to collect contact details and maintenance requests from tenants. Information is used to manage the property and is not sold. Replace this stub with counsel-approved language before production launch.</p>',
                'meta_title' => 'Privacy Policy',
                'meta_description' => 'How L&L International Ventures LLC uses information submitted through the tenant portal.',
                'is_published' => true,
            ]
        );

        Page::query()->updateOrCreate(
            ['slug' => 'terms'],
            [
                'title' => 'Terms and Conditions',
                'body' => '<p>Use of this tenant portal is limited to authorized tenants and staff of L&amp;L International Ventures LLC. Replace this stub with counsel-approved terms before production launch.</p>',
                'meta_title' => 'Terms and Conditions',
                'meta_description' => 'Terms of use for the L&L International Ventures LLC tenant portal.',
                'is_published' => true,
            ]
        );
    }
}
