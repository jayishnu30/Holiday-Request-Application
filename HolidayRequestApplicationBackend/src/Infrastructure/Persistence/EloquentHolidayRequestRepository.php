<?php
namespace App\Repositories;

use App\Models\HolidayRequest;
use App\Repositories\HolidayRequestRepositoryInterface;

class EloquentHolidayRequestRepository implements HolidayRequestRepositoryInterface
{
    /**
     * Get all holiday requests for a user.
     *
     * @param  int  $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getHolidayRequestsByUser(int $userId)
    {
        return HolidayRequest::where('user_id', $userId)->get();
    }

    /**
     * Create a new holiday request.
     *
     * @param  array  $data
     * @return \App\Models\HolidayRequest
     */
    public function createHolidayRequest(array $data)
    {
        return HolidayRequest::create([
            'user_id' => $data['user_id'],
            'start_date' => $data['start_date'],
            'end_date' => $data['end_date'],
            'total_days' => $data['total_days'],
            'status' => 'PENDING', // Default status
        ]);
    }

    /**
     * Get a holiday request by ID.
     *
     * @param  int  $requestId
     * @return \App\Models\HolidayRequest|null
     */
    public function getHolidayRequestById(int $requestId)
    {
        return HolidayRequest::find($requestId);
    }

    /**
     * Update a holiday request's status.
     *
     * @param  int  $requestId
     * @param  string  $status
     * @return bool
     */
    public function updateHolidayRequestStatus(int $requestId, string $status)
    {
        $holidayRequest = HolidayRequest::find($requestId);

        if ($holidayRequest) {
            $holidayRequest->status = $status;
            return $holidayRequest->save();
        }

        return false;
    }
}
?>