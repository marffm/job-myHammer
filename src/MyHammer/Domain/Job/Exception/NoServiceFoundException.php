<?php
declare(strict_types=1);

namespace App\MyHammer\Domain\Job\Exception;

class NoServiceFoundException extends \RuntimeException
{

    /**
     * @param int $serviceId
     * @return NoServiceFoundException
     */
    public static function fromId(int $serviceId): self
    {
        return new self(
            sprintf('Service with id %s not found.', $serviceId)
        );
    }
}
