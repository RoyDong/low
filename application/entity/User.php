<?php

namespace entity;

class User extends Base
{
    protected $id;

    protected $name;

    protected $email;

    protected $passwd;

    protected $salt;

    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getPasswd()
    {
        return $this->passwd;
    }

    public function getSalt()
    {
        return $this->salt;
    }

    public function setPasswd($passwd)
    {
        $this->salt = uniqid('', true);
        $this->passwd = sha1($passwd.$this->salt);

        return $this;
    }

    public function checkPasswd($passwd)
    {
        return sha1($passwd.$this->salt) === $this->passwd;
    }

    public function getAuthorizedKey($time)
    {
        return sha1($this->passwd.$this->salt.$time).'_'.$time.'_'.$this->id;
    }

    public function initContent($data)
    {
        $this->id = $data['id'];
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->passwd = $data['passwd'];
        $this->salt = $data['salt'];

        return $this;
    }
}
