<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $usersId = User::pluck('id')->all();
        $taskId = Task::pluck('id')->all();
        return [
            'user_id' => $usersId[array_rand($usersId)],
            'task_id' => $taskId[array_rand($taskId)],
            'body' => $this->faker->realText(20)
        ];
    }
}
