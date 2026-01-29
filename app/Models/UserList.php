<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserList extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'user_list';
    
    protected $fillable = [
        'name',
        'email',
        'phone',
        'password'
    ];

    public function subscriptions() {
        return $this->hasMany(PaymentSubscriptions::class, 'user_id');
    }
}
