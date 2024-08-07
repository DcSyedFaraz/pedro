<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
    public function configure()
    {
        return $this->afterCreating(function (User $user) {
            // Assign a random role to the user
            $role = Role::inRandomOrder()->first();
            $user->assignRole($role);
        });
    }

    public function admin()
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole('Admin');
        });
    }

    public function user()
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole('User');
        });
    }
    public function manager()
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole('account manager');
        });
    }
    public function vendor()
    {
        return $this->afterCreating(function (User $user) {
            $user->assignRole('vendor');
        });
    }
}
