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

  function getUsersToAddFiltered($id)
  {
    $sql = "SELECT u.id, u.first_name, u.last_name 
      FROM users AS u 
      LEFT JOIN eventy_users AS eu ON eu.user_id = u.id AND eu.event_id =" . $id . " 
      WHERE eu.user_id IS NULL;";

    return $this->db->query($sql)->getResult();
  }

  function getRolesToAddFiltered($id)
  {
    $sql = "SELECT g.id, g.name, g.description
      FROM groups AS g
      LEFT JOIN eventy_groups AS eg ON eg.group_id = g.id AND eg.event_id =" . $id . " 
      WHERE eg.group_id IS NULL;";

    return $this->db->query($sql)->getResult();
  }

  function getGroupById($id)
  {
    $builder = $this->db->table('groups');
    $builder->select('*')
      ->where('id', $id);
    $result = $builder->get();
    return $result->getResult()[0];
  }

  function getEventById($id)
  {
    $builder = $this->db->table('eventy AS e');
    $builder->select('e.*')
      ->where('e.id', $id);
    $result = $builder->get();
    return $result->getResult()[0];
  }

  function getGroups()
  {
    $builder = $this->db->table('groups');
    $builder->select('*');
    $result = $builder->get();
    return $result->getResult();
  }


  function removeUserFromGroup($groupId, $userId)
  {
    $builder = $this->db->table('users_groups');

    $builder->where('group_id', $groupId);
    $builder->where('user_id', $userId);
    $builder->delete();

    return true;
  }

  function removeUserFromEvent($euId)
  {
    $builder = $this->db->table('eventy_users');

    $builder->where('id', $euId);
    $builder->delete();
    return true;
  }

  function removeGroupFromEvent($egId)
  {
    $builder = $this->db->table('eventy_groups');

    $builder->where('id', $egId);
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

  function deleteGroupById($groupId)
  {
    $builder = $this->db->table('groups');

    $builder->where('id', $groupId);
    if ($builder->delete()) {
      return true;
    } else {
      return false;
    }
  }

  public function getUsersFromEventByEventId($id)
  {
    $res = $this->db->query("SELECT eu.id,u.first_name,u.last_name FROM users AS u
      LEFT JOIN eventy_users AS eu ON eu.user_id = u.id
      WHERE eu.event_id = " . $id);
    return $res->getResult();
  }

  public function getGroupsFromEventByEventId($id)
  {
    $res = $this->db->query("SELECT eg.id,g.name,g.description FROM `groups` AS g
      LEFT JOIN eventy_groups AS eg ON eg.group_id = g.id
      WHERE eg.event_id = " . $id);
    return $res->getResult();
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

  function deleteUserById($id)
  {
    $builder = $this->db->table('users');

    $builder->where('id', $id);
    $builder->delete();

    return true;
  }

  function getUsersAll()
  {
    $sql = "SELECT u.id, u.first_name, u.last_name FROM users AS u";

    return $this->db->query($sql)->getResult();
  }

  function getUsersByGroupId($id)
  {
    $builder = $this->db->table('users_groups');
    $builder->select('users.id,users.first_name,users.last_name')
      ->join('users', 'users.id=users_groups.user_id', 'left')
      ->where('users_groups.group_id', $id)
      ->orderBy('users.id');
    $result = $builder->get()->getResult();
    return $result;
  }


  function getGroupsByEventId($eId)
  {
    $builder = $this->db->table('groups AS g');
    $builder->select('g.name')
      ->join('eventy_groups AS eg', 'eg.group_id=g.id', 'left')
      ->where('eg.event_id', $eId);
    $result = $builder->get()->getResult();
    return $result;
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

  function getUsers($id)
  {
    $sql = "SELECT u.id, u.first_name, u.last_name FROM users AS u
              LEFT JOIN users_groups AS ug ON ug.user_id = u.id and ug.group_id = " . $id . "
              where ug.id is null
              group by u.id;";

    return $this->db->query($sql)->getResult();
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

  function getUserById($id)
  {
    $builder = $this->db->table('users');
    $builder->select('*');
    $builder->where('users.id', $id);
    $result = $builder->get()->getResult()[0];
    return $result;
  }

  function checkUser($email)
  {
    $builder = $this->db->table('users');
    $builder->select('count(id)')
      ->where('email', $email);
    $result = $builder->get()[0];
    return $result;
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
