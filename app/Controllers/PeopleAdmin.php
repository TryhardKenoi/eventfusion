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
<<<<<<< HEAD
    $model = new Model();

    $data['users'] = $model->getUsersAll();
    $data['settings'] = $this->siteSettings;

    return view('user/userList', $data);
  }

  public function deleteUser($id)
  {
    $model = new Model();
    $model->deleteUserById($id);
    return redirect()->to('/admin/users/')->with('flash-success', 'Uživatel smazán!');
  }

  public function editUserView($id)
  {
    $model = new Model();
    $data['user'] = $model->getUserById($id);
    $data['settings'] = $this->siteSettings;

=======
    $data['users']= $this->userModel->getUsersAll();
    return view('user/userList', $data);
  }

  public function deleteUser($id){
    $this->userModel->deleteUserById($id);
    return redirect()->to('/admin/users/')->with('flash-success', 'Uživatel smazán!');
  }

  public function editUserView($id){
    $data['user'] = $this->userModel->getUserById($id);
>>>>>>> 3e38d418f25e402cdaaa59e92ab5ef4e09029d2c
    return view('user/editUser', $data);
  }

  public function editUserPost($id)
  {
    $data['settings'] = $this->siteSettings;

    $data = $this->request->getPost();
    $userDB = $this->userModel->find($id);

    if (!empty($data['password'])) {
      $password = password_hash($data['password'], PASSWORD_DEFAULT);
    } else {
      $password = $userDB->password;
    }

    $prep = [
      'email' => $data['email'],
      'username' => $data['email'],
      'first_name' => $data['first_name'],
      'last_name' => $data['last_name'],
      'phone' => $data['phone'],
      'password' => $password,
      'company' => $data['company']
    ];
<<<<<<< HEAD
    $model->update($id, $prep);

    return redirect()->to('admin/user/edit/' . $id)->with('flash-success', 'Údaje úspěšně změněny');
=======
    $this->userModel->update($id, $prep);
    return redirect()->to('admin/user/edit/'.$id)->with('flash-success', 'Údaje úspěšně změněny');
>>>>>>> 3e38d418f25e402cdaaa59e92ab5ef4e09029d2c
  }

  public function registerUserView()
  {

    $data['settings'] = $this->siteSettings;

    return view('auth/registerAdmin');
  }

  public function registerUserPost()
  {
    $data['settings'] = $this->siteSettings;

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

    if (!$this->validate($rules, $errors)) {
      return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    } else {
      $identity = $this->request->getPost('email');
      $password = $this->request->getPost('password');
      $email = $this->request->getPost('email');
      $additional_data = array(
        'first_name' => $this->request->getPost('first_name'),
        'last_name' => $this->request->getPost('last_name'),
      );
      $group = array('2'); //Group

      $this->ionAuth->register($identity, $password, $email, $additional_data, $group);
      return redirect()->to('/admin/users');
    }
  }

  public function getGroups()
  {
<<<<<<< HEAD
    $data['settings'] = $this->siteSettings;

    $model = new Model();
    $data['groups'] = $model->getGroups();
=======
    $data['groups'] = $this->groupModel->getGroups();
>>>>>>> 3e38d418f25e402cdaaa59e92ab5ef4e09029d2c

    return view('groups/groupList', $data);
  }

  public function deleteGroup($id)
  {
<<<<<<< HEAD
    $data['settings'] = $this->siteSettings;

    $model = new Model();
    $model->deleteGroupsUsersByGroupId($id);
    $model->deleteGroupById($id);

    return redirect()->to('/admin/groups')->with('flash-success', 'Skupina smazana!');
  }

  public function editGroup($id)
  {
    $data['settings'] = $this->siteSettings;

    $model = new Model();
    $data['group'] = $model->getGroupById($id);
    $data['people'] = $model->getUsers($id);
    $data['users'] = $model->getUsersByGroupId($id);
    return view('groups/editGroup', $data);
  }

  public function addUserToGroup($id)
  {
    $data['settings'] = $this->siteSettings;

    $model = new Model();
    $gModel = new GroupModel();
=======
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
>>>>>>> 3e38d418f25e402cdaaa59e92ab5ef4e09029d2c
    $data = $this->request->getPost();
    $prep = [
      'name' => $data['name'],
      'description' => $data['description']
    ];
<<<<<<< HEAD
    $gModel->update($id, $prep);

    if ($this->request->getVar('users') != null) {
      $users =  $this->request->getPost('users');
      if ($model->addUserToGroup($id, $users)) {
        return redirect()->to('/admin/group/edit/' . $id);
=======
    $this->groupModel->update($id, $prep);
      
    if($this->request->getVar('users') != null) {      
      $users =  $this->request->getPost('users');
      if($this->userGroupModel->addUserToGroup($id, $users)){
        return redirect()->to('/admin/group/edit/'.$id);
>>>>>>> 3e38d418f25e402cdaaa59e92ab5ef4e09029d2c
      }
    }
    return redirect()->to('/admin/group/edit/' . $id);
  }

  public function removeUserFromGroup($groupId, $userId)
  {
<<<<<<< HEAD
    $model = new Model();

    if ($userId == User::user()->id) {
      return redirect()->to('/admin/group/edit/' . $groupId)->with('flash-error', 'Nemuze odebrat sam sebe!');
    }

    $model->removeUserFromGroup($groupId, $userId);
    return redirect()->to('/admin/group/edit/' . $groupId)->with('Fsuccess', 'Uspesne odebrano!');
=======
    if($userId == User::user()->id) {        
      return redirect()->to('/admin/group/edit/'.$groupId)->with('flash-error', 'Nemuze odebrat sam sebe!');
    }

    $this->userGroupModel->removeUserFromGroup($groupId, $userId);
    return redirect()->to('/admin/group/edit/'.$groupId)->with('Fsuccess', 'Uspesne odebrano!');
>>>>>>> 3e38d418f25e402cdaaa59e92ab5ef4e09029d2c
  }

  public function createGroupView()
  {
    return view('groups/createGroupAdmin');
  }

  public function createGroupPost()
  {
    $idU = \App\Helpers\User::user()->id;

    $name = $this->request->getPost('name');
    $description = $this->request->getPost('description');
    if (!$description) {
      $description = "";
    }
    $group = $this->ionAuth->createGroup($name, $description);

    if (!$group) {
      return redirect()->to('/admin/groups')->with('flash-error', 'Skupina již existuje');
    } else {
      $this->ionAuth->addToGroup($group, $idU);
      $this->ionAuth->updateGroup($group, $name, array(
        'owner_id' => $idU
      ));
      return redirect()->to('/admin/groups')->with('flash-success', 'Skupina vytvořena');
    }
  }
}
