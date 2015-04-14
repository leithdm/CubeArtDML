<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateArtsTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {

    Schema::create('artists', function (Blueprint $table)
    {
      $table->increments('id');

      $table->string('title', 10)->default('Mr.');
      $table->string('first_name', 100);
      $table->string('middle_name', 100);
      $table->string('second_name', 100);
      $table->string('address1', 255);
      $table->string('address2', 255);
      $table->string('address3', 255);
      $table->string('city', 255);
      $table->string('country', 255);
      $table->text('about', 1000);
      $table->string('quote', 255);
      $table->string('email', 255);
      $table->string('phone1', 255);
      $table->string('phone2', 255);
      $table->string('facebook', 255)->nullable();
      $table->string('twitter', 255)->nullable();
      $table->string('pinterest', 255)->nullable();
      $table->string('google', 255)->nullable();
      $table->string('picture', 255)->nullable();

      $table->timestamps();
    });

    Schema::create('arts', function (Blueprint $table)
    {
      $table->increments('id');

      $table->integer('artist_id')->unsigned();
      $table->string('category', 255);
      $table->integer('year');
      $table->string('title', 255);
      $table->string('subject', 255);
      $table->string('medium', 255);
      $table->integer('price');
      $table->decimal('height');
      $table->decimal('width');
      $table->decimal('depth');
      $table->text('details', 1000);
      $table->string('picture', 255)->nullable();
      $table->integer('views')->nullable();
      $table->string('status', 255);
      $table->foreign('artist_id')->references('id')->on('artists')->onDelete('cascade')->onUpdate('cascade');
      $table->timestamps();
    });

    Schema::create('customers', function (Blueprint $table)
    {
      $table->increments('id');

      $table->string('title', 10);
      $table->string('first_name', 100);
      $table->string('middle_name', 100);
      $table->string('second_name', 100);
      $table->string('address1', 255);
      $table->string('address2', 255);
      $table->string('address3', 255);
      $table->string('city', 255);
      $table->string('country', 255);
      $table->string('phone1', 255);
      $table->string('phone2', 255);
      $table->string('email', 255);

      $table->timestamps();
    });

    Schema::create('orders', function (Blueprint $table)
    {
      $table->increments('id');
      $table->integer('customer_id')->unsigned();
      $table->integer('sellingPrice')->unsigned()->nullable();
      $table->integer('arts_id')->unsigned()->nullable();
      $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
      $table->foreign('arts_id')->references('id')->on('arts')->onDelete('cascade')->onUpdate('cascade');
      $table->timestamps();
    });


    Schema::create('users', function (Blueprint $table)
    {
      $table->increments('id');

      $table->string('username', 100);
      $table->string('email', 60)->unique();
      $table->string('password', 100);
      $table->rememberToken();

      $table->timestamps();
    });

    Schema::create('employees', function (Blueprint $table)
    {
      $table->increments('id');

      $table->string('title', 10);
      $table->string('first_name', 100);
      $table->string('middle_name', 100);
      $table->string('second_name', 100);
      $table->string('address1', 255);
      $table->string('address2', 255);
      $table->string('address3', 255);
      $table->string('city', 255);
      $table->string('country', 255);
      $table->string('email', 255);
      $table->string('phone1', 255);
      $table->string('phone2', 255);
      $table->string('picture', 255)->nullable();

      $table->timestamps();
    });

    Schema::create('exhibitions', function (Blueprint $table)
    {
      $table->increments('id');

      $table->string('title', 100);
      $table->dateTime('date_event');
      $table->string('about', 255);
      $table->string('picture', 255)->nullable();

      $table->timestamps();
    });

    //new galleries schema
    Schema::create('galleries', function (Blueprint $table)
    {
      $table->increments('id');
      $table->integer('arts_id');
      $table->timestamps();
    });

    Schema::create('carousels', function (Blueprint $table)
    {
      $table->increments('id');
      $table->integer('arts_id');
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
    Schema::drop('galleries');
    Schema::drop('carousels');
    Schema::drop('orders');
    Schema::drop('customers');
    Schema::drop('exhibitions');
    Schema::drop('employees');
    Schema::drop('users');
    Schema::drop('arts');
    Schema::drop('artists');
  }
}
