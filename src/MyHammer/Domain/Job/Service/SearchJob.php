<?php
declare(strict_types=1);

namespace App\MyHammer\Domain\Job\Service;

use App\MyHammer\Domain\Job\DTOInterface\SearchJobDTOInterface;
use App\MyHammer\Domain\Job\RepositoryInterface\JobRepositoryInterface;

class SearchJob
{

    /**
     * @var JobRepositoryInterface
     */
    private $jobRepository;

    /**
     * SearchJob constructor.
     * @param JobRepositoryInterface $jobRepository
     */
    public function __construct(JobRepositoryInterface $jobRepository)
    {
        $this->jobRepository = $jobRepository;
    }

    /**
     * @param SearchJobDTOInterface $searchJobDTO
     * @return array|null
     */
    public function searchJob(SearchJobDTOInterface $searchJobDTO): ?array
    {
        $jobs = $this->jobRepository->searchJob($searchJobDTO);
    }
}
