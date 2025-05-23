<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->dropForeign(['student_id']); // remove old foreign key
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade'); // add new one
        });
    }
    
    public function down()
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });
    }
    
};
