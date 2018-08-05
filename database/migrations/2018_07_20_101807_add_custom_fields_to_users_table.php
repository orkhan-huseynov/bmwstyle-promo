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
            $table->integer('group_id')->unsigned()->default(10)->after('password');
            $table->string('surname')->nullable()->after('group_id');
            $table->string('lastname')->nullable()->after('surname');
            $table->string('fin')->nullable()->after('lastname');
            $table->string('photo')->nullable()->after('fin');
            $table->string('phone')->nullable()->after('photo');
            $table->string('car_lic_number')->nullable()->after('phone');
            $table->string('car_model')->nullable()->after('car_lic_number');
            $table->string('car_vin')->nullable()->after('car_model');
            $table->timestamp('date_of_birth')->nullable()->after('car_vin');
            $table->string('card_number')->nullable()->after('date_of_birth');
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
            $table->dropColumn('card_number');
        });
    }
}
