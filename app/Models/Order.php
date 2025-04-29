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
	protected $appends = ['status_text'];
	protected $table = 'orders';

	protected $casts = [
		'total_amount' => 'int',
		'status' => 'int',
		'remittance_date' => 'date:Y-m-d',
		'remittance_amount' => 'int',
		'user_id' => 'int',
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

	public function getStatusTextAttribute(): string
	{
		return match ($this->status) {
			0 => '尚未付款',
			1 => '等待客服確認款項',
			2 => '已確認付款',
			3 => '取消訂單',
			default => '未知狀態',
		};
	}

	public function user()
	{
		return $this->belongsTo(User::class);
	}

	public function orderItems()
	{
		return $this->hasMany(OrderItem::class);
	}
}
