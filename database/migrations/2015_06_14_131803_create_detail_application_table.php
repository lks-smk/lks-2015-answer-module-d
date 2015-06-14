<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailApplicationTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        //Drop if detail_application table exists
        Schema::dropIfExists('detail_application');

        //Detail_application table schema
        Schema::create(
            'detail_application', function (Blueprint $table) {

            $table->bigIncrements('detail_id');
            $table->char('request_id', 8);
            $table->date('payment_date');
            $table->decimal('payment_amount', 10, 2);
            $table->decimal('principal_debt', 10, 2);
            $table->decimal('interest', 10, 2);
            $table->decimal('balance', 10, 2);
        }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {

        //Drop detail_application table
        Schema::drop('detail_application');
    }

}
