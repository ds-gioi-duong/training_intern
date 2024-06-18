<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTimesheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timesheets', function (Blueprint $table) {
            $table->id()->comment('Primary Key');
            $table->date('date')->default(DB::raw('CURRENT_DATE'))->comment('Date of timesheet');
            $table->unsignedBigInteger('user_id')->comment('Foreign key to User table');
            $table->text('difficulties')->nullable()->comment('Difficulties encountered');
            $table->text('next_day_plans')->nullable()->comment('Plans for the next day');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Creation timestamp');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'))->useCurrentOnUpdate()->nullable()->comment('Update timestamp');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('timesheets');
    }
}
