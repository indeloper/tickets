<?php

namespace App\Http\Interfaces;

use Illuminate\Database\Eloquent\Model;

interface BlockableInterface
{
    public function block(): bool;

    public function unblock(): bool;
}
