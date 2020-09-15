<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public const XKCD_FEED = [
        'site_url' => 'https://xkcd.com/',
        'title' => 'xkcd.com',
        'url' => 'https://xkcd.com/atom.xml',
    ];

    protected $user;

    /**
     * Set up the test environment.
     *
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();
    }

    /**
     * Search for a feed.
     *
     * @return void
     */
    public function testFeedSearchWebsite(): void
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->json('GET', '/api/feeds/search', [
                'url' => 'https://xkcd.com',
            ]);

        $response
            ->assertOk()
            ->assertJsonCount(2) // Atom + RSS matches
            ->assertJson([self::XKCD_FEED]);
    }

    /**
     * Search for a feed.
     *
     * @return void
     */
    public function testFeedSearchFeedUrl(): void
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->json('GET', '/api/feeds/search', [
                'url' => 'https://xkcd.com/atom.xml',
            ]);

        $response
            ->assertOk()
            ->assertJsonCount(1) // Atom match only
            ->assertJson([self::XKCD_FEED]);
    }

    /**
     * Subscribe to a feed.
     *
     * @return void
     */
    public function testSubscribe(): void
    {
        $response = $this->actingAs($this->user, 'sanctum')
            ->json('POST', '/api/subscriptions', [
                'url' => 'https://xkcd.com/atom.xml',
            ]);

        $response
            ->assertStatus(201)
            ->assertJson(self::XKCD_FEED);
    }

    /**
     * List feed subscriptions.
     *
     * @return void
     */
    public function testSubscriptions()
    {
        $this->actingAs($this->user, 'sanctum')
            ->json('POST', '/api/subscriptions', [
                'url' => 'https://xkcd.com/atom.xml',
            ]);

        $response = $this->actingAs($this->user, 'sanctum')
            ->json('GET', '/api/subscriptions');

        $response
            ->assertOk()
            ->assertJson([
                'data' => [
                    [
                        'feed' => self::XKCD_FEED,
                    ],
                ],
            ]);
    }
}
