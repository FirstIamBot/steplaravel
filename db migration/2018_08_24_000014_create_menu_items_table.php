<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuItemsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'menu_items';

    /**
     * Run the migrations.
     * @table menu_items
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('menu_id')->nullable()->default(null);
            $table->string('title');
            $table->string('url');
            $table->string('target')->default('_self');
            $table->string('icon_class')->nullable()->default(null);
            $table->string('color')->nullable()->default(null);
            $table->integer('parent_id')->nullable()->default(null);
            $table->integer('order');
            $table->string('route')->nullable()->default(null);
            $table->text('parameters')->nullable()->default(null);

            $table->index(["menu_id"], 'menu_items_menu_id_foreign');
            $table->nullableTimestamps();


            $table->foreign('menu_id', 'menu_items_menu_id_foreign')
                ->references('id')->on('menus')
                ->onDelete('cascade')
                ->onUpdate('restrict');
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
