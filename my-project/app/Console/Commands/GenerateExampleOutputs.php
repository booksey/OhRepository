<?php

namespace App\Console\Commands;

use App\Classes\ExampleData;
use Illuminate\Console\Command;

class GenerateExampleOutputs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:outputs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generates the outputs for the given example data';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $exampleData = ExampleData::get();
        echo var_export($exampleData);
    }
}
