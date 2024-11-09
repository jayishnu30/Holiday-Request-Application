<?php
namespace App\Core\Domain\Entities;

class User
{
    public $id;
    public $username;
    public $password;
    public $role;
    public $first_name;
    public $last_name;
    public $email;

    public function __construct($id, $username, $password, $role, $first_name, $last_name, $email)
    {
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
    }
}
?>