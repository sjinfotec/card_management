<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

class MasterOffice extends Model
{
    use HasFactory;

    protected $table = 'company';

    private $id;					// ID
    private $company;				// 会社
    private $company_code;			// 会社CODE
    private $office;				// 営業所
    private $office_code;			// 営業所CODE
    private $post_code;				// 郵便番号
    private $address;				// 住所
    private $direct_dial;			// TEL（直通）
    private $tel;					// TEL
    private $fax;					// FAX
    private $remarks;				// 備考
    private $design;				// デザイン
    private $status;				// ステータス
    private $created_user;			// 作成ユーザー
    private $updated_user;			// 修正ユーザー
    private $created_at;			// 作成日時
    private $updated_at;			// 修正日時
    private $is_deleted;			// 削除フラグ
        

	//ID
	public function getIdAttribute()
	{
		return $this->id;
	}public function setIdAttribute($value)
	{
		$this->id = $value;
	}

	//会社
	public function getCompanyAttribute()
	{
		return $this->company;
	}public function setCompanyAttribute($value)
	{
		$this->company = $value;
	}
	//会社CODE
	public function getCompanycodeAttribute()
	{
		return $this->company_code;
	}
	public function setCompanycodeAttribute($value)
	{
		$this->company_code = $value;
	}

	//営業所
	public function getOfficeAttribute()
	{
		return $this->office;
	}
	public function setOfficeAttribute($value)
	{
		$this->office = $value;
	}

	//営業所CODE
	public function getOfficecodeAttribute()
	{
		return $this->office_code;
	}
	public function setOfficecodeAttribute($value)
	{
		$this->office_code = $value;
	}

	//郵便番号
	public function getPostcodeAttribute()
	{
		return $this->post_code;
	}
	public function setPostcodeAttribute($value)
	{
		$this->post_code = $value;
	}

	//住所
	public function getAddressAttribute()
	{
		return $this->address;
	}
	public function setAddressAttribute($value)
	{
		$this->address = $value;
	}

	//TEL（直通）
	public function getDirectdialAttribute()
	{
		return $this->direct_dial;
	}
	public function setDirectdialAttribute($value)
	{
		$this->direct_dial = $value;
	}

	//TEL
	public function getTelAttribute()
	{
		return $this->tel;
	}
	public function setTelAttribute($value)
	{
		$this->tel = $value;
	}

	//FAX
	public function getFaxAttribute()
	{
		return $this->fax;
	}
	public function setFaxAttribute($value)
	{
		$this->fax = $value;
	}

	//備考
	public function getRemarksAttribute()
	{
		return $this->remarks;
	}
	public function setRemarksAttribute($value)
	{
		$this->remarks = $value;
	}

	//デザイン
	public function getDesignAttribute()
	{
		return $this->design;
	}
	public function setDesignAttribute($value)
	{
		$this->design = $value;
	}

	//ステータス
	public function getStatusAttribute()
	{
		return $this->status;
	}
	public function setStatusAttribute($value)
	{
		$this->status = $value;
	}

	//作成ユーザー
	public function getCreateduserAttribute()
	{
		return $this->created_user;
	}
	public function setCreateduserAttribute($value)
	{
		$this->created_user = $value;
	}

	//修正ユーザー
	public function getUpdateduserAttribute()
	{
		return $this->updated_user;
	}
	public function setUpdateduserAttribute($value)
	{
		$this->updated_user = $value;
	}

	//作成日時
	public function getCreatedatAttribute()
	{
		return $this->created_at;
	}
	public function setCreatedatAttribute($value)
	{
		$this->created_at = $value;
	}

	//修正日時
	public function getUpdatedatAttribute()
	{
		return $this->updated_at;
	}
	public function setUpdatedatAttribute($value)
	{
		$this->updated_at = $value;
	}

	//削除フラグ
	public function getIsdeletedAttribute()
	{
		return $this->is_deleted;
	}
	public function setIsdeletedAttribute($value)
	{
		$this->is_deleted = $value;
	}




    // ------------- implements --------------

	//ID
    private $param_edit_id;
	public function getParamIdAttribute()
	{
		return $this->param_edit_id;
	}
	public function setParamIdAttribute($value)
	{
		$this->param_edit_id = $value;
	}

	//会社
    private $param_company;
	public function getParamCompanyAttribute()
	{
		return $this->param_company;
	}
	public function setParamCompanyAttribute($value)
	{
		$this->param_company = $value;
	}

	//会社CODE
    private $param_company;
	public function getParamCompanycodeAttribute()
	{
		return $this->param_company_code;
	}
	public function setParamCompanycodeAttribute($value)
	{
		$this->param_company_code = $value;
	}

	//営業所
    private $param_company;
	public function getParamOfficeAttribute()
	{
		return $this->param_office;
	}
	public function setParamOfficeAttribute($value)
	{
		$this->param_office = $value;
	}

	//営業所CODE
    private $param_company;
	public function getParamOfficecodeAttribute()
	{
		return $this->param_office_code;
	}
	public function setParamOfficecodeAttribute($value)
	{
		$this->param_office_code = $value;
	}

	//デザイン
    private $param_design;
	public function getParamDesignAttribute()
	{
		return $this->param_design;
	}
	public function setParamDesignAttribute($value)
	{
		$this->param_design = $value;
	}

	//ステータス
    private $param_status;
	public function getParamStatusAttribute()
	{
		return $this->param_status;
	}
	public function setParamStatusAttribute($value)
	{
		$this->param_status = $value;
	}


    

}
