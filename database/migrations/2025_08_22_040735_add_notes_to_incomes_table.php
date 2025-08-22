<?php
// filepath: database/migrations/2025_08_22_XXXXXX_add_notes_to_incomes_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->text('notes')->nullable()->after('category'); // Agrega la columna después de 'category'
        });
    }

    public function down()
    {
        Schema::table('incomes', function (Blueprint $table) {
            $table->dropColumn('notes');
        });
    }
};