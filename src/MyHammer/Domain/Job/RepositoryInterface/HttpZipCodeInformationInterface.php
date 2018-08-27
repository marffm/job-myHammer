<?php
namespace App\MyHammer\Domain\Job\RepositoryInterface;

interface HttpZipCodeInformationInterface
{

    public function getGermanZipCodeInformation(string $zipCode): ?array;
}
