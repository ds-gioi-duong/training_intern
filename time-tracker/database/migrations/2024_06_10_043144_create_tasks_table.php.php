<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id()->comment('Primary Key');
            $table->unsignedBigInteger('timesheet_id')->comment('Foreign key to Timesheet table');
            $table->string('name')->default('Task Name');
            $table->timestamp('start')->nullable();
            $table->timestamp('end')->nullable();
            $table->string('type')->default('task');
            $table->integer('progress')->default(0);
            $table->json('dependencies')->nullable();
            $table->integer('priority')->nullable();
            $table->boolean('isDisabled')->default(false);
            $table->text('styles')->nullable();
            $table->boolean('hideChildren')->default(false);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'))->comment('Creation timestamp');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP'))->useCurrentOnUpdate()->nullable()->comment('Update timestamp');
        });
    }
   
}
     