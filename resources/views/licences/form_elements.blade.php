     <div class="box-body">
       <div class="col-md-6">                
			<div class="form-group">
			 {{ Form::label('title', getPhrase( 'Title' ) ) }} {!! required_field(); !!}
			 {{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Eg: Standard Licence' ),
			 'ng-model' => 'title',
			 'required' => true,
			 'ng-class'=>'{"has-error": formName.title.$touched && formName.title.$invalid}',
					)) }}
			<div class="validation-error" ng-messages="formName.title.$error" >
				{!! getValidationMessage()!!}
			</div>
			</div>
			
			<div class="form-group">
				 {{ Form::label('price', getPhrase( 'price' ) ) }} {!! required_field(); !!}
				 {{ Form::number('price', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'price' ),
				 'ng-model' => 'price',
				 'required' => true,
				 'ng-class'=>'{"has-error": formName.price.$touched && formName.price.$invalid}',
						)) }}
				<div class="validation-error" ng-messages="formName.price.$error" >
					{!! getValidationMessage()!!}
				</div>
				</div>
			
			<div class="form-group">
			{{ Form::label('description', getPhrase( 'Description' ) ) }}               
			{{ Form::textarea('description', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Enter decription' ), 'rows'=>'4')) }}
			</div>               
         </div>

            <div class="col-md-6">
              
				<div class="form-group">
				 {{ Form::label('duration', getPhrase( 'duration' ) ) }} {!! required_field(); !!}
				 {{ Form::number('duration', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'duration' ),
				 
				 'ng-model' => 'duration',
				 'required' => true,
				 'ng-class'=>'{"has-error": formName.duration.$touched && formName.duration.$invalid}',
						)) }}
				<div class="validation-error" ng-messages="formName.duration.$error" >
					{!! getValidationMessage()!!}
				</div>
				</div>
				
				<?php 
				$duration_type['Day(s)'] = getPhrase( 'Day(s)' );
				$duration_type['Month(s)'] = getPhrase( 'Month(s)' );
				$duration_type['Year(s)'] = getPhrase( 'Year(s)' );
				?>
				<div class="form-group">
				{{ Form::label('duration_type', getPhrase( 'duration_type' ) ) }}
				{{Form::select('duration_type', $duration_type, null, ['class'=>'form-control', "id"=>"status"])}}
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