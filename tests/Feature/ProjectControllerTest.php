<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Project;

class ProjectControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index()
    {
        // Create some projects
        $projects = Project::factory()->count(3)->create();

        // Send a GET request to the index endpoint
        $response = $this->getJson('api/projects');

        // Assert the response status is 200
        $response->assertStatus(200);

        // Assert the response contains the projects
        foreach ($projects as $project) {
            $response->assertJsonFragment(['id' => $project->id]);
        }
    }

    public function test_store()
    {
        // Prepare data for a new project
        $data = [
            'name' => 'New Project',
            // Add other fields as necessary
        ];

        // Send a POST request to the store endpoint
        $response = $this->postJson('api/projects', $data);

        // Assert the response status is 201 (Created)
        $response->assertStatus(201);

        // Assert the response contains the project data
        $response->assertJsonFragment($data);

        // Assert the project was created in the database
        $this->assertDatabaseHas('projects', $data);
    }
}
