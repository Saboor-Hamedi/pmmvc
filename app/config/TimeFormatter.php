<?php

namespace App\config;

use Carbon\Carbon;

class TimeFormatter
{
    protected $timestamp;
    protected $format;
    public function __construct($format = 'Y-m-d H:i:s', $timestamp = null)
    {
        $this->format = $format;
        $this->timestamp = $timestamp;
    }
    public function format($timestamp = null)
    {
        // If a timestamp is provided, use it; otherwise, use the stored timestamp
        $timestamp = $timestamp ?? $this->timestamp;
        // Use Carbon to format the timestamp
        $formattedTime = Carbon::parse($timestamp)->format($this->format);

        return $formattedTime;
    }
}
