<?php
namespace App\MyHammer\Domain\Job\RepositoryInterface;

use App\MyHammer\Domain\Job\DTOInterface\SearchJobDTOInterface;
use App\MyHammer\Domain\Job\Entity\Job;

interface JobRepositoryInterface
{

    public function store(Job $job): void;

    /**
     * @param SearchJobDTOInterface $searchJobDTO
     * @return Job[]|null
     */
    public function searchJob(SearchJobDTOInterface $searchJobDTO): ?array;
}
