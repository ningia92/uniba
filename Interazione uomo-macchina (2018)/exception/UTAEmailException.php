<?php

namespace App\Exception;

class UTAEmailException extends \Exception
{
    private $email;

    public function __construct($email)
    {
        parent::__construct('Email ' . $email . ' non inviata');
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }
}