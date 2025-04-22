<?php

namespace App\Models;

use App\Enums\LeaveRequestStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LeaveRequest extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $guarded = [];
    protected $casts = [
        'status' => LeaveRequestStatus::class,
    ];

    // The employee who submitted the leave request
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // The manager/admin who reviewed the leave request
    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
