<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoundRobinTrackerTable extends Migration
{
    public function up()
    {
        Schema::create('round_robin_tracker', function (Blueprint $table) {
            $table->id();
            $table->foreignId('last_assigned_user_id')->nullable()->constrained('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('round_robin_tracker');
    }
}
