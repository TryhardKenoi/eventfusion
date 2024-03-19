<?php

namespace App\Controllers;

use App\Models\SiteSettingsModel;
use CodeIgniter\HTTP\Request;

class SiteSettingsController extends BaseController
{

    public function index()
    {        
        return view('settings/index', ['settings'=>$this->siteSettings]);
    }

    public function save()
    {
        helper('form');

        $formSettings = $this->request->getPost();
        foreach($formSettings as $key=>$value)
        {
            if($this->model->getSettings()[$key])
            {
                $m = $this->model->where('name', $key)->first();
                $this->model->update($m->id,[
                    'value' => $value
                ]);
            }else {
                $this->model->insert([
                    'name' => $key,
                    'value' => $value
                ]);
            }           
        }

        return redirect()->to('/settings')->with('flash-success', 'Ulozeno!');
    }
}