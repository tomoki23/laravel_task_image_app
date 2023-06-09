<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categoriesId = Category::pluck('id')->all();
        $usersId = User::pluck('id')->all();
        $statusLabels = config('status.statusLabels');
        $statusKeys = array_keys($statusLabels);

        return [
            'user_id' => $usersId[array_rand($usersId)],
            'assigned_user_id' => $usersId[array_rand($usersId)],
            'category_id' => $categoriesId[array_rand($categoriesId)],
            'title' => $this->faker->realText(10),
            'image_path' => UploadedFile::fake()->image('photo.jpg'),
            'body' => $this->faker->realText(20),
            'status' =>  $this->faker->randomElement($statusKeys),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
