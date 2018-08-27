<?php
declare(strict_types=1);

namespace App\MyHammer\Application\DTO;

use App\MyHammer\Domain\Job\DTOInterface\SearchJobDTOInterface;

class SearchJobDTO implements SearchJobDTOInterface
{

    /**
     * @var int|null
     */
    private $id;
    /**
     * @var int|null
     */
    private $serviceId;
    /**
     * @var null|string
     */
    private $zipCode;
    /**
     * @var int
     */
    private $idUser;

    /**
     * SearchJobDTO constructor.
     * @param int|null $id
     * @param int|null $serviceId
     * @param null|string $zipCode
     * @param int $idUser
     */
    public function __construct(
        ?int $id,
        ?int $serviceId,
        ?string $zipCode,
        int $idUser
    ) {
        $this->id = $id;
        $this->serviceId = $serviceId;
        $this->zipCode = $zipCode;
        $this->idUser = $idUser;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int|null
     */
    public function getServiceId(): ?int
    {
        return $this->serviceId;
    }

    /**
     * @return null|string
     */
    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    /**
     * @return int
     */
    public function getIdUser(): int
    {
        return $this->idUser;
    }

    /**
     * @param array $param
     * @return SearchJobDTO
     */
    public static function fromArray(array $param): self
    {
        return new self(
            $param['job_id'] ?? null,
            $param['service_id'] ?? null,
            $param['zipcode'] ?? null,
            $param['id_user']
        );
    }
}
