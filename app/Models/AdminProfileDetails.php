<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProfileDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'admin_id',
        'address',
        'twitter',
        'google',
        'linkdin',
        'facebook',
        'gitHub',
        'biography'
    ];

    public function admin(){
        return $this->belongsTo(Admin::class, 'admin_id');
    }

}
