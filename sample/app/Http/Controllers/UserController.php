<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $name = $request->input('name');
        if (empty($name)) {
            return 'invalid name';
        }
        $user = new \App\User();
        $user->name = $name;
        if ($user->save()) {
            return 'success';
        }
        return 'failed';
    }

    public function get(Request $request, $id)
    {
        return \App\User::findOrFail($id);
    }
}
