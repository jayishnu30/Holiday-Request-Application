<?php
namespace App\Http\Controllers;

use App\Core\Services\HolidayRequestService;
use App\Core\Services\ValidationService;
use App\Http\Requests\HolidayRequestRequest;
use App\Http\Resources\HolidayRequestResource;

class HolidayRequestController extends Controller
{
    private $holidayRequestService;
    private $validationService;

    public function __construct(HolidayRequestService $holidayRequestService, ValidationService $validationService)
    {
        $this->holidayRequestService = $holidayRequestService;
        $this->validationService = $validationService;
    }

    public function requestHoliday(HolidayRequestRequest $request)
    {
        $holidayRequest = new \App\Core\Domain\Entities\HolidayRequest(
            auth()->user(), // Assuming authenticated user
            $request->start_date,
            $request->end_date
        );

        $this->holidayRequestService->createHolidayRequest($holidayRequest);

        return response()->json(new HolidayRequestResource($holidayRequest), 201);
    }

    public function getHolidayRequests()
    {
        $userId = auth()->user()->id;
        $holidayRequests = $this->holidayRequestService->viewHolidayRequests($userId);
        return response()->json(HolidayRequestResource::collection($holidayRequests));
    }

    public function validateRequest($requestId)
    {
        $this->validationService->approveHolidayRequest($requestId);
        return response()->json(['status' => 'Approved']);
    }

    public function denyRequest($requestId)
    {
        $this->validationService->denyHolidayRequest($requestId);
        return response()->json(['status' => 'Denied']);
    }
}
?>