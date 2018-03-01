<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Image;
use File;
use Input;
use Excel;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
	
	public $excel_data = '';
	
	function final_atts( $defaults, $pairs ) {
		$atts = (array)$defaults;
		$out = array();
		foreach ($pairs as $name => $default) {
			if ( array_key_exists($name, $atts) )
				$out[$name] = $atts[$name];
			else
				$out[$name] = $default;
		}
		return $out;
	}
	public function uploadFile( $params_array = array() )
	{
		$defaults = array(
			'request' => '',
			'model' => '',
			'destinationPath' => '',
			'destinationPathThumbs' => '',
			'request_field' => '',
			'db_field' => '',
			'file_index' => 0, // THis is useful only if the file is array
			'prefix' => '',
			'preserve_id_index' => true,
		);
		$params = $this->final_atts($params_array, $defaults);
		
		$prefix = (isset($params['prefix'])) ? $params['prefix'] : '';
		$file_index = (isset($params['file_index'])) ? $params['file_index'] : '';
		$preserve_id_index = $params['preserve_id_index'];
		
		if( isset($params['request']) && $params['request'] != '' ) {
			$request = $params['request'];
		}
		if( ! isset( $params['destinationPath'] ) || ! isset( $params['request_field'] ) ) {
			return false;
		}
		
		if( $params['destinationPath'] == '' || $params['request_field'] == '' ) {
			return false;
		}
		
		$fileName = '';
		$destinationPath      = $params['destinationPath'];
		$destinationPathThumb = isset($params['destinationPathThumbs']) ? $params['destinationPathThumbs'] : '';
		if($params['request_field'] == 'digi_download_files') {
			dd($params);
		}
		if( is_array($request->$params['request_field']) ) {			
		
			if( $file_index != '' ) { // Array of files
				$files = $request->$params['request_field'];
				dd($params);
				foreach( $files as $index => $fileInfo ) {				
					
					if( isset($fileInfo['file']) && $file_index == $index) {
						$old_image = '';
						if ( isset( $params['model'] ) && $params['model'] != '' ) {
							$old_image = $params['model']->$params['db_field'];				
							if( $preserve_id_index ) {
								$fileName = $prefix.$params['model']->id.'_'.$file_index.'.'.$fileInfo['file']->guessClientExtension();
							} else {
								$fileName = $prefix.rand().$params['model']->id.'_'.$file_index.'.'.$fileInfo['file']->guessClientExtension();
							}
						} else {
							$fileName = $prefix . rand().'.'.$fileInfo['file']->guessClientExtension();
						}
						$fileInfo['file']->move($destinationPath, $fileName);
						if( $destinationPathThumb != '') {
							$width = (isset($params['thumbsize']['width'])) ? $params['thumbsize']['width'] : 45;
							$height = (isset($params['thumbsize']['height'])) ? $params['thumbsize']['height'] : 45;
							
							Image::make($destinationPath.$fileName)->resize($width, $height)->save($destinationPathThumb.$fileName);
						}
					}
				}
			}

		} elseif ( $request->hasFile( $params['request_field'] ) ) {          
			$old_image = '';
			$destinationPath      = $params['destinationPath'];
			$destinationPathThumb = $params['destinationPathThumbs'];
			if ( isset( $params['model'] ) && $params['model'] != '' ) {
				$old_image = $params['model']->$params['db_field'];				
				if( $preserve_id_index ) {
					$fileName = $prefix.$params['model']->id.'.'.$request->$params['request_field']->guessClientExtension();
				} else {
					$fileName = $prefix.rand().$params['model']->id.'.'.$request->$params['request_field']->guessClientExtension();
				}
				
			} else {
				$fileName = $prefix . rand().'.'.$request->$params['request_field']->guessClientExtension();
			}			
			$request->file( $params['request_field'] )->move($destinationPath, $fileName);

			if( $destinationPathThumb != '') {
				$width = (isset($params['thumbsize']['width'])) ? $params['thumbsize']['width'] : 45;
				$height = (isset($params['thumbsize']['height'])) ? $params['thumbsize']['height'] : 45;
				
				Image::make($destinationPath.$fileName)->resize($width, $height)->save($destinationPathThumb.$fileName);
			}
			if ( isset( $params['model'] ) && $params['model'] != '' ) {
				$params['model']->$params['db_field'] = $fileName;
				$params['model']->save();
			}

			if( $old_image != $fileName && isset( $params['model'] ) && $params['model'] != '') {
				$this->deleteFile($old_image, $destinationPath);
				$this->deleteFile($old_image, $destinationPathThumb);
			}
        }
		echo $fileName;die();
		return $fileName;
	}
	
	/**
     * This method will delete the file at specified path
     * @param  [type]  $record   [description]
     * @param  [type]  $path     [description]
     * @param  boolean $is_array [description]
     * @return [type]            [description]
     */
    public function deleteFile($record, $path, $is_array = FALSE)
    {
        $files = array();
        $files[] = $path.$record;
        File::delete($files);
    }
	
	/**
      * This method verifies if the record exists with the email or user name
      * If Exists it returns true else it returns false
      * @param  [type]  $value [description]
      * @param  string  $type  [description]
      * @return boolean        [description]
      */
     public function isRecordExists($model, $field, $value = '', $condition = '=')
     {
        return $model::where($field,$condition,$value)->get()->count();
     }
	 
	 
	 public function downloadExcel($fields)
	{

		Excel::create('import_report', function($excel) use($fields) {
		  $excel->sheet('Failed', function($sheet) use($fields) {
		  $sheet->row(1, ['Reason'] + array_values( $fields ) );
		  $data = $this->excel_data;
		  $cnt = 2;
		  foreach ($data['failed'] as $data_item) {			
			$item = (Object) $data_item->record;
			$row = array( $data_item->type );
			$keys = array_keys( $fields );
			foreach( $keys as $key ) {
				$row[] = isset( $item->$key ) ? $item->$key : '';
			}
			$sheet->appendRow($cnt++, $row);
		  }
		});

		$excel->sheet('Success', function($sheet) use($fields) {
		  $sheet->row(1, array_values( $fields ));
		  $data = $this->excel_data;
		  $cnt = 2;
		  foreach ($data['success'] as $data_item) {
			$item = (Object)$data_item;
			$keys = array_keys( $fields );
			$row = array();
			foreach( $keys as $key ) {
				$row[] = isset( $item->$key ) ? $item->$key : '';
			}
			$sheet->appendRow($cnt++, $row);
		  }
		});
		})->download('xlsx');

		return TRUE;
	}
	
	public function isModuleEligible($mod, $per = array())
	{
		$isEligible = isModuleEligible($mod, $per);
		
		if( ! $isEligible ) {
			if( ! Auth::check() ) {				
				flash('Ooops..!', 'Please login to access this page', 'error');
				return URL_USERS_LOGIN;
			} else {
				prepareBlockUserMessage();
				$user = getUserRecord();
				if( in_array($user->role_id, array( OWNER_ROLE_ID, ADMIN_ROLE_ID, EXECUTIVE_ROLE_ID )) )
				{
					return URL_DASHBOARD;
				}
				elseif( $user->role_id == USER_ROLE_ID )
				{					
					return URL_USERS_DASHBOARD;					
				}
				else
				{
					return URL_VENDOR_DASHBOARD;
				}
			}
		}
		else {
			return '';
		}
	}
}
