<style> .modal-backdrop {
    position: relative !important;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1040;
    background-color: #000;
}</style>

@if( $purchases->count() > 0 )

	@foreach( $purchases as $data )
	<tr>
		<td class="col1">{{$data->name}}</td>
		<td class="col2">{{currency($data->paid_amount)}}</td>
		<td class="col3">{{$data->payment_gateway}}</td>
		<td class="col4">{{$data->updated_at}}</td>
		@if($data->payment_status=='success')
		<td class="col5"><span class="label label-success">{{getPhrase(ucfirst($data->payment_status))}}</span></td>
		@elseif($data->payment_status=='pending')
         <td class="col5"><span class="label label-info">{{getPhrase(ucfirst($data->payment_status))}}</span></td>
        @elseif($data->payment_status=='cancelled')
        <td class="col5"><span class="label label-danger">{{getPhrase(ucfirst($data->payment_status))}}</span></td>
        @endif
		<td class="col6"><button class="btn btn-info btn-sm" onclick="viewProductDetails({{$data->id}})">{{getPhrase('view_details')}}</button></td>
		
	</tr>
	@endforeach
	@else
		<tr> <td colspan="8" align="center"> {{ getPhrase('No Purchases Found') }} 
	<?php echo sprintf( getPhrase('Click %s to purchase'), '<a href="'.URL_DISPLAY_PRODUCTS.'">'.getPhrase('here').'</a>' );?> </td></tr>
@endif
	{{ $purchases->links() }}


 <div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">{{getPhrase('product_details')}}</h4>
      </div>
      <div class="modal-body">
        <div class="row">
           <div class="col-md-8 col-md-offset-2" id="product_details">
              
           </div>
        </div>
      </div>
      <div class="modal-footer">
      
        <button type="button" class="btn btn-lg btn-default button" data-dismiss="modal">{{ getPhrase('ok')}}</button>
      </div>
    </div>

  </div>
</div>



	@section('footer_scripts')

	<script>
  function viewProductDetails(record_id)
{    

  
    $.ajax({
        url : '{{URL_GET_PAYMENT_PRODUCT_DETAILS}}',
        method:'post',
        data:{
            _token:'{{ Session::token() }}',
            record_id:record_id
        },
        dataType: 'html',
    }).done(function (data) {
        
    $('#product_details').html(data);
        $('#myModal1').modal('show');
    }).fail(function () {
        alert('Posts could not be loaded.');
    });
    
}
</script>
	@stop
