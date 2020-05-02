<?php

namespace App\Entity;

class Infos{
    private $id;
    private $title;
    private $content;
    private $created;
  	  

    /**
     * @return mixed
     */
    public function getId():string
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     *
     * @return self
     */
    public function setId(string $id):self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle():string
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     *
     * @return self
     */
    public function setTitle(string $title):self
    {
        $this->title = $title;

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
}