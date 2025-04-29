<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class UserInfo
 * 
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property Carbon|null $birth_date
 * @property Carbon|null $birth_time
 * @property string|null $birth_city
 * @property string|null $address
 * @property int $status
 * @property int $user_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property User $user
 *
 * @package App\Models
 */
class UserInfo extends Model
{
	use HasFactory;

	protected $table = 'user_infos';

	protected $casts = [
		'birth_date' => 'date:Y-m-d',
		'birth_time' => 'datetime',
		'status' => 'int',
		'user_id' => 'int'
	];

	protected $fillable = [
		'name',
		'phone',
		'birth_date',
		'birth_time',
		'birth_city',
		'address',
		'status',
		'user_id'
	];

	public function user()
	{
		return $this->belongsTo(User::class);
	}
}
