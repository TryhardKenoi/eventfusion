<?php

namespace App\Models;

use CodeIgniter\Model;

class UserGroupModel extends Model
{
    function removeUserFromGroup($groupId, $userId)
    {
      $builder = $this->db->table('users_groups');
  
      $builder->where('group_id', $groupId);
      $builder->where('user_id', $userId);
      $builder->delete();
  
      return true;
    }
  
    function deleteGroupsUsersByGroupId($id)
    {
      $builder = $this->db->table('users_groups');
  
      $builder->where('group_id', $id);
      $builder->delete();
      return true;
    }
  
    function isInGroup($userId, $groupId)
    {
      $builder = $this->db->table('users_groups');
      $builder->select('users.id,users.first_name,users.last_name')
        ->join('users', 'users.id=users_groups.user_id', 'left')
        ->where('users_groups.group_id', $groupId)
        ->where('users.id', $userId);
      $result = $builder->get()->getResult();
  
      return count($result) == 1 ? true : false;
    }
  
    function addUserToGroup($id, $data)
    {
      foreach ($data as $d) {
        $o = [
          'user_id' => $d,
          'group_id' => $id
        ];
        $this->db->table('users_groups')->insert($o);
      }
      return true;
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
