<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_type')->nullable()->comment('Student,Employee,Admin');
            $table->string('name')->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile')->nullable();
            $table->text('address')->nullable();
            $table->string('gender')->nullable();
            $table->string('image')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('religion')->nullable();
            $table->string('id_no')->nullable();
            $table->date('data_of_birth')->nullable();
            $table->string('code')->nullable();
            $table->string('role')->nullable()->comment('admin = head of software, operator = computeroperator,user = employee');
            $table->date('join_date')->nullable();
            $table->unsignedBigInteger('designation_id')->nullable();
            $table->double('salary')->nullable();
            $table->tinyInteger('status')->default(1)->comment('0 = inactive ,1 = active');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
