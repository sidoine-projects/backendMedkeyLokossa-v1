<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\PayementController;


class SynchroniserPayements extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'payements:synchroniser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Synchronise les Payements avec la base de données en ligne';

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
        $payementController = new PayementController();
        $payementController->synchroniserPayements();
    }
}
