<?php
declare(strict_types=1);

namespace App\MyHammer\Domain\Job\Entity;

use App\MyHammer\Domain\Job\DTOInterface\InsertNewJobDTOInterface;
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
     * @var int
     * @ORM\Column(name="service_id", type="integer", nullable=false)
     */
    private $serviceId;

    /**
     * @var string
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    private $title;

    /**
     * @var int
     * @ORM\Column(name="zip_code", type="int", nullable=false)
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
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;


    public function __construct(
        int $serviceId,
        string $title,
        int $zipCode,
        string $city,
        string $description,
        string $executionDate
    ) {
        $this->serviceId = $serviceId;
        $this->title = $title;
        $this->zipCode = $zipCode;
        $this->city = $city;
        $this->description = $description;
        $this->executionDate = new \DateTime($executionDate);
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getZipCode(): int
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
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt->format('Y-m-d H:i');
    }

    /**
     * @return null|string
     */
    public function getUpdatedAt(): ?string
    {
        if (null !== $this->updatedAt && $this->updatedAt instanceof \DateTime) {
            return $this->updatedAt->format('Y-m-d H:i');
        }
        return null;
    }


    /**
     * @param InsertNewJobDTOInterface $insertNewJobDTO
     * @return Job
     */
    public static function fromInsertNewJobDTO(InsertNewJobDTOInterface $insertNewJobDTO): self
    {
        return new self(
            $insertNewJobDTO->getServiceId(),
            $insertNewJobDTO->getTitle(),
            $insertNewJobDTO->getZipCode(),
            $insertNewJobDTO->getCity(),
            $insertNewJobDTO->getDescription(),
            $insertNewJobDTO->getExecutionDate()
        );
    }
}
