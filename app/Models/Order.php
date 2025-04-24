<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Order
 * 
 * @property int $id
 * @property int $total_amount
 * @property int $status
 * @property Carbon|null $remittance_date
 * @property int|null $remittance_amount
 * @property string|null $remittance_account
 * @property string|null $remittance_account_last5
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 * @property Collection|OrderItem[] $order_items
 *
 * @package App\Models
 */
class Order extends Model
{
	protected $table = 'orders';

	protected $casts = [
		'total_amount' => 'int',
		'status' => 'int',
		'remittance_date' => 'datetime',
		'remittance_amount' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'total_amount',
		'status',
		'remittance_date',
		'remittance_amount',
		'remittance_account',
		'remittance_account_last5',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function order_items()
	{
		return $this->hasMany(OrderItem::class);
	}
}
