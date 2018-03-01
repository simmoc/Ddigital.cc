 <?php echo $__env->make('common.angular-factory', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>

 
 app.controller('searchController', function ($scope, $http, httpPreConfig)
  {
      
      $scope.products = []; 
      $scope.searchtestlenght = 0;
$scope.textChanged = function (text) {
  $scope.searchtestlenght  = text.length;
  route = '<?php echo e(URL_GET_THE_PRODUCTS); ?>';
  data    = {   _method: 'post', 
                  '_token':httpPreConfig.getToken(), 
                  'search_text': text,
               };
               
      httpPreConfig.webServiceCallPost(route, data).then(function(result){
        result = result.data;
        products = [];
 
        angular.forEach(result, function(value, key) {
            products.push(value);
          })

        $scope.products = products;
     
        });

}



});
 
  
</script>