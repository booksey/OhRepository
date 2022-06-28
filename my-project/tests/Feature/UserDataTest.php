<?php

namespace Tests\Feature;

use App\Classes\ExampleData;
use App\Classes\UserData;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserDataTest extends TestCase
{
    /**
     * Test UserData calculate feature
     *
     * @return void
     */
    public function test_user_data_calculate()
    {
        $exampleData = ExampleData::get();
        foreach ($exampleData as $data) {
            $userData = new UserData($data);
            $userData->calculate();
            $this->assertIsInt($userData->getCalculatedStandardPoints());
            $this->assertIsInt($userData->getCalculatedExtraPoints());
        }
    }
}
