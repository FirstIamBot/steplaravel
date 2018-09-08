<?php

namespace App\Model\Library;

use Illuminate\Database\Eloquent\Model;

class Autors extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'autors';
	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;
	/**
	 *Если основные ключ называется иначе,
	 *чем id настроить имя столбца в модели idautots
	 */
	protected  $primaryKey = 'idautots';
}
