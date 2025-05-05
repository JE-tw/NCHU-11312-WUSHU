<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Service
 * 
 * @property int $id
 * @property string $name
 * @property int $price
 * @property string $introduction
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class Service extends Model
{
	use SoftDeletes; // 使用軟刪除
	protected $table = 'services';

	protected $casts = [
		'price' => 'int'
	];

	protected $fillable = [
		'name',
		'price',
		'introduction'
	];
}
