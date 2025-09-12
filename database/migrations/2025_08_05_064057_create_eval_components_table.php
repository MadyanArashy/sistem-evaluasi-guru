<?php

use App\Models\Criteria;
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
        Schema::create('eval_components', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignIdFor(Criteria::class, 'criteria_id')
                  ->constrained('criterias')
                  ->onDelete('cascade');
            $table->string('name');
            $table->smallInteger('weight');
            $table->string('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('eval_components');
    }
};
