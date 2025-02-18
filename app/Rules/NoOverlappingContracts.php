<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Contract;

class NoOverlappingContracts implements Rule
{
    private $box_id, $date_start, $date_end;

    public function __construct($box_id, $date_start, $date_end)
    {
        $this->box_id = $box_id;
        $this->date_start = $date_start;
        $this->date_end = $date_end;
    }

    public function passes($attribute, $value)
    {
        return !Contract::where('box_id', $this->box_id)
            ->where(function ($query) {
                $query->whereBetween('date_start', [$this->date_start, $this->date_end])
                    ->orWhereBetween('date_end', [$this->date_start, $this->date_end])
                    ->orWhere(function ($q) {
                        $q->where('date_start', '<', $this->date_start)
                            ->where('date_end', '>', $this->date_end);
                    });
            })
            ->exists();
    }

    public function message()
    {
        return 'Ce box a déjà un contrat en cours sur cette période.';
    }
}
