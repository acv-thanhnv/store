<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ImportSysInitDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $databaseInitScript = File::get(database_path("dbscript\\for_migration_init_database.sql"));
        \Illuminate\Support\Facades\DB::unprepared("SET GLOBAL log_bin_trust_function_creators = 1;");
        \Illuminate\Support\Facades\DB::unprepared($databaseInitScript);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //no thing
    }
}
