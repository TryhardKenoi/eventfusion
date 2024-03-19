<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    protected $table = 'users';
    protected $id = '$id';
    protected $allowedFields = [
        'email',
        'username',
        'first_name',
        'last_name',
        'phone',
        'company',
        'password'
    ];
    protected $returnType = "object";

    function getUsersToAddFiltered($id)
    {
      $sql = "SELECT u.id, u.first_name, u.last_name 
        FROM users AS u 
        LEFT JOIN eventy_users AS eu ON eu.user_id = u.id AND eu.event_id =" . $id . " 
        WHERE eu.user_id IS NULL;";
  
      return $this->db->query($sql)->getResult();
    }

    public function getUsersFromEventByEventId($id)
    {
      $res = $this->db->query("SELECT eu.id,u.first_name,u.last_name FROM users AS u
        LEFT JOIN eventy_users AS eu ON eu.user_id = u.id
        WHERE eu.event_id = " . $id);
      return $res->getResult();
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

    function getUsers($id)
    {
      $sql = "SELECT u.id, u.first_name, u.last_name FROM users AS u
                LEFT JOIN users_groups AS ug ON ug.user_id = u.id and ug.group_id = " . $id . "
                where ug.id is null
                group by u.id;";
  
      return $this->db->query($sql)->getResult();
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



}