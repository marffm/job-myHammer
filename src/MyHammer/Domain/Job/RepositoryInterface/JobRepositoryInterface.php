<?php
namespace App\MyHammer\Domain\Job\RepositoryInterface;

use App\MyHammer\Domain\Job\Entity\Job;

interface JobRepositoryInterface
{

    public function store(Job $job): void;
}
