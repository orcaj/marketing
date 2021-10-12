<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldDigitaltable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('digitals', function (Blueprint $table) {
            $table->string('campaign_name');
            $table->string('campaign_link')->nullable();
            $table->string('campaign_status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('digitals', function (Blueprint $table) {
            $table->dropColumn('campaign_name');
            $table->dropColumn('campaign_link');
            $table->dropColumn('campaign_status');
        });
    }
}
