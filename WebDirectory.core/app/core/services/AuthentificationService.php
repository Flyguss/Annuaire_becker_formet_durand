<?php

namespace WebDirectory\core\services;





use WebDirectory\core\domain\entites\User;

class AuthentificationService implements AuthentificationServiceInterface {


    public function addUser($email , $password ): void {
        $user = new User ;
        $user->email = $email ;
        $user->password = $password ;
        $user->role = 1 ;
        $user->save() ;
    }

    public function getUserByEmail($email){

    return User::where('email' , 'like' , $email)->first() ;

    }

    public function verifyPassword($password , $user): bool {
        return password_verify($password ,$user->password);
    }
}