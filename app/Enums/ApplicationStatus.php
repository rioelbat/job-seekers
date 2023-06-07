<?php

namespace App\Enums;

enum ApplicationStatus: string
{
    case PENDING = 'pending';
    case ACCEPTED = 'accepted';
    case REJECTED = 'rejected';

    public function isAccepted(): bool
    {
        return $this === self::ACCEPTED;
    }

    public function isRejected(): bool
    {
        return $this === self::REJECTED;
    }

    public function isPending(): bool
    {
        return $this === self::PENDING;
    }

    public function getLabelText(): string
    {
        return match ($this) {
            self::ACCEPTED => 'Accepted',
            self::REJECTED => 'Rejected',
            self::PENDING => 'Pending',
        };
    }
}
