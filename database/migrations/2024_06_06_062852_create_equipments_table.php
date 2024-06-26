<?php

use App\Models\Brand;
use App\Models\Category;
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
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('price_per_day')->nullable();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('stock')->nullable();
            $table->integer('on_rent')->nullable()->ondelete();
            $table->foreignIdFor(Category::class)->nullable()->constrained()
                ->onDelete('restrict');
            $table->foreignIdFor(Brand::class)->nullable()->constrained()
                ->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
