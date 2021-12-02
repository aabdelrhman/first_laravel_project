<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoices_id');
            $table->string('invoice_number' , 50);
            $table->foreign('invoices_id')->references('id')->on('invoices')->onDelete('cascade');
            $table->string('product' , 50);
            $table->string('section' , 999);
            $table->string('status' , 50);
            $table->integer('value_status');
            $table->integer('remaining_amout')->default('0');
            $table->integer('amount_paid')->default('0');
            $table->text('note')->nullable();
            $table->date('Payment_Date')->nullable();
            $table->string('user' , 300);
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
        Schema::dropIfExists('invoices_details');
    }
}
