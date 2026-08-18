<?php

namespace Tests\Feature;

use App\Models\Property;
use App\Models\TenantRequest;
use App\Models\User;
use App\Support\Company;
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
        Company::forget();

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

    public function test_home_page_matches_branding(): void
    {
        $this->property();
        $this->get('/')
            ->assertOk()
            ->assertSee('Welcome Home.')
            ->assertSee('Tenant login')
            ->assertSee('Sign in to my account')
            ->assertSee('Activate my account')
            ->assertSee('Your tenant portal includes')
            ->assertSee('TENANT PORTAL')
            ->assertSee('Angie Ojeda');
    }

    public function test_contact_page_matches_layout(): void
    {
        $this->property();
        $this->get('/contact')
            ->assertOk()
            ->assertSee('Contact Us')
            ->assertSee('Maintenance Request')
            ->assertSee('Late Rent')
            ->assertSee('@LLInternationalVentures')
            ->assertSee('Submit request')
            ->assertSee('Angie Ojeda');
    }

    public function test_tenant_dashboard_shows_demo_balance_and_history(): void
    {
        $property = $this->property();
        $tenant = User::factory()->create(['property_id' => $property->id]);

        $this->actingAs($tenant)
            ->get(route('tenant.dashboard'))
            ->assertOk()
            ->assertSee('$2,375.00')
            ->assertSee('Apr 1, 2025')
            ->assertSee('Pay rent')
            ->assertSee('How to Pay with Zelle')
            ->assertSee('Pay Now with Chase');
    }

    public function test_guest_can_submit_contact_form(): void
    {
        Mail::fake();
        Storage::fake('local');
        $this->property();

        $response = $this->from('/contact')->post('/contact', [
            'type' => 'maintenance',
            'subject' => 'Leaky faucet',
            'body' => 'Kitchen sink is leaking.',
            'name' => 'Jane Tenant',
            'email' => 'jane@example.com',
            'phone' => '5125550101',
            'preferred_contact' => 'email',
            'priority' => 'high',
            'attachment' => UploadedFile::fake()->image('sink.jpg'),
        ]);

        $response->assertRedirect();
        $this->followRedirects($response)->assertSee('Thank you! Your request has been received');

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
