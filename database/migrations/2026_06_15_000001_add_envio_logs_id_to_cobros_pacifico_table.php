<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('cobros_pacifico', function (Blueprint $table) {
            $table->foreignId('envio_logs_id')
                ->nullable()
                ->constrained('envio_logs')
                ->nullOnDelete()
                ->after('referencia');
            $table->index('envio_logs_id');
        });
    }

    public function down(): void
    {
        Schema::table('cobros_pacifico', function (Blueprint $table) {
            $table->dropForeign(['envio_logs_id']);
            $table->dropIndex(['envio_logs_id']);
            $table->dropColumn('envio_logs_id');
        });
    }
};
