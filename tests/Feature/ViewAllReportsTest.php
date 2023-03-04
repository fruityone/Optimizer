<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ViewAllReportsTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testViewAllJsonReport()
    {
        $response = $this->get('/admin/view-reports');
        $response->assertStatus(200);
    }
}
