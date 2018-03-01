     <div class="box-body">
       <div class="col-md-6">
                
				<div class="form-group">
                 {{ Form::label('title', getPhrase( 'Title' ) ) }} {!! required_field(); !!}
                 {{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Eg: Wordpress Templates' ),)) }}
                </div>
				
				<?php 
				$status['header'] = getPhrase( 'Header' );
				$status['footer'] = getPhrase('Footer');
				$status['content'] = getPhrase('Content');
				?>
				<div class="form-group">
				{{ Form::label('type', getPhrase( 'Select' ) ) }}
				{{Form::select('type', $status, null, ['class'=>'form-control', "id"=>"status"])}}
				</div>
				
				<div class="form-group">
                 {{ Form::label('subject', getPhrase( 'Subject' ) ) }} {!! required_field(); !!}
                 {{ Form::text('subject', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Eg: Wordpress Templates' ),)) }}
                </div>
				
				
				
				               
            </div>

            <div class="col-md-6">
              <div class="form-group">
                 {{ Form::label('from_email', getPhrase( 'from_email' ) ) }} {!! required_field(); !!}
                 {{ Form::text('from_email', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Eg: admin@admin.com' ),)) }}
                </div>
				
				<div class="form-group">
                 {{ Form::label('from_name', getPhrase( 'from_name' ) ) }} {!! required_field(); !!}
                 {{ Form::text('from_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'From Name' ),)) }}
                </div>
				
				<?php 
				$template_types = array();
				$template_types['email'] = getPhrase( 'email' );
				$template_types['sms'] = getPhrase('SMS');
				?>
				<div class="form-group">
				{{ Form::label('template_type', getPhrase( 'Select' ) ) }}
				{{Form::select('template_type', $template_types, null, ['class'=>'form-control', "id"=>"status"])}}
				</div>      
           
			</div>
			
			<div class="col-md-12">
				<div class="form-group">
					{{ Form::label('content', getPhrase( 'content' ) ) }}               
					{{ Form::textarea('content', $value = null, $attributes = array('class'=>'form-control ckeditor', 'placeholder' => getPhrase( 'Content for the template' ), 'rows'=>'4')) }}
					</div>
			</div>
              </div>   
              <!-- /.box-body -->

              <div class="box-footer">
               <div class="btn-center">
                <button type="submit" class="btn btn-primary">{{$button_name}}</button>
                  </div>
              </div>