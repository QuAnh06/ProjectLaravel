<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class PaymentSubscriptions extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'payment_subscriptions';
    protected $fillable = ['user_id', 'app_id', 'plan_id', 'status'];
    
    public function user(){
        return $this->belongsTo(UserList::class, 'user_id');
    }

    public function app(){
        return $this->belongsTo(AppModel::class, 'app_id');
    }

    public function plan(){
        return $this->belongsTo(Payment::class, 'plan_id');
    }
}
