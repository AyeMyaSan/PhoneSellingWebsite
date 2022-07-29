<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model  {
    
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'order';
    
    /**
    * Attributes that should be mass-assignable.
    *
    * @var array
    */
    protected $fillable = ['order_id','user_id','total_quantity','total_price','status','user_name','email','phoneNo','address','created_at', 'updated_at'];
    /**
    * The attributes excluded from the model's JSON form.
    *
    * @var array
    */
    protected $hidden = [];
    
    /**
    * The attributes that should be casted to native types.
    *
    * @var array
    */
    protected $casts = [];
    
    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['created_at', 'updated_at'];
    
    // public function user(){
        //     return $this->belongsTo('App\User');
        // }
        
    }