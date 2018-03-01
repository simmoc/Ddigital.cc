     <div class="box-body">
       <div class="col-md-6">
                
				<div class="form-group">
                 {{ Form::label('title', getPhrase( 'Title' ) ) }} {!! required_field(); !!}
                 {{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'category_name' ),
						)) }}

                </div>
                
				<div class="form-group">
              	{{ Form::label('description', getPhrase( 'Description' ) ) }}               
				{{ Form::textarea('description', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Enter purpose of the category' ), 'rows'=>'4')) }}
                </div>

                  <div class="form-group">
                 {{ Form::label('meta_tag_title', getPhrase( 'Meta tag title' ) ) }}
                 {{ Form::text('meta_tag_title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Meta tag title' ) ) ) }}

                </div>

                  
               <div class="form-group">
                 {{ Form::label('meta_tag_keywords', getPhrase( 'Meta Keywords' ) ) }}
                 {{ Form::text('meta_tag_keywords', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Meta Keywords' ),
            )) }}

                </div>
               
            </div>

            <div class="col-md-6">
           
		   <div class="form-group">
                 {{ Form::label('meta_tag_description', getPhrase( 'Meta Description' ) ) }}
                 {{ Form::textarea('meta_tag_description', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Meta Description' ),'rows'=>'4'
            )) }}

                </div> 
               
                <div class="form-group">
                {{ Form::label('parent_id', getPhrase( 'Select Parent' ) ) }}
               <?php
			   $selected = 0;
			   if($record)
				   $selected = $record->parent_id;
			   ?>
				{{Form::select('parent_id', $parent_categories, $selected, ['class'=>'form-control', "id"=>"parent_id"])}}
                </div>
				
				<div class="form-group">
					{{ Form::label('icon', getPhrase( 'Icon' ) ) }}
					{{ Form::text('icon', $value = null , $attributes = array('class'=>'form-control icp icp-auto', 'placeholder' => getPhrase( 'Icon' ),'data-input-search' => true, )) }}				
				</div>
  

				<?php 
				$status = array(
				'Active' => getPhrase('Active'),
				'Inactive' => getPhrase('Inactive'),
				);

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