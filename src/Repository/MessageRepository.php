<?php

namespace App\Repository;

use App\Entity\Message;
use Frameworkphp3wa\MessageRepository;

class MessageRepository extends AbstractRepository{
	public function __construct() {
        parent::__construct("mongodb");
    }
}
