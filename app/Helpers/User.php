<?php

namespace App\Helpers;

use App\Models\Model;
use stdClass;

class User
{
  public static function isLoggedIn() {
      $ionAuth = new \IonAuth\Libraries\IonAuth();

      return $ionAuth->loggedIn();
  }

  public static function isAdmin() {
    
    $model = new Model();
    $ionAuth = new \IonAuth\Libraries\IonAuth();
    return count($model->isAdminByUserId($ionAuth->user()->row()->id)) == 1 ? true : false;
  }

  public static function user() {
    $ionAuth = new \IonAuth\Libraries\IonAuth();

    $user = $ionAuth->user()->row();

    return  $user;
  }

}
