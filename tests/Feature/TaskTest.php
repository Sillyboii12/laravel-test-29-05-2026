<?php

use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
    $this->withoutMiddleware(\Illuminate\Foundation\Http\Middleware\PreventRequestForgery::class);
});

test('user can see tasks index', function () {
    Task::factory()->count(3)->create();

    $response = $this->get(route('tasks.index'));

    $response->assertStatus(200);
    $response->assertSee(Task::first()->title);
});

test('user can create a task', function () {
    $response = $this->post(route('tasks.store'), [
        'title' => 'New Task',
        'description' => 'Task description',
    ]);

    $response->assertRedirect(route('tasks.index'));
    $this->assertDatabaseHas('tasks', [
        'title' => 'New Task',
        'description' => 'Task description',
    ]);
});

test('user can update a task', function () {
    $task = Task::factory()->create();

    $response = $this->put(route('tasks.update', $task), [
        'title' => 'Updated Task',
        'description' => 'Updated description',
    ]);

    $response->assertRedirect(route('tasks.index'));
    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'title' => 'Updated Task',
    ]);
});

test('user can delete a task', function () {
    $task = Task::factory()->create();

    $response = $this->delete(route('tasks.destroy', $task));

    $response->assertRedirect(route('tasks.index'));
    $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
});

test('user can update a task status and sync completed_at', function () {
    $task = Task::factory()->create(['status' => 'pending', 'completed_at' => null]);

    // Set to completed
    $this->patch(route('tasks.update-status', $task), ['status' => 'completed']);
    $task->refresh();
    expect($task->status)->toBe('completed');
    expect($task->completed_at)->not->toBeNull();

    // Set back to in_progress
    $this->patch(route('tasks.update-status', $task), ['status' => 'in_progress']);
    $task->refresh();
    expect($task->status)->toBe('in_progress');
    expect($task->completed_at)->toBeNull();
});

test('task validation works', function () {
    $response = $this->post(route('tasks.store'), [
        'title' => '',
    ]);

    $response->assertSessionHasErrors('title');
});
