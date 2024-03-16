<?php

namespace App\Controllers;

use App\Helpers\User;
use App\Libraries\Datum;


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
    $data['user'] = $this->userModel->getUserById($id);
    return view('user/changeDetails', $data);
  }

  public function changeDetailsPost($id){
    $data = $this->request->getPost();
    $userDB = $this->userModel->find($id);

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
    $this->userModel->update($id, $prep);
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
    $data['group'] = $this->groupModel->getGroupById($id);
    $data['people'] = $this->userModel->getUsers($id);
    $data['users'] = $this->userModel->getUsersByGroupId($id);
    return view('groups/group', $data);
  }

  public function addUserToGroup($id){
    $data = $this->request->getPost();
    $prep = [
        'name' => $data['name'],
        'description' => $data['description']
    ];
    if($data){
        $this->groupModel->update($id, $prep);
    }
    if($this->request->getVar('users') != null) {      
      $users =  $this->request->getPost('users');
      if($this->userGroupModel->addUserToGroup($id, $users)){
        return redirect()->to('/group/'.$id)->with('flash-success','Uživatelé přidáni');
      }
    }else {
      return redirect()->to('/group/'.$id)->with('flash-success', 'Změny přidány úspěšně');

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
      $identity = str_replace(' ', '', $this->request->getPost('email'));
      $password = $this->request->getPost('password');
      $email = str_replace(' ', '', $this->request->getPost('email'));
      $additional_data = array(
        'first_name' => str_replace(' ', '', $this->request->getPost('first_name')),
        'last_name' => str_replace(' ', '', $this->request->getPost('last_name')),
      );
      $group = array('2'); //Group
  
      $this->ionAuth->register($identity, $password, $email, $additional_data, $group);
      return redirect()->to('/auth/login');
    }
    
    return view('auth/register', $data);
  }

    public function removeUserFromGroup($groupId, $userId)
    {
        if($userId == User::user()->id) {
            return redirect()->to('/group/'.$groupId)->with('flash-error', 'Nemůžete odebrat sám sebe!');
        }

        $this->userGroupModel->removeUserFromGroup($groupId, $userId);
        return redirect()->to('/group/'.$groupId)->with('flash-success', 'Úspěšně odebráno!');
    }

    public function deleteGroup($id)
    {
      $this->userGroupModel->deleteGroupsUsersByGroupId($id);
      $this->groupModel->deleteGroupById($id);
      
      return redirect()->to('/profile')->with('flash-success', 'Skupina smazána!');
    }

}