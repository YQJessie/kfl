angular.module("kfl",['ng','ngRoute','ngAnimate'])
    .controller('parentCtrl',function($scope){
    })
    .controller('startCtrl',function($scope,$location){
        $scope.toMain=function(){
            $location.path('/main');
        }
    })
    .controller('mainCtrl',function($scope,$http){
        $scope.hasMoreData=true;
        $scope.dishList=[];
        $http.get('data/dish_getbypage.php?start=0')
            .success(function(data){
                $scope.dishList=data;
            })
        //$scope.dishList.push({
        //    dname:'酸甜开胃虾',
        //    material:'明虾，番茄酱，白糖，白醋，淀粉，葱，姜',
        //    price:'36.00',
        //    img:'img/p0281.jpg'
        //});
        //$scope.dishList.push({
        //    dname:'桂香紫薯山药卷',
        //    material:'紫薯，铁棍山药，炼乳，桂花粉',
        //    price:'36.00',
        //    img:'img/p2679.jpg'
        //});
        //$scope.dishList.push({
        //    dname:'小米椒爱上小公鸡',
        //    material:'葱，姜，蒜，小米椒，干辣椒，生抽，老抽，麻椒，八角，香叶',
        //    price:'36.00',
        //    img:'img/p4788.jpg'
        //})
        $scope.loadMore=function(){
            $http.get('data/dish_getbypage.php?start='+$scope.dishList.length)
                .success(function(data){
                    if(data.length<5){
                        $scope.hasMoreData=false;
                    }
                    $scope.dishList=$scope.dishList.concat(data);
                })
        }
        ////加载更多
        //$scope.loadMore=function(){
        //    $scope.dishList.push({
        //        dname:'小米椒爱上小公鸡',
        //        material:'葱，姜，蒜，小米椒，干辣椒，生抽，老抽，麻椒，八角，香叶',
        //        price:'36.00',
        //        img:'img/p4788.jpg'
        //    });
        //    $scope.dishList.push({
        //        dname:'小米椒爱上小公鸡',
        //        material:'葱，姜，蒜，小米椒，干辣椒，生抽，老抽，麻椒，八角，香叶',
        //        price:'36.00',
        //        img:'img/p4788.jpg'
        //    });
        //    $scope.dishList.push({
        //        dname:'小米椒爱上小公鸡',
        //        material:'葱，姜，蒜，小米椒，干辣椒，生抽，老抽，麻椒，八角，香叶',
        //        price:'36.00',
        //        img:'img/p4788.jpg'
        //    });
        //}


        //监视Model数据KW的改变，只要一改变就要发起服务器请求
        $scope.$watch('kw',function(){
            if(!$scope.kw){
                return;
            }
            $http.get('data/dish_getbykw.php?kw='+$scope.kw)
                .success(function(data){
                    $scope.dishList=data;
                })
        })
    })
    .controller('detailCtrl',function($scope,$http,$routeParams){
        //console.log($routeParams);
        $http.get('data/dish_getbyid.php?did='+$routeParams.did)
            .success(function(data){
                $scope.dish=data[0];
            })
    })
    .controller('orderCtrl',function($scope,$http,$routeParams){
        $scope.order={did:$routeParams.did};
        $scope.submitOrder=function(){
            var orderData=jQuery.param($scope.order);
            //$http.get('data/order_add.php?'+orderData).success(function(){
            //
            //})
            $http.post('data/order_add.php',orderData).success(function(data){
                console.log('接收服务端返回数据');
                console.log(data);
                if(data.result==ok){

                }

            })
        }
    })
    .controller('myOrderCtrl',function($scope,$http,$routeParams){

    })
    .config(function($routeProvider){
        $routeProvider
            .when('/start',{
                templateUrl:'tpl/start.html',
                controller:'startCtrl'
            })
            .when('/main',{
                templateUrl:'tpl/main.html',
                controller:'mainCtrl'
            })
            .when('/detail/:did',{
                templateUrl:'tpl/detail.html',
                controller:'detailCtrl'
            })
            .when('/order/:did',{
                templateUrl:'tpl/order.html',
                controller:'orderCtrl'
            })
            .otherwise({
                redirectTo:'/start'
            })

    })
    .run(function($http){
        $http.defaults.headers.post={
            'Content-Type':'application/x-www-form-urlencoded'
        };
    })