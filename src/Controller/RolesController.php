<?php

namespace App\Controller;

use App\Entity\Roles;

class RolesController extends AbstractAppController
{
    protected function getEntityClass(): string
    {
        return Roles::class;
    }
}
