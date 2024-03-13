<?php

namespace App\Filters;

class TaskFilter extends QueryFilter
{
    public function status($status = null)
    {
        return $this->builder->when($status, function ($query) use ($status) {
            $query->where('status', $status);
        });
    }

    public function date($date = null)
    {
        return $this->builder->when($date, function ($query) use ($date) {
            $query->where('created_at', 'LIKE', $date . '%');
        });
    }
}
