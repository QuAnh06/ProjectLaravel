<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payments', function (Blueprint $table) {
            $table->foreignId('app_id')->nullable()->after('id')->constrained('app_models')->onDelete('cascade');
        });

        $apps = DB::table('app_models')->get();
        foreach ($apps as $app) {
            DB::table('payments')
                ->where('name', $app->name)
                ->update(['app_id' => $app->id]);
        }

        Schema::table('payments', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->unsignedBigInteger('app_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::table('payments', function ($table) {
        $table->string('name')->after('id')->nullable();
    });

    $payments = DB::table('payments')
        ->join('app_models', 'payments.app_id', '=', 'app_models.id')
        ->select('payments.id', 'app_models.name as app_name')
        ->get();

    foreach ($payments as $payment) {
        DB::table('payments')
            ->where('id', $payment->id)
            ->update(['name' => $payment->app_name]);
    }

    Schema::table('payments', function ($table) {
        $table->dropForeign(['app_id']);
        $table->dropColumn('app_id');
        
        $table->string('name')->nullable(false)->change();
        
    });
    }
};
