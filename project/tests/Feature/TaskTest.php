<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class TaskTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    public function it_will_list_tasks()
    {
        $this->withoutMiddleware();

        $this->post('tasks/', [
            'title'       => 'Titulo 1',
            'description' => 'Descrição 1',
        ]);

        $this->post('tasks/', [
            'title'       => 'Titulo 2',
            'description' => 'Descrição 2',
        ]);

        $listResponse = $this->get('tasks/');
        $titleResponse = $this->get('tasks/?title=Titulo 1');
        $descriptionResponse = $this->get('tasks/?description=Descrição 1');
        $orderByAscTitleResponse = $this->get('tasks/?order_by=title');
        $orderByDescTitleResponse = $this->get('tasks/?order_by=-title');
        $orderByAscDescriptionResponse = $this->get('tasks/?order_by=description');
        $orderByDescDescriptionResponse = $this->get('tasks/?order_by=-description');

        $listResponse->assertJson([
            'current_page' => 1,
            'data' =>
                array (
                    0 =>
                        array (
                            'id' => 2,
                            'title' => 'Titulo 2',
                            'description' => 'Descrição 2',
                        ),
                    1 =>
                        array (
                            'id' => 1,
                            'title' => 'Titulo 1',
                            'description' => 'Descrição 1',
                        ),
                ),
            'first_page_url' => 'http://localhost/tasks?page=1',
            'from' => 1,
            'last_page' => 1,
            'last_page_url' => 'http://localhost/tasks?page=1',
            'next_page_url' => NULL,
            'path' => 'http://localhost/tasks',
            'per_page' => 10,
            'prev_page_url' => NULL,
            'to' => 2,
            'total' => 2,
        ]);
        $listResponse->assertStatus(200);

        $titleResponse->assertJson([
            'current_page' => 1,
            'data' =>
                array (
                    0 =>
                        array (
                            'id' => 1,
                            'title' => 'Titulo 1',
                            'description' => 'Descrição 1',
                        ),
                ),
            'first_page_url' => 'http://localhost/tasks?page=1',
            'from' => 1,
            'last_page' => 1,
            'last_page_url' => 'http://localhost/tasks?page=1',
            'next_page_url' => NULL,
            'path' => 'http://localhost/tasks',
            'per_page' => 10,
            'prev_page_url' => NULL,
            'to' => 1,
            'total' => 1,
        ]);
        $titleResponse->assertStatus(200);
        $descriptionResponse->assertJson([
            'current_page' => 1,
            'data' =>
                array (
                    0 =>
                        array (
                            'id' => 1,
                            'title' => 'Titulo 1',
                            'description' => 'Descrição 1',
                        ),
                ),
            'first_page_url' => 'http://localhost/tasks?page=1',
            'from' => 1,
            'last_page' => 1,
            'last_page_url' => 'http://localhost/tasks?page=1',
            'next_page_url' => NULL,
            'path' => 'http://localhost/tasks',
            'per_page' => 10,
            'prev_page_url' => NULL,
            'to' => 1,
            'total' => 1,
        ]);
        $descriptionResponse->assertStatus(200);

        $orderByAscTitleResponse->assertJson([
            'current_page' => 1,
            'data' =>
                array (
                    0 =>
                        array (
                            'id' => 1,
                            'title' => 'Titulo 1',
                            'description' => 'Descrição 1',
                        ),
                    1 =>
                        array (
                            'id' => 2,
                            'title' => 'Titulo 2',
                            'description' => 'Descrição 2',
                        ),
                ),
            'first_page_url' => 'http://localhost/tasks?page=1',
            'from' => 1,
            'last_page' => 1,
            'last_page_url' => 'http://localhost/tasks?page=1',
            'next_page_url' => NULL,
            'path' => 'http://localhost/tasks',
            'per_page' => 10,
            'prev_page_url' => NULL,
            'to' => 2,
            'total' => 2,
        ]);
        $orderByAscTitleResponse->assertStatus(200);
        $orderByDescTitleResponse->assertJson([
            'current_page' => 1,
            'data' =>
                array (
                    0 =>
                        array (
                            'id' => 2,
                            'title' => 'Titulo 2',
                            'description' => 'Descrição 2',
                        ),
                    1 =>
                        array (
                            'id' => 1,
                            'title' => 'Titulo 1',
                            'description' => 'Descrição 1',
                        ),
                ),
            'first_page_url' => 'http://localhost/tasks?page=1',
            'from' => 1,
            'last_page' => 1,
            'last_page_url' => 'http://localhost/tasks?page=1',
            'next_page_url' => NULL,
            'path' => 'http://localhost/tasks',
            'per_page' => 10,
            'prev_page_url' => NULL,
            'to' => 2,
            'total' => 2,
        ]);
        $orderByDescTitleResponse->assertStatus(200);

        $orderByAscDescriptionResponse->assertJson([
            'current_page' => 1,
            'data' =>
                array (
                    0 =>
                        array (
                            'id' => 1,
                            'title' => 'Titulo 1',
                            'description' => 'Descrição 1',
                        ),
                    1 =>
                        array (
                            'id' => 2,
                            'title' => 'Titulo 2',
                            'description' => 'Descrição 2',
                        ),
                ),
            'first_page_url' => 'http://localhost/tasks?page=1',
            'from' => 1,
            'last_page' => 1,
            'last_page_url' => 'http://localhost/tasks?page=1',
            'next_page_url' => NULL,
            'path' => 'http://localhost/tasks',
            'per_page' => 10,
            'prev_page_url' => NULL,
            'to' => 2,
            'total' => 2,
        ]);
        $orderByAscDescriptionResponse->assertStatus(200);
        $orderByDescDescriptionResponse->assertJson([
            'current_page' => 1,
            'data' =>
                array (
                    0 =>
                        array (
                            'id' => 2,
                            'title' => 'Titulo 2',
                            'description' => 'Descrição 2',
                        ),
                    1 =>
                        array (
                            'id' => 1,
                            'title' => 'Titulo 1',
                            'description' => 'Descrição 1',
                        ),
                ),
            'first_page_url' => 'http://localhost/tasks?page=1',
            'from' => 1,
            'last_page' => 1,
            'last_page_url' => 'http://localhost/tasks?page=1',
            'next_page_url' => NULL,
            'path' => 'http://localhost/tasks',
            'per_page' => 10,
            'prev_page_url' => NULL,
            'to' => 2,
            'total' => 2,
        ]);
        $orderByDescDescriptionResponse->assertStatus(200);
    }

    /** @test */
    public function it_will_register_a_task()
    {
        $this->withoutMiddleware();

        $response = $this->post('tasks/', [
            'title'       => 'Titulo',
            'description' => 'Descrição',
        ]);

        $response->assertJsonStructure([
            'title',
            'description',
        ]);

        $response->assertStatus(201);
    }

    /** @test */
    public function it_will_fail_on_register_a_task()
    {
        $this->withoutMiddleware();

        $titleRequired = $this->post('tasks/', [
            'description' => 'Descrição',
        ]);

        $descriptionRequired = $this->post('tasks/', [
            'title' => 'Título',
        ]);

        $titleMaxLength = $this->post('tasks/', [
            'title' => 'Título123456789123456789123456789123456789123456789',
            'description' => 'Descrição'
        ]);

        $descriptionMaxLength = $this->post('tasks/', [
            'title' => 'Título',
            'description' => 'Descrição1234567891234567891234567891234567891234
            12345678912345678912345678912345678912345678912345678912345678912
            12345678912345678912345678912345678912345678934567891234567
            123456789123456789123456789123456789123456789891234567895678912345
            678912345678912345678912345678912345678912345678912345678912345678
            9123456789123456789123456789123456789123456789123456789123456789'
        ]);

        $titleRequired->assertJson([
            "errors" => [
                "title" => ["The title field is required."]
            ]
        ]);

        $titleMaxLength->assertJson([
            "errors" => [
                "title" => ["The title may not be greater than 50 characters."]
            ]
        ]);

        $descriptionRequired->assertJson([
            "errors" => [
                "description" => ["The description field is required."]
            ]
        ]);

        $descriptionMaxLength->assertJson([
            "errors" => [
                "description" => ["The description may not be greater than 255 characters."]
            ]
        ]);

        $titleRequired->assertStatus(400);
        $titleMaxLength->assertStatus(400);
        $descriptionRequired->assertStatus(400);
        $descriptionMaxLength->assertStatus(400);
    }

    /** @test */
    public function it_will_update_a_task()
    {
        $this->withoutMiddleware();

        $this->post('tasks/', [
            'title'       => 'Titulo',
            'description' => 'Descrição',
        ]);

        $updateResponse = $this->patch('tasks/1', [
            'title'       => 'Titulo 1',
            'description' => 'Descrição 1',
        ]);

        $updateResponse->assertStatus(202);
        $updateResponse->assertJson([
            'title'       => 'Titulo 1',
            'description' => 'Descrição 1',
        ]);
    }

    /** @test */
    public function it_will_fail_on_update_a_task()
    {
        $this->withoutMiddleware();

        $this->post('tasks/', [
            'title'       => 'Titulo',
            'description' => 'Descrição',
        ]);

        $notFoundResponse = $this->patch('tasks/2', [
            'title'       => 'Titulo 1',
            'description' => 'Descrição 1',
        ]);

        $descriptionMaxLength = $this->patch('tasks/1', [
            'description' => 'Descrição 1123456789123456789123456789123456789
            123456789123456789123456789123456789123456789123456789123456789
            123456789123456789123456789123456789123456789123456789123456789
            123456789123456789123456789123456789123456789123456789123456789
            123456789123456789123456789123456789123456789123456789123456789
            123456789123456789123456789123456789123456789123456789123456789',
        ]);

        $titleMaxLength = $this->patch('tasks/1', [
            'title' => 'Titulo 123456789123456789123456789123456789123456789
            123456789123456789123456789123456789123456789123456789',
        ]);

        $titleMaxLength->assertJson([
            "errors" => [
                "title" => ["The title may not be greater than 50 characters."]
            ]
        ]);

        $descriptionMaxLength->assertJson([
            "errors" => [
                "description" => ["The description may not be greater than 255 characters."]
            ]
        ]);

        $notFoundResponse->assertStatus(404);
        $titleMaxLength->assertStatus(400);
        $descriptionMaxLength->assertStatus(400);
    }

    /** @test */
    public function it_will_remove_a_task()
    {
        $this->withoutMiddleware();

        $this->post('tasks/', [
            'title'       => 'Titulo',
            'description' => 'Descrição',
        ]);

        $removeResponse = $this->delete('tasks/1');

        $removeResponse->assertStatus(204);
    }

    /** @test */
    public function it_will_fail_onremove_a_task()
    {
        $this->withoutMiddleware();

        $this->post('tasks/', [
            'title'       => 'Titulo',
            'description' => 'Descrição',
        ]);

        $removeResponse = $this->delete('tasks/2');

        $removeResponse->assertStatus(404);
    }
}
