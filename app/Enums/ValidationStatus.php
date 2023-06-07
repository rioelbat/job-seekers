<?php

namespace App\Enums;

enum ValidationStatus: string
{
    case ACCEPTED = 'accepted';
    case DECLINED = 'declined';
    case PENDING = 'pending';

    public function isAccepted(): bool
    {
        return $this === self::ACCEPTED;
    }

    public function isDeclined(): bool
    {
        return $this === self::DECLINED;
    }

    public function isPending(): bool
    {
        return $this === self::PENDING;
    }

    public function getLabelText(): string
    {
        return match ($this) {
            self::ACCEPTED => 'Accepted',
            self::DECLINED => 'Declined',
            self::PENDING => 'Pending',
        };
    }
}
