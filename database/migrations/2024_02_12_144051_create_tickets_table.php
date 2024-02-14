<?php

use App\Models\User;
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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('state');
            $table->string('tenant')->nullable();
            $table->string('address');
            $table->text('description')->nullable();
            $table->string('label')->nullable();
            $table->foreignIdFor(User::class, 'initiator_id')->constrained('users');
            $table->string('assignee')->nullable();
            $table->foreignIdFor(User::class, 'assignee_id')->nullable()->constrained('users');
            $table->string('payer')->nullable();
            $table->json('budget')->nullable();
            $table->timestamp('payed_at')->nullable();
            $table->timestamp('deadline')->nullable();
            $table->timestamp('end_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
