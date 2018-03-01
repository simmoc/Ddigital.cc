<script src="{{JS}}angular.js"></script>
 <script src="{{JS}}ngStorage.js"></script>
<script src="{{JS}}angular-messages.js"></script>

<script>
var app = angular.module('digi-downloads', ['ngMessages']);
app.controller('payments_report', function( $scope, $http) {
    
    $scope.initAngData = function() {
     $scope.all_records=1;
    }
   
	$scope.setDetails = function(record_id) {


		if(record_id=='')
            return;
        
        if(record_id === undefined)
            return;
        route = '{{URL_GET_PAYMENT_RECORD}}';  
        data= {_method: 'post', '_token':$scope.getToken(), 'record_id': record_id};
         $scope.payment_record =[];
        $http.post(route, data).then(function(response) {
         console.log(response.data);
        $scope.payment_record = response.data;

       });

	}
	    
	$scope.getToken = function(){
      return  $('[name="_token"]').val();
    }

} 


 );

</script>