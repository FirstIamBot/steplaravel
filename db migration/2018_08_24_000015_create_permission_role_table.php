<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionRoleTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'permission_role';

    /**
     * Run the migrations.
     * @table permission_role
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('permission_id');
            $table->unsignedInteger('role_id');

            $table->index(["role_id"], 'permission_role_role_id_index');

            $table->index(["permission_id"], 'permission_role_permission_id_index');


            $table->foreign('permission_id', 'permission_role_permission_id')
                ->references('id')->on('permissions')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->foreign('role_id', 'permission_role_role_id_index')
                ->references('id')->on('roles')
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
