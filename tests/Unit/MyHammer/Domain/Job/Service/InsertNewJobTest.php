<?php
declare(strict_types=1);

namespace App\Tests\Unit\MyHammer\Domain\Job\Service;

use App\MyHammer\Domain\Job\DTOInterface\InsertNewJobDTOInterface;
use App\MyHammer\Domain\Job\RepositoryInterface\HttpZipCodeInformationInterface;
use App\MyHammer\Domain\Job\RepositoryInterface\JobRepositoryInterface;
use App\MyHammer\Domain\Job\RepositoryInterface\ServiceRepositoryInterface;
use App\MyHammer\Domain\Job\Service\InsertNewJob;
use App\MyHammer\Domain\Service\Entity\Service;
use App\MyHammer\Infrastructure\HTTP\HttpZipCodeInformation;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class InsertNewJobTest extends TestCase
{
    /** @var InsertNewJob */
    private $insertNewJob;

    /** @var MockObject */
    private $jobRepository;

    /** @var MockObject */
    private $serviceRepository;

    /** @var MockObject */
    private $insertNewJobDTO;

    /** @var MockObject */
    private $serviceEntity;

    /** @var MockObject */
    private $httpZipCode;

    public function setUp(): void
    {
        $this->jobRepository = $this->getMockBuilder(JobRepositoryInterface::class)->getMock();

        $this->serviceRepository = $this->getMockBuilder(ServiceRepositoryInterface::class)->getMock();

        $this->insertNewJobDTO = $this->getMockBuilder(InsertNewJobDTOInterface::class)->getMock();

        $this->httpZipCode = $this->getMockBuilder(HttpZipCodeInformationInterface::class)->getMock();


        $this->serviceEntity = $this->getMockBuilder(Service::class)
            ->disableOriginalConstructor()->getMock();

        $this->insertNewJob = new InsertNewJob(
            $this->jobRepository,
            $this->serviceRepository,
            $this->httpZipCode
        );
    }

    /**
     * @test
     */
    public function mustInsertJobWithSuccess(): void
    {
        $this->insertNewJobDTO->method('getServiceId')->willReturn(123);
        $this->insertNewJobDTO->method('getTitle')->willReturn('This is a test.');
        $this->insertNewJobDTO->method('getZipCode')->willReturn(10115);
        $this->insertNewJobDTO->method('getCity')->willReturn('Unit Test City');
        $this->insertNewJobDTO->method('getDescription')->willReturn('This is a simple Description');
        $this->insertNewJobDTO->method('getExecutionDate')->willReturn('2018-09-10');

        $this->httpZipCode->method('getGermanZipCodeInformation')->willReturn(['country' => 'Germany']);

        $this->serviceRepository->method('findServiceById')->willReturn($this->serviceEntity);

        $response = $this->insertNewJob->insertJob($this->insertNewJobDTO);

        $this->assertEquals('123', $response->getServiceId());
        $this->assertEquals('This is a test.', $response->getTitle());
        $this->assertEquals('2018-09-10 00:00', $response->getExecutionDate());
    }

    /**
     * @test
     * @expectedException \App\MyHammer\Domain\Job\Exception\NoServiceFoundException
     */
    public function shouldThrowNoServiceFoundException(): void
    {
        $this->insertNewJobDTO->method('getServiceId')->willReturn(123);
        $this->serviceRepository->method('findServiceById')->willReturn(null);

        $this->insertNewJob->insertJob($this->insertNewJobDTO);
    }

    /**
     * @test
     * @expectedException \App\MyHammer\Domain\Job\Exception\ZipCodeNotAllowed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function shouldThrowZipCodeNotAllowedException(): void
    {
        $this->insertNewJobDTO->method('getServiceId')->willReturn(123);
        $this->serviceRepository->method('findServiceById')->willReturn($this->serviceEntity);
        $this->httpZipCode->method('getGermanZipCodeInformation')->willReturn(null);

        $this->insertNewJob->insertJob($this->insertNewJobDTO);
    }
}
