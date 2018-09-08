<?php

namespace App\Model\Library;

use Illuminate\Database\Eloquent\Model;

class Genres extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'genres';
	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;
	/**
	 *Если основные ключ называется иначе,
	 *чем id настроить имя столбца в модели idgenre
	 */
	protected  $primaryKey = 'idgenre';

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 *
	 */
	public function books()
	{
		return $this->belongsTo('App\Model\Library\Books', 'genre', 'idgenre');
	}
}
