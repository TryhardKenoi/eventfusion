<?php

namespace App\Models;

use CodeIgniter\Model;

class EventyGroupModel extends \CodeIgniter\Model
{

    protected $table = 'eventy_groups';
    protected $id = '$id';
    protected $allowedFields = [
        'event_id',
        'group_id'
    ];
    protected $returnType = "object";


    function removeGroupFromEvent($egId)
    {
      $builder = $this->db->table('eventy_groups');
  
      $builder->where('id', $egId);
      $builder->delete();
      return true;
    }
}