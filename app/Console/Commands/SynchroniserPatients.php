<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\PatientController;

class SynchroniserPatients extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'patients:synchroniser';

    /**
     * The console command description.
     *
     * @var string
     */


    protected $description = 'Synchronise les Patients avec la base de données en ligne';

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
        
        $patientController = new PatientController();
        $patientController->synchroniserPatients();
    }


}
