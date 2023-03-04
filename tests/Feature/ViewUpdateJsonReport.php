<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewUpdateJsonReport extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testViewUpdateJsonReport()
    {
        $response = $this->get('/view-update-json-report');

        $response->assertStatus(200);
    }
}
