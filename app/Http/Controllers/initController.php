<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Role;
use App\User;
use App\Permission;
use Auth;


class initController extends Controller {

    public function testAuth ()
    {
        dd(Auth::attempt(['email' => 'user2@hotmail.com', 'password' => '1234']));
    }

    public function initUser ()
    {
        $user1 = new User();
        $user1->name      = 'user1';
        $user1->email     = 'user1@hotmail.com';
        $user1->password  = bcrypt('1234');
        $user1->save();

        $user2 = new User();
        $user2->name      = 'user2';
        $user2->email     = 'user2@hotmail.com';
        $user2->password  = '1234';
        $user2->save();
    }

    public function init ()
    {
        $owner = new Role();
        $owner->name         = 'owner';
        $owner->display_name = 'Project Owner'; // optional
        $owner->description  = 'User is the owner of a given project'; // optional
        $owner->save();

        $admin = new Role();
        $admin->name         = 'admin';
        $admin->display_name = 'User Administrator'; // optional
        $admin->description  = 'User is allowed to manage and edit other users'; // optional
        $admin->save();

        $createPost = new Permission();
        $createPost->name         = 'create-post';
        $createPost->display_name = 'Create Posts'; // optional
        // Allow a user to...
        $createPost->description  = 'create new blog posts'; // optional
        $createPost->save();

        $editUser = new Permission();
        $editUser->name         = 'edit-user';
        $editUser->display_name = 'Edit Users'; // optional
        // Allow a user to...
        $editUser->description  = 'edit existing users'; // optional
        $editUser->save();

        $admin->attachPermission($createPost);
        // equivalent to $admin->perms()->sync(array($createPost->id));

        $owner->attachPermissions(array($createPost, $editUser));
        // equivalent to $owner->perms()->sync(array($createPost->id, $editUser->id));
    }

    public function assignRole ()
    {
        // $user1 = User::where('name', '=', 'user1')->first();

        // // role attach alias
        // // $user->attachRole($admin); // parameter can be an Role object, array, or id

        // // or eloquent's original technique
        // $user1->roles()->attach(1); // id only


        $user1 = User::where('name', '=', 'user2')->first();

        // role attach alias
        $user1->attachRole(2); // parameter can be an Role object, array, or id
    }

    public function checkUser ()
    {
        $user = User::where('name', '=', 'user1')->first();
        echo 'Has role owner: '.$user->hasRole('owner')."<br>";   // false
        echo 'Has role admin: '.$user->hasRole('admin').'<br>';   // true
        echo 'Has permission edit-user: '.$user->can('edit-user').'<br>';   // false
        echo 'Has permission create-post: '.$user->can('create-post').'<br>'; // true
    } 
}