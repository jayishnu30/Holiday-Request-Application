<?php
namespace App\Core\Domain\Repositories;

use App\Core\Domain\Entities\HolidayRequest;

interface HolidayRequestRepositoryInterface
{
    public function save(HolidayRequest $holidayRequest);
    public function findById($id);
    public function findByUser($userId);
    public function findPendingRequests();
}
?>
