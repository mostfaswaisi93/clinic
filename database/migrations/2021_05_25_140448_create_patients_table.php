<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            // $table->string('id_number')->unique(); // Id Number
            $table->string('full_name');
            $table->string('address');
            $table->string('phone');
            $table->date('dob'); // Date of Birth
            $table->longText('notes');
            $table->string('gender'); // Gender
            $table->string('blood_group'); // Blood Group
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Doctor
            $table->integer('enabled')->default(1);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patients');
    }
}
