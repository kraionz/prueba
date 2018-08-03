<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;


class CreateSettingsTable extends Migration
{
    private $valueColumn;
    private $tablename;
    private $keyColumn;

    public function __construct()
	{
			$this->tablename = Config::get('setting.table');
			$this->keyColumn = Config::get('setting.keyColumn');
			$this->valueColumn = Config::get('setting.valueColumn');

	}

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create($this->tablename, function(Blueprint $table)
		{
			$table->increments('id');
			$table->string($this->keyColumn)->index();
			$table->text($this->valueColumn)->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop($this->tablename);
	}
}
