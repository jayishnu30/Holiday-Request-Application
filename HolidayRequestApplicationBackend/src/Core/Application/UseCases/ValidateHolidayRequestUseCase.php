<?php
namespace App\Core\Application\UseCases;

use App\Repositories\HolidayRequestRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Models\HolidayRequest;
use App\Exceptions\HolidayRequestException;

class ValidateHolidayRequestUseCase
{
    protected $holidayRequestRepo;

    public function __construct(HolidayRequestRepositoryInterface $holidayRequestRepo)
    {
        $this->holidayRequestRepo = $holidayRequestRepo;
    }

    /**
     * Validate and approve a holiday request.
     *
     * @param  int  $requestId
     * @return bool
     * @throws \App\Exceptions\HolidayRequestException
     */
    public function approve(int $requestId)
    {
        $holidayRequest = $this->holidayRequestRepo->getHolidayRequestById($requestId);

        if (!$holidayRequest) {
            throw new HolidayRequestException('Holiday request not found.');
        }

        if ($holidayRequest->status !== 'PENDING') {
            throw new HolidayRequestException('This holiday request is already processed.');
        }

        // Approve the holiday request
        return $this->holidayRequestRepo->updateHolidayRequestStatus($requestId, 'APPROVED');
    }

    /**
     * Validate and deny a holiday request.
     *
     * @param  int  $requestId
     * @return bool
     * @throws \App\Exceptions\HolidayRequestException
     */
    public function deny(int $requestId)
    {
        $holidayRequest = $this->holidayRequestRepo->getHolidayRequestById($requestId);

        if (!$holidayRequest) {
            throw new HolidayRequestException('Holiday request not found.');
        }

        if ($holidayRequest->status !== 'PENDING') {
            throw new HolidayRequestException('This holiday request is already processed.');
        }

        // Deny the holiday request
        return $this->holidayRequestRepo->updateHolidayRequestStatus($requestId, 'DENIED');
    }
}
?>