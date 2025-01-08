<?php

namespace App\Controller;

use App\Entity\Agencies;

class AgenciesController extends AbstractAppController
{
    protected function getEntityClass(): string
    {
        return Agencies::class;
    }
}
