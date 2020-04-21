<?php

namespace App\validations;

use App\Entity\User;

class UserValidation
{

    public function __construct()
    {
    }

    public function isValid(string $email, string $firstname, string $lastname, string $password, int $age)
    {
        $errors = array(
            "email" => array(null, null),
            "firstname" => array(null),
            "lastname" => array(null),
            "password" => array(null, null),
            "age" => array(null)
        );

        // email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"][0] = "format invalide";
        };
        if ($email != null) {
            $errors["email"][1] = "vide";
        };

        // firstname
        if ($firstname != null) {
            $errors["firstname"][0] = "vide";
        };
        //lastname
        if ($lastname != null) {
            $errors["lastname"][0] = "vide";
        };
        //password
        if($password != null) {
            $errors["password"][0] = "vide";
        }
        if(strlen($password) < 8 || strlen($password) > 40) {
            $errors["password"][1] = "mauvaise taille";
        }
        //age 
        if($age < 13) {
            $errors["age"][0] = "age invalide";
        }

        if(
            $errors["email"][0] == null && 
            $errors["email"][1] == null && 
            $errors["firstname"][0] == null && 
            $errors["lastname"][0] == null && 
            $errors["password"][0] == null && 
            $errors["password"][1] == null && 
            $errors["age"][0] == null && 
            $errors["age"][1] == null
        ) {
            return true;
        }else {
            return false;
        }
    }
}
