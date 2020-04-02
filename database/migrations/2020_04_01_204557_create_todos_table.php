<?php

use App\Models\Todo;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->id(Todo::COLUMN_ID);
            $table->unsignedBigInteger(Todo::COLUMN_USER_ID);
            $table->string(Todo::COLUMN_NAME);
            $table->text(Todo::COLUMN_DESCRIPTION);
            $table->date(Todo::COLUMN_DATE);
            $table->enum(Todo::COLUMN_STATUS, Todo::STATUS_LIST)->default(Todo::STATUS_NEW);
            $table->timestamps();

            $table->foreign(Todo::COLUMN_USER_ID)
                ->references(User::COLUMN_ID)
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('todos');
    }
}
