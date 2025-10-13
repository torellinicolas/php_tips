<?php

namespace Source\Models;

use CoffeeCode\DataLayer\DataLayer;

class User extends DataLayer
{
    public function __construct()
    {
        parent::__construct("users", ["first_name", "last_name"]);
    }

    /**
     * Retorna todos os endereços vinculados a este usuário
     * @return array|null
     */
    public function addresses(): ?array
    {
        return (new Address())->find("user_id = :uid", "uid={$this->id}")->fetch(true);
    }
}
