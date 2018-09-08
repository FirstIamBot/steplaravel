<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataRowsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'data_rows';

    /**
     * Run the migrations.
     * @table data_rows
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('data_type_id');
            $table->string('field');
            $table->string('type');
            $table->string('display_name');
            $table->tinyInteger('required')->default('0');
            $table->tinyInteger('browse')->default('1');
            $table->tinyInteger('read')->default('1');
            $table->tinyInteger('edit')->default('1');
            $table->tinyInteger('add')->default('1');
            $table->tinyInteger('delete')->default('1');
            $table->text('details')->nullable()->default(null);
            $table->integer('order')->default('1');

            $table->index(["data_type_id"], 'data_rows_data_type_id_foreign');


            $table->foreign('data_type_id', 'data_rows_data_type_id_foreign')
                ->references('id')->on('data_types')
                ->onDelete('cascade')
                ->onUpdate('cascade');
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
