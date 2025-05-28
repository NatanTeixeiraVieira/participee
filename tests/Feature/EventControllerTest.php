<?php

namespace Tests\Feature;

use App\Models\Event;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guest_cannot_access_event_routes()
    {
        $response = $this->get(route('events.index'));
        $response->assertRedirect(route('login'));
    }

    /** @test */
    public function authenticated_user_can_see_event_list()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create(['created_by' => $user->id]);

        $this->actingAs($user)
            ->get(route('events.index'))
            ->assertOk()
            ->assertSee($event->name);
    }

    /** @test */
    public function authenticated_user_can_create_event()
    {
        $user = User::factory()->create();

        $data = [
            'name' => 'Test Event',
            'description' => 'Description of event',
            'state' => 'SP',
            'city' => 'São Paulo',
            'neighborhood' => 'Centro',
            'zipcode' => '01000-000',
            'number' => '123',
            'complement' => 'Apt 1',
            'date' => now()->addDays(5)->format('Y-m-d'),
        ];

        $response = $this->actingAs($user)
            ->post(route('events.store'), $data);

        $response->assertRedirect(route('events.index'));
        $this->assertDatabaseHas('events', [
            'name' => 'Test Event',
            'created_by' => $user->id,
        ]);
    }

    /** @test */
    public function user_can_see_event_details()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create(['created_by' => $user->id]);

        $this->actingAs($user)
            ->get(route('events.show', $event))
            ->assertOk()
            ->assertSee($event->name);
    }

    /** @test */
    public function user_can_update_own_event()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create(['created_by' => $user->id]);

        $response = $this->actingAs($user)->put(route('events.update', $event), [
            'name' => 'Updated Name',
            'description' => 'Updated description',
            'state' => 'SP',
            'city' => 'São Paulo',
            'neighborhood' => 'Centro',
            'zipcode' => '01000-000',
            'number' => '123',
            'complement' => '',
            'date' => now()->addDays(10)->format('Y-m-d'),
        ]);

        $response->assertRedirect(route('events.index'));
        $this->assertDatabaseHas('events', [
            'id' => $event->id,
            'name' => 'Updated Name',
        ]);
    }

    /** @test */
    public function user_cannot_update_others_event()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $event = Event::factory()->create(['created_by' => $otherUser->id]);

        $response = $this->actingAs($user)->put(route('events.update', $event), [
            'name' => 'Hacked',
            'description' => '...',
            'state' => 'SP',
            'city' => 'São Paulo',
            'neighborhood' => 'Centro',
            'zipcode' => '01000-000',
            'number' => '123',
            'complement' => '',
            'date' => now()->addDays(10)->format('Y-m-d'),
        ]);

        $response->assertRedirect(route('events.index'));
        $this->assertDatabaseMissing('events', ['name' => 'Hacked']);
    }

    /** @test */
    public function user_can_delete_own_event()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create(['created_by' => $user->id]);

        $response = $this->actingAs($user)->delete(route('events.destroy', $event));

        $response->assertRedirect(route('events.index'));
        $this->assertDatabaseMissing('events', ['id' => $event->id]);
    }

    /** @test */
    public function user_cannot_delete_others_event()
    {
        $user = User::factory()->create();
        $otherUser = User::factory()->create();
        $event = Event::factory()->create(['created_by' => $otherUser->id]);

        $response = $this->actingAs($user)->delete(route('events.destroy', $event));

        $response->assertRedirect(route('events.index'));
        $this->assertDatabaseHas('events', ['id' => $event->id]);
    }

    /** @test */
    public function user_can_join_event()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('events.join', $event));

        $response->assertRedirect();
        $this->assertTrue($event->participants()->where('user_id', $user->id)->exists());
    }

    /** @test */
    public function user_can_leave_event()
    {
        $user = User::factory()->create();
        $event = Event::factory()->create();
        $event->participants()->attach($user->id);

        $response = $this->actingAs($user)
            ->delete(route('events.leave', $event));

        $response->assertRedirect();
        $this->assertFalse($event->participants()->where('user_id', $user->id)->exists());
    }
}
