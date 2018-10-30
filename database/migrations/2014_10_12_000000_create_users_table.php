<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
//            $table->charset('utf8mb4');
            //$table->collate('utf8mb4_unicode_ci'); 

            $table->increments('id');
            $table->string('login');
            $table->string('email');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
            $table->string("name");
            $table->string("lastname");
            $table->date("date_born");
            $table->datetime("date_register");
            $table->string("city");
            $table->unsignedTinyInteger("sex");
            $table->string("telefon_nr");
            $table->string("education");
            $table->string("image");
            $table->string("voivodeship");
            $table->text("addiction");
            $table->text("hobby");
            $table->text("interested");
        });
        Schema::create('message', function (Blueprint $table) {
            $table->engine = 'InnoDB';
  //          $table->charset('utf8mb4');
            //$table->collate('utf8mb4_unicode_ci'); 

            $table->increments('id');
            $table->text('message_text');
            $table->Integer('users_id')->unsigned();
            $table->foreign("users_id")->references("id")->on("users");
            //$table->timestamps();
            $table->string("title");
            $table->datetime("date");
            $table->timestamps();
            
        });
        Schema::create('message_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
    //        $table->charset('utf8mb4');
            //$table->collate('utf8mb4_unicode_ci'); 

            $table->increments('id');
            $table->text('message_text');
            $table->Integer('message_id')->unsigned();
            $table->foreign("message_id")->references("id")->on("message");
            //$table->timestamps();
            $table->datetime("date");
            $table->timestamps();
           
        });
        Schema::create('statistic', function (Blueprint $table) {
            $table->engine = 'InnoDB';
      //      $table->charset('utf8mb4');
            //$table->collate('utf8mb4_unicode_ci'); 

            $table->increments('id');
            $table->string('how_page');
            $table->string('ip');
            $table->string('http_user_agent');
            $table->Integer('users_id')->unsigned();
            $table->foreign("users_id")->references("id")->on("users");
            $table->timestamps();
          
            //$table->timestamps();
            $table->datetime("date");
        });
        Schema::create('forwarding_boyfriend', function (Blueprint $table) {
            $table->engine = 'InnoDB';
        //    $table->charset('utf8mb4');
          //  $table->collate('utf8mb4_unicode_ci'); 

            $table->increments('id');
            $table->Integer('user_id_host');
            $table->Integer('user_id_client');
            $table->unsignedTinyInteger('type');
            $table->timestamps();
            $table->datetime("date");
            $table->integer("users_id_host")->unsigned();
            $table->foreign("users_id_host")->references("id")->on("users");
            $table->integer("users_id_client")->unsigned();
            $table->foreign("users_id_client")->references("id")->on("users");

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('message');
        Schema::dropIfExists('message_users');
        Schema::dropIfExists('statistic');
        Schema::dropIfExists('forwarding_boyfriend');
        
    }
}
