<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupModel extends \CodeIgniter\Model
{

    protected $table = 'groups';
    protected $id = '$id';
    protected $allowedFields = [
        'name',
        'description',
        'owner_id'
    ];
    protected $returnType = "object";

    
    
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

  function getGroups()
  {
    $builder = $this->db->table('groups');
    $builder->select('*');
    $result = $builder->get();
    return $result->getResult();
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

  public function getGroupsFromEventByEventId($id)
  {
    $res = $this->db->query("SELECT eg.id,g.name,g.description FROM `groups` AS g
      LEFT JOIN eventy_groups AS eg ON eg.group_id = g.id
      WHERE eg.event_id = " . $id);
    return $res->getResult();
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

}