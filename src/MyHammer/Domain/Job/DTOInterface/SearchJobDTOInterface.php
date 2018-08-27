<?php
namespace App\MyHammer\Domain\Job\DTOInterface;

interface SearchJobDTOInterface
{
    public function getId(): ?int;

    public function getServiceId(): ?int;

    public function getIdUser(): int;

    public function getZipCode(): ?string;
}
