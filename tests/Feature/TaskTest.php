<?php

namespace Tests\Feature;

use App\Models\Project;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Task;


class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_reorder_tasks()
    {
        // Create a project
        $project = Project::factory()->create();

        // Create some tasks associated with the project
        $task1 = Task::factory()->create(['priority' => 1, 'project_id' => $project->id]);
        $task2 = Task::factory()->create(['priority' => 2, 'project_id' => $project->id]);
        $task3 = Task::factory()->create(['priority' => 3, 'project_id' => $project->id]);


        // Send a POST request to the reorder endpoint
        $response = $this->postJson('api/tasks/reorder', ['taskIds' => [$task3->id, $task1->id, $task2->id]]);

        // Assert the response status is 200
        $response->assertStatus(200);

        // Assert the tasks have been reordered correctly
        $this->assertEquals(2, $task1->fresh()->priority);
        $this->assertEquals(3, $task2->fresh()->priority);
        $this->assertEquals(1, $task3->fresh()->priority);
    }
}
