<?php
namespace App\MyHammer\Domain\DTOInterface;

interface InsertNewJobDTOInterface
{
    public function getServiceId(): int;

    public function getTitle(): string;

    public function getZipCode(): int;

    public function getCity(): string;

    public function getDescription(): string;

    public function getExecutionDate(): string;
}
