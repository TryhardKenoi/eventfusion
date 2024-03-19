<?php

namespace App\Models;

use CodeIgniter\Model;

class EventModel extends \CodeIgniter\Model
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
}
