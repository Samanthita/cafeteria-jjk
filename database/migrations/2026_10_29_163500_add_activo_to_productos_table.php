<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasColumn('productos', 'activo')) {
            Schema::table('productos', function (Blueprint $table) {
                $table->tinyInteger('activo')->default(1)->after('imagen');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('productos', 'activo')) {
            Schema::table('productos', function (Blueprint $table) {
                $table->dropColumn('activo');
            });
        }
    }
};
