<?php
declare(strict_types=1);

namespace App\MyHammer\Domain\Job\Entity;

use App\MyHammer\Domain\Job\DTOInterface\InsertNewJobDTOInterface;
use App\MyHammer\Domain\Service\Entity\Service;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class Job
 * @package App\MyHammer\Domain\Job\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="job")
 */
class Job
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\Column(name="job_id", type="integer", nullable=false, unique=true)
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Service
     * @ORM\ManyToOne(targetEntity="App\MyHammer\Domain\Service\Entity\Service", cascade={"all"}, fetch="LAZY")
     * @ORM\JoinColumn(name="service_id", referencedColumnName="service_id", nullable=false)
     */
    private $serviceId;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(name="zip_code", type="string", nullable=false)
     */
    private $zipCode;

    /**
     * @var string
     * @ORM\Column(name="city", type="string", nullable=false)
     */
    private $city;

    /**
     * @var string
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var \DateTime
     * @ORM\Column(name="execution_date", type="datetime")
     */
    private $executionDate;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;
    /**
     * @var int
     * @ORM\Column(name="id_user", type="integer")
     */
    private $idUser;


    public function __construct(
        string $title,
        string $zipCode,
        string $city,
        string $description,
        string $executionDate,
        int $idUser
    ) {
        $this->title = $title;
        $this->zipCode = $zipCode;
        $this->city = $city;
        $this->description = $description;
        $this->executionDate = new \DateTime($executionDate);
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
        $this->idUser = $idUser;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getServiceId(): ?int
    {
        return $this->serviceId instanceof Service ? $this->serviceId->getServiceId() : null;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getExecutionDate(): string
    {
        return $this->executionDate->format('Y-m-d H:i');
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
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
        return $this->updatedAt->format('Y-m-d H:i');
    }

    /**
     * @param Service $service
     */
    public function setService(Service $service): void
    {
        $this->serviceId = $service;
    }

    /**
     * @param InsertNewJobDTOInterface $insertNewJobDTO
     * @return Job
     */
    public static function fromInsertNewJobDTO(InsertNewJobDTOInterface $insertNewJobDTO): self
    {
        return new self(
            $insertNewJobDTO->getTitle(),
            $insertNewJobDTO->getZipCode(),
            $insertNewJobDTO->getCity(),
            $insertNewJobDTO->getDescription(),
            $insertNewJobDTO->getExecutionDate(),
            $insertNewJobDTO->getIdUser()
        );
    }
}
