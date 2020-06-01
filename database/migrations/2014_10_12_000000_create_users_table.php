<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone')->nullable();
            $table->boolean('isAdmin')->default(false);
            $table->boolean('verified')->default(false);
            $table->string('email_token')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        $this->Admin();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }

    private function Admin()
    {
        $data = [
            [
                'name' => 'Damilare Anjorin',
                'email' => 'damilareanjorin@gmail.com',
                'isAdmin' => 1,
                'verified' => 1,
                'password' => bcrypt('damilare001')
            ]
        ];

        \Illuminate\Support\Facades\DB::table('users')->insert($data);
    }

}
