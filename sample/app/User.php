<?php

namespace App;

class User extends Model
{
    public function create($name) {
        $user = new User();

        $user->name = $name;
        $user->save();
    }
}
