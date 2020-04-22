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
            "age" => array(null, null)
        );

        // email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"][0] = "format invalide";
        };
        if ($email == null) {
            $errors["email"][1] = "vide";
        };

        // firstname
        if ($firstname == null || strlen($firstname) < 3) {
            $errors["firstname"][0] = "vide";
        };
        //lastname
        if ($lastname == null) {
            $errors["lastname"][0] = "vide";
        };
        //password
        if($password == null) {
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
            $errors["email"][0] == null  && 
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

    public function canAddItem($item)
    {
        $content = $item->getContent();
        $name = $item->getNameItem();
        $date = $item->getCreateDate();

        $errors = array(
            "name" => array(null),
            "content" => array(null),
            "date" => array(null)
        );

        if($name == null || strlen($name) > 30 || strlen($name) < 3){
            $errors["name"][0] = "invalide name";
        }
        if($content == null || strlen($content) > 1000 || strlen($content) < 3){
            $errors["content"][0] = "invalide content";
        }
        if($date == null ){
            $errors["date"][0] = "date invalide";
        }

        if(
            $errors["name"][0] == null &&
            $errors["content"][0] == null &&
            $errors["date"][0] == null
        ){
            //$this->sendMail($user);
            return true;
        }else{
            return false;
        }

    }

    public function sendMail($user)
    {
        $age = $user->getAge();
        if($age >= 18){
            return true;
            //envoie du mail
        }else{
            return false;
            //age requis 18
        }
    }
}
