<?php
namespace App\Core\Application\UseCases;

use App\Repositories\HolidayRequestRepositoryInterface;
use App\Exceptions\HolidayRequestException;

class ViewHolidayRequestUseCase
{
    protected $holidayRequestRepo;

    public function __construct(HolidayRequestRepositoryInterface $holidayRequestRepo)
    {
        $this->holidayRequestRepo = $holidayRequestRepo;
    }

    /**
     * Retrieve the details of a holiday request by its ID.
     *
     * @param  int  $requestId
     * @return \App\Models\HolidayRequest
     * @throws \App\Exceptions\HolidayRequestException
     */
    public function execute(int $requestId)
    {
        // Fetch the holiday request by ID
        $holidayRequest = $this->holidayRequestRepo->getHolidayRequestById($requestId);

        if (!$holidayRequest) {
            throw new HolidayRequestException('Holiday request not found.');
        }

        return $holidayRequest;
    }
}
?>
