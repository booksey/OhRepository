<?php

namespace App\Console\Commands;

use App\Classes\ExampleData;
use App\Classes\UserData;
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
        foreach ($exampleData as $data) {
            $userData = new UserData($data);
            $userData->calculate();
            echo "Standard points: " . $userData->getCalculatedStandardPoints() . ", Extra points: ". $userData->getCalculatedExtraPoints() . "\n";
        }
    }
}
