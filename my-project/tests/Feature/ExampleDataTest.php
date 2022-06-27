<?php

namespace Tests\Feature;

use App\Classes\ExampleData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExampleDataTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example_data_count()
    {
        $exampleData = ExampleData::get();

        $this->assertCount(
            4,
            $exampleData, "Invalid example data count!"
        );
    }
}
