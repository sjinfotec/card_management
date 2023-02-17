<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SearchController extends Controller
{

    public function index(Request $request)
    {
        $authusers = Auth::user();
        return view('search', compact('authusers'));
    }

    public function search(Request $request)
    {
        $authusers = Auth::user();
        return view('search', compact('authusers')
        );
    }





    /** 検索SEARCH取得
     *
     * @return list results
     */
    public function getSearch(Request $request){
        //Log::debug("getDataAone in ");
        $this->array_messagedata = array();
        $s_order_no = "";
        $s_company_name = "";
        $result = true;
        try {
            // パラメータチェック
            $params = array();
            if (!isset($request->keyparams)) {
                Log::error('class = '.__CLASS__.' method = '.__FUNCTION__.' '.str_replace('{0}', "keyparams", Config::get('const.LOG_MSG.parameter_illegal')));
                $this->array_messagedata[] = Config::get('const.MSG_ERROR.parameter_illegal');
                return response()->json(
                    ['result' => false, 'details' => null,
                    Config::get('const.RESPONCE_ITEM.messagedata') => $this->array_messagedata]
                );
            }
            $params = $request->keyparams;
            //Log::debug("getDataAsearch params[s_order_no] = ".$params['s_order_no']);
            if (!isset($params['s_order_no']) && !isset($params['s_company_name'])) {
                Log::error('class = '.__CLASS__.' method = '.__FUNCTION__.' '.str_replace('{0}', "edit_id", Config::get('const.LOG_MSG.parameter_illegal')));
                $this->array_messagedata[] = Config::get('const.MSG_ERROR.parameter_illegal');
                return response()->json(
                    ['result' => false, 'details' => null,
                    Config::get('const.RESPONCE_ITEM.messagedata') => $this->array_messagedata]
                );
            }
            $s_order_no = isset($params['s_order_no']) ? $params['s_order_no'] : "";
            $s_company_name = isset($params['s_company_name']) ? $params['s_company_name'] : "";
            //Log::debug("getDataAsearch s_company_name = ".$s_company_name);
            /*
            $searchget = new InventoryA();
            if(isset($s_order_no))      $searchget->setParamOrdernoAttribute($s_order_no);
            if(isset($s_company_name))  $searchget->setParamCompanynameAttribute($s_company_name);
            $details =  $searchget->getSearchA();
            */

            return response()->json(
                ['result' => $result, 'details' => $details, 's_order_no' => $s_order_no, 's_company_name' => $s_company_name,
                Config::get('const.RESPONCE_ITEM.messagedata') => $this->array_messagedata]
            );
        }catch(\PDOException $pe){
            throw $pe;
        }catch(\Exception $e){
            Log::error('class = '.__CLASS__.' method = '.__FUNCTION__.' '.Config::get('const.LOG_MSG.unknown_error'));
            Log::error($e->getMessage());
            throw $e;
        }
    }



    /** 詳細取得
     *
     * @return list results
     */
    public function getDataone(Request $request){
        //Log::debug("getDataAone in ");
        $this->array_messagedata = array();
        $edit_id = "";
        $product_id = "";
        $result = true;
        try {
            // パラメータチェック
            $params = array();
            if (!isset($request->keyparams)) {
                Log::error('class = '.__CLASS__.' method = '.__FUNCTION__.' '.str_replace('{0}', "keyparams", Config::get('const.LOG_MSG.parameter_illegal')));
                $this->array_messagedata[] = Config::get('const.MSG_ERROR.parameter_illegal');
                return response()->json(
                    ['result' => false, 'details' => null,
                    Config::get('const.RESPONCE_ITEM.messagedata') => $this->array_messagedata]
                );
            }
            $params = $request->keyparams;
            //Log::debug("getDataAone params[edit_id] = ".$params['edit_id']);
            //Log::debug("getDataAone params[product_id] = ".$params['product_id']);
            if (!isset($params['edit_id'])) {
                Log::error('class = '.__CLASS__.' method = '.__FUNCTION__.' '.str_replace('{0}', "edit_id", Config::get('const.LOG_MSG.parameter_illegal')));
                $this->array_messagedata[] = Config::get('const.MSG_ERROR.parameter_illegal');
                return response()->json(
                    ['result' => false, 'details' => null,
                    Config::get('const.RESPONCE_ITEM.messagedata') => $this->array_messagedata]
                );
            }
            $edit_id = $params['edit_id'];
            //Log::debug("getDataAone edit_id = ".$edit_id);
            $inventory_a = new InventoryA();
            $inventory_a->setParamEditidAttribute($edit_id);
            $details =  $inventory_a->getDataInvA();

            
            $product_id = $params['product_id'];
            //Log::debug("getDataAone product_id = ".$product_id);
            if(isset($product_id)) {
                $inventory_a2 = new InventoryA();
                $inventory_a2->setParamProductidAttribute($product_id);
                $details2 =  $inventory_a2->getDataInvA();
            }  else {
                $details2 = "";
            }
        


            return response()->json(
                ['result' => $result, 'details' => $details, 'details2' => $details2, 'edit_id' => $edit_id, 'product_id' => $product_id,
                Config::get('const.RESPONCE_ITEM.messagedata') => $this->array_messagedata]
            );
        }catch(\PDOException $pe){
            throw $pe;
        }catch(\Exception $e){
            Log::error('class = '.__CLASS__.' method = '.__FUNCTION__.' '.Config::get('const.LOG_MSG.unknown_error'));
            Log::error($e->getMessage());
            throw $e;
        }
    }


}
