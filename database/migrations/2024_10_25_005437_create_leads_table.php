<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone', 15)->nullable();
            $table->enum('status', [
                'new',
                'follow_up',
                'survey_request',
                'survey_approved',
                'survey_rejected',
                'survey_completed',
                'final_proposal_follow_up',
                'deal',
                'not_deal',
            ])->default('new'); // Default status
            $table->foreignId('assigned_to')->unique()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('leads');
    }
}
