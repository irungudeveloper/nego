<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) 
        {
            $table->id();
            $table->integer('merchant_id');
            $table->integer('customer_id');
            $table->integer('product_id');
            $table->integer('dicsount_amount');
            $table->integer('negotiation_status');
            // $table->string('type');
            // $table->morphs('notifiable');
            // $table->text('data');
            // $table->timestamp('read_at')->nullable();
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
        Schema::dropIfExists('notifications');
    }
}
