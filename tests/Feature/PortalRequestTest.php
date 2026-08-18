<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\TenantRequest;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class PortalRequestTest extends TestCase
{
    use RefreshDatabase;

    private function property(): Property
    {
        return Property::query()->create([
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
    }

    public function test_home_page_renders(): void
    {
        $this->property();
        $this->get('/')->assertOk();
    }

    public function test_guest_can_submit_contact_form(): void
    {
        Mail::fake();
        Storage::fake('local');
        $this->property();

        $this->post('/contact', [
            'type' => 'maintenance',
            'subject' => 'Leaky faucet',
            'body' => 'Kitchen sink is leaking.',
            'name' => 'Jane Tenant',
            'email' => 'jane@example.com',
            'phone' => '5125550101',
            'preferred_contact' => 'email',
            'priority' => 'high',
            'attachment' => UploadedFile::fake()->image('sink.jpg'),
        ])->assertRedirect();

        $this->assertDatabaseHas('tenant_requests', [
            'subject' => 'Leaky faucet',
            'email' => 'jane@example.com',
        ]);
    }

    public function test_tenant_cannot_view_another_tenants_request(): void
    {
        $property = $this->property();
        $owner = User::factory()->create(['property_id' => $property->id]);
        $other = User::factory()->create(['property_id' => $property->id]);
        $request = TenantRequest::query()->create([
            'property_id' => $property->id,
            'user_id' => $owner->id,
            'type' => 'other',
            'subject' => 'Private',
            'body' => 'Secret',
            'name' => $owner->name,
            'email' => $owner->email,
            'preferred_contact' => 'email',
            'status' => 'new',
        ]);

        $this->actingAs($other)->get(route('tenant.requests.show', $request))->assertForbidden();
        $this->actingAs($owner)->get(route('tenant.requests.show', $request))->assertOk();
    }
}
