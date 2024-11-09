<?php
namespace App\Repositories;

use App\Models\User;
use App\Repositories\UserRepositoryInterface;

class EloquentUserRepository implements UserRepositoryInterface
{
    /**
     * Get a user by ID.
     *
     * @param  int  $userId
     * @return \App\Models\User|null
     */
    public function getUserById(int $userId)
    {
        return User::find($userId);
    }

    /**
     * Get a user by their email.
     *
     * @param  string  $email
     * @return \App\Models\User|null
     */
    public function getUserByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }

    /**
     * Create a new user.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    public function createUser(array $data)
    {
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => $data['role'] ?? 'employee', // Default role is 'employee'
        ]);
    }

    /**
     * Update user details.
     *
     * @param  int  $userId
     * @param  array  $data
     * @return \App\Models\User|null
     */
    public function updateUser(int $userId, array $data)
    {
        $user = User::find($userId);

        if ($user) {
            $user->update($data);
            return $user;
        }

        return null;
    }
}
?>