<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    public function createdBy() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignedTo() {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
