<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutorsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'autors';

    /**
     * Run the migrations.
     * @table autors
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idautots');
            $table->string('name0', 100)->nullable()->default(null);
            $table->string('name1', 100)->nullable()->default(null);
            $table->string('name2', 100)->nullable()->default(null);
            $table->string('name3', 100)->nullable()->default(null);
            $table->string('name4', 100)->nullable()->default(null);
            $table->string('name5', 100)->nullable()->default(null);
            $table->string('name6', 100)->nullable()->default(null);
            $table->string('name7', 100)->nullable()->default(null);
            $table->string('name8', 100)->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
