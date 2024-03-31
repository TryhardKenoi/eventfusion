<?php

namespace App\Models;

use CodeIgniter\Database\Query;
use Config\Database;

class Model
{
  var $db;
  function __construct()
  {
    $this->db = \Config\Database::connect();
  }

  function isAdminByUserId($id)
  {
    $builder = $this->db->table('users_groups');
    $builder->select('*')
      ->join('groups', 'groups.id=users_groups.group_id', 'left')
      ->where('users_groups.user_id', $id)
      ->where('groups.name', 'admin');
    return $builder->get()->getResult();
  }
}
