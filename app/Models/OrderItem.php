<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderItem
 * 
 * @property int $id
 * @property int $order_id
 * @property int $product_id
 * @property string $product_type
 * @property int $price_at_order_time
 * @property bool $is_accessible
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Order $order
 *
 * @package App\Models
 */
class OrderItem extends Model
{
	protected $table = 'order_items';

	protected $casts = [
		'order_id' => 'int',
		'product_id' => 'int',
		'price_at_order_time' => 'int',
		'is_accessible' => 'bool'
	];

	protected $fillable = [
		'order_id',
		'product_id',
		'product_type',
		'price_at_order_time',
		'is_accessible'
	];

	public function order()
	{
		return $this->belongsTo(Order::class);
	}
}
