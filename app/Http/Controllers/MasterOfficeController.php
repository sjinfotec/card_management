<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class MasterOfficeController extends Controller
{
    public function index222(Request $request)
    {
        $authusers = Auth::user();
        return view('masteroffice', compact('authusers'));
    }

    public function index(Request $request)
    {
        $authusers = Auth::user();
        $result['htmlselect'] = "";
        $htmlselect = "";
        $select_mode = "TOP";
        return view('masteroffice', compact(
            'authusers',
            'result',
            'htmlselect',
            'select_mode'
            )
        );
    }


    /**
     * 取得（request）
     *
     * @return void
     */
    public function getData(Request $request){
        $this->array_messagedata = array();
        try {
            $details = $this->getDataFunc($request);
            $totals = $this->getDataTotalFunc($request);
            return response()->json(
                ['result' => true, 'details' => $details, 'totals' => $totals,
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

    /**
     * 取得
     *
     * @return void
     */
    public function getDataFunc($request){
        $this->array_messagedata = array();
        //$details = new Collection();
        $result = true;
        try {
            // パラメータセット
            $params = array();
            $params_product_name = null;
            $params_mdate = null;
            $params_charge = null;
            $params_orderfr = null;
            $params_marks = null;
            $params_is_deleted = null;

            $material_management = new MatManage();

            if (isset($request->keyparams)) {
                $params = $request->keyparams;
                if (!empty($params['product_name'])) {
                    $params_product_name = $params['product_name'];
                    $material_management->setParamProductnameAttribute($params_product_name);
                }
                if (!empty($params['mdate'])) {
                    $params_mdate = $params['mdate'];
                    $material_management->setParamMdateAttribute($params_mdate);
                }
                if (!empty($params['charge'])) {
                    $params_charge = $params['charge'];
                    $material_management->setParamChargeAttribute($params_charge);
                }
                if (!empty($params['orderfr'])) {
                    $params_orderfr = $params['orderfr'];
                    $material_management->setParamOrderfrAttribute($params_orderfr);
                }
                if (!empty($params['marks'])) {
                    $params_marks = $params['marks'];
                    $material_management->setParamMarksAttribute($params_marks);
                }
                if (!empty($params['is_deleted'])) {
                    $params_is_deleted = $params['is_deleted'];
                    $material_management->setParamIsdeletedAttribute($params_is_deleted);
                }
            }

            $details =  $material_management->getDataMM();

            return $details;
        }catch(\PDOException $pe){
            throw $pe;
        }catch(\Exception $e){
            Log::error('class = '.__CLASS__.' method = '.__FUNCTION__.' '.Config::get('const.LOG_MSG.unknown_error'));
            Log::error($e->getMessage());
            throw $e;
        }
    }


    /**
     * 取得total
     *
     * @return void
     */
    public function getDataTotalFunc($request){
        $this->array_messagedata = array();
        //$details = new Collection();
        $result = true;
        try {
            // パラメータセット
            $params = array();
            $params_marks = null;

            $material_management = new MatManage();

            if (isset($request->keyparams)) {
                $params = $request->keyparams;
                if (!empty($params['marks'])) {
                    $params_marks = $params['marks'];
                    $material_management->setParamMarksAttribute($params_marks);
                }
            }

            $details =  $material_management->getDataMMtotal();

            return $details;
        }catch(\PDOException $pe){
            throw $pe;
        }catch(\Exception $e){
            Log::error('class = '.__CLASS__.' method = '.__FUNCTION__.' '.Config::get('const.LOG_MSG.unknown_error'));
            Log::error($e->getMessage());
            throw $e;
        }
    }





}
