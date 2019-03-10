<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class UserTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_will_register_a_user()
    {
        $response = $this->post('users/', [
            'name'     => 'Jose da Silva',
            'email'    => 'test2@email.com',
            'password' => '123456'
        ]);

        $response->assertJsonStructure([
            'access_token',
            'token_type',
            'expires_in'
        ]);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_will_fail_on_register_a_user()
    {
        $nameRequired = $this->post('users/', [
            'email'    => 'test2@email.com',
            'password' => '123456'
        ]);

        $emailRequired = $this->post('users/', [
            'name'    => 'Joao da Silva',
            'password' => '123456'
        ]);

        $passwordRequired = $this->post('users/', [
            'name'    => 'Joao da Silva',
            'email'    => 'test2@email.com'
        ]);

        $nameMaxLength = $this->post('users/', [
            'name'    => 'João da Silva Ribeiro Maximiano dos Santos',
            'email'    => 'test2@email.com',
            'password' => '123456'
        ]);

        $emailMaxLength = $this->post('users/', [
            'name'    => 'João da Silva',
            'email'    => 'joao.silva.ribeiro.maximiano.santos@email.com',
            'password' => '123456'
        ]);

        $passwordMaxLength = $this->post('users/', [
            'name'    => 'João da Silva',
            'email'    => 'joao.silva@email.com',
            'password' => '12345678901234567890'
        ]);

        $nameRequired->assertJson([
            "errors" => [
                "name" => ["The name field is required."]
            ]
        ]);

        $nameMaxLength->assertJson([
            "errors" => [
                "name" => ["The name may not be greater than 40 characters."]
            ]
        ]);

        $emailRequired->assertJson([
            "errors" => [
                "email" => ["The email field is required."]
            ]
        ]);

        $emailMaxLength->assertJson([
            "errors" => [
                "email" => ["The email may not be greater than 40 characters."]
            ]
        ]);

        $passwordRequired->assertJson([
            "errors" => [
                "password" => ["The password field is required."]
            ]
        ]);

        $passwordMaxLength->assertJson([
            "errors" => [
                "password" => ["The password may not be greater than 12 characters."]
            ]
        ]);

        $nameRequired->assertStatus(400);
        $nameMaxLength->assertStatus(400);
        $emailRequired->assertStatus(400);
        $emailMaxLength->assertStatus(400);
        $passwordRequired->assertStatus(400);
        $passwordMaxLength->assertStatus(400);
    }
}
