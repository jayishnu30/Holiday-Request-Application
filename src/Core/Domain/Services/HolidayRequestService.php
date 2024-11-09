<?php
namespace App\Core\Services;

use App\Core\Domain\Repositories\HolidayRequestRepositoryInterface;
use App\Core\Domain\Entities\HolidayRequest;

class HolidayRequestService
{
    private $holidayRequestRepository;

    public function __construct(HolidayRequestRepositoryInterface $holidayRequestRepository)
    {
        $this->holidayRequestRepository = $holidayRequestRepository;
    }

    public function createHolidayRequest(HolidayRequest $holidayRequest)
    {
        if ($holidayRequest->isValid()) {
            $this->holidayRequestRepository->save($holidayRequest);
        } else {
            throw new \Exception("Holiday request exceeds 10 days.");
        }
    }

    public function viewHolidayRequests($userId)
    {
        return $this->holidayRequestRepository->findByUser($userId);
    }

    public function viewPendingRequests()
    {
        return $this->holidayRequestRepository->findPendingRequests();
    }
}
?>