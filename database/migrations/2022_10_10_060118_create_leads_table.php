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
        Schema::create('leads', function (Blueprint $table)
        {
            $table->engine = "InnoDB";
            $table->id('id');

            $table->unsignedBigInteger('qr_id')->nullable();
            $table->foreign('qr_id')->references('id')->on('qrs')->onDelete('cascade');

            $table->unsignedBigInteger('place_id')->nullable();
            $table->foreign('place_id')->references('id')->on('places')->onDelete('cascade');

            $table->unsignedBigInteger('prospect_id')->nullable();

            $table->enum('business_line', ['PF', 'SG', 'BF'])->collation('utf8mb4_unicode_ci')->nullable();

            $table->string('name', 50)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('email', 30)->collation('utf8mb4_unicode_ci')->nullable();
            $table->string('phone', 30)->collation('utf8mb4_unicode_ci')->nullable();

            $table->time('time_capture', $precision = 0);

            //status

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
        Schema::dropIfExists('leads');
    }
};
