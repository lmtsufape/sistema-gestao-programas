<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


class ModifyDocumentosEstagiosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        if (!Schema::hasColumn('documentos_estagios', 'pdf')) {
            // Verifique se o driver de conexão é MySQL ou PostgreSQL
            if (config('database.default') === 'mysql') {
                DB::statement("SET GLOBAL max_allowed_packet=32777216;");
                DB::statement("ALTER TABLE documentos_estagios ADD pdf MEDIUMBLOB");
            } elseif (config('database.default') === 'pgsql') {
                DB::statement("ALTER TABLE documentos_estagios ADD pdf BYTEA");
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
