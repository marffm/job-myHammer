<?php
declare(strict_types=1);

namespace App\MyHammer\Domain\Job\Exception;

class ZipCodeNotAllowed extends \InvalidArgumentException
{

    /**
     * @param string $zipCode
     * @return ZipCodeNotAllowed
     */
    public static function fromZipCodeGerman(string $zipCode): self
    {
        return new self(
            sprintf('This Zip Code %s is not a German', $zipCode)
        );
    }
}
