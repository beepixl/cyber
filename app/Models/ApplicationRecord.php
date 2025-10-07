<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplicationRecord extends Model
{
	protected $fillable = [
		'name',
		'address',
		'mobile_no',
		'date',
		'time',
		'officer',
		'details_of_application',
		'sp_instructions',
		'action_taken',
		'photo',
		'io_name',
		'io_mobile',
		'io_instructions',
		'io_feedback',
		'applicant_feedback',
		'status',
	];

	protected $casts = [
		'date' => 'date',
	];
}
