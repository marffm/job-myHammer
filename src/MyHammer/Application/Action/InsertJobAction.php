<?php
declare(strict_types=1);

namespace App\MyHammer\Application\Action;

use App\MyHammer\Application\DTO\InsertNewJobDTO;
use App\MyHammer\Domain\Job\Entity\Job;
use App\MyHammer\Domain\Job\Service\InsertNewJob;

class InsertJobAction
{

    /**
     * @var InsertNewJob
     */
    private $insertNewJob;

    /**
     * InsertJobAction constructor.
     * @param InsertNewJob $insertNewJob
     *
     */
    public function __construct(InsertNewJob $insertNewJob)
    {
        $this->insertNewJob = $insertNewJob;
    }

    /**
     * @param array $params
     * @return Job
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function insertJob(array $params): Job
    {
        $insertJobDTO = InsertNewJobDTO::fromArray($params);
        return $this->insertNewJob->insertJob($insertJobDTO);
    }
}
