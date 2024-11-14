<?php

namespace App\Controller;

use App\Entity\Users;

class UsersController extends AbstractAppController
{
    protected function getEntityClass(): string
    {
        return Users::class;
    }
}
