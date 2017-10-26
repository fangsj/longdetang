<?php
/**
 * Created by PhpStorm.
 * User: fangsj
 * Date: 2017/10/9
 * Time: 下午5:37
 */

namespace App\Repositorys;

use App\Models\User;

class UserRepository implements IUserRepository
{
    public function findAll()
    {
        return User::all();
    }
}