<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Chapter
 * 
 * @property int $id
 * @property string $name
 * @property string $introduction
 * @property string $video_url
 * @property int $sort
 * @property int $course_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Course $course
 *
 * @package App\Models
 */
class Chapter extends Model
{
	protected $table = 'chapters';

	protected $casts = [
		'sort' => 'int',
		'course_id' => 'int'
	];

	protected $fillable = [
		'name',
		'introduction',
		'video_url',
		'sort',
		'course_id'
	];

	public function course()
	{
		return $this->belongsTo(Course::class);
	}
}
