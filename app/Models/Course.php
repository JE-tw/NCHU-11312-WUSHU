<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Course
 * 
 * @property int $id
 * @property string $name
 * @property int $category_id
 * @property int $price
 * @property string $introduction
 * @property string $detail
 * @property int $is_featured
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Category $category
 * @property Collection|Chapter[] $chapters
 *
 * @package App\Models
 */
class Course extends Model
{
	protected $table = 'courses';

	protected $casts = [
		'category_id' => 'int',
		'price' => 'int',
		'is_featured' => 'boolean'
	];

	protected $fillable = [
		'name',
		'category_id',
		'price',
		'introduction',
		'detail',
		'is_featured',
		'featured_image'
	];

	public function category()
	{
		return $this->belongsTo(Category::class, 'category_id');
	}

	public function chapters()
	{
		return $this->hasMany(Chapter::class);
	}
}
