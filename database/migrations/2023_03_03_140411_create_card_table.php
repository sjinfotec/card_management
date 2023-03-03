<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card', function (Blueprint $table) {

            $table->bigIncrements('id')->comment('ID');
            $table->integer('sheet')->nullable()->comment('枚数');
            $table->string('company', 100)->nullable()->comment('会社');
            $table->char('company_code', 8)->nullable()->comment('会社CODE');
            $table->string('office', 50)->nullable()->comment('営業所');
            $table->char('office_code', 8)->nullable()->comment('営業所CODE');
            $table->string('department', 50)->nullable()->comment('部署');
            $table->string('division', 50)->nullable()->comment('課');
            $table->string('director', 50)->nullable()->comment('役職');
            $table->string('name', 100)->nullable()->comment('氏名');
            $table->string('reading', 100)->nullable()->comment('読み');
            $table->string('mobile_phone', 13)->nullable()->comment('携帯電話');
            $table->string('email', 128)->nullable()->comment('メールアドレス');
            $table->string('certification1', 100)->nullable()->comment('資格1');
            $table->string('certification2', 100)->nullable()->comment('資格2');
            $table->string('certification3', 100)->nullable()->comment('資格3');
            $table->string('post_code', 7)->nullable()->comment('郵便番号');
            $table->string('address', 256)->nullable()->comment('住所');
            $table->string('direct_dial', 13)->nullable()->comment('TEL（直通）');
            $table->string('tel', 13)->nullable()->comment('TEL');
            $table->string('fax', 13)->nullable()->comment('FAX');
            $table->string('roma', 100)->nullable()->comment('ローマ字');
            $table->string('kana', 50)->nullable()->comment('ふりがな');
            $table->string('remarks', 256)->nullable()->comment('備考');
            $table->string('imagefile', 191)->nullable()->comment('画像ファイル');
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
        Schema::dropIfExists('card');
    }
}
