<?php
namespace App\MyHammer\Domain\Job\RepositoryInterface;

interface HttpZipCodeInformationInterface
{

    public function getGermanZipCodeInformation(int $zipCode): ?array;
}
