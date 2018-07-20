<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCustomFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('group_id')->unsigned()->after('password');
            $table->string('surname')->after('group_id');
            $table->string('lastname')->after('surname');
            $table->string('fin')->nullable()->after('lastname');
            $table->string('photo')->after('fin');
            $table->string('phone')->after('photo');
            $table->string('car_lic_number')->after('phone');
            $table->string('car_model')->after('car_lic_number');
            $table->string('car_vin')->after('car_model');
            $table->timestamp('date_of_birth')->after('car_vin');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('group_id');
            $table->dropColumn('surname');
            $table->dropColumn('lastname');
            $table->dropColumn('fin');
            $table->dropColumn('photo');
            $table->dropColumn('phone');
            $table->dropColumn('car_lic_number');
            $table->dropColumn('car_model');
            $table->dropColumn('car_vin');
            $table->dropColumn('date_of_birth');
        });
    }
}
