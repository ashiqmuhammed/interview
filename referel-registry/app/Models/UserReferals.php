<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReferals extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'refered_user_id',
        'points'
    ];

    /**
     * Get the user that owns the UserReferals
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get the user that owns the UserReferals
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function refered_user()
    {
        return $this->belongsTo(User::class, 'refered_user_id');
    }
}
