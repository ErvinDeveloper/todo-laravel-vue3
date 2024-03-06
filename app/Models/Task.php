<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'status'
    ];

    protected function serializeDate(\DateTimeInterface $date) {
        return $date->diffForHumans();
    }

    public function scopeSelectForList($query)
    {
        return $query->select('id', 'title', 'status', 'created_at');
    }
}
