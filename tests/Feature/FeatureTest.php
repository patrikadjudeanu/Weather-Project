<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @test
     */
    public function statistics_redirect_unauthenticated()
    {
        $response = $this->get('/statistics')->assertRedirect('/welcome');
    }

    /**
     * @test
     */
    public function temperature_redirect_unauthenticated()
    {
        $response = $this->get('/temperature')->assertRedirect('/welcome');
    }

    /**
     * @test
     */
    public function home_redirect_unauthenticated()
    {
        $response = $this->get('/')->assertRedirect('/welcome');
    }
}
