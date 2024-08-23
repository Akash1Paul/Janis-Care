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
        Schema::create('customers_details', function (Blueprint $table) {
            $table->id();
            $table->string('buisness_name');
            $table->string('company_name');
            $table->string('relationship_manager');
            $table->string('email');
            $table->string('spoc_name');
            $table->string('spoc_number');
            $table->string('credit_amount');
            $table->text('state');
            $table->string('city');
            $table->string('credit_period');
            $table->string('outlet_name');
            $table->string('outlet_spoc');
            $table->string('outlet_spoc_number');
            $table->string('phone');
            $table->string('gst');
            $table->string('product_id')->nullable();
            $table->string('discount_price')->nullable();
            $table->string('order_quantity')->nullable();
            $table->string('document');
            $table->string('fda_license_number');
            $table->string('pincode');
            $table->string('billing_address');
            $table->string('delivery_address');
            $table->string('outlet_email');
            $table->string('note');
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
        Schema::dropIfExists('customers_details');
    }
};
