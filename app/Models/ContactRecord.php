<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ContactRecord
 * 
 * @property int $id
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $title
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class ContactRecord extends Model
{
	use HasFactory;
	protected $table = 'contact_records';

	protected $fillable = [
		'name',
		'phone',
		'email',
		'title',
		'content',
		'created_at'
	];
}
