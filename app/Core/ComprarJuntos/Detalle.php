<?php namespace App\Core\ComprarJuntos;

use Illuminate\Database\Eloquent\Model;

class Detalle extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $table = 'clu_order_detail';
	
	protected $fillable = ['id','price','volume','description','order_id'];
			
}