<?php

namespace App\Models;

use CodeIgniter\Model;

class SiteSettingsModel extends Model
{
    
    protected $table = 'site_settings';
    
    protected $allowedFields = [
        'name',
        'value'
    ];

    protected $returnType = "object";

    public function getSettings(): array
    {
        $data = [];
        foreach($this->findAll() as $val)
        {
            $data[$val->name] = $val->value;
        }
        return $data;
    }
}
