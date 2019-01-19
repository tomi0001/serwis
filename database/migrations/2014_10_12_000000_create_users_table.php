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
        Schema::create('patients', function (Blueprint $table) {
            $table->engine = 'InnoDB';
//            $table->charset('utf8mb4');
            //$table->collate('utf8mb4_unicode_ci'); 

            $table->increments('id');
            $table->rememberToken();
            $table->timestamps();
            $table->string("name");
            $table->string("lastname");
            $table->date("date_born");
            $table->char("pesel",11);
            $table->string("adress");
            $table->unsignedTinyInteger("sex");
            $table->string("telefon_nr")->nullable();
            $table->text("diseases")->nullable();; 
        });
        Schema::create("users",function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string("login");
            $table->string("password");
            $table->integer("role");
            $table->string("remember_token");
            $table->timestamps();
            
        });
        Schema::create('doctors', function (Blueprint $table) {
            $table->engine = 'InnoDB';
//            $table->charset('utf8mb4');
            //$table->collate('utf8mb4_unicode_ci'); 

            $table->increments('id');

            $table->rememberToken();
            $table->timestamps();
            $table->string("name");
            $table->string("lastname");
            $table->string("specializations");
            $table->unsignedTinyInteger("sex");
            $table->string("telefon_nr");
            $table->time("hour_open");
            $table->time("hour_close");
            $table->integer("id_users")->unsigned();
            $table->foreign("id_users")->references("id")->on("users");
        });
        Schema::create('nurses', function (Blueprint $table) {
            $table->engine = 'InnoDB';
//            $table->charset('utf8mb4');
            //$table->collate('utf8mb4_unicode_ci'); 

            $table->increments('id');

            $table->rememberToken();
            $table->timestamps();
            $table->string("name");
            $table->string("lastname");
            $table->unsignedTinyInteger("sex");
            $table->string("telefon_nr");

            $table->integer("id_users")->unsigned();
            $table->foreign("id_users")->references("id")->on("users");
        });
        Schema::create('patients_registers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
  //          $table->charset('utf8mb4');
            //$table->collate('utf8mb4_unicode_ci'); 

            $table->increments('id');
            $table->Integer('patients_id')->unsigned();
            $table->foreign("patients_id")->references("id")->on("patients");
            $table->Integer('doctors_id')->unsigned();
            $table->foreign("doctors_id")->references("id")->on("doctors");
            //$table->timestamps();
            $table->datetime("date");
            $table->datetime("date_close");
            $table->unsignedTinyInteger("if_visit");
            $table->timestamps();
            
        });
        Schema::create('drugs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
  //          $table->charset('utf8mb4');
            //$table->collate('utf8mb4_unicode_ci'); 

            $table->increments('id');
            $table->string("name");
            $table->float("field1");
            $table->float("field2");
            $table->float("field3");
            $table->float("field4");
            $table->float("field5");
            $table->integer("field6");
            $table->Integer('patients_id')->unsigned();
            $table->foreign("patients_id")->references("id")->on("patients");
            $table->Integer('id_visit')->unsigned();
            $table->foreign("id_visit")->references("id")->on("patients_registers");
            $table->timestamps();
            
        });
        Schema::create('visits', function (Blueprint $table) {
            $table->engine = 'InnoDB';
  //          $table->charset('utf8mb4');
            //$table->collate('utf8mb4_unicode_ci'); 

            $table->increments('id');
            $table->Integer('patients_id')->unsigned();
            $table->foreign("patients_id")->references("id")->on("patients");
            $table->text('visit_text');
            $table->Integer('doctors_id')->unsigned();
            $table->foreign("doctors_id")->references("id")->on("doctors");
            //$table->timestamps();
            $table->datetime("date");
            $table->text("drugs");
            $table->Integer('visit_id')->unsigned();
            $table->foreign("visit_id")->references("id")->on("patients_registers");
            $table->timestamps();
            
        });
        Schema::create('admins', function (Blueprint $table) {
            $table->engine = 'InnoDB';
  //          $table->charset('utf8mb4');
            //$table->collate('utf8mb4_unicode_ci'); 

            $table->increments('id');
            $table->string('login');
            
            //$table->timestamps();
            $table->string("password");
            $table->integer("how_visit");
            $table->integer("id_users")->unsigned();
            $table->foreign("id_users")->references("id")->on("users");
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
        Schema::dropIfExists('patients');
        Schema::dropIfExists('doctors');
        Schema::dropIfExists('nurses');
        Schema::dropIfExists('patients_registers');
        Schema::dropIfExists('drugs');
        Schema::dropIfExists('visits');
        Schema::dropIfExists('admins');
        Schema::dropIfExists('users');

        
    }
}
