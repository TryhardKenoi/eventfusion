<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends Model
{

    protected $table = 'eventy';
    protected $id = '$id';
    protected $allowedFields = [
        'nazev_eventu',
        'zacatek_eventu',
        'konec_eventu',
        'color',
        'description',
        'latitute',
        'longtitute',
        'creator_id'
    ];
    protected $returnType = "object";


    public function deleteEventAndRelated($eventId)
    {
        $this->db->transBegin();

        // Smazání záznamu z tabulky událostí
        $this->delete($eventId);

        // Smazání záznamů z tabulky eventy_groups
        $this->db->table('eventy_groups')->where('event_id', $eventId)->delete();

        // Smazání záznamů z tabulky eventy_users
        $this->db->table('eventy_users')->where('event_id', $eventId)->delete();

        if ($this->db->transStatus() === false) {
            $this->db->transRollback();
            return false;
        } else {
            $this->db->transCommit();
            return true;
        }
    }

    function getEventById($id)
    {
      $builder = $this->db->table('eventy AS e');
      $builder->select('e.*')
        ->where('e.id', $id);
      $result = $builder->get();
      return $result->getResult()[0];
    }

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
