<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Jobs\FetchNewsJob;

class FetchAndStoreNewsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch and store news articles from all sources';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        FetchNewsJob::dispatch();
        $this->info('News fetching job dispatched.');
    }
}
