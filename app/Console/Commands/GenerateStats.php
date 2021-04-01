<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class GenerateStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:stats {user?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate Stats of the system';

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
     * @return int
     */
    public function handle()
    {
        $userId = $this->argument('user');
        dd($userId);
        $user = User::select('name', 'email')->withCount('stories')->get()->toArray();
         //$this->info('There are total of '.$count.' Users');
        $this->table(['Name', 'Email', 'Count'], $user);
    }
}
