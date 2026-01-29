<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Models\PaymentSubscriptions;

class Payment extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'payments'; 
    protected $primaryKey = 'id';

    protected $fillable = ['app_id', 'package', 'price'];
    
    public function subscriptions(){
        return $this -> hasMany(PaymentSubscriptions::class, 'plan_id');
    }

    public function app(){
        return $this->belongsTo(AppModel::class, 'app_id');
    }

    public function symbol()
    {
        return $this->currency === 'EN' ? '¥' : '$';
    }
}
