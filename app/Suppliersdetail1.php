<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Suppliersdetail1 extends Model
{
    protected $table ='suppliersdetail1';
	protected $fillable = [
        'name',
        
        
        'price',
       
		'value',
      
        'supplier_id',
		


    ];

   
	public function suppliers() //  Place (n) -> Category (1)
    {
        return $this->belongsTo(Supplier::class);
    }
}
