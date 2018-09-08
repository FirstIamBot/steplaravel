<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'books';

    /**
     * Run the migrations.
     * @table books
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('idbooks');
            $table->string('ISBN', 128)->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->integer('genre')->nullable()->default(null);
            $table->mediumText('idAutor')->nullable()->default(null);
            $table->integer('imageID')->nullable()->default(null);
            $table->string('imageURL')->nullable()->default(null);
            $table->string('name', 128)->nullable()->default(null);
            $table->integer('price')->nullable()->default(null);
            $table->string('strAutor', 128)->nullable()->default(null);
            $table->string('AuthorComposer', 128)->nullable()->default(null);
            $table->string('Paper', 128)->nullable()->default(null);
            $table->string('Weight', 128)->nullable()->default(null);
            $table->string('ChildAge', 128)->nullable()->default(null);
            $table->string('YearPublication', 128)->nullable()->default(null);
            $table->string('YearFirstPublication', 128)->nullable()->default(null);
            $table->string('Publish', 128)->nullable()->default(null);
            $table->string('Publishing', 128)->nullable()->default(null);
            $table->string('illustrator', 128)->nullable()->default(null);
            $table->string('illustrations', 128)->nullable()->default(null);
            $table->string('HistoricalPeriod', 128)->nullable()->default(null);
            $table->string('Class', 128)->nullable()->default(null);
            $table->string('NumberPages', 128)->nullable()->default(null);
            $table->string('whom', 128)->nullable()->default(null);
            $table->string('Literature', 128)->nullable()->default(null);
            $table->string('LiteraturePeriods', 128)->nullable()->default(null);
            $table->string('LiteratureCountries', 128)->nullable()->default(null);
            $table->string('OriginalTitle', 128)->nullable()->default(null);
            $table->string('Translator')->nullable()->default(null);
            $table->string('Binding', 128)->nullable()->default(null);
            $table->string('style', 128)->nullable()->default(null);
            $table->string('Occasion', 128)->nullable()->default(null);
            $table->string('Edited', 128)->nullable()->default(null);
            $table->string('GiftBbooks', 128)->nullable()->default(null);
            $table->string('SeriesBooks', 128)->nullable()->default(null);
            $table->string('Compiler', 128)->nullable()->default(null);
            $table->string('ReferenceEditions', 128)->nullable()->default(null);
            $table->string('Type', 128)->nullable()->default(null);
            $table->string('Circulation', 128)->nullable()->default(null);
            $table->string('Format', 128)->nullable()->default(null);
            $table->string('Font', 128)->nullable()->default(null);
            $table->string('Language', 128)->nullable()->default(null);
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
