     <div class="box-body">
       <div class="col-md-6">
                
				<div class="form-group">
                 {{ Form::label('title', getPhrase( 'Title' ) ) }} {!! required_field(); !!}
                 {{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Eg: Contact Us' ),)) }}
                </div>
				
				<?php 
				$status = array();
				$status['yes'] = getPhrase( 'Yes' );
				$status['no'] = getPhrase('No');
				?>
				<div class="form-group">
				{{ Form::label('show_in_menu', getPhrase( 'Show in menu?' ) ) }}
				{{Form::select('show_in_menu', $status, null, ['class'=>'form-control', "id"=>"show_in_menu"])}}
				</div>
				
            </div>			
			
			<div class="col-md-6">
				{{ Form::label('icon', getPhrase( 'Icon' ) ) }}
				{{ Form::text('icon', $value = null , $attributes = array('class'=>'form-control icp icp-auto', 'placeholder' => getPhrase( 'Icon' ),'data-input-search' => true, )) }}				
			</div>

            <div class="col-md-6">
								
				<?php 
				$status = array();
				$status['Active'] = getPhrase( 'Active' );
				$status['Inactive'] = getPhrase('Inactive');
				?>
				<div class="form-group">
				{{ Form::label('status', getPhrase( 'Status' ) ) }}
				{{Form::select('status', $status, null, ['class'=>'form-control', "id"=>"status"])}}
				</div>
           
			</div>
			
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('content', getPhrase( 'content' ) ) }}               
					{{ Form::textarea('content', $value = null, $attributes = array('class'=>'form-control ckeditor', 'placeholder' => getPhrase( 'Content for the template' ), 'rows'=>'4')) }}
				</div>
				<h2>SEO Settings</h2>
				<div class="form-group">
                 {{ Form::label('meta_tag_title', getPhrase( 'Title Meta Tag' ) ) }}
                 {{ Form::text('meta_tag_title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Title Meta Tag' ),)) }}
                </div>
			</div>
			
			<div class="col-md-6">
				<div class="form-group">
				{{ Form::label('meta_tag_description', getPhrase( 'Description Meta Tag' ) ) }}               
				{{ Form::textarea('meta_tag_description', $value = null, $attributes = array('class'=>'form-control ckeditor', 'placeholder' => getPhrase( 'Description Meta Tag' ), 'rows'=>'4')) }}
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
				{{ Form::label('meta_tag_keywords', getPhrase( 'Kewords Meta Tag' ) ) }}               
				{{ Form::textarea('meta_tag_keywords', $value = null, $attributes = array('class'=>'form-control ckeditor', 'placeholder' => getPhrase( 'Kewords Meta Tag' ), 'rows'=>'4')) }}
				</div>
			</div>
              </div>   
              <!-- /.box-body -->

              <div class="box-footer">
               <div class="btn-center">
                <button type="submit" class="btn btn-primary" ng-disabled='!formUsers.$valid'>{{$button_name}}</button>
                  </div>
              </div>