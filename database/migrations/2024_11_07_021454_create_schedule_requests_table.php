// database/migrations/[timestamp]_create_schedule_requests_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('schedule_requests', function (Blueprint $table) {
            $table->id();
            $table->string('event_title');
            $table->date('event_date');
            $table->string('location');
            $table->time('start_time');
            $table->time('end_time');
            $table->string('program');
            $table->string('email');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedule_requests');
    }
};