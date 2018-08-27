<?php
declare(strict_types=1);

namespace App\MyHammer\Application\Action;

use App\MyHammer\Domain\Job\Service\SearchJob;

class SearchJobAction
{

    /**
     * @var SearchJob
     */
    private $searchJob;

    /**
     * SearchJobAction constructor.
     * @param SearchJob $searchJob
     */
    public function __construct(SearchJob $searchJob)
    {
        $this->searchJob = $searchJob;
    }

    /**
     * @param array $params
     * @return array|null
     */
    public function searchJob(array $params): ?array
    {
        $searchJobDTO = '';
    }
}
