<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSMSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('s_m_s', function (Blueprint $table) {
            $table->id();
            $table->string('message_id')->nullable();
            $table->string('number')->nullable();
            $table->string('status')->nullable();
            $table->string('status_code')->nullable();
            $table->string('cost')->nullable();
            // Delivery
            $table->string('delivery_status')->nullable();
            $table->string('network_code')->nullable();
            $table->string('failure_reason')->nullable();
            $table->string('retry_count')->nullable();
            // Opt out
            $table->string('opt_out')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('s_m_s');
    }
}
