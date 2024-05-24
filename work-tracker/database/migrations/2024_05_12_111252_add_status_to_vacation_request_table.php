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
    Schema::table('vacation_request', function (Blueprint $table) {
        $table->enum('status', ['waiting', 'rejected', 'accepted'])->default('waiting');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vacation_request', function (Blueprint $table) {
            //
        });
    }
};
