<?php
declare(strict_types=1);

namespace App\MyHammer\Domain\Job\Service;

use App\MyHammer\Domain\Job\DTOInterface\InsertNewJobDTOInterface;
use App\MyHammer\Domain\Job\Entity\Job;
use App\MyHammer\Domain\Job\Exception\NoServiceFoundException;
use App\MyHammer\Domain\Job\RepositoryInterface\JobRepositoryInterface;
use App\MyHammer\Domain\Job\RepositoryInterface\ServiceRepositoryInterface;
use App\MyHammer\Domain\Service\Entity\Service;

class InsertNewJob
{

    /**
     * @var JobRepositoryInterface
     */
    private $jobRepository;
    /**
     * @var ServiceRepositoryInterface
     */
    private $serviceRepository;

    /**
     * InsertNewJob constructor.
     * @param JobRepositoryInterface $jobRepository
     * @param ServiceRepositoryInterface $serviceRepository
     */
    public function __construct(
        JobRepositoryInterface $jobRepository,
        ServiceRepositoryInterface $serviceRepository
    ) {
        $this->jobRepository = $jobRepository;
        $this->serviceRepository = $serviceRepository;
    }

    /**
     * @param InsertNewJobDTOInterface $insertNewJobDTO
     * @return Job
     */
    public function insertJob(InsertNewJobDTOInterface $insertNewJobDTO): Job
    {

        $this->checkServiceExists($insertNewJobDTO->getServiceId());

        $newJob = Job::fromInsertNewJobDTO($insertNewJobDTO);

        $this->jobRepository->store($newJob);
        return $newJob;
    }

    /**
     * @param int $serviceId
     */
    private function checkServiceExists(int $serviceId): void
    {
        $service = $this->serviceRepository->findServiceById($serviceId);
        if (! $service instanceof Service) {
            throw NoServiceFoundException::fromId($serviceId);
        }
    }
}
