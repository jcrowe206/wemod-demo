<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('urls', function(Blueprint $table) {
            $table->id();
            $table->string('fingerprint')->index()->unique();
            $table->string('scheme');
            $table->string('host');
            $table->string('path');
            $table->string('query')->nullable();
            $table->timestamps();
        });

        Schema::create('url_short_codes', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('url_id');
            $scColumn = $table->string('short_code')->unique();
            $table->timestamps();

            $scColumn->charset = 'utf8';
            $scColumn->collation = 'utf8_bin';
            $table->foreign('url_id', 'url_short_codes_url_id_fk')->references('id')->on('urls');

        });

        Schema::create('url_short_code_analytics', function(Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('url_short_code_id');
            $table->bigInteger('num_visits')->default(0);

            $table->foreign('url_short_code_id', 'short_code_analytics_url_short_code_id_fk')->references('id')->on('url_short_codes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('url_short_code_analytics');
        Schema::dropIfExists('url_short_codes');
        Schema::dropIfExists('urls');
    }
};
