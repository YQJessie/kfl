/**
 * Created by yaq on 2016/7/11.
 */
angular.module("myM1",['ng','ngRoute','ngAnimate'])
    .controller('myC1',function(){

    })
    .config(function($routeProvider){
        $routeProvider
            .when('/start',{
                templateUrl:'tpl/start.html'
            })
            .when('/main',{
                templateUrl:'tpl/main.html'
            })
            .otherwise({
                redirectTo:'/start'
            })
    })
