<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDataTypesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'data_types';

    /**
     * Run the migrations.
     * @table data_types
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->string('display_name_singular');
            $table->string('display_name_plural');
            $table->string('icon')->nullable()->default(null);
            $table->string('model_name')->nullable()->default(null);
            $table->string('policy_name')->nullable()->default(null);
            $table->string('controller')->nullable()->default(null);
            $table->string('description')->nullable()->default(null);
            $table->tinyInteger('generate_permissions')->default('0');
            $table->tinyInteger('server_side')->default('0');
            $table->text('details')->nullable()->default(null);

            $table->unique(["name"], 'data_types_name_unique');

            $table->unique(["slug"], 'data_types_slug_unique');
            $table->nullableTimestamps();
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
