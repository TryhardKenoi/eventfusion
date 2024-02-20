<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends \CodeIgniter\Model
{

    protected $table = 'users';
    protected $id = '$id';
    protected $allowedFields = [
        'first_name',
        'last_name',
        'phone',
        'company',
        'password'
    ];
    protected $returnType = "object";

}
