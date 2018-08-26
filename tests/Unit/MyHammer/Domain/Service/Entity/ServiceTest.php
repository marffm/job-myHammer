<?php
declare(strict_types=1);

namespace App\Tests\Unit\MyHammer\Domain\Service\Entity;

use App\MyHammer\Domain\Service\Entity\Service;
use PHPUnit\Framework\TestCase;

class ServiceTest extends TestCase
{

    /**
     * @test
     */
    public function mustReturnWithSuccess(): void
    {
        $service = new Service(
            123456,
            'Test Unit'
        );

        $now = new \DateTime('now');

        $this->assertEquals(123456, $service->getServiceId());
        $this->assertEquals('Test Unit', $service->getName());
        $this->assertEquals($now->format('Y-m-d H:i'), $service->getCreatedAt());
    }
}
