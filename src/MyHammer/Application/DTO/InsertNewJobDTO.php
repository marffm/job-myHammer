<?php
declare(strict_types=1);

namespace App\MyHammer\Application\DTO;

use App\MyHammer\Domain\Job\DTOInterface\InsertNewJobDTOInterface;

class InsertNewJobDTO implements InsertNewJobDTOInterface
{

    /**
     * @var int
     */
    private $serviceId;
    /**
     * @var string
     */
    private $title;
    /**
     * @var string
     */
    private $zipCode;
    /**
     * @var string
     */
    private $city;
    /**
     * @var string
     */
    private $description;
    /**
     * @var string
     */
    private $executionDate;
    /**
     * @var int
     */
    private $idUser;

    /**
     * InsertNewJobDTO constructor.
     * @param int $serviceId
     * @param string $title
     * @param string $zipCode
     * @param string $city
     * @param string $description
     * @param string $executionDate
     * @param int $idUser
     */
    public function __construct(
        int $serviceId,
        string $title,
        string $zipCode,
        string $city,
        string $description,
        string $executionDate,
        int $idUser
    ) {
        $this->assertTitle($title);

        $this->serviceId = $serviceId;
        $this->title = $title;
        $this->zipCode = $zipCode;
        $this->city = $city;
        $this->description = $description;
        $this->executionDate = $executionDate;
        $this->idUser = $idUser;
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
        return $this->executionDate;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }


    /**
     * @param string $title
     */
    private function assertTitle(string $title): void
    {
        $titleLength = strlen($title);

        if ($titleLength < 5 || $titleLength > 50) {
            throw new \InvalidArgumentException('Invalid Title length');
        }
    }


    public static function fromArray(array $params): self
    {
        return new self(
            (int)$params['service_id'],
            $params['title'],
            $params['zipcode'],
            $params['city'],
            $params['description'],
            $params['execution_date'],
            (int)$params['id_user']
        );
    }
}
