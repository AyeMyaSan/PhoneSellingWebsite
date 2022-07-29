<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Product extends Model  {
    
    /**
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'product';
    
    /**
    * Attributes that should be mass-assignable.
    *
    * @var array
    */
    protected $fillable = ['user_id','model','category','brand','screensize','resolution','cpu','gpu','os','ram','memory','camera','battery','color','other_feactures','price','image','visibility'];
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