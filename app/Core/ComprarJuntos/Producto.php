<?php namespace App\Core\ComprarJuntos;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'clu_products';
	
	protected $fillable = ['id','name','price','category','unity_measure','colors','sizes','description','image1','image2','image3','order','store_id'];
			
}