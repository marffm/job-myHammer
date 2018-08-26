<?php
declare(strict_types=1);

namespace App\MyHammer\Domain\Service\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Service
 * @package App\MyHammer\Domain\Service\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="service")
 */
class Service
{
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\Column(name="service_id", type="integer", nullable=false, unique=true, length=6)
     */
    private $serviceId;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private $name;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * Service constructor.
     * @param null|string $serviceId
     * @param string $name
     */
    public function __construct(?string $serviceId, string $name)
    {
        $this->serviceId = null !== $serviceId ?? hexdec(uniqid());
        $this->name = $name;
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @return int
     */
    public function getServiceId(): int
    {
        return $this->serviceId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt->format('Y-m-d H:i');
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return null === $this->updatedAt ? null : $this->updatedAt->format('Y-m-d H:i');
    }
}
