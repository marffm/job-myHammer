<?php
declare(strict_types=1);

namespace App\MyHammer\Infrastructure\Repository;

use App\MyHammer\Domain\Job\RepositoryInterface\ServiceRepositoryInterface;
use App\MyHammer\Domain\Service\Entity\Service;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Doctrine\Common\Persistence\ObjectManager;

class DoctrineServiceRepository implements ServiceRepositoryInterface
{

    /**
     * @var ObjectManager
     */
    private $doctrine;

    /**
     * DoctrineServiceRepository constructor.
     * @param Registry $doctrine
     */
    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine->getManager();
    }

    /**
     * @param int $serviceId
     * @return Service|null
     */
    public function findServiceById(int $serviceId): ?Service
    {
        $service = $this->doctrine->getRepository(Service::class)->findOneBy(['service_id' => $serviceId]);
        return $service instanceof Service ? $service : null;
    }
}
