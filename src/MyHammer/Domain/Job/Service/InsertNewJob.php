<?php
declare(strict_types=1);

namespace App\MyHammer\Domain\Job\Service;

use App\MyHammer\Domain\Job\DTOInterface\InsertNewJobDTOInterface;
use App\MyHammer\Domain\Job\Entity\Job;
use App\MyHammer\Domain\Job\Exception\NoServiceFoundException;
use App\MyHammer\Domain\Job\Exception\ZipCodeNotAllowed;
use App\MyHammer\Domain\Job\RepositoryInterface\HttpZipCodeInformationInterface;
use App\MyHammer\Domain\Job\RepositoryInterface\JobRepositoryInterface;
use App\MyHammer\Domain\Job\RepositoryInterface\ServiceRepositoryInterface;
use App\MyHammer\Domain\Service\Entity\Service;

class InsertNewJob
{
    private const COUNTRY_ALLOWED = 'Germany';
    /**
     * @var JobRepositoryInterface
     */
    private $jobRepository;
    /**
     * @var ServiceRepositoryInterface
     */
    private $serviceRepository;
    /**
     * @var HttpZipCodeInformationInterface
     */
    private $zipCodeInformation;

    /**
     * InsertNewJob constructor.
     * @param JobRepositoryInterface $jobRepository
     * @param ServiceRepositoryInterface $serviceRepository
     * @param HttpZipCodeInformationInterface $zipCodeInformation
     */
    public function __construct(
        JobRepositoryInterface $jobRepository,
        ServiceRepositoryInterface $serviceRepository,
        HttpZipCodeInformationInterface $zipCodeInformation
    ) {
        $this->jobRepository = $jobRepository;
        $this->serviceRepository = $serviceRepository;
        $this->zipCodeInformation = $zipCodeInformation;
    }

    /**
     * @param InsertNewJobDTOInterface $insertNewJobDTO
     * @return Job
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function insertJob(InsertNewJobDTOInterface $insertNewJobDTO): Job
    {
        $service = $this->checkServiceExists($insertNewJobDTO->getServiceId());

        $this->checkZipCode($insertNewJobDTO->getZipCode());

        $newJob = Job::fromInsertNewJobDTO($insertNewJobDTO);
        $newJob->setService($service);

        $this->jobRepository->store($newJob);
        return $newJob;
    }

    /**
     * @param int $serviceId
     * @return Service
     */
    private function checkServiceExists(int $serviceId): Service
    {
        $service = $this->serviceRepository->findServiceById($serviceId);
        if (! $service instanceof Service) {
            throw NoServiceFoundException::fromId($serviceId);
        }
        return $service;
    }

    /**
     * @param string $zipCode
     */
    private function checkZipCode(string $zipCode): void
    {
        $zipCodeInformation = $this->zipCodeInformation->getGermanZipCodeInformation($zipCode);

        if (null === $zipCodeInformation || $zipCodeInformation['country'] !== static::COUNTRY_ALLOWED) {
            throw ZipCodeNotAllowed::fromZipCodeGerman($zipCode);
        }
    }
}
