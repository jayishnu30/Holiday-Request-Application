<?php
namespace App\Core\Application\UseCases;

use App\Repositories\HolidayRequestRepositoryInterface;
use App\Repositories\UserRepositoryInterface;
use App\Models\HolidayRequest;
use App\Exceptions\HolidayRequestException;

class CreateHolidayRequestUseCase
{
    protected $holidayRequestRepo;
    protected $userRepo;

    public function __construct(
        HolidayRequestRepositoryInterface $holidayRequestRepo,
        UserRepositoryInterface $userRepo
    ) {
        $this->holidayRequestRepo = $holidayRequestRepo;
        $this->userRepo = $userRepo;
    }

    /**
     * Handle the creation of a holiday request by an employee.
     *
     * @param  int  $userId
     * @param  string  $startDate
     * @param  string  $endDate
     * @return \App\Models\HolidayRequest
     * @throws \App\Exceptions\HolidayRequestException
     */
    public function execute(int $userId, string $startDate, string $endDate)
    {
        // Fetch the user
        $user = $this->userRepo->getUserById($userId);

        if (!$user) {
            throw new HolidayRequestException('User not found.');
        }

        // Calculate the total number of days requested
        $requestedDays = $this->calculateTotalDays($startDate, $endDate);

        // Check if the total requested days exceed 10 days in the current year
        $existingRequests = $this->holidayRequestRepo->getHolidayRequestsByUser($userId);
        $totalRequestedDays = $existingRequests->sum('total_days');

        if ($totalRequestedDays + $requestedDays > 10) {
            throw new HolidayRequestException('Cannot request more than 10 days of holidays per year.');
        }

        // Create the holiday request
        return $this->holidayRequestRepo->createHolidayRequest([
            'user_id' => $userId,
            'start_date' => $startDate,
            'end_date' => $endDate,
            'total_days' => $requestedDays,
        ]);
    }

    /**
     * Calculate the total number of days between the start and end dates.
     *
     * @param  string  $startDate
     * @param  string  $endDate
     * @return int
     */
    private function calculateTotalDays(string $startDate, string $endDate)
    {
        $start = \Carbon\Carbon::parse($startDate);
        $end = \Carbon\Carbon::parse($endDate);

        return $start->diffInDays($end) + 1; // Include start day in the calculation
    }
}
?>