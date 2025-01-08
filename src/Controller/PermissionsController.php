<?php

namespace App\Controller;

use App\Entity\Permissions;

class PermissionsController extends AbstractAppController
{
    protected function getEntityClass(): string
    {
        return Permissions::class;
    }
}
