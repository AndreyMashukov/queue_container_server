<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
    {

	protected $table    = "order";
	protected $fillable = [
	    "id", "hash", "container_name", "readable_container_name"
	];

    }

?>

