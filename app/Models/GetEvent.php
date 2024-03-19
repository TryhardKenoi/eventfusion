<?php

namespace App\Models;

use CodeIgniter\Model;

class GetEvent extends \CodeIgniter\Model
{
    protected $table = 'eventy';
    protected $id = '$id';

    public function getDataWithID(){
      if(\App\Helpers\User::isLoggedIn()){
        $userID = \App\Helpers\User::user()->id;

        $res =  $this->db->query("
            select e.*
            from eventy as e
            left join eventy_groups as eg on eg.event_id = e.id
            left join users_groups as ug on ug.group_id = eg.group_id and ug.user_id = ".$userID."
            left join eventy_users as eu on eu.event_id = e.id and eu.user_id = ".$userID."
            where ug.id IS NOT NULL or eu.id IS NOT NULL or e.creator_id = ".$userID."
            group by e.id;");
        $data = $res->getResult();
        return $data;
      }else{
        return [];
        }

    }
}
