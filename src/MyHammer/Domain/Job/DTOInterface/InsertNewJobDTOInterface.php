<?php
namespace App\MyHammer\Domain\Job\DTOInterface;

interface InsertNewJobDTOInterface
{
    public function getServiceId(): int;

    public function getTitle(): string;

    public function getZipCode(): string;

    public function getCity(): string;

    public function getDescription(): string;

    public function getExecutionDate(): string;

    public function getIdUser(): int;

}
