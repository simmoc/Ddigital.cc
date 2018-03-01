     <div class="box-body">
       <div class="col-md-6">                
			<div class="form-group">
			 {{ Form::label('title', getPhrase( 'Title' ) ) }} {!! required_field(); !!}
			 {{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'enter_title' ),
			 'ng-model' => 'title',
			 'required' => true,
			 'ng-class'=>'{"has-error": formName.title.$touched && formName.title.$invalid}',
					)) }}
			<div class="validation-error" ng-messages="formName.title.$error" >
				{!! getValidationMessage()!!}
			</div>
			</div>
			
			
			
			<div class="form-group">
			{{ Form::label('description', getPhrase( 'Description' ) ) }}               
			{{ Form::textarea('description', $value = null, $attributes = array('class'=>'form-control ckeditor', 'placeholder' => getPhrase( 'Enter decription' ), 'rows'=>'4')) }}
			</div> 
			
			<?php 
				$icons = getIcons();
				?>
                <div class="form-group">
                {{ Form::label('icon', getPhrase( 'Icon' ) ) }}
               
        {{Form::select('icon', $icons, null, ['class'=>'form-control'])}}
                </div>	

<?php 
				$status['Active'] = 'Active';
				$status['Inactive'] = 'Inactive';
				?>
                <div class="form-group">
                {{ Form::label('status', getPhrase( 'Select' ) ) }}
               
        {{Form::select('status', $status, null, ['class'=>'form-control', "id"=>"status"])}}
                </div>			
         </div>

            
              </div>   
              <!-- /.box-body -->

              <div class="box-footer">
               <div class="btn-center">
                <button type="submit" class="btn btn-primary">{{$button_name}}</button>
                  </div>
              </div>