<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('submissions', function (Blueprint $table) {
            $table->unsignedBigInteger('users_id')->after('id');
            $table->unsignedBigInteger('student_organizations_id')->after('users_id');
            $table->unsignedBigInteger('chairman')->after('student_organizations_id');
            $table->unsignedBigInteger('chairman_of_the_commitee')->after('chairman');
            $table->unsignedBigInteger('academic_student_affairs')->after('chairman_of_the_commitee');
            $table->unsignedBigInteger('coordinator_academic')->after('academic_student_affairs');
            $table->unsignedBigInteger('student_executive_board')->after('coordinator_academic');
            $table->string('name_of_activity')->after('student_executive_board');
            $table->dateTime('date_start')->after('name_of_activity');
            $table->dateTime('date_end')->after('date_start');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('submissions', function (Blueprint $table) {
            //
        });
    }
};
