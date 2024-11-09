<?php
namespace App\Core\Services;

use App\Core\Domain\Repositories\HolidayRequestRepositoryInterface;

class ValidationService
{
    private $holidayRequestRepository;

    public function __construct(HolidayRequestRepositoryInterface $holidayRequestRepository)
    {
        $this->holidayRequestRepository = $holidayRequestRepository;
    }

    public function approveHolidayRequest($requestId)
    {
        $holidayRequest = $this->holidayRequestRepository->findById($requestId);
        $holidayRequest->status = 'APPROVED';
        $this->holidayRequestRepository->save($holidayRequest);
    }

    public function denyHolidayRequest($requestId)
    {
        $holidayRequest = $this->holidayRequestRepository->findById($requestId);
        $holidayRequest->status = 'DENIED';
        $this->holidayRequestRepository->save($holidayRequest);
    }
}
?>