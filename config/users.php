<?php

class users{

    private $pseudo;
    private $password;

    public function setPseudo($pseudo){

        $this->pseudo = $pseudo;

    }

    public function getPseudo(): string {

        return $this->pseudo;

    }

    public function setPassword($password){

        $this->password = $password;

    }

    public function getPassword(): string {

        return $this->password;
        
    }

}