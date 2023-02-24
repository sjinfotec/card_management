<template>
  <div>



    <div>vue変数テスト htmlSelect：{{ htmlSelect }}</div>
    <div>vue変数テスト selectMode：{{ selectMode }}</div>

    <div id="input_area_1" v-if="selectMode=='COMPLETE'">
      <div id="top_cnt">
        <h2 class="title mgt20">結果 / {{ acttitle }} 完了</h2>
        <!--
        <button type="button" class="btn_gc1 textcolor2" onclick="window.print();">
            印刷
        </button>
        -->
      </div>
            <div id="btn_cnt2">
              <button type="button" class="" @click="backLine()">一覧へ</button>
            </div>

      <div class="print-none" v-if="actionmsgArr.length">
          <ul class="error-red color_red">
            <li v-for="(actionmsg,index) in actionmsgArr" v-bind:key="index">{{ actionmsg }}</li>
          </ul>
      </div>
      <div id="tbl_1">
        <table>
          <thead>
            <tr>
              <th class="gc2">日付</th>
              <th class="gc2">部署</th>
              <th class="gc2">担当</th>
              <th class="gc2">商品名 <button type="button" class="" @click="ForwardReverse('product_name',1)">▲</button> <button type="button" class="" @click="ForwardReverse('product_name',2)">▼</button></th>
              <th class="gc2">分類</th>
              <th class="gc2">発注先</th>
              <th class="gc2">単位</th>
              <th class="gc2">入庫数</th>
              <th class="gc2">出庫数</th>
              <th class="gc2">現在在庫</th>
              <th class="gc2">単価</th>
              <th class="gc2">合計金額</th>
              <th class="gc2">備考</th>
              <th class="gc2">&nbsp;</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item,rowIndex) in details" :key="rowIndex" v-bind:class="classObj1">
              <td class="nbr">{{ item['mdate'] }}</td>
              <td class="w4e">{{ item['department'] }}</td>
              <td class="w3e">{{ item['charge'] }}</td>
              <td v-bind:class="(item['status'] == 'newest') ? 'bgcolor5' : ''">{{ item['product_name'] }}</td>
              <td>{{ item['product_number'] }}</td>
              <td>{{ item['order_address'] }}</td>
              <td class="nbr">{{ item['unit'] }}</td>
              <!--<td class="style1">{{ item['quantity'] }}</td>-->
              <td class="style1" v-bind:class="(item['receipt'] === 0) ? 'color3' : ''">{{ item['receipt'] }}</td>
              <td class="style1" v-bind:class="(item['delivery'] === 0) ? 'color3' : ''">{{ item['delivery'] }}</td>
              <td>{{ item['remarks'] }}</td>
              <td class="nbr w2e">
                <div v-if="btnMode === 'off'"></div>
                <div v-else></div>
                <div v-if="item['status']=='newest'">
                  <button type="button" class="style1" @click="EditBtn(item['id'], item['product_code'], details[rowIndex].product_name, 'update', rowIndex)">
                  更新
                  </button>
                  <button type="button" class="style2" @click="EditBtn(item['id'], item['product_code'], details[rowIndex].product_name, 'fix', rowIndex)">
                  修正
                  </button>
                </div>
                <div v-else>
                  <button type="button" class="style2" @click="EditBtn(item['id'], item['product_code'], details[rowIndex].product_name, 'fix', rowIndex)">
                  修正
                  </button>
                </div>
              </td>
            </tr>

          </tbody>
        </table>
      </div><!-- end tbl_1 -->
    </div><!--end v-if-->







    <div id="input_area_1" v-if="selectMode=='NEW'">
      <div id="top_cnt">
        <h2>名刺 / 新規登録</h2>
        <button type="button" class="customize" @click="viewBtn(2)">
          管理者
        </button>
      </div>

      <div class="" v-if="messagevalidatesNew.length">
          <ul class="error-red color_red">
            <li v-for="(messagevalidate,index) in messagevalidatesNew" v-bind:key="index">{{ messagevalidate }}</li>
          </ul>
      </div>










      <div id="cnt1">
        <div class="inputgroup w1">
          <div class="cate gc2">枚数</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="form.sheet"
              maxlength="20"
              name="sheet"
            />
          </div>
        </div>
      </div><!--## end id="cnt1" ##-->

      <div id="cnt1">
        <div class="inputgroup w1">
          <div class="cate gc2">会社</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="form.company"
              maxlength="100"
              name="company"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">営業所</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="form.office"
              maxlength="50"
              name="office"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">部署</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="form.department"
              maxlength="50"
              name="department"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">課</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="form.division"
              maxlength="50"
              name="division"
            />
          </div>
        </div>
      </div><!--## end id="cnt1" ##-->

      <div id="cnt1">
        <div class="inputgroup w1">
          <div class="cate gc2">役職</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="form.director"
              maxlength="50"
              name="director"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">資格1</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="form.certification1"
              maxlength="50"
              name="certification1"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">資格2</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="form.certification2"
              maxlength="50"
              name="certification2"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">資格3</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="form.certification3"
              maxlength="50"
              name="certification3"
            />
          </div>
        </div>
      </div><!--## end id="cnt1" ##-->


      <div id="cnt1">
        <div class="inputgroup w1">
          <div class="cate gc2">氏名</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="form.name"
              maxlength="100"
              name="name"
            />
          </div>
        </div>
      </div><!--## end id="cnt1" ##-->


      <div id="cnt1">
        <div class="inputgroup w1">
          <div class="cate gc2">読み</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="form.reading"
              maxlength="100"
              name="reading"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">ローマ字</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="form.roma"
              maxlength="100"
              name="roma"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">ふりがな</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="form.kana"
              maxlength="50"
              name="kana"
            />
          </div>
        </div>
      </div><!--## end id="cnt1" ##-->

      <div id="cnt1">
        <div class="inputgroup w1">
          <div class="cate gc2">携帯電話</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="form.mobile_phone"
              maxlength="13"
              name="mobile_phone"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">メールアドレス</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="form.email"
              maxlength="128"
              name="email"
            />
          </div>
        </div>
      </div><!--## end id="cnt1" ##-->

      <div id="cnt1">
        <div class="inputgroup w1">
          <div class="cate gc2">郵便番号</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="form.post_code"
              maxlength="7"
              name="post_code"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">住所</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="form.address"
              maxlength="256"
              name="address"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">TEL（直通）</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="form.direct_dial"
              maxlength="13"
              name="direct_dial"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">TEL</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="form.tel"
              maxlength="13"
              name="tel"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">FAX</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="form.fax"
              maxlength="13"
              name="fax"
            />
          </div>
        </div>
      </div><!--## end id="cnt1" ##-->

      <div id="cnt1">
        <div class="inputgroup w1">
          <div class="cate gc2">画像ファイル</div>
          <div class="inputzone">
            <input
              type="file"
              class="form_style bc2"
              name="image"
            />
          </div>
        </div>
      </div><!--## end id="cnt1" ##-->

      <div id="cnt1">
        <div class="inputgroup w4">
          <div class="cate gc2">備考</div>
          <div class="inputzone">
            <textarea class="form_style_t bc2" v-model="form.remarks" maxlength="191" name="remarks" rows="3"></textarea>
          </div>
        </div>
      </div><!--## end id="cnt1" ##-->

      <div id="cnt1" v-if="view_switch=='on'">
        <div class="inputgroup w1">
          <div class="cate">作成ユーザー</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style"
              v-model="form.created_user"
              maxlength="20"
              name="created_user"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate">修正ユーザー</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style"
              v-model="form.updated_user"
              maxlength="20"
              name="updated_user"
            />
          </div>
        </div>
        <div class="inputgroup w2">
          <div class="cate">作成日時</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style"
              v-model="form.created_at"
              maxlength="16"
              name="created_at"
            />
          </div>
        </div>
        <div class="inputgroup w2">
          <div class="cate">修正日時</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style"
              v-model="form.updated_at"
              maxlength="16"
              name="updated_at"
            />
          </div>
        </div>

        <div class="inputgroup w1">
          <div class="cate">ステータス</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style"
              v-model="form.status"
              maxlength="20"
              name="status"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate">削除フラグ</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style"
              v-model="form.is_deleted"
              maxlength="20"
              name="is_deleted"
            />
          </div>
        </div>
      </div><!--## end id="cnt1" ##-->

      <div id="button1">
          <div class="btnstyle">
            <button type="button" class="style1" @click="dataStore()">新規登録する</button>
          </div>
      </div>

    </div><!--end selectMode=='NEW'-->





    <div id="input_area_1" v-if="selectMode=='EDT'">

      <div id="top_cnt">
        <h2 v-if="btnMode==='update'">名刺 / 更新</h2>
        <h2 v-if="btnMode==='fix'">名刺 / 修正</h2>
        <button type="button" class="customize" @click="viewBtn(2)">
          追加情報
        </button>
      </div>

      <div v-for="(item,index) in details" v-bind:key="item.id">

        <div class="" v-if="messagevalidatesNew.length">
            <ul class="error-red color_red">
              <li v-for="(messagevalidate,index) in messagevalidatesNew" v-bind:key="index">{{ messagevalidate }}</li>
            </ul>
        </div>

        <input type="hidden" v-model="details[index].id" name="id" />

        <div id="cnt1">
        <div class="inputgroup w1">
          <div class="cate gc2">枚数</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="details[index].sheet"
              maxlength="20"
              name="sheet"
            />
          </div>
        </div>
      </div><!--## end id="cnt1" ##-->

      <div id="cnt1">
        <div class="inputgroup w1">
          <div class="cate gc2">会社</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="details[index].company"
              maxlength="100"
              name="company"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">営業所</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="details[index].office"
              maxlength="50"
              name="office"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">部署</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="details[index].department"
              maxlength="50"
              name="department"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">課</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="details[index].division"
              maxlength="50"
              name="division"
            />
          </div>
        </div>
      </div><!--## end id="cnt1" ##-->

      <div id="cnt1">
        <div class="inputgroup w1">
          <div class="cate gc2">役職</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="details[index].director"
              maxlength="50"
              name="director"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">資格1</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="details[index].certification1"
              maxlength="50"
              name="certification1"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">資格2</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="details[index].certification2"
              maxlength="50"
              name="certification2"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">資格3</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="details[index].certification3"
              maxlength="50"
              name="certification3"
            />
          </div>
        </div>
      </div><!--## end id="cnt1" ##-->


      <div id="cnt1">
        <div class="inputgroup w1">
          <div class="cate gc2">氏名</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="details[index].name"
              maxlength="100"
              name="name"
            />
          </div>
        </div>
      </div><!--## end id="cnt1" ##-->


      <div id="cnt1">
        <div class="inputgroup w1">
          <div class="cate gc2">読み</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="details[index].reading"
              maxlength="100"
              name="reading"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">ローマ字</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="details[index].roma"
              maxlength="100"
              name="roma"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">ふりがな</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="details[index].kana"
              maxlength="50"
              name="kana"
            />
          </div>
        </div>
      </div><!--## end id="cnt1" ##-->

      <div id="cnt1">
        <div class="inputgroup w1">
          <div class="cate gc2">携帯電話</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="details[index].mobile_phone"
              maxlength="13"
              name="mobile_phone"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">メールアドレス</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="details[index].email"
              maxlength="128"
              name="email"
            />
          </div>
        </div>
      </div><!--## end id="cnt1" ##-->

      <div id="cnt1">
        <div class="inputgroup w1">
          <div class="cate gc2">郵便番号</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="details[index].post_code"
              maxlength="7"
              name="post_code"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">住所</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="details[index].address"
              maxlength="256"
              name="address"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">TEL（直通）</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="details[index].direct_dial"
              maxlength="13"
              name="direct_dial"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">TEL</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="details[index].tel"
              maxlength="13"
              name="tel"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate gc2">FAX</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style bc2"
              v-model="details[index].fax"
              maxlength="13"
              name="fax"
            />
          </div>
        </div>
      </div><!--## end id="cnt1" ##-->

      <div id="cnt1">
        <div class="inputgroup w1">
          <div class="cate gc2">画像ファイル</div>
          <div class="inputzone">
            <input
              type="file"
              class="form_style bc2"
              name="image"
            />
          </div>
        </div>
      </div><!--## end id="cnt1" ##-->

      <div id="cnt1">
        <div class="inputgroup w4">
          <div class="cate gc2">備考</div>
          <div class="inputzone">
            <textarea class="form_style_t bc2" v-model="details[index].remarks" maxlength="191" name="remarks" rows="3"></textarea>
          </div>
        </div>
      </div><!--## end id="cnt1" ##-->

      <div id="cnt1" v-if="view_switch=='on'">
        <div class="inputgroup w1">
          <div class="cate">作成ユーザー</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style"
              v-model="details[index].created_user"
              maxlength="20"
              name="created_user"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate">修正ユーザー</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style"
              v-model="details[index].updated_user"
              maxlength="20"
              name="updated_user"
            />
          </div>
        </div>
        <div class="inputgroup w2">
          <div class="cate">作成日時</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style"
              v-model="details[index].created_at"
              maxlength="16"
              name="created_at"
            />
          </div>
        </div>
        <div class="inputgroup w2">
          <div class="cate">修正日時</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style"
              v-model="details[index].updated_at"
              maxlength="16"
              name="updated_at"
            />
          </div>
        </div>

        <div class="inputgroup w1">
          <div class="cate">ステータス</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style"
              v-model="details[index].status"
              maxlength="20"
              name="status"
            />
          </div>
        </div>
        <div class="inputgroup w1">
          <div class="cate">削除フラグ</div>
          <div class="inputzone">
            <input
              type="text"
              class="form_style"
              v-model="details[index].is_deleted"
              maxlength="20"
              name="is_deleted"
            />
          </div>
        </div>
      </div><!--## end id="cnt1" ##-->






        <div id="cnt1" v-if="view_switch=='on'">
          <div id="button1">
            <button type="button" class="" @click="recordDel(index,'all')">この商品（履歴含む）を削除</button>
            <button type="button" class="" @click="recordDel(index,'one')">この登録（レコード）を削除</button>
          </div>

        </div>


        <div id="button1">
          <div>
            <div class="btnstyle" v-if="btnMode==='update'">
              <button type="button" class="style1" @click="dataUpdate(index,1)">在庫の更新</button>
            </div>
            <div class="btnstyle" v-if="btnMode==='fix'">
              <button type="button" class="style2" @click="dataUpdate(index,0)">在庫の修正</button>
            </div>
          </div>
          <div>
            <!--
            <div class="btnstyle">
              <button type="button" class="" @click="dataUpdate(index,2)"><span>{{ item['company_name'] }} </span><span>の新しい商品を登録する</span></button>
            </div>
            -->
            <div class="btnstyle">
              <button type="button" class="" @click="backLine()">一覧へ</button>
            </div>
            <div class="btnstyle">
              <button type="button" class="" @click="resultLine()">検索一覧へ</button>
            </div>
            <div class="btnstyle" v-if="btnMode==='fix'">
              <button type="button" class="" @click="dataDel(index,4)">抹消</button>
            </div>
            <div class="btnstyle" v-if="btnMode==='great'">
              <button type="button" class="" @click="recordDel(index,'one')">この登録を削除</button>
            </div>
          </div>
        </div>

 

      </div><!--end v-for-->




      <div id="cnt2" v-for="(item2,index2) in details" v-bind:key="index2">
        <div>
          <!--<h4>{{ details[index2].product_name }} {{ item2['product_name'] }} 履歴一覧</h4>-->
          <h4>{{ product_title }}<span style="margin-left:20px;">履歴一覧</span></h4>
        </div>
      </div><!--end v-for-->

      <div id="tbl_1">
        <table>
          <thead>
            <tr>

              <th class="gc2">日付これ</th>
              <th class="gc2">部署</th>
              <th class="gc2">担当</th>
              <th class="gc2">商品名</th>
              <th class="gc2">分類</th>
              <th class="gc2">発注先</th>
              <th class="gc2">単位</th>
              <th class="gc2">入庫数</th>
              <th class="gc2">出庫数</th>
              <th class="gc2">現在在庫</th>
              <th class="gc2">単価</th>
              <th class="gc2">合計金額</th>
              <!--
              <th class="gc2">箱数</th>
              -->
              <th class="gc2">備考</th>
              <!--<th class="gc2">&nbsp;</th>-->
            </tr>
          </thead>
          <tbody>
            <tr  v-for="(item,rowIndex) in details2" :key="rowIndex" v-bind:class="(item['id'] == edit_id) ? 'bgcolor3' : ''">
              <td>{{ item['mdate'] }}</td>
              <td>{{ item['department'] }}</td>
              <td>{{ item['charge'] }}</td>
              <td>{{ item['product_name'] }}</td>
              <td>{{ item['product_number'] }}</td>
              <td>{{ item['order_address'] }}</td>
              <td class="nbr">{{ item['unit'] }}</td>
              <td class="style1" v-bind:class="(item['receipt'] === 0) ? 'color3' : ''">{{ item['receipt'] }}</td>
              <td class="style1" v-bind:class="(item['delivery'] === 0) ? 'color3' : ''">{{ item['delivery'] }}</td>
              <td class="style1" v-bind:style="(item['now_inventory'] === 0) ? 'color:red' : ''">{{ Number(item.now_inventory) | numberFormat }}</td>
              <td class="style1">{{ Number(item.unit_price) | numberFormat }}</td>
              <td class="style1"><div v-if="item['total'] !== null">{{ Number(item['total']) | numberFormat }}</div></td>
              <td>{{ item['remarks'] }}</td>
              <!--<td>id={{ item['id'] }} edit_id={{ edit_id }}</td>-->
            </tr>
          </tbody>
        </table>
      </div><!-- end tbl_1 -->

    </div><!--end selectMode=='EDT'-->
























    <div v-if="selectMode=='LINEACTIVE'">
      <div id="top_cnt">
        <h2 class="title mgt20">検索結果一覧</h2>
        <!--
        <button type="button" class="btn_gc1 textcolor2" onclick="window.print();">
            印刷
        </button>
        -->
      </div>
      <div id="topform_cnt" class="print-none">
        <form id="form1" name="form3">
          <input type="text" class="form_style bc1 w10e" v-model="s_department" maxlength="30" name="s_department">
          <button type="button" class="" @click="searchBtn()">
            部署 検索
          </button>
        </form>
        <form id="form1" name="form2">
          <input type="text" class="form_style bc1 w10e" v-model="s_name" maxlength="30" name="s_name">
          <button type="button" class="" @click="searchBtn()">
            名前 検索
          </button>
        </form>
        <form id="form1" name="form1">
          <input type="text" class="form_style bc1 w10e" v-model="s_yomi" maxlength="30" name="s_yomi">
          <button type="button" class="" @click="searchBtn()">
            読み 検索
          </button>
        </form>
        <!--
        <button type="button" class="btn_gc2" @click="NewBtn()">
          新規登録
        </button>
        -->
      </div>

      <div id="tbl_1" class="mgt20">
        <table>
          <thead>
            <tr>
              <th class="">&nbsp;</th>
              <th class="">No</th>
              <!--<th class="">会社</th>-->
              <th class="">営業所</th>
              <th class="">部署 <button type="button" class="" @click="ForwardReverse('department',1)">▲</button><button type="button" class="" @click="ForwardReverse('department',2)">▼</button></th>
              <th class="">課 <button type="button" class="" @click="ForwardReverse('division',1)">▲</button><button type="button" class="" @click="ForwardReverse('division',2)">▼</button></th>
              <th class="">役職</th>
              <th class="">氏名</th>
              <th class="">ローマ字</th>
              <th class="">ふりがな</th>
              <th class="">読み <button type="button" class="" @click="ForwardReverse('yomi',1)">▲</button><button type="button" class="" @click="ForwardReverse('yomi',2)">▼</button></th>
              <th class="">携帯電話</th>
              <th class="">メールアドレス</th>
              <th class="">資格</th>
              <!--
              <th class="">〒</th>
              <th class="">住所</th>
              <th class="">TEL（直通）</th>
              <th class="">TEL</th>
              <th class="">FAX</th>
              -->
              <th class="">画像ファイル</th>
              <th class="">備考</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(item,rowIndex) in details" :key="rowIndex">
              <td class="nbr w2e">
                <button type="button" class="style2" @click="EditBtn(item['id'], item['product_code'], details[rowIndex].product_name, 'fix', rowIndex)">
                編集
                </button>
              </td>
              <td class="nbr">{{ item['id'] }}</td>
              <!--<td class="nbr">{{ item['company'] }}</td>-->
              <td class="w4e">{{ item['office'] }}</td>
              <td class="w3e">{{ item['department'] }}</td>
              <td class="">{{ item['division'] }}</td>
              <td class="">{{ item['aaa'] }}</td>
              <td class="">{{ item['name'] }}</td>
              <td class="">{{ item['roma'] }}</td>
              <td class="">{{ item['charge'] }}</td>
              <td class="">{{ item['charge'] }}</td>
              <td class="">{{ item['charge'] }}</td>
              <td class="">{{ item['charge'] }}</td>
              <td class="">{{ item['charge'] }}</td>
              <td class="">{{ item['charge'] }}</td>
              <!--
              <td class="">{{ item['charge'] }}</td>
              <td class="">{{ item['charge'] }}</td>
              <td class="">{{ item['charge'] }}</td>
              <td class="">{{ item['charge'] }}</td>
              <td class="">{{ item['charge'] }}</td>
              -->
              <td>{{ item['remarks'] }}</td>
              <!--<td class="style1"><div v-if="item['total'] !== null">{{ Number(item['total']) | numberFormat }}</div></td>-->
            </tr>
            <tr class="border1">
              <td colspan="2" class="style1">{{ this.details.length }} 件</td>
              <td colspan="19" class="style1"></td>
              <!--<td class="style1">{{ Number(totals) | numberFormat }}</td>-->
            </tr>
          </tbody>
        </table>
        <div class="" v-if="details == ''">該当するデータがありません</div>
      </div><!-- end tbl_1 -->
    </div><!--end selectMode=='LINEACTIVE'-->




  </div>
</template>

<script>
//import moment from "moment";
//import { dialogable } from "../mixins/dialogable.js";
//import { checkable } from "../mixins/checkable.js";
//import { requestable } from "../mixins/requestable.js";
export default {
  name: 'Edit',
  template: `
    <div>
    </div>
  `,
  //mixins: [dialogable, checkable, requestable],
  props: {
    /*
    authusers: {
      type: Array,
      default: []
    },
    */
    htmlSelect: String,
    selectMode: {
      type: String,
      default: 'EDT'
    }


  },
  data() {
    return {
      form: {
        id: "",
        sheet: "",
        company: "",
        office: "",
        department: "",
        division: "",
        director: "",
        name: "",
        reading: "",
        mobile_phone: "",
        email: "",
        certification1: "",
        certification2: "",
        certification3: "",
        post_code: "",
        address: "",
        direct_dial: "",
        tel: "",
        fax: "",
        roma: "",
        kana: "",
        remarks: "",
        image: "",
        status: "",
        created_user: "",
        updated_user: "",
        created_at: "",
        updated_at: "",
        is_deleted: ""
      },
      details: [],
      details2: [],
      informations: [],
      content: "",
      login_user_code: 0,
      login_user_role: 0,
      dialogVisible: false,
      messageshowsearch: false,
      messagevalidatesNew: [],
      infomationmessage: [],
      message: "aaa",
      showMessage: true,
      btnMode: "",
      view_switch: "off",
      s_department: "",
      s_name: "",
      s_yomi: "",
      totals: "",

    };
  },
  // マウント時
  mounted() {
    //this.login_user_code = this.authusers["code"];
    //this.login_user_role = this.authusers["role"];
    this.Test();
  },
  filters: {
    numberFormat: function(num){
      return num.toLocaleString();
    }
  },
  methods: {
    searchBtn() {
      this.details = [];
      this.searchItem();
      this.selectMode = 'COMPLETE';
    },
    searchBtn2() {
      this.details = [];
      this.searchItem2();
      this.selectMode = 'COMPLETE';
    },
    viewBtn(go) {
    var amari = this.i % go;
    //console.log("viewBtn amari = " + amari);
    if(amari == 0){
      //console.log("viewBtn amari 0");
      this.view_switch = 'on';
    } else {
      this.view_switch = 'off';
    }
    this.i = this.i + 1;
    //console.log("viewBtn i = " + this.i);

    },
    backLine() {
      this.selectMode = "LINEACTIVE";
      const sc = this.selectCnt;
      this.getItem(sc);

    },
    resultLine() {
      this.details = [];
      this.searchItem();
      this.selectMode = "COMPLETE";
    },
    ForwardReverse(arraykey,q1) {
      //console.log("ForwardReverse in  = " + q1);
      //console.log("ForwardReverse in  = " + arraykey);
      var sort_target = arraykey; //ソート対象を変数で設定
      //if(q1 == 1) this.details.sort((a, b) => a[sort_target] - b[sort_target]);
      //if(q1 == 2) this.details.sort((a, b) => b[sort_target] - a[sort_target]);
      //this.details = this.details.sort((x, y) => x[sort_target].localeCompare(y[sort_target], 'ja'));
      //this.details = this.details.sort((x, y) => x[sort_target].lastIndexOf(y[sort_target], 'ja'));
      //console.log("ForwardReverse in details = " + this.details);

      if(q1 == 1) {
        this.details = this.details.sort(function(x, y) {
          if (x[sort_target] === y[sort_target]) {
            return 0;
          }
          else if (x[sort_target] === null) {
            return 1;
          }
          else if (y[sort_target] === null) {
            return -1;
          }
          else {
            return x[sort_target].localeCompare(y[sort_target], 'ja');
          }
        });
      }
      if(q1 == 2) {
        this.details = this.details.sort(function(x, y) {
          if (x[sort_target] === y[sort_target]) {
            return 0;
          }
          else if (x[sort_target] === null) {
            return 1;
          }
          else if (y[sort_target] === null) {
            return -1;
          }
          else {
            return y[sort_target].localeCompare(x[sort_target], 'ja');
          }
        });
      }
      //console.log(this.details);
    },

    // ------------------------ サーバー処理 ----------------------------
    Test(){
      console.log('テストコンソール出力')
    },
    // 取得処理
    getItem(sc) {
      this.inputClear();
      var arrayParams = { 
        charge : this.charge,
        product_name : this.product_name,
        mdate : this.mdate,
        orderfr : this.orderfr,
        marks : sc,
        is_deleted : 0
      };
      //console.log("getitem in arrayParams['mdate'] = " + arrayParams['mdate']);
      this.postRequest("/material_management/get", arrayParams)
        .then(response  => {
          //console.log(response);
          this.getThen(response);
        })
        .catch(reason => {
          //console.log("getitem reason");
          this.serverCatch("取得");
        });
    },
    // 取得処理(単)
    getItemOne(e,p,pn,md) {
      this.inputClear();
      //console.log("getitem one in edit_id = " + e);
      //console.log("getitem one in product_code = " + p);
      //console.log("getitem one in p_name = " + pn);
      this.edit_id = e;
      this.product_code = p;
      this.product_title = pn;
      //this.smode = md;
      //console.log("getitem one in product_title = " + this.product_title);
      var arrayParams = {  edit_id : e , product_code : p};
      this.postRequest("/material_management/getone", arrayParams)
        .then(response  => {
          this.getThen(response, md);
          if(md === 'update') {
            this.details[0].mdate = this.itsdate;
            this.details[0].receipt = "";
            this.details[0].delivery = "";
          }
        })
        .catch(reason => {
          //console.log("getitem reason");
          this.serverCatch("取得");
        });
    },
    // 検索処理
    searchItem() {
        //console.log("searchItem in s_ = " + this.s_order_no);
        //this.s_order_no = this.s_order_no;
        this.classObj1 = "";
        this.acttitle = "検索";
        var motion_msg = "検索";
        var messages = [];
        var arrayParams = { s_department : this.s_department , s_charge : this.s_charge , s_product_name : this.s_product_name , s_product_number : this.s_product_number , marks : this.selectCnt , s_history : this.s_history};
        this.postRequest("/material_management/search", arrayParams)
          .then(response  => {
            this.putThenSearch(response, motion_msg);
            //this.btnMode = "1";
          })
          .catch(reason => {
            this.serverCatch("検索");
          });
    },
    // 登録インサート処理
    dataStore() {
      if (this.checkFormStore()) {
        this.product_title = this.form.product_name;
        this.classObj1 = "bgcolor3";
        this.acttitle = "新規登録";
        var messages = [];
        var arrayParams = { form : this.form , marks : this.selectCnt};
        this.postRequest("/material_management/insert", arrayParams)
          .then(response  => {
            this.putThenStore(response, "新規登録");
          })
          .catch(reason => {
            this.serverCatch("登録");
          });
      }
    },
    // ゴミ箱処理
    dataDel(index,k) {
        this.product_title = this.form.product_name;
        this.classObj1 = "bgcolor4";
        this.acttitle = "抹消へ移動";
        var messages = [];
        var arrayParams = { details : this.details[index] , upkind : k };
        this.postRequest("/material_management/update", arrayParams)
          .then(response  => {
            this.putThenDel(response, "抹消へ移動");
          })
          .catch(reason => {
            this.serverCatch("抹消移動");
          });
    },
    // レコード削除処理
    recordDel(index,dk) {
        var messages = [];
        messages.push("この登録を削除しますか？");
        this.htmlMessageSwal(this.details[index].product_name, messages, "info", true, true).then(
          result => {
            if (result) {
              //this.storeData();
              var arrayParams = { details : this.details[index] , delkind : dk  };
              this.postRequest("/material_management/delete", arrayParams)
                .then(response  => {
                  this.putThenRecordDel(response, "削除");
                })
                .catch(reason => {
                  this.serverCatch("削除");
                });

            }
          }
        );

    },
    // 編集変更処理
    dataUpdate(index,k) {
        var messages = [];
        if (k == 1) {
          this.details[index].now_inventory = this.details[index].now_inventory + this.details[index].receipt - this.details[index].delivery;
          this.details[index].total = this.details[index].now_inventory * this.details[index].unit_price;
        }
        var arrayParams = { details : this.details[index] , upkind : k };
        var motion_msg = "";
        if (k == 0) motion_msg = '修正';
        if (k == 1) motion_msg = '在庫を更新';
        if (k == 2) motion_msg = '新しい商品追加';
        this.postRequest("/material_management/update", arrayParams)
          .then(response  => {
            this.putThenHead(response, motion_msg, k);
          })
          .catch(reason => {
            this.serverCatch(motion_msg);
          });
    },
    // -------------------- 共通 ----------------------------
    // 取得正常処理
    getThen(response,md) {
      var res = response.data;
      //console.log('getthen in res = ' + res);
      if (res.result) {
        this.details = res.details;
        this.details2 = res.details2;
        this.count = this.details.length;
        //this.before_count = this.count;
        if (res.totals) {
          this.totals = res.totals[0].totals;
        }
        if ( this.details.length > 0) {
          this.form.id = this.details[0].id;
          this.form.mdate = this.details[0].mdate;
          this.form.department = this.details[0].department;
          this.form.charge = this.details[0].charge;
          this.form.product_name = this.details[0].product_name;
          this.form.product_code = this.details[0].product_code;
          this.form.product_number = this.details[0].product_number;
          this.form.unit = this.details[0].unit;
          this.form.quantity = this.details[0].quantity;
          this.form.receipt = this.details[0].receipt;
          this.form.delivery = this.details[0].delivery;
          this.form.now_inventory = this.details[0].now_inventory;
          this.form.nbox = this.details[0].nbox;
          this.form.order_address = this.details[0].order_address;
          this.form.unit_price = this.details[0].unit_price;
          this.form.total = this.details[0].total;
          this.form.remarks = this.details[0].remarks;
          this.form.note = this.details[0].note;
          this.form.status = this.details[0].status;
          this.form.marks = this.details[0].marks;
          this.form.created_user = this.details[0].created_user;
          this.form.updated_user = this.details[0].updated_user;
          this.form.created_at = this.details[0].created_at;
          this.form.updated_at = this.details[0].updated_at;
          this.form.is_deleted = this.details[0].is_deleted;

        } else {
          
        }
      } else {
        if (res.messagedata.length > 0) {
          this.htmlMessageSwal("エラー", res.messagedata, "error", true, false);
        } else {
          this.serverCatch("取得");
        }
      }
    },
    // 検索系正常処理
    putThenSearch(response, eventtext) {
      var messages = [];
      var res = response.data;
      //if (res.result) {
      if (res.details.length > 0) {
          this.details = res.details;
          //this.classObj1 = (this.details[0].status == 'newest') ? 'bgcolor3' : '';
          if(res.s_history) {
            this.str_s_history = ' 履歴含む';
          }
          else {
            this.str_s_history = '';
          }
          console.log("putThenSearch in res.search_totals = " + res.search_totals[0].total_s);
          if (res.search_totals) {
            this.search_totals = res.search_totals[0].total_s;
          }

          this.product_title = res.s_department + ' ' + res.s_charge + ' ' + res.s_product_name + ' ' + res.s_product_number + ' ' + this.str_s_history;
          //console.log("putThenSearch in res.s_product_name = " + res.s_product_name);
          this.$toasted.show(this.product_title + " " + eventtext + "しました");
          this.actionmsgArr.push(this.product_title + " を検索しました。");
      } else {
          this.actionmsgArr.push(this.s_department + this.s_charge + this.s_product_name + this.s_product_number + " が見つかりませんでした。","");
        if (res.messagedata.length > 0) {
          this.htmlMessageSwal("警告", res.messagedata, "warning", true, false);
        } else {
          this.serverCatch(eventtext);
        }
      }
    },
    // 更新系正常処理
    putThenHead(response, eventtext, k) {
      let object_mode = {0: 'fix', 1: 'update', 2: 'new'};
      console.log('key: ' + k + 'value: ' + object_mode[k]);
      var messages = [];
      var res = response.data;
      if (res.result) {
        if(res.id) {
          //this.acttitle = "更新";
          this.edit_id = res.id;
          //console.log("putThenHead in res.pid = " + res.product_code);
          this.product_code = res.product_code;
          this.product_title = res.product_name;
        }
        this.$toasted.show(this.product_title + "を" + eventtext + "しました");
        this.getItemOne(this.edit_id,this.product_code,this.product_title,object_mode[k]);
      } else {
        if (res.messagedata.length > 0) {
          this.htmlMessageSwal("警告", res.messagedata, "warning", true, false);
        } else {
          this.serverCatch(eventtext);
        }
      }
    },
    // 新規系正常処理
    putThenStore(response, eventtext) {
      var messages = [];
      var res = response.data;
      if (res.result) {
        this.re_id = res.id;
        this.acttitle = "登録";
        this.getItemOne(this.re_id,this.product_code,this.product_title);
        this.$toasted.show(this.product_title + "を" + eventtext + "しました");
        this.actionmsgArr.push(this.product_title + "を新規登録しました。","");
        this.selectMode = 'COMPLETE';

      } else {
        if (res.messagedata.length > 0) {
          this.htmlMessageSwal("警告", res.messagedata, "warning", true, false);
        } else {
          this.serverCatch(eventtext);
        }
      }
    },
    // 削除系正常処理
    putThenDel(response, eventtext) {
      var messages = [];
      var res = response.data;
      if (res.result) {
        this.re_id = res.id;
        this.acttitle = "移動";
        this.getItemOne(this.re_id,this.product_code,this.product_title);
        this.$toasted.show(this.product_title + "を" + eventtext + "しました");
        this.actionmsgArr.push(this.product_title + " を抹消へ移動しました。","");
        this.btnMode = 'off';
        this.selectMode = 'COMPLETE';

      } else {
        if (res.messagedata.length > 0) {
          this.htmlMessageSwal("警告", res.messagedata, "warning", true, false);
        } else {
          this.serverCatch(eventtext);
        }
      }
    },
    // レコード削除正常処理
    putThenRecordDel(response, eventtext) {
      var messages = [];
      var res = response.data;
      if (res.result) {
        this.re_id = res.id;
        this.acttitle = "削除";
        this.getItemOne(this.re_id,this.product_code,this.product_title);
        this.$toasted.show(this.product_title + "を" + eventtext + "しました");
        this.actionmsgArr.push(this.product_title + " を削除しました。");
        this.selectMode = 'COMPLETE';

      } else {
        if (res.messagedata.length > 0) {
          this.htmlMessageSwal("警告", res.messagedata, "warning", true, false);
        } else {
          this.serverCatch(eventtext);
        }
      }
    },
    // 異常処理
    serverCatch(eventtext) {
      var messages = [];
      //messages.push("在庫管理" + eventtext + "に失敗しました");
      //this.htmlMessageSwal("エラー", messages, "error", true, false);
    },
    
    inputClear() {
      this.details = [];

      this.form.id = "";
      this.form.mdate = "";
      this.form.department = "";
      this.form.charge = "";
      this.form.product_name = "";
      this.form.product_code = "";
      this.form.product_number = "";
      this.form.unit = "";
      this.form.quantity = "";
      this.form.receipt = "";
      this.form.delivery = "";
      this.form.now_inventory = "";
      this.form.nbox = "";
      this.form.order_address = "";
      this.form.unit_price = "";
      this.form.total = "";
      this.form.remarks = "";
      this.form.note = "";
      this.form.status = "";
      this.form.marks = "";
      this.form.created_user = "";
      this.form.updated_user = "";
      this.form.created_at = "";
      this.form.updated_at = "";
      this.form.is_deleted = "";

    },
    dateset: function()  {
      var date_obj = new Date();
      //console.log('todayset = ' + date_obj);
      this.today_year  = date_obj.getFullYear(); // 西暦年取得
      this.today_month = date_obj.getMonth();    // 月取得
      this.today_day = date_obj.getDate();    // 日取得
      // 文字列として連結month_format
      this.itsdate = ('0000' + this.today_year).slice(-4) 
                      + '-' 
                      + ('00' + (this.today_month + 1)).slice(-2) 
                      + '-' 
                      + ('00' + (this.today_day)).slice(-2) 
    },

    // -------------------- 共通 ----------------------------
  }
};
</script>
