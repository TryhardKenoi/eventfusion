<?php

namespace App\Validation;

use App\Models\UserModel;

class UserRules {
    public function validate_user($value, string $params, array $data) {
        $model = new UserModel();
        $user = $model->where('email', $data['identity'])
                      ->first();
        if(!$user) {
            return false;
        }
        return password_verify($data['password'], $user->password);
    }
}
