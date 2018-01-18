<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Feed;

class UpdateFeeds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update-feeds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update subscribed Atom/RSS feeds';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $feeds = Feed::has('subscriptions')->get();
        foreach ($feeds as $feed) {
            Log::debug('Updating feed', ['id' => $feed->id]);
            $feed->updateFeed();
        }
    }
}
