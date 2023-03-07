<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company', function (Blueprint $table) {

            $table->bigIncrements('id')->comment('ID');
            $table->string('company', 100)->nullable()->comment('会社');
            $table->char('company_code', 8)->nullable()->comment('会社CODE');
            $table->string('office', 50)->nullable()->comment('営業所');
            $table->char('office_code', 8)->nullable()->comment('営業所CODE');
            $table->char('post_code', 8)->nullable()->comment('郵便番号');
            $table->string('address', 256)->nullable()->comment('住所');
            $table->string('direct_dial', 15)->nullable()->comment('TEL（直通）');
            $table->string('tel', 15)->nullable()->comment('TEL');
            $table->string('fax', 15)->nullable()->comment('FAX');
            $table->string('remarks', 256)->nullable()->comment('備考');
            $table->char('design', 4)->nullable()->comment('デザイン');
            $table->string('status', 10)->nullable()->comment('ステータス');
            $table->string('created_user', 10)->nullable()->comment('作成ユーザー');
            $table->string('updated_user', 10)->nullable()->comment('修正ユーザー');
            $table->timestamps();
            $table->boolean('is_deleted')->nullable()->comment('削除フラグ')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('company');
    }
}
