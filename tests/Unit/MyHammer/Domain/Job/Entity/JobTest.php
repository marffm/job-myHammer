<?php
declare(strict_types=1);

namespace App\Tests\Unit\MyHammer\Domain\Job\Entity;

use App\MyHammer\Domain\DTOInterface\InsertNewJobDTOInterface;
use App\MyHammer\Domain\Job\Entity\Job;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class JobTest extends TestCase
{
    /**
     * @var MockObject
     */
    private $insertNewJobDTO;

    public function setUp(): void
    {
        $this->insertNewJobDTO = $this->getMockBuilder(InsertNewJobDTOInterface::class)->getMock();
        $this->insertNewJobDTO->method('getServiceId')->willReturn(123);
        $this->insertNewJobDTO->method('getTitle')->willReturn('This is a test.');
        $this->insertNewJobDTO->method('getZipCode')->willReturn(10115);
        $this->insertNewJobDTO->method('getCity')->willReturn('Unit Test City');
        $this->insertNewJobDTO->method('getDescription')->willReturn('This is a simple Description');
        $this->insertNewJobDTO->method('getExecutionDate')->willReturn('2018-09-10');
    }

    /**
     * @test
     */
    public function mustReturnWithSuccess(): void
    {
        $jobEntity = Job::fromInsertNewJobDTO($this->insertNewJobDTO);

        $createdAt = new \DateTime('now');

        $this->assertEquals(123, $jobEntity->getServiceId());
        $this->assertEquals('This is a test.', $jobEntity->getTitle());
        $this->assertEquals(10115, $jobEntity->getZipCode());
        $this->assertEquals('Unit Test City', $jobEntity->getCity());
        $this->assertEquals('This is a simple Description', $jobEntity->getDescription());
        $this->assertEquals('2018-09-10 00:00', $jobEntity->getExecutionDate());
        $this->assertEquals($createdAt->format('Y-m-d H:i'), $jobEntity->getCreatedAt());
    }
}
