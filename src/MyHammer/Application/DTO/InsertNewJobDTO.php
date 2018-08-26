<?php
declare(strict_types=1);

namespace App\MyHammer\Application\DTO;

use App\MyHammer\Application\Helper\ZipCodeVerifier;
use App\MyHammer\Domain\Job\DTOInterface\InsertNewJobDTOInterface;
use App\MyHammer\Infrastructure\HTTP\HttpZipCodeInformation;

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
     * @var int
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
     * InsertNewJobDTO constructor.
     * @param int $serviceId
     * @param string $title
     * @param int $zipCode
     * @param string $city
     * @param string $description
     * @param string $executionDate
     */
    public function __construct(
        int $serviceId,
        string $title,
        int $zipCode,
        string $city,
        string $description,
        string $executionDate
    ) {
        $this->assertTitle($title);

        $this->serviceId = $serviceId;
        $this->title = $title;
        $this->zipCode = $zipCode;
        $this->city = $city;
        $this->description = $description;
        $this->executionDate = $executionDate;
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
        return $this->executionDate;
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
            $params['service_id'],
            $params['title'],
            $params['zipcode'],
            $params['city'],
            $params['description'],
            $params['execution_date']
        );
    }
}
