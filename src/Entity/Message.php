<?php

namespace App\Entity;

class Message{
    private $id;
    private $userid;
    private $content;
    private $created;
    private $comments;

    /**
     * Get the value of id
     */ 
    public function getId():string
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId(string $id):self
    {
        $this->id = $id;

        return $this;
    }


    /**
     * @return mixed
     */
    public function getUserid():int
    {
        return $this->userid;
    }

    /**
     * @param mixed $userid
     *
     * @return self
     */
    public function setUserid(int $userid):self
    {
        $this->userid = $userid;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getContent():string
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     *
     * @return self
     */
    public function setContent(string $content):self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCreated():string
    {
        return $this->created;
    }

    /**
     * @param mixed $created
     *
     * @return self
     */
    public function setCreated(string $created):self
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return array
     */
    public function getComments():array
    {
        return $this->comments;
    }

    /**
     * @param mixed $created
     *
     * @return self
     */
    public function setComments(array $comments):self
    {
        $this->comments = $comments;

        return $this;
    }
}