<?php

namespace App\MyHammer\Domain\Job\RepositoryInterface;

use App\MyHammer\Domain\Service\Entity\Service;

interface ServiceRepositoryInterface
{

    public function findServiceById(int $serviceId): ?Service;
}
