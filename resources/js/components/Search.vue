<template>
  <div>

    <div v-if="selectMode=='LINEACTIVE'">
      <div id="top_cnt">
        <h2 class="title mgt20">検索結果一覧</h2>
        <!--
        <button type="button" class="btn_gc1 textcolor2" onclick="window.print();">
            印刷
        </button>
        -->
      </div>
      <div id="topform2_cnt" class="print-none">
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
          <input type="text" class="form_style bc1 w10e" v-model="s_reading" maxlength="30" name="s_reading">
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
              <th class="">読み <button type="button" class="" @click="ForwardReverse('reading',1)">▲</button><button type="button" class="" @click="ForwardReverse('reading',2)">▼</button></th>
              <th class="">携帯電話</th>
              <th class="">メールアドレス</th>
              <th class="">資格</th>
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
              <td class="">{{ item['director'] }}</td>
              <td class="">{{ item['name'] }}</td>
              <td class="">{{ item['roma'] }}</td>
              <td class="">{{ item['kana'] }}</td>
              <td class="">{{ item['reading'] }}</td>
              <td class="">{{ item['mobile_phone'] }}</td>
              <td class="">{{ item['email'] }}</td>
              <td class="">{{ item['certification'] }}</td>
              <td class="">{{ item['image'] }}</td>
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
  name: 'Search',
  template: `
    <div>
    <p>エクスポートデフォルト</p>
    </div>
  `,
  //mixins: [dialogable, checkable, requestable],
  props: {
    /*
    authusers: {
      type: Array,
      default: []
    
    }
    */
  },
  data() {
    return {
      details: [],
      informations: [],
      content: "",
      login_user_code: 0,
      login_user_role: 0,
      dialogVisible: false,
      messageshowsearch: false,
      infomationmessage: [],
      message: "aaa",
      showMessage: true,
      selectMode: "LINEACTIVE",
      s_department: "",
      s_name: "",
      s_reading: "",
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
