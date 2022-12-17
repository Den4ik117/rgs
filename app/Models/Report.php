<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;

class Report
{
    const X_INTERVALS = 10;
    const Y_INTERVALS = 11;

    public readonly Value $x;
    public readonly Value $y;
    public readonly int $total;

    public function __construct(Collection $users)
    {
        $this->total = $users->count();

        $this->x = new Value($users, 'x', self::X_INTERVALS, $this->total);
        $this->y = new Value($users, 'y', self::Y_INTERVALS, $this->total);
    }
}
