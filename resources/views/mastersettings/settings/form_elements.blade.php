 					

 				 

					 <fieldset class="form-group">

						{{ Form::label('title', getphrase('title')) }}

						<span class="text-red">*</span>

						{{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('title')

							)) }}

						

					</fieldset>



 				 

					 <fieldset class="form-group">
						{{ Form::label('key', getphrase('key')) }}
						<span class="text-red">*</span>
						{{ Form::text('key', $value = null , $attributes = array('class'=>'form-control', 'placeholder' =>  getPhrase('Introduction')							
						 ))}}
					</fieldset>
					
					<fieldset class="form-group">
						{{ Form::label('Parent of', getphrase('parent_id')) }}
						<span class="text-red">*</span>
						{{ Form::select('parent_id', ['0' => getPhrase('Parent')] + $parents, null ,array('class'=>'form-control'							
						 ))}}
					</fieldset>
					
					<fieldset class="form-group">
						{{ Form::label('Status', getphrase('status')) }}
						<span class="text-red">*</span>
						{{ Form::select('status', array('active' => getPhrase('Active'), 'inactive' => getPhrase('In-Active')), null ,array('class'=>'form-control'							
						 ))}}
					</fieldset>



					


					<fieldset class="form-group">

						{{ Form::label('description', getphrase('description')) }}

						{{ Form::textarea('description', $value = null , $attributes = array('class'=>'form-control', 'rows'=>'5', 'placeholder' => getphrase('description_of_the_topic'))) }}

					</fieldset>
                 

						<div class="buttons text-center">

							<button class="btn btn-lg btn-primary button"

							>{{ $button_name }}</button>

						</div>
