<?php

namespace App\Controllers;

use App\Helpers\User;
use App\Models\GroupModel;
use App\Models\Model;
use App\Models\UserModel;
use App\Libraries\Datum;
use PHPUnit\TextUI\XmlConfiguration\Group;

class People extends BaseController
{

  var $datum;
  protected $db;
  function __construct()
  {
    $this->datum = new Datum();
    $this->db = \Config\Database::connect();
  }

  public function profil()
  {
    $ionAuth = new \IonAuth\Libraries\IonAuth();
    $id = \App\Helpers\User::user()->id;
    $user_groups = $this->ionAuth->getUsersGroups($id)->getResult();
    $groups = array();
    foreach($user_groups as $group){
        if($group->id == 1 || $group->id == 2){
          continue;
        }
        $groups[] = $group;
    }

    $data['user_groups'] = $groups;
    return view('user/profil', $data);
  }

  public function changeDetailsView($id){
    $model = new Model();
    $data['user'] = $model->getUserById($id);
    return view('user/changeDetails', $data);
  }

  public function changeDetailsPost($id){
    $data = $this->request->getPost();
    $model = new UserModel();
    $userDB = $model->find($id);

    $password = $userDB->password;


    if(!empty($data['password']) && !empty($data['old_password']) && !empty($data['password-again'])){
      if(password_verify($data['old-password'], $userDB->password)){
        $password = password_hash($data['password'], PASSWORD_DEFAULT);
      }else{
        return redirect()->to('profile/details/'.$id)->with('flash-error', 'Hesla se neshodují!');
      }
    }

    $prep = [
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'company' => $data['company'],
      'phone' => $data['phone'],
      'password' => $password
    ];
    $model->update($id, $prep);
    return redirect()->to('profile/details/'.$id)->with('flash-success', 'Údaje úspěšně změněny');

  }

  public function createGroupView(){
    return view('groups/createGroup');
  }

  public function createGroupPost(){
    $idU = \App\Helpers\User::user()->id;

    $name = $this->request->getPost('name');
    $description = $this->request->getPost('description'); 
    $group = $this->ionAuth->createGroup($name, $description);


    if(!$group){
      return redirect()->to('/profile')->with('flash-error', 'Skupina již existuje');
    }else{
      $this->ionAuth->addToGroup($group, $idU);
      $this->ionAuth->updateGroup($group, $name, array(
        'owner_id' => $idU
      ));
      return redirect()->to('/profile');
    }

    return redirect()->to('/profile');
  }

  public function getGroupById($id){
    $model = new Model();
    $data['group'] = $model->getGroupById($id);
    $data['people'] = $model->getUsers($id);
    $data['users'] = $model->getUsersByGroupId($id);
    return view('groups/group', $data);
  }

  public function addUserToGroup($id){
    $model = new Model();
    $gModel = new GroupModel();
    $data = $this->request->getPost();
    $prep = [
        'name' => $data['name'],
        'description' => $data['description']
    ];
    if($data){
        $gModel->update($id, $prep);
    }
    if($this->request->getVar('users') != null) {      
      $users =  $this->request->getPost('users');
      if($model->addUserToGroup($id, $users)){
        return redirect()->to('/group/'.$id);
      }
    }else {
      return redirect()->to('/group/'.$id)->with('flash-error', 'banany');

    }
  }


  public function registerView(){
    
    helper('form');
    return view('auth/register');
  }

  public function registerPost()
  {
    helper('form');

    //validace vsutpu
    $rules = [
      'email' => 'required|valid_email|is_unique[users.email]',
      'first_name' => 'required',
      'last_name' => 'required',
      'password' => 'required',
      'password_confirm' => 'required|matches[password]'
    ];
    //customizovana validace
    $errors = [
      'email' => [
        'required' => 'Musíš vyplnit email!',
        'is_unique' => 'Email je již použit!'
      ],
      'first_name' =>  [
        'required' => 'Musíš vyplnit jméno!',
      ],
      'last_name' =>  [
        'required' => 'Musíš vyplnit přijmení!',
      ],
      'password' =>  [
        'required' => 'Musíš vyplnit heslo!',
      ],
      'password_confirm' =>  [
        'required' => 'Musíš vyplnit heslo kontrola!',
        'matches' => 'Hesla se musí shodovat!'
      ],
    ];
    //pokud neni validace do prazdneho arraye pridej validacni errory
    if (!$this->validate($rules, $errors)) {
      $data['validation'] = $this->validator;
    }else {
      $identity = $this->request->getPost('email');
      $password = $this->request->getPost('password');
      $email = $this->request->getPost('email');
      $additional_data = array(
        'first_name' => $this->request->getPost('first_name'),
        'last_name' => $this->request->getPost('last_name'),
      );
      $group = array('2'); //Group
  
      $this->ionAuth->register($identity, $password, $email, $additional_data, $group);
      return redirect()->to('/auth/login');
    }
    
    return view('auth/register', $data);
  }

    public function removeUserFromGroup($groupId, $userId)
    {
        $model = new Model();

        if($userId == User::user()->id) {
            return redirect()->to('/group/'.$groupId)->with('flash-error', 'Nemůžete odebrat sám sebe!');
        }

        $model->removeUserFromGroup($groupId, $userId);
        return redirect()->to('/group/'.$groupId)->with('flash-success', 'Úspěšně odebráno!');
    }
}