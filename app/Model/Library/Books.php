<?php

namespace App\Model\Library;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
	/**
	 * The table associated with the model.
	 *
	 * @var string
	 */
	protected $table = 'books';
	/**
	 * Indicates if the model should be timestamped.
	 *
	 * @var bool
	 */
	public $timestamps = false;
	/**
	 *Если основные ключ называется иначе,
	 *чем id настроить имя столбца в модели idbooks
	 */
	protected  $primaryKey = 'idbooks';

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     */
	public function genre()
	{
		return $this->belongsTo('App\Model\Library\Genres', 'idgenre', 'genre');
		#return $this->hasOne(Genres::class);
	}
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     *
     */
	public function autor()
	{
		return $this->belongsTo('App\Model\Library\Autors', 'idautots');
	}
}
