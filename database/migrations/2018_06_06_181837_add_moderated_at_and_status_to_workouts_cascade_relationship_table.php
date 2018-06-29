<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddModeratedAtAndStatusToWorkoutsCascadeRelationshipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('workouts', function (Blueprint $table) {
            $table->smallInteger('status')->default(0);
            $table->dateTime('moderated_at')->nullable();
            $table->dropForeign('workouts_w_o_d_id_foreign');
            $table->dropForeign('workouts_user_id_foreign');
            $table->foreign('w_o_d_id')->references('id')->on('w_o_d_s')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('workouts', function (Blueprint $table) {
            $table->dropColumn('status');
            $table->dropColumn('moderated_at');
        });
    }
}
