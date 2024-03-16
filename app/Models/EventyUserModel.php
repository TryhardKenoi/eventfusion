<?php

namespace App\Models;

use CodeIgniter\Model;

class EventyUserModel extends \CodeIgniter\Model
{

    protected $table = 'eventy_users';
    protected $id = '$id';
    protected $allowedFields = [
        'event_id',
        'user_id'
    ];
    protected $returnType = "object";


    function removeUserFromEvent($euId)
    {
      $builder = $this->db->table('eventy_users');
  
      $builder->where('id', $euId);
      $builder->delete();
      return true;
    }

    function getUsersByEventId($eId)
    {
      $builder = $this->db->table('eventy_users AS eu');
      $builder->select('u.first_name, u.last_name')
        ->join('users AS u', 'u.id=eu.user_id', 'left')
        ->where('eu.event_id', $eId);
      $result = $builder->get()->getResult();
      return $result;
    }
}
