<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_setups', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('school_code', 20);
            $table->string('school_name', 255);
            $table->string('school_email', 255);
            $table->string('school_address', 255);
            $table->string('school_motto', 255);
            $table->string('school_mobile_no', 100);
            $table->bigInteger('created_by')->default(1);
            $table->bigInteger('updated_by')->default(1);
            $table->timestamps();
        });
        DB::table('school_setups')->insert([
            [
            'school_code' => 'Miedusoft Solutions Academy',
            'school_name' => 'MSA',
            'eMail' => 'miedusoftsolutions@miedusoft.ng',
            'phone' => '08140326189, 08059775734',
            'address' => 'Zaki-Biam, Ukum LGA, Benue State',
            'motto' => '.....educational management simplified'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('school_setups');
    }
};
