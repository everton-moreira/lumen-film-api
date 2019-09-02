<?php
 
 namespace App\Models;
 
 use Illuminate\Database\Eloquent\Model;
 
 class Actor extends Model
 {	
 	protected $table = 'actor';
 	
 	protected $fillable = [
 		'actor_id','first_name','last_name','last_update'
 	];
     
 	protected $casts = [
 		'last_update' => 'datetime:Y-m-d H:i:s'
 	];
 
 	public $timestamps = false;
 }