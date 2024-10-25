<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateLeadDistributionTrackersTable extends Migration
{
    public function up()
    {
        Schema::create('lead_distribution_trackers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('last_sales_id')->nullable();
            $table->timestamps();
        });

        // Insert an initial record to use for tracking
        DB::table('last_sales_id')->insert(['last_sales_id' => null]);
    }

    public function down()
    {
        Schema::dropIfExists('lead_distribution_trackers');
    }
}
