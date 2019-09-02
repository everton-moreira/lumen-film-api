<?php
 
 namespace App\Models;
 
 use Illuminate\Database\Eloquent\Model;
 
 class User extends Model
 {	
 	protected $table = 'user';
 	
 	protected $fillable = [
 		'user_id','name','email','ativo','perfil','foto'
	 ];
	 
	 protected $hidden = [
        'password',
	];
	
	protected $casts = [
		'ativo' => 'boolean'
	];
     
 	public $timestamps = false;
 }