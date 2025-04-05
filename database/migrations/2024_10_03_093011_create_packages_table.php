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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('type')->default('default');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('subcategory_id')->nullable();
            $table->unsignedBigInteger('air_ticket_id')->nullable();
            $table->unsignedBigInteger('departure_id')->nullable();
            $table->unsignedBigInteger('route_id')->nullable();
            $table->unsignedBigInteger('inclusion_id')->nullable();
            $table->decimal('amount', 10, 2)->nullable();
            $table->integer('no_of_days')->nullable();
            $table->string('pdf_document')->nullable();
            $table->string('main_image')->nullable();
            $table->json('additional_images')->nullable();
            $table->unsignedBigInteger('guide_id')->nullable();
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('category')->onDelete('cascade');
            $table->foreign('subcategory_id')->references('id')->on('category')->onDelete('set null');
            $table->foreign('air_ticket_id')->references('id')->on('air_tickets')->onDelete('set null');
            $table->foreign('departure_id')->references('id')->on('dipartures')->onDelete('set null');
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('set null');
            $table->foreign('inclusion_id')->references('id')->on('inclusions')->onDelete('set null');
            $table->foreign('guide_id')->references('id')->on('users')->onDelete('set null')->where('type', '=', 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');

        Schema::table('packages', function (Blueprint $table) {
            // Dropping foreign key constraints
            $table->dropForeign(['category_id']);
            $table->dropForeign(['subcategory_id']);
            $table->dropForeign(['air_ticket_id']);
            $table->dropForeign(['departure_id']);
            $table->dropForeign(['route_id']);
            $table->dropForeign(['inclusion_id']);
            $table->dropForeign(['guide_id']);

            // Dropping the columns
            $table->dropColumn([
                'type',
                'category_id',
                'subcategory_id',
                'air_ticket_id',
                'departure_id',
                'route_id',
                'inclusion_id',
                'amount',
                'no_of_days',
                'pdf_document',
                'main_image',
                'additional_images',
                'guide_id',
            ]);
        });
    }
};
