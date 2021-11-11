<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class addColumnToUnwAnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('fmt_unjumble_words_ans')) {
            Schema::table('fmt_unjumble_words_ans', function (Blueprint $table) {
                $table->index('question_id');
                $table->index('active');
                $table->index('arrange');
                $table->index('media_id');
            });
        }
        if (Schema::hasTable('fmt_unjumble_words_ques')) {
            Schema::table('fmt_unjumble_words_ques', function (Blueprint $table) {
                $table->index('active');
                $table->index('media_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('fmt_unjumble_words_ques');
    }
}
