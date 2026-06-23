<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement("ALTER TABLE cobros_pacifico MODIFY COLUMN envio_logs_id BIGINT UNSIGNED NULL COMMENT 'FK a envio_logs'");
    }

    public function down(): void
    {
        DB::statement("ALTER TABLE cobros_pacifico MODIFY COLUMN envio_logs_id BIGINT UNSIGNED NULL COMMENT ''");
    }
};
