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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->text('slug');
            $table->text('description')->nullable();
            $table->text('logo')->nullable();
            $table->text('banner')->nullable();
            $table->text('url')->nullable();

            $table->unsignedBigInteger('company_type_id');
            $table->foreign('company_type_id')->references('id')->on('company_types');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
