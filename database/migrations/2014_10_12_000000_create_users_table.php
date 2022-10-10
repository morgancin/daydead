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
        Schema::create('users', function (Blueprint $table)
        {
            $table->engine = "InnoDB";
            $table->id('id');

            $table->unsignedBigInteger('leader_user_id')->nullable();

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');

            $table->enum('role', ['admin', 'user'])->collation('utf8mb4_unicode_ci')->nullable();

            $table->string('name', 100)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('code', 100)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('place', 100)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('manager', 100)->collation('utf8mb4_unicode_ci')->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
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
};
