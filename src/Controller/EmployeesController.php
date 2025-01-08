<?php

namespace App\Controller;

use App\Entity\Employees;

class EmployeesController extends AbstractAppController
{
    protected function getEntityClass(): string
    {
        return Employees::class;
    }
}
