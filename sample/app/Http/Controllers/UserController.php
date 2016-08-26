<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

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
            // redisにユーザ情報を保存
            Redis::set('user:profile:'.$user->id, $user);
            return 'success';
        }
        return 'failed';
    }

    public function get(Request $request, $id)
    {
        $cacheResult = Redis::get('user:profile:'.$id);

        // redisキャッシュがあればキャッシュから
        if ($cacheResult) {
            return $cacheResult;
        }

        // なければDBから取得
        return \App\User::findOrFail($id);
    }
}
