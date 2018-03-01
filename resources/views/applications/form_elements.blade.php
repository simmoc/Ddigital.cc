     <div class="box-body">
       <div class="col-md-6">
                <div class="form-group">
                 {{ Form::label('title', 'Title') }}
                 {{ Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'My First Tour',
						)) }}

                </div>
                <div class="form-group">
              	{{ Form::label('description', 'Purpose') }}
               
						{{ Form::textarea('description', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'Enter purpose of the tour', 'rows'=>'4'

							)) }}

                </div>

                  <div class="form-group">
                 {{ Form::label('start_date', 'Travel Start date') }}
                 {{ Form::text('start_date', $value = null , $attributes = array('class'=>'form-control datepicker', 'placeholder' => '2017-01-01','id'=>'dp1'
            )) }}

                </div>

                  <div class="form-group">
                 {{ Form::label('end_date', 'Travel End date') }}
                 {{ Form::text('end_date', $value = null , $attributes = array('class'=>'form-control datepicker', 'placeholder' => '2017-01-03',
            )) }}

                </div> 
               <div class="form-group">
                 {{ Form::label('travel_mode', 'Travel Mode') }}
                 {{ Form::text('travel_mode', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Bus',
            )) }}

                </div>
               
            </div>

            <div class="col-md-6">
            
                  <div class="form-group">
                 {{ Form::label('ticket_cost', 'Ticket Cost') }}
                 {{ Form::text('ticket_cost', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => '22.11',
            )) }}

                </div>
                <div class="form-group">
                 {{ Form::label('cab_cost_home', 'Cab cost at home') }}
                 {{ Form::text('cab_cost_home', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => '22.11',
            )) }}

                </div>
            <div class="form-group">
                 {{ Form::label('cab_cost_destination', 'Cab cost at destination') }}
                 {{ Form::text('cab_cost_destination', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => '22.11',
            )) }}

                </div>
            <div class="form-group">
                 {{ Form::label('hotel_cost', 'Hotel Cost') }}
                 {{ Form::text('hotel_cost', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => '22.11',
            )) }}

                </div>

               
                <div class="form-group">
                {{ Form::label('manager_id', 'Select Manager') }}
               
        {{Form::select('manager_id', $roles, null, ['class'=>'form-control', "id"=>"manager_id"])}}
                </div>
  

          <?php 
              $status['draft'] = 'Draft';
              $status['submitted'] = 'Submit';

          ?>
                <div class="form-group">
                {{ Form::label('status', 'Select') }}
               
        {{Form::select('status', $status, null, ['class'=>'form-control', "id"=>"status"])}}
                </div>
            </div>
              </div>   
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">{{$button_name}}</button>
              </div>

					  


 

					  



					 