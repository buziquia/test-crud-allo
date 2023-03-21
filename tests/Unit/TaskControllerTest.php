<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        Task::factory()->create(['name' => 'Tarefa 1']);
        Task::factory()->create(['name' => 'Tarefa 2']);

        $response = $this->get('/api/tasktest');

        $response->assertStatus(200)
            ->assertJson([
                ['name' => 'Tarefa 1'],
                ['name' => 'Tarefa 2'],
            ]);
    }

    public function testStore()
    {
        $response = $this->post('/api/tasktest', [
            'name' => 'Nova tarefa',
            'description' => 'Descrição da nova tarefa',
            'create' => '2023-03-20',
            'finish' => '2023-03-21',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'name' => 'Nova tarefa',
                'description' => 'Descrição da nova tarefa',
                'create' => '2023-03-20',
                'finish' => '2023-03-21',
            ]);

        $this->assertDatabaseHas('task', [
            'name' => 'Nova tarefa',
            'description' => 'Descrição da nova tarefa',
            'create' => '2023-03-20',
            'finish' => '2023-03-21',
        ]);
    }

    public function testShow()
    {
        $task = Task::factory()->create(['name' => 'Tarefa']);

        $response = $this->get('/api/tasktest/' . $task->id);

        $response->assertStatus(200)
            ->assertJson([
                'name' => 'Tarefa',
            ]);
    }

    public function testUpdate()
    {
        $task = Task::factory()->create(['name' => 'Tarefa']);

        $response = $this->put('/api/tasktest/' . $task->id, [
            'name' => 'Nova tarefa',
            'description' => 'Nova descrição',
            'create' => '2023-03-22',
            'finish' => '2023-03-23',
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'name' => 'Nova tarefa',
                'description' => 'Nova descrição',
                'create' => '2023-03-22',
                'finish' => '2023-03-23',
            ]);

        $this->assertDatabaseHas('task', [
            'name' => 'Nova tarefa',
            'description' => 'Nova descrição',
            'create' => '2023-03-22',
            'finish' => '2023-03-23',
        ]);
    }

    public function testDestroy()
    {
        $task = Task::factory()->create();
        $response = $this->delete("api/tasktest/$task->id");
        $response->assertStatus(200);
        $this->assertDatabaseMissing('task', ['id' => $task->id]);
    }
}
