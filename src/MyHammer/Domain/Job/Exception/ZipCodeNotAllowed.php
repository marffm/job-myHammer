<?php
declare(strict_types=1);

namespace App\MyHammer\Domain\Job\Exception;

class ZipCodeNotAllowed extends \InvalidArgumentException
{

    /**
     * @param int $zipCode
     * @return ZipCodeNotAllowed
     */
    public static function fromZipCodeGerman(int $zipCode): self
    {
        return new self(
            sprintf('This Zip Code %s is not a German', $zipCode)
        );
    }
}
