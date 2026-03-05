<?php

namespace App\Services;

use App\Models\ActivityLog;

class ActivityLogger
{
    public static function record(
        ?int $userId,
        string $action,
        string $description,
        array $metadata = []
    ): void {
        ActivityLog::create([
            'user_id'     => $userId,
            'action'      => $action,
            'description' => $description,
            'metadata'    => $metadata ?: null,
            'ip_address'  => request()->ip(),
        ]);
    }
}