<?php
namespace App\Core\Domain\Entities;

use DateTime;

class HolidayRequest
{
    public $id;
    public $user;
    public $start_date;
    public $end_date;
    public $total_days;
    public $status;
    public $requested_at;
    public $validated_at;

    public function __construct($user, $start_date, $end_date, $status = 'PENDING')
    {
        $this->user = $user;
        $this->start_date = new DateTime($start_date);
        $this->end_date = new DateTime($end_date);
        $this->total_days = $this->calculateTotalDays();
        $this->status = $status;
        $this->requested_at = new DateTime();
    }

    private function calculateTotalDays()
    {
        $diff = $this->start_date->diff($this->end_date);
        return $diff->days + 1; // Including start day
    }

    public function isValid()
    {
        return $this->total_days <= 10;  // Only allow up to 10 days of holiday
    }
}
?>