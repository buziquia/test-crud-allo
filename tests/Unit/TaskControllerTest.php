<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{

    public function testIndex()
    {
        $response = $this->get('/api/task/test');

        $response->assertStatus(200);
    }
}
