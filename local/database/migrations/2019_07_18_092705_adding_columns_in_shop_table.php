<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddingColumnsInShopTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shop', function (Blueprint $table) {
            $table->string('cnic');
            $table->string('gender');
            $table->string('contact_no');
            $table->string('associated_with_contractor');
            $table->string('name_of_firm');
            $table->date('date_of_registration');
            $table->string('name_of_owner_or_contractor');
           
            $table->integer('number_of_rhinos_in_team');
            $table->integer('shop_type_id');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shop', function (Blueprint $table) {
            $table->dropColumn('cnic');
            $table->dropColumn('gender');
            $table->dropColumn('contact_no');
            $table->dropColumn('associated_with_contractor');
            $table->dropColumn('name_of_firm');
            $table->dropColumn('date_of_registration');
            $table->dropColumn('name_of_owner_or_contractor');
           
            $table->dropColumn('number_of_rhinos_in_team');
            $table->dropColumn('shop_type_id');
            
        });
    }
}