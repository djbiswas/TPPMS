<?php

namespace Tests\Feature;

use App\Models\Page;
use App\Models\Property;
use App\Models\User;
use App\Support\Company;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminCmsTest extends TestCase
{
    use RefreshDatabase;

    private function admin(): User
    {
        Company::forget();
        $property = Property::query()->create([
            'name' => '317 Freedom Park',
            'address_line' => '317 Freedom Park',
            'city' => 'Liberty Hill',
            'state' => 'TX',
            'postal_code' => '78642',
            'type' => 'Single Family Home',
            'manager_name' => 'Angie Ojeda',
            'manager_title' => 'Property Manager',
            'manager_email' => 'manager@llinternationalventures.com',
            'manager_phone' => '(512) 806-3630',
            'office_hours' => 'Mon - Fri | 9:00 AM – 5:00 PM',
        ]);

        return User::factory()->admin()->create(['property_id' => $property->id]);
    }

    public function test_guest_cannot_update_settings(): void
    {
        $this->patch(route('admin.settings.update'), [
            'company_name' => 'Hacked',
            'zelle_handle' => '@x',
            'manager_email' => 'a@b.com',
            'manager_phone' => '1',
            'rent_amount' => '1',
            'next_due_date' => 'now',
        ])->assertRedirect();
    }

    public function test_admin_can_save_branding_and_meta(): void
    {
        Storage::fake('public');
        $admin = $this->admin();

        $this->actingAs($admin)->patch(route('admin.settings.update'), [
            'company_name' => 'Demo Ventures LLC',
            'tagline' => 'Test tagline',
            'meta_title' => 'Demo Portal',
            'meta_description' => 'Demo description',
            'meta_keywords' => 'rent,portal',
            'zelle_handle' => '@DemoZelle',
            'wire_instructions' => 'Wire here',
            'office_hours' => '9-5',
            'manager_email' => 'manager@llinternationalventures.com',
            'manager_phone' => '(512) 806-3630',
            'rent_amount' => '2375',
            'next_due_date' => 'May 1, 2025',
            'logo' => UploadedFile::fake()->image('logo.png', 200, 80),
        ])->assertRedirect();

        Company::forget();
        $this->assertSame('Demo Ventures LLC', Company::get('company_name'));
        $this->assertSame('Demo Portal', Company::get('meta_title'));
        $this->assertNotEmpty(Company::get('logo'));
        Storage::disk('public')->assertExists(Company::get('logo'));

        $this->get('/')->assertOk()->assertSee('DEMO VENTURES LLC')->assertSee('Demo description');
    }

    public function test_admin_can_create_and_update_a_page(): void
    {
        $admin = $this->admin();

        $this->actingAs($admin)->post(route('admin.pages.store'), [
            'title' => 'FAQ',
            'slug' => 'faq',
            'body' => '<p>How do I pay rent?</p>',
            'meta_title' => 'FAQ',
            'meta_description' => 'Common questions',
            'is_published' => '1',
        ])->assertRedirect(route('admin.pages.index'));

        $page = Page::query()->where('slug', 'faq')->first();
        $this->assertNotNull($page);

        $this->get(route('pages.show', 'faq'))->assertOk()->assertSee('How do I pay rent?');

        $this->actingAs($admin)->patch(route('admin.pages.update', $page), [
            'title' => 'Frequently Asked',
            'slug' => 'faq',
            'body' => '<p>Updated answer</p>',
            'is_published' => '1',
        ])->assertRedirect(route('admin.pages.index'));

        $this->get(route('pages.show', 'faq'))->assertSee('Updated answer');
    }

    public function test_privacy_route_uses_page_content(): void
    {
        $this->seed(\Database\Seeders\PageSeeder::class);
        $this->get('/privacy')->assertOk()->assertSee('Privacy Policy');
    }

    public function test_protected_page_cannot_be_deleted(): void
    {
        $admin = $this->admin();
        $this->seed(\Database\Seeders\PageSeeder::class);
        $privacy = Page::query()->where('slug', 'privacy')->first();

        $this->actingAs($admin)->delete(route('admin.pages.destroy', $privacy))->assertForbidden();
        $this->assertDatabaseHas('pages', ['slug' => 'privacy']);
    }
}
