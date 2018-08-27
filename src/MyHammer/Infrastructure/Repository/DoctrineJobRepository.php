<?php
declare(strict_types=1);

namespace App\MyHammer\Infrastructure\Repository;

use App\MyHammer\Domain\Job\DTOInterface\SearchJobDTOInterface;
use App\MyHammer\Domain\Job\Entity\Job;
use App\MyHammer\Domain\Job\RepositoryInterface\JobRepositoryInterface;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Common\Persistence\ObjectManager;

class DoctrineJobRepository implements JobRepositoryInterface
{
    /**
     * @var ObjectManager
     */
    private $doctrine;

    /**
     * DoctrineJobRepository constructor.
     * @param Registry $doctrine
     */
    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine->getManager();
    }

    /**
     * @param Job $job
     */
    public function store(Job $job): void
    {
        $this->doctrine->persist($job);
        $this->doctrine->flush();
    }

    /**
     * @param SearchJobDTOInterface $searchJobDTO
     * @return array|null
     */
    public function searchJob(SearchJobDTOInterface $searchJobDTO): ?array
    {
        $search = ['id' => $searchJobDTO->getId()];
        $response = $this->doctrine->getRepository(Job::class)->findBy($search);

        echo '<pre>' .var_dump($response);
        die;
    }
}
