<?php
namespace Modules\Admin\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Admin\Entities\User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => 'Cloud MicroApp',
            'email' => 'info@cloudmicroapp.com.tr',
            'password' => Hash::make('XX2486xx@'), // password
            'remember_token' => Str::random(10),
        ];
    }
}