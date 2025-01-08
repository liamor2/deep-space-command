<?php

namespace App\Controller;

use App\Entity\Missions;

class MissionsController extends AbstractAppController
{
    protected function getEntityClass(): string
    {
        return Missions::class;
    }
}
