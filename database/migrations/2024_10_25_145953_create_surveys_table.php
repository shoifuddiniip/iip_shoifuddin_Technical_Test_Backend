<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSurveysTable extends Migration
{
    public function up()
    {
        Schema::create('surveys', function (Blueprint $table) {
            $table->id();
            $table->foreignId('lead_id')->constrained()->onDelete('cascade'); // Foreign key to leads table
            $table->string('status')->default('pending'); // Status of the survey (e.g., pending, completed)
            $table->text('feedback')->nullable(); // Feedback from the survey
            $table->text('image')->nullable(); // Adding the image field
            $table->timestamps(); // Created and updated timestamps
        });
    }

    public function down()
    {
        Schema::dropIfExists('surveys');
    }
}
