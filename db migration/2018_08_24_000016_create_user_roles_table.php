<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserRolesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'user_roles';

    /**
     * Run the migrations.
     * @table user_roles
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('user_id');
            $table->unsignedInteger('role_id');

            $table->index(["role_id"], 'user_roles_role_id_index');

            $table->index(["user_id"], 'user_roles_user_id_index');


            $table->foreign('role_id', 'user_roles_role_id_index')
                ->references('id')->on('roles')
                ->onDelete('cascade')
                ->onUpdate('restrict');

            $table->foreign('user_id', 'user_roles_user_id')
                ->references('id')->on('users')
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
