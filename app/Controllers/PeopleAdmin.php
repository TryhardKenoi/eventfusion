<?php

namespace App\Controllers;

use App\Helpers\User;

use App\Libraries\Datum;

class PeopleAdmin extends BaseController
{

  var $datum;
  protected $db;
  function __construct()
  {
    $this->datum = new Datum();
    $this->db = \Config\Database::connect();
  }

  public function getUsers()
  {
    $data['users']= $this->userModel->getUsersAll();
    return view('user/userList', $data);
  }

  public function deleteUser($id){
    $this->userModel->deleteUserById($id);
    return redirect()->to('/admin/users/')->with('flash-success', 'Uživatel smazán!');
  }

  public function editUserView($id){
    $data['user'] = $this->userModel->getUserById($id);
    return view('user/editUser', $data);
  }

  public function editUserPost($id){
    $data = $this->request->getPost();
    $userDB = $this->userModel->find($id);

    if(!empty($data['password'])){
      $password = password_hash($data['password'], PASSWORD_DEFAULT);
    }else{
      $password = $userDB->password;
    }
    
    $prep = [
      'email' => $data['email'],
      'username' => $data['email'],
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'phone' => $data['phone'],
      'password' => $password,
      'company' =>$data['company']
    ];
    $this->userModel->update($id, $prep);
    return redirect()->to('admin/user/edit/'.$id)->with('flash-success', 'Údaje úspěšně změněny');
  }

  public function registerUserView(){
    return view('auth/registerAdmin');
  }

  public function registerUserPost()
  {
    helper('form');

    //validace vsutpu
    $rules = [
      'email' => 'required|valid_email|is_unique[users.email]',
      'first_name' => 'required',
      'last_name' => 'required',
      'password' => 'required',
      'password-again' => 'required|matches[password]'
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
      'password-again' =>  [
        'required' => 'Musíš vyplnit heslo kontrola!',
        'matches' => 'Hesla se musí shodovat!'
      ],
    ];

    if(!$this->validate($rules, $errors)){
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }else{
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
  }

  public function getGroups()
  {
    $data['groups'] = $this->groupModel->getGroups();

    return view('groups/groupList', $data);
  }

  public function deleteGroup($id)
  {
    $this->userGroupModel->deleteGroupsUsersByGroupId($id);
    $this->groupModel->deleteGroupById($id);
    
    return redirect()->to('/admin/groups')->with('flash-success', 'Skupina smazana!');
  }

  public function editGroup($id){
    $data['group'] = $this->groupModel->getGroupById($id);
    $data['people'] = $this->userModel->getUsers($id);
    $data['users'] = $this->userModel->getUsersByGroupId($id);
    return view ('groups/editgroup', $data);
  }

  public function addUserToGroup($id){
    $data = $this->request->getPost();
    $prep = [
        'name' => $data['name'],
        'description' => $data['description']
    ];
    $this->groupModel->update($id, $prep);
      
    if($this->request->getVar('users') != null) {      
      $users =  $this->request->getPost('users');
      if($this->userGroupModel->addUserToGroup($id, $users)){
        return redirect()->to('/admin/group/edit/'.$id);
      }
    }
    return redirect()->to('/admin/group/edit/'.$id);
  }

  public function removeUserFromGroup($groupId, $userId)
  {
    if($userId == User::user()->id) {        
      return redirect()->to('/admin/group/edit/'.$groupId)->with('flash-error', 'Nemuze odebrat sam sebe!');
    }

    $this->userGroupModel->removeUserFromGroup($groupId, $userId);
    return redirect()->to('/admin/group/edit/'.$groupId)->with('Fsuccess', 'Uspesne odebrano!');
  }

  public function createGroupView(){
    return view('groups/createGroupAdmin');
  }

  public function createGroupPost(){
    $idU = \App\Helpers\User::user()->id;

    $name = $this->request->getPost('name');
    $description = $this->request->getPost('description'); 
    if(!$description){
      $description = "";
    }
    $group = $this->ionAuth->createGroup($name, $description);
    
    if(!$group){
      return redirect()->to('/admin/groups')->with('flash-error', 'Skupina již existuje');
    }else{
      $this->ionAuth->addToGroup($group, $idU);
      $this->ionAuth->updateGroup($group, $name, array(
        'owner_id' => $idU
      ));
      return redirect()->to('/admin/groups')->with('flash-success', 'Skupina vytvořena');
    }
  }
}