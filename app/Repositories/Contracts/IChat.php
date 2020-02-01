<?php

namespace App\Repositories\Contracts;

interface IChat 
{

    public function createParticipants($chatId, array $data);
    public function getUserChats();
    
}