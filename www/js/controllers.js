var app = angular.module('starter.controllers', ['ngSanitize','ionic.rating']);

var handleOpenURL = function(url) {
    //alert("RECEIVED URL: " + url);
     var strValue = url;
      strValue = strValue.replace('ionicapp://transactionid=','');
      //window.location.href = strValue + ".html";

    window.localStorage.setItem("external_load", strValue);
};


app.run(function($ionicPlatform,$state) {
  $ionicPlatform.ready(function() {
    if(window.cordova && window.cordova.plugins.Keyboard) {
      // Hide the accessory bar by default (remove this to show the accessory bar above the 
      // for form inputs)
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);

      // Don't remove this line unless you know what you are doing. It stops the viewport
      // from snapping when text inputs are focused. Ionic handles this internally for
      // a much nicer keyboard experience.
      cordova.plugins.Keyboard.disableScroll(true);
      
    }
    if(window.StatusBar) {
      StatusBar.styleDefault();
    }

    if(window.localStorage.getItem("ticketnumber") !== null && window.localStorage.getItem("ticketnumber") !== "")
      {
        //alert("ticket number match");
        var ticketnumber = window.localStorage.getItem("ticketnumber");
        $state.go('sidemenu.response',{ticketnumber:ticketnumber});        
      }else{
        //alert("ticket number no match");
       //window.localStorage.setItem("ticketnumber", '3213131');
        
      }


  });
});






app.constant('myconfig', {
    appName: 'Book4Holiday',
    appVersion: 'development',
    webservicesurl: 'http://book4holiday.com/beta/services',
    imagepathurl: 'http://book4holiday.com/beta//'
});

// (Amar) Controllers And Web Services Start //

// Controllers Start //



app.controller('ResponseCtrl',function($scope,$ionicSlideBoxDelegate,$ionicNavBarDelegate,$state,myconfig,process,webservices){
  $ionicNavBarDelegate.showBackButton(false);
  $scope.ticketnumber = $state.params.ticketnumber;
  //console.log("ticketnumber is: "+ticketnumber);
  $scope.userData = {};
  $scope.res = {};
  $scope.res.success=false;
  $scope.res.failed=false;

   webservices.getUserDetailsWithTicketNumber($scope.ticketnumber).success(function (response) {
        console.clear();
        console.log(response);
        $scope.userData = response[0];
        if ($scope.userData.responsestatus=="Ok") {
          $scope.res.success=true;
          $scope.res.failed=false;
        }else if($scope.userData.responsestatus==""){
          $scope.res.success=false;
          $scope.res.failed=false;
        }else{
          $scope.res.success=false;
          $scope.res.failed=true;
        }
        window.localStorage.setItem("ticketnumber",'');
        //var paymenturl = myconfig.webservicesurl+"/confirmevents.php?data="+encodeURIComponent(JSON.stringify(response));
        
    });




  });

app.controller('HomeCtrl',function($scope,$ionicSlideBoxDelegate,$state,myconfig,process){
  $scope.data = {};
  $scope.imagepathurl = myconfig.imagepathurl;
  
  process.getslidersdata().success(function (response) 
  {
    console.log(response);
    $scope.data = response;
  })

  //console.log("constant value is: "+myconfig.webservicesurl);
  $scope.next = function() {
    $ionicSlideBoxDelegate.next();
  };
  $scope.previous = function() {
    $ionicSlideBoxDelegate.previous();
  };

  // Called each time the slide changes
  $scope.slideChanged = function(index) {
    $scope.slideIndex = index;
  };
  

});


app.controller('TestCtrl',function($scope,$state,$http,webservices,myconfig,$ionicPopup,$sce){
  console.clear();
  $scope.usr = [];
  $scope.usr.urlToSend = $sce.trustAsResourceUrl($state.params.url);

  console.log('url is: '+$scope.usr.urlToSend);

});

app.controller('CheckOutOptionEventCtrl',function($scope,$state,$http,webservices,myconfig,$ionicPopup,$window){
  console.clear();

  $scope.c={};
  $scope.o=[];
  $scope.c.proceedguest=true;
  $scope.c.otpview=false;
  $scope.usertotals = $state.params.usertotals;
  $scope.userselectedoptions = $state.params.userselectedoptions;
  
  if(localStorage.getItem("holidayCustomerEmail") !== null && localStorage.getItem("holidayCustomerEmail") !== ""){
    $scope.c.email = localStorage.getItem("holidayCustomerEmail");
    $scope.c.name = localStorage.getItem("holidayCustomerName");
    $scope.c.mobile = localStorage.getItem("holidayCustomerMobile");
    $scope.o.customerid = localStorage.getItem("holidayCustomerId");
    
    
    webservices.saveUserSelectedSessionAndUserSelectionsAndUserTotalsEvents($scope.c,$scope.o, $scope.usertotals, $scope.userselectedoptions ).success(function (response) {
        console.clear();
        console.log(response);
        var paymenturl = myconfig.webservicesurl+"/confirmevents.php?data="+encodeURIComponent(JSON.stringify(response));
		console.log(paymenturl);
        var finalurl = myconfig.webservicesurl+"/test.php";
        var responseurl = myconfig.webservicesurl+"/responsemulticheckout.php";
                      try {
                          ref = window.open(paymenturl,'_blank','location=no'); //encode is needed if you want to send a variable with your link if not you can use ref = window.open(url,'_blank','location=no');
                               ref.addEventListener('loadstop', LoadStop);
                               ref.addEventListener('exit', Close);
                          }
                          catch (err)    
                          {
                              alert(err);
                          }

                          function LoadStop(event) {
                            
                               //if(event.url == responseurl){
                               if(event.url.match("/ticketnumber")){
                                //alert("event url is: "+event.url);
                                //alert("response is: "+event.url);
                                  // alert("fun load stop runs");
                                  var eventurl = event.url;
                                   ref.close();
                                   var tkt = eventurl.split("/ticketnumber");
                                   //alert("extracted information"+tkt[1]);
                                   window.localStorage.setItem("ticketnumber", tkt[1]);
                                   $window.location.reload(true);
                               }    
                          }
                          function Close(event) {
                               ref.removeEventListener('loadstop', LoadStop);
                               ref.removeEventListener('exit', Close);
                          } 
        //$state.go('sidemenu.test',{url:paymenturl});

        
        //window.location.href=paymenturl;
        //return false;
    });
    
    

  }else{
    
       //console.log($scope.usertotals);
       //console.log($scope.userselectedoptions);
       $scope.check = function(){
         console.log($scope.c.option);
         if ($scope.c.option=='B') {
           $scope.c.proceedguest=true;
           //$scope.c.otpview=false;
         }else{
          $scope.c.proceedguest=true;
          $scope.c.otpview=false;
         }

       }//end of check function

       $scope.submit = function(c){
        
          webservices.sendUserLoginAsGuest(c).success(function (response) {
                  console.clear();
                  $scope.o=response;
                  console.log($scope.o); 
                  $scope.c.proceedguest=true;
                  $scope.c.otpview=true;

                  });

       }//end of submit

       $scope.checkotp = function(c){

        if (c.otp==$scope.o.otp) {
          //OTP matches
         webservices.saveUserSelectedSessionAndUserSelectionsAndUserTotalsEvents($scope.c,$scope.o, $scope.usertotals,   $scope.userselectedoptions ).success(function (response) {
                  console.clear();
                  console.log(response);
                  var paymenturl = myconfig.webservicesurl+"/confirmevents.php?data="+encodeURIComponent(JSON.stringify(response));
                  var finalurl = myconfig.webservicesurl+"/test.php";
                  var responseurl = myconfig.webservicesurl+"/responsemulticheckout.php";
                      try {
                          ref = window.open(paymenturl,'_blank','location=no'); //encode is needed if you want to send a variable with your link if not you can use ref = window.open(url,'_blank','location=no');
                               ref.addEventListener('loadstop', LoadStop);
                               ref.addEventListener('exit', Close);
                          }
                          catch (err)    
                          {
                              alert(err);
                          }

                          function LoadStop(event) {
                            
                               //if(event.url == responseurl){
                               if(event.url.match("/ticketnumber")){
                                //alert("event url is: "+event.url);
                                //alert("response is: "+event.url);
                                  // alert("fun load stop runs");
                                  var eventurl = event.url;
                                   ref.close();
                                   var tkt = eventurl.split("/ticketnumber");
                                   //alert("extracted information"+tkt[1]);
                                   window.localStorage.setItem("ticketnumber", tkt[1]);
                                   $window.location.reload(true);
                               }    
                          }
                          function Close(event) {
                               ref.removeEventListener('loadstop', LoadStop);
                               ref.removeEventListener('exit', Close);
                          } 
                  });

        }else{
            
            var alertPopup = $ionicPopup.alert({
                         title: 'Alert!',
                         template: 'OTP is wrong'
                       });

                       alertPopup.then(function(res) {
                         console.log('Pop up response');
                       });



        }


       }

  }

});


app.controller('checkOutOptionResortsCtrl',function($scope,$state,$http,webservices,myconfig,$ionicPopup,$window){
  console.clear();


  console.clear();
  $scope.c={};
  $scope.o=[];
  $scope.c.proceedguest=true;
  $scope.c.otpview=false;
  $scope.usertotals = $state.params.usertotals;
  $scope.userselectedoptions = $state.params.userselectedoptions;
  $scope.dateofvisit = $state.params.dateofvisit;

  console.log($scope.dateofvisit);

  if(localStorage.getItem("holidayCustomerEmail") !== null && localStorage.getItem("holidayCustomerEmail") !== ""){
    $scope.c.email = localStorage.getItem("holidayCustomerEmail");
    $scope.c.name = localStorage.getItem("holidayCustomerName");
    $scope.c.mobile = localStorage.getItem("holidayCustomerMobile");
    $scope.o.customerid = localStorage.getItem("holidayCustomerId");
    
    
    webservices.saveUserSelectedSessionAndUserSelectionsAndUserTotalsEvents($scope.c,$scope.o, $scope.usertotals, $scope.userselectedoptions ).success(function (response) {
        console.clear();
        console.log(response);
        var paymenturl = myconfig.webservicesurl+"/confirmevents.php?data="+encodeURIComponent(JSON.stringify(response));
        var finalurl = myconfig.webservicesurl+"/test.php";
                  var responseurl = myconfig.webservicesurl+"/responsemulticheckout.php";
                      try {
                          ref = window.open(paymenturl,'_blank','location=no'); //encode is needed if you want to send a variable with your link if not you can use ref = window.open(url,'_blank','location=no');
                               ref.addEventListener('loadstop', LoadStop);
                               ref.addEventListener('exit', Close);
                          }
                          catch (err)    
                          {
                              alert(err);
                          }

                          function LoadStop(event) {
                            
                               //if(event.url == responseurl){
                               if(event.url.match("/ticketnumber")){
                                //alert("event url is: "+event.url);
                                //alert("response is: "+event.url);
                                  // alert("fun load stop runs");
                                  var eventurl = event.url;
                                   ref.close();
                                   var tkt = eventurl.split("/ticketnumber");
                                   //alert("extracted information"+tkt[1]);
                                   window.localStorage.setItem("ticketnumber", tkt[1]);
                                   $window.location.reload(true);
                               }    
                          }
                          function Close(event) {
                               ref.removeEventListener('loadstop', LoadStop);
                               ref.removeEventListener('exit', Close);
                          } 
        //$state.go('sidemenu.test',{url:paymenturl});
        
        //window.location.href=paymenturl;
        //return false;
    });
  }else{

      console.log($scope.usertotals);
      console.log("this is resorts ctrl");

       $scope.check = function(){
         console.log($scope.c.option);
         if ($scope.c.option=='B') {
           $scope.c.proceedguest=true;
         }else{
          $scope.c.proceedguest=true;
         }

       }//end of check function

       $scope.submit = function(c){
        
          webservices.sendUserLoginAsGuest(c).success(function (response) {
                  console.clear();
                  $scope.o=response;
                  console.log($scope.o); 
                  $scope.c.proceedguest=true;
                  $scope.c.otpview=true;

                  });

       }//end of submit

       $scope.checkotp = function(c){

        if (c.otp==$scope.o.otp) {
          //OTP matches
         webservices.saveUserSelectedDataResortSingleCheckOut($scope.c,$scope.o, $scope.usertotals,   $scope.userselectedoptions ).success(function (response) {
                  console.clear();
                  console.log(response);
                  var paymenturl = myconfig.webservicesurl+"/confirm.php?data="+encodeURIComponent(JSON.stringify(response));
                  var finalurl = myconfig.webservicesurl+"/test.php";
                  var responseurl = myconfig.webservicesurl+"/responsemulticheckout.php";
                      try {
                          ref = window.open(paymenturl,'_blank','location=no'); //encode is needed if you want to send a variable with your link if not you can use ref = window.open(url,'_blank','location=no');
                               ref.addEventListener('loadstop', LoadStop);
                               ref.addEventListener('exit', Close);
                          }
                          catch (err)    
                          {
                              alert(err);
                          }

                          function LoadStop(event) {
                            
                               //if(event.url == responseurl){
                               if(event.url.match("/ticketnumber")){
                                //alert("event url is: "+event.url);
                                //alert("response is: "+event.url);
                                  // alert("fun load stop runs");
                                  var eventurl = event.url;
                                   ref.close();
                                   var tkt = eventurl.split("/ticketnumber");
                                   //alert("extracted information"+tkt[1]);
                                   window.localStorage.setItem("ticketnumber", tkt[1]);
                                   $window.location.reload(true);
                               }    
                          }
                          function Close(event) {
                               ref.removeEventListener('loadstop', LoadStop);
                               ref.removeEventListener('exit', Close);
                          } 
                  //$state.go('sidemenu.test',{url:paymenturl});
                  
                  //window.location.href=paymenturl;
                  //return false;
                  });

        }else{
            
            var alertPopup = $ionicPopup.alert({
                         title: 'Alert!',
                         template: 'OTP is wrong'
                       });

                       alertPopup.then(function(res) {
                         console.log('Pop up response');
                       });



        }


       }
    }

  });


app.controller('checkOutOptionCtrl',function($scope,$state,$http,webservices,myconfig,$ionicPopup,$window){
  console.clear();
  $scope.c={};
  $scope.o=[];
  $scope.c.proceedguest=true;
  $scope.c.otpview=false;
  $scope.usertotals = $state.params.usertotals;
  $scope.userselectedoptions = $state.params.userselectedoptions;
  
  if(localStorage.getItem("holidayCustomerEmail") !== null && localStorage.getItem("holidayCustomerEmail") !== ""){
    $scope.c.email = localStorage.getItem("holidayCustomerEmail");
    $scope.c.name = localStorage.getItem("holidayCustomerName");
    $scope.c.mobile = localStorage.getItem("holidayCustomerMobile");
    $scope.o.customerid = localStorage.getItem("holidayCustomerId");
    
    
    webservices.saveUserSelectedSessionAndUserSelectionsAndUserTotalsEvents($scope.c,$scope.o, $scope.usertotals, $scope.userselectedoptions ).success(function (response) {
        console.clear();
        console.log(response);
        var paymenturl = myconfig.webservicesurl+"/confirmevents.php?data="+encodeURIComponent(JSON.stringify(response));
		console.log(paymenturl);
        var finalurl = myconfig.webservicesurl+"/test.php";
                  var responseurl = myconfig.webservicesurl+"/responsemulticheckout.php";
                      try {
                          ref = window.open(paymenturl,'_blank','location=no'); //encode is needed if you want to send a variable with your link if not you can use ref = window.open(url,'_blank','location=no');
                               ref.addEventListener('loadstop', LoadStop);
                               ref.addEventListener('exit', Close);
                          }
                          catch (err)    
                          {
                              alert(err);
                          }

                          function LoadStop(event) {
                            
                               //if(event.url == responseurl){
                               if(event.url.match("/ticketnumber")){
                                //alert("event url is: "+event.url);
                                //alert("response is: "+event.url);
                                  // alert("fun load stop runs");
                                  var eventurl = event.url;
                                   ref.close();
                                   var tkt = eventurl.split("/ticketnumber");
                                   //alert("extracted information"+tkt[1]);
                                   window.localStorage.setItem("ticketnumber", tkt[1]);
                                   $window.location.reload(true);
                               }    
                          }
                          function Close(event) {
                               ref.removeEventListener('loadstop', LoadStop);
                               ref.removeEventListener('exit', Close);
                          } 
        //$state.go('sidemenu.test',{url:paymenturl});
        
        //window.location.href=paymenturl;
        //return false;
    });
  }else{


       $scope.check = function(){
         console.log($scope.c.option);
         if ($scope.c.option=='B') {
           $scope.c.proceedguest=true;
         }else{
          $scope.c.proceedguest=true;
         }

       }//end of check function

       $scope.submit = function(c){
        
          webservices.sendUserLoginAsGuest(c).success(function (response) {
                  console.clear();
                  $scope.o=response;
                  console.log($scope.o); 
                  $scope.c.proceedguest=true;
                  $scope.c.otpview=true;

                  });

       }//end of submit

       $scope.checkotp = function(c){

        if (c.otp==$scope.o.otp) {
          //OTP matches
         webservices.saveUserSelectedSessionAndUserSelectionsAndUserTotals($scope.c,$scope.o, $scope.usertotals,   $scope.userselectedoptions ).success(function (response) {
                  console.clear();
                  console.log(response);
                  var paymenturl = myconfig.webservicesurl+"/confirm.php?data="+encodeURIComponent(JSON.stringify(response));
                  var finalurl = myconfig.webservicesurl+"/test.php";
                  var responseurl = myconfig.webservicesurl+"/responsemulticheckout.php";
                      try {
                          ref = window.open(paymenturl,'_blank','location=no'); //encode is needed if you want to send a variable with your link if not you can use ref = window.open(url,'_blank','location=no');
                               ref.addEventListener('loadstop', LoadStop);
                               ref.addEventListener('exit', Close);
                          }
                          catch (err)    
                          {
                              alert(err);
                          }

                          function LoadStop(event) {
                            
                               //if(event.url == responseurl){
                               if(event.url.match("/ticketnumber")){
                                //alert("event url is: "+event.url);
                                //alert("response is: "+event.url);
                                  // alert("fun load stop runs");
                                  var eventurl = event.url;
                                   ref.close();
                                   var tkt = eventurl.split("/ticketnumber");
                                   //alert("extracted information"+tkt[1]);
                                   window.localStorage.setItem("ticketnumber", tkt[1]);
                                   $window.location.reload(true);
                               }    
                          }
                          function Close(event) {
                               ref.removeEventListener('loadstop', LoadStop);
                               ref.removeEventListener('exit', Close);
                          } 
                  
                  });

        }else{
            
            var alertPopup = $ionicPopup.alert({
                         title: 'Alert!',
                         template: 'OTP is wrong'
                       });

                       alertPopup.then(function(res) {
                         console.log('Pop up response');
                       });

        }


       }

    }
});




app.controller('SingleBookingResortCtrl',function($scope,$state,$http,webservices,myconfig,$ionicPopup){
  console.clear();

console.log("single booking controller");
  $scope.userChoosen = $state.params.obj;
  //popup();
  $scope.data={};
  $scope.data.kidsmealqty=0;
  $scope.calculatedData=[];
  $scope.dateofvisit = $state.params.dateofvisit;



  $scope.submit= function(){
    console.log($scope.calculatedData); 
    console.log($scope.userChoosen); 
   
    $state.go('sidemenu.checkoutoptionresorts',{usertotals:$scope.calculatedData,userselectedoptions:$scope.userChoosen});
  }

$scope.taxBreakUp = function(){

  var alertPopup = $ionicPopup.alert({
     title: 'Tax Break Up',
     template: '<div class="row"><div class="col col-50 tax-col">Internet Handling Charges:</div> <div class="col col-50 text-right tax-col"style="float:right">Rs.' +$scope.calculatedData.internetchargeswithouttotal+
'</div></div><div class="row"><div class="col col-50 tax-col">Service tax :</div> <div class="col col-50 text-right tax-col"style="float:right">Rs '+$scope.calculatedData.servicetax+
'</div></div><div class="row"><div class="col col-50 tax-col">Swachh Bharat :</div><div class="col col-50 text-right tax-col"style="float:right"> Rs '+$scope.calculatedData.swachcess+
'</div></div><div class="row"><div class="col col-50 tax-col">Krishi Cess : </div><div class="col col-50 text-right tax-col"style="float:right">Rs '+$scope.calculatedData.krishicess+'</div></div>'
   });

   alertPopup.then(function(res) {
     console.log('Thank you for not eating my delicious ice cream cone');
   });
  
}


        webservices.sendUserSelectedOptionsToServerResortBooking($scope.userChoosen,$scope.dateofvisit).success(function (response) {
                   //console.log(response); 

                   $scope.calculatedData=response;
                   
                   //$scope.calculatedData.push({'dateofvisit':$scope.dateofvisit},{obj:response});
                   $scope.calculatedData.dateofvisit=$scope.dateofvisit;
                   // console.log($scope.calculatedData); 
                   // console.log($scope.userChoosen); 
                   //console.log("date of visit aadded in onbject si: "+$scope.calculatedData.dateofvisit);  
                   console.log(response);  
                  })



});



app.controller('MultiBookingCtrl',function($scope,$state,$http,webservices,myconfig,$ionicPopup){
  console.clear();
  //console.clear();
  $scope.userChoosen = $state.params.obj;
  popup();
  $scope.data={};
  $scope.data.kidsmealqty=0;
  $scope.calculatedData={};
  $scope.dateofvisit = $state.params.dateofvisit;

  console.log($scope.dateofvisit);

  $scope.submit= function(){
    console.log($scope.calculatedData); 
    console.log($scope.userChoosen); 
   
    $state.go('sidemenu.checkoutoption',{ dateofvisit:$scope.dateofvisit, usertotals:$scope.calculatedData,userselectedoptions:$scope.userChoosen});
  }

$scope.taxBreakUp = function(){

  var alertPopup = $ionicPopup.alert({
     title: 'Tax Break Up',
	 
     template: '<div class="row"><div class="col col-50 tax-col">Internet Handling Charges:</div> <div class="col col-50 text-right tax-col"style="float:right">Rs.' +$scope.calculatedData.internetchargeswithouttotal+
'</div></div><div class="row"><div class="col col-50 tax-col">Service tax :</div> <div class="col col-50 text-right tax-col"style="float:right">Rs '+$scope.calculatedData.servicetax+
'</div></div><div class="row"><div class="col col-50 tax-col">Swachh Bharat :</div><div class="col col-50 text-right tax-col"style="float:right"> Rs '+$scope.calculatedData.swachcess+
'</div></div><div class="row"><div class="col col-50 tax-col">Krishi Cess : </div><div class="col col-50 text-right tax-col"style="float:right">Rs '+$scope.calculatedData.krishicess+'</div></div>'
   });

   alertPopup.then(function(res) {
     //console.log('Thank you for not eating my delicious ice cream cone');
   });
  
}
  
      
 




       function popup(){
          //alert("hello");
           // An elaborate, custom popup
            var myPopup = $ionicPopup.show({
              template: '<img src="http://book4holiday.com/beta/assets/frontend/img/BK-Kids-Meal.jpg" class="full-image"/><br/><input type="number" ng-model="data.kidsmealqty" class="kidmealtextbox" placeholder="Enter Kids Meal Quantity" value="0">',
              title: 'Enter Kids Meal Quantity',
              scope: $scope,
              buttons: [
                { text: 'Skip' },
                {
                  text: '<b>Ok</b>',
                  type: 'button-balanced',
                  onTap: function(e) {
                    if ($scope.data.kidsmealqty!=0) {
                      //don't allow the user to close unless he enters wifi password
                      //console.log('inside if condition');
                      //e.preventDefault();
                    } else {
                      return $scope.data.kidsmealqty;
                    }
                  }
                }
              ]
            });

            myPopup.then(function(res) {
              //console.log('Tapped!', res);
              
              
              
                webservices.sendUserSelectedOptionsToServer($scope.userChoosen,$scope.data.kidsmealqty,$scope.dateofvisit).success(function (response) {
                   console.log(response); 

                   $scope.calculatedData=response;
                   
                   //$scope.calculatedData.push({'dateofvisit':$scope.dateofvisit},{obj:response});
                   //$scope.calculatedData.dateofvisit=$scope.dateofvisit;
                  // console.log($scope.calculatedData); 
                  // console.log($scope.userChoosen); 
                   //console.log("date of visit aadded in on object si: "+$scope.calculatedData.dateofvisit);  
                  })
                          
            });


        }//end of popup function

  });

app.controller('MultiCheckOutCtrl',function($scope,$state,$http,webservices,myconfig,$ionicPopup){
      console.clear();
      //alert("hello");
        $scope.date = new Date();
        $scope.userChoosen = {};
       $scope.resortid = $state.params.resortid;

       //console.log("MulticheckoutCtrl id is: "+$scope.resortid);

      $scope.userBookingDetails = {};
      $scope.usrdata={};
      $scope.errorStatus=false;
      
       webservices.getPackagesBasedOnResortId($scope.resortid).success(function(data) {
            //console.log("Inside MultiCheckOutCtrl controller : "+data[0].bannerimage); 
            $scope.userBookingDetails = data;
            //console.clear();
            //console.log(data);

        });


       $scope.proceed  = function(){
       
          $scope.count = 0;
          $scope.userChoosen = [];
          console.log($scope.userBookingDetails); 
          angular.forEach($scope.userBookingDetails, function(item){
                   
                   $scope.userChoosen.push({
                    packageid:item.packageid,
                    adultqty:item.mobileadultqty,
                    childqty:item.mobilechildqty
                   });

                   //alert(item.mobileadultqty);

                    if ((item.mobileadultqty==0 && item.mobilechildqty==0)  || (item.mobileadultqty==undefined && item.mobilechildqty==undefined)) {
                      //alert("Please book atleast one ticket");
                      $scope.count++;
                   } 

               });
      			  
              if ($scope.usrdata.dateofvisit==undefined) {
                         var alertPopup2 = $ionicPopup.alert({
                         title: 'Alert!',
                         template: 'Please choose a date'
                       });
                     
                   }else if($scope.count==$scope.userBookingDetails.length){
             
                        //alert("Please select a date");
            var alertPopup = $ionicPopup.alert({
                         title: 'Alert!',
                         template: 'Please book atleast one ticket'

                       });

                       alertPopup2.then(function(res) {
                          console.log("date choosen :"+$scope.usrdata.dateofvisit);
                       });
             
                   }else{
                    $scope.errorStatus=false;
                    
                    //alert("else part");
                    console.log("count is: "+$scope.count); 
                    $state.go('sidemenu.multibooking', {obj: $scope.userChoosen,dateofvisit:$scope.usrdata.dateofvisit});
                   } 
                 
         
       }//end of proceed
       
});


app.controller('SingleBookingCtrl',function($scope,$state,$http,webservices,myconfig,$ionicPopup){
  console.clear();
  $scope.userChoosen = $state.params.useroptions;
  $scope.dateofvisit = $state.params.dateofvisit;
  $scope.calculatedUserData = {};

  //console.log($state.params);
  console.table($scope.userChoosen);
  

  webservices.calculateEventsSingleCheckoutUserSelectedOptions($scope.userChoosen,$scope.dateofvisit).success(function(data) {
        
        $scope.calculatedUserData = data; 
        console.log($scope.calculatedUserData);

        });

 $scope.proceed = function(){

     $state.go('sidemenu.checkoutoptionevents',{ usertotals: $scope.calculatedUserData , userselectedoptions: $scope.userChoosen });

  }

  $scope.taxBreakUp = function(){

  var alertPopup = $ionicPopup.alert({
     title: 'Tax Break Up',
          template: '<div class="row"><div class="col col-50 tax-col">Internet Handling Charges:</div> <div class="col col-50 text-right tax-col"style="float:right">Rs.' +$scope.calculatedUserData.internetchargeswithouttotal+
'</div></div><div class="row"><div class="col col-50 tax-col">Service tax :</div> <div class="col col-50 text-right tax-col" style="float:right">Rs '+$scope.calculatedUserData.servicetax+
'</div></div><div class="row"><div class="col col-50 tax-col">Swachh Bharat :</div><div class="col col-50 text-right tax-col tax-col" style="float:right"> Rs '+$scope.calculatedUserData.swachcess+
'</div></div><div class="row"><div class="col col-50 tax-col">Krishi Cess : </div><div class="col col-50 text-right tax-col" style="float:right">Rs '+$scope.calculatedUserData.krishicess+'</div></div>'
   });

   alertPopup.then(function(res) {
     console.log('Thank you for not eating my delicious ice cream cone');
   });
  
}




});

app.controller('EventSingleCheckOutCtrl',function($scope,$state,$http,webservices,myconfig,$ionicPopup){
  console.clear();
  $scope.date = new Date();
        $scope.userChoosen = {};
       $scope.packageid = $state.params.packageid;
       $scope.userBookingDetails={};
       //console.log("EventSingleCheckOutCtrl id is: "+$scope.packageid);

      $scope.userBookingDetails = {};
      $scope.usrdata = {};
      $scope.errorStatus=false;
       webservices.getEventPackagesBasedOnPackageId($scope.packageid).success(function(data) {
        //console.log("Inside MultiCheckOutCtrl controller : "+data[0].bannerimage); 
            $scope.userBookingDetails = data;
			//console.log(data);
			
			$scope.maxdate = data[0].todate;
			$scope.mindate = data[0].fromdate;
			
			console.log($scope.mindate);
			

        });
		
       $scope.proceed  = function(){
          $scope.count = 0;
          $scope.userChoosen = [];
          angular.forEach($scope.userBookingDetails, function(item){
                   
                   $scope.userChoosen.push({
                    packageid:item.packageid,
                    adultqty:item.mobileadultqty,
                    childqty:item.mobilechildqty
                   });

                   if (item.mobileadultqty==0 && item.mobilechildqty==0) {
                      //alert("Please book atleast one ticket");
                      $scope.count++;
                   } 

                   
               });
                  if($scope.usrdata.dateofvisit==undefined){

                    $scope.errorStatus=true;

                    var alertPopup2 = $ionicPopup.alert({
                         title: 'Alert!',
                         template: 'Please choose a date'
                       });

                       alertPopup2.then(function(res) {
                         //console.log('Thank you for not eating my delicious ice cream cone');
                       });



                   }else if($scope.count==$scope.userBookingDetails.length){
                    $scope.errorStatus=true;

                    var alertPopup = $ionicPopup.alert({
                         title: 'Alert!',
                         template: 'Please book atleast one ticket'
                       });

                       alertPopup.then(function(res) {
                         console.log('Thank you for not eating my delicious ice cream cone');
                       });


                   }else{
                    $scope.errorStatus=false;
                    console.log($scope.userChoosen);
                    //console.log($scope.usrdata.dateofvisit);
                    $state.go('sidemenu.singlebooking', { useroptions: $scope.userChoosen,dateofvisit: $scope.usrdata.dateofvisit }, { reload: true });
                   }
          //console.log("count is: "+count); 
          //console.log($scope.userChoosen); 
          //$state.go('multibooking', {obj: $scope.userChoosen});
       }//end of proceed
       
});



app.controller('ResortSingleCheckOutCtrl',function($scope,$state,$http,webservices,myconfig,$ionicPopup){
  console.clear();
$scope.date = new Date();
  //alert("asdf");
        //console.log("this is single checkout resort");
        $scope.usrdata={};
        $scope.userChoosen = {};
       $scope.packageid = $state.params.packageid;

       console.log("SingleCheckOutCtrl id is: "+$scope.packageid);

      $scope.userBookingDetails = {};
      $scope.errorStatus=false;
       webservices.getPackagesBasedOnResortIdToShowPrice($scope.packageid).success(function(data) {
        //console.log("Inside MultiCheckOutCtrl controller : "+data[0].bannerimage); 
		console.log(data);
            $scope.userBookingDetails = data;
             

        });


       $scope.proceed  = function(){
          $scope.count = 0;
          $scope.userChoosen = [];
          angular.forEach($scope.userBookingDetails, function(item){
                   
                   $scope.userChoosen.push({
                    packageid:item.packageid,
                    adultqty:item.mobileadultqty,
                    childqty:item.mobilechildqty
                   });

                   if (item.mobileadultqty==0 && item.mobilechildqty==0) {
                      //alert("Please book atleast one ticket");
                      $scope.count++;
                   } 

                   
               });
                  if($scope.usrdata.dateofvisit==undefined){

                    var alertPopup2 = $ionicPopup.alert({
                         title: 'Alert!',
                         template: 'Please choose a date'
                       });

                       alertPopup2.then(function(res) {
                         //console.log('Thank you for not eating my delicious ice cream cone');
                       });



                   }else if($scope.count==$scope.userBookingDetails.length){
                    $scope.errorStatus=true;

                    var alertPopup = $ionicPopup.alert({
                         title: 'Alert!',
                         template: 'Please book atleast one ticket'
                       });

                       alertPopup.then(function(res) {
                         console.log('Thank you for not eating my delicious ice cream cone');
                       });


                   }else{

                    $scope.errorStatus=false;
                    $state.go('sidemenu.singlebookingresort', { obj: $scope.userChoosen,dateofvisit : $scope.usrdata.dateofvisit });

                   }
          //console.log("count is: "+count); 
          //console.log($scope.userChoosen); 
          //$state.go('multibooking', {obj: $scope.userChoosen});
       }//end of proceed
       
});



app.controller('ResortDetailsCtrl',function($scope,$state,$http,webservices,myconfig,$ionicPopup){
  console.clear();
        $scope.date = new Date();
       $scope.resortid = $state.params.id;
		$scope.data={};
	   
		//$scope.data.comments;
       //console.log("details id is: "+$scope.i;
       $scope.userBookingDetails = {};
       $scope.reviewsdata = {};
       $scope.imagepathurl = myconfig.imagepathurl;
    // $scope.userBookingDetails = {};
      $scope.errorStatus=false;
        webservices.getPackagesBasedOnResortId($scope.resortid).success(function(data) {
        //console.log("Inside ResortDetails controller : "+data[0].bannerimage); 
            console.clear();
          console.log(data); 
          
		  if(!data[0].packageid){
			$scope.nopackage=true;
			$scope.package=false;
			$scope.userBookingDetails = data;
		  }else{
			  $scope.nopackage=false;
			  $scope.package=true;
			  $scope.userBookingDetails = data;
		  }
        });
			
        
		webservices.getResortReviews($scope.resortid).success(function(reviewsdata) {
          //console.clear();
          //console.log(reviewsdata); 
          $scope.rrating = {};
		  if(!reviewsdata[0].packageid){
			$scope.noreviews=true;
			$scope.reviews=false;
			$scope.eventreviews = reviewsdata;
		  }else{
			  $scope.noreviews=false;
			  $scope.reviews=true;
			  $scope.eventreviews = reviewsdata;
			 
		  }
        });
    if($scope.resortid!=1){
  $scope.resortsSingleCheckout = function(myresortid){
        //console.log("Resort id is: "+myresortid);
        $state.go('sidemenu.singlecheckout', {"packageid": myresortid});
       }
    }
	$scope.submitresortreview = function(){

	  var alertPopup = $ionicPopup.alert({
		 title: 'Submit Review', scope: $scope,
		 template: '<div class="list"><center><rating name="rating" ng-model="data.rating" max="5"></rating></center><label class="item item-input"><input type="text" ng-model="data.subject" name="subject" placeholder="Subject"></label><label class="item item-input"><textarea name="review" ng-model="data.review" placeholder="Comments"></textarea></label></div>',
		 buttons: [
		 { text: 'Cancel' },
		 {
                  text: '<b>Ok</b>',
                  type: 'button-balanced',
                  onTap: function(e) {
                    if ($scope.data.review!="") {
						
						} else {
                      return $scope.data;
                    }
                  }
                }
			]
		 });
	

   alertPopup.then(function(res) {
	  $scope.data.customerid = localStorage.getItem("holidayCustomerId");
              webservices.submitResortReviews($scope.data,$scope.resortid).success(function (response) {
                   console.clear();
				   console.log(response); 

                 
                  })
              
                          
            });

  
  
}

});

app.controller('ZooCtrl',function($scope,$state,$http,$window,webservices,myconfig,$ionicPopup){
  console.clear();
        
       $scope.resortid = $state.params.id;

       //console.log("details id is: "+$scope.resortid);
       $scope.userBookingDetails = {};
       $scope.reviewsdata = {};
       $scope.imagepathurl = myconfig.imagepathurl;
	   		$scope.data={};
			$scope.rating={};
    // $scope.userBookingDetails = {};
      $scope.errorStatus=false;
        webservices.getPackagesForZoo($scope.resortid).success(function(data) {
        //console.log("Inside ResortDetails controller : "+data[0].bannerimage); 
            $scope.userBookingDetails = data;
            console.log(data);
        });
		
		webservices.getResortReviews($scope.resortid).success(function(reviewsdata) {
          console.clear();
          //console.log(reviewsdata); 
          $scope.eventreviews = reviewsdata;
		  // console.log($scope.eventreviews.pricereview);
			//  for(i=0;i<=reviewsdata.pricereview;i++){
			//	  reviewsdata.pricereview;
			//	  console.log(reviewsdata.pricereview);
			//  }
        });
       $scope.resortsMultiCheckout = function(myresortid){
        //console.log("Resort id is: "+myresortid);
        //alert(myresortid);
       $state.go('sidemenu.multicheckout', {"resortid": myresortid});
        //$state.go('multicheckout/'+myresortid);
       }
	   $scope.submitzooreview = function(){

	  var alertPopup = $ionicPopup.alert({
		 title: 'Submit Review', scope: $scope,
		 template: '<div class="list"><center><rating name="rating" ng-model="data.rating" max="5"></rating></center><label class="item item-input"><input type="text" ng-model="data.subject" name="subject" placeholder="Subject"></label><label class="item item-input"><textarea name="review" ng-model="data.review" placeholder="Comments"></textarea></label></div>',
		 buttons: [
		 { text: 'Cancel' },
		 {
                  text: '<b>Ok</b>',
                  type: 'button-balanced',
                  onTap: function(e) {
                    if ($scope.data.review!="") {
						
						} else {
                      return $scope.data;
                    }
                  }
                }
			]
		 });
	

   alertPopup.then(function(res) {
	  $scope.data.customerid = localStorage.getItem("holidayCustomerId");
              webservices.submitResortReviews($scope.data,$scope.resortid).success(function (response) {
                   console.clear();
				   console.log(response); 
					$window.location.reload(true);
                 
                  })
              
                          
            });

  
  
}
	   

});

app.controller('EventDetailsCtrl',function($scope,$state,$http,$window,webservices,myconfig,$ionicPopup){
  console.clear();
        console.clear();
       $scope.eventid = $state.params.id;
	   $scope.nopackage=false;
       $scope.data={};
       //console.log("details id is: "+$scope.eventid);
       $scope.userBookingDetails = {};
       $scope.eventreviews = {};
       $scope.imagepathurl = myconfig.imagepathurl;
    
      $scope.errorStatus=false;
        webservices.getPackagesBasedOnEventId($scope.eventid).success(function(data) {
          console.clear();
          console.log(data); 
          
		  if(!data[0].packageid){
			$scope.nopackage=true;
			$scope.package=false;
			$scope.userBookingDetails = data;
		  }else{
			  $scope.nopackage=false;
			  $scope.package=true;
			  $scope.userBookingDetails = data;
		  }
        });
		
        webservices.getEventReviews($scope.eventid).success(function(reviewsdata) {
          //console.clear();
          //console.log(reviewsdata); 
          //$scope.eventreviews = reviewsdata;
		  if(!reviewsdata[0].packageid){
			$scope.noreviews=true;
			$scope.reviews=false;
			$scope.eventreviews = reviewsdata;
		  }else{
			  $scope.noreviews=false;
			  $scope.reviews=true;
			  $scope.eventreviews = reviewsdata;
		  }
        });

       $scope.resortsSingleCheckout = function(myresortid){
        //console.log("Resort id is: "+myresortid);
        $state.go('singlecheckout', {"packageid": myresortid});
       }
       $scope.submitresortreview = function(){

	  var alertPopup = $ionicPopup.alert({
		 title: 'Submit Review', scope: $scope,
		 template: '<div class="list"><center><rating name="rating" ng-model="data.rating" max="5"></rating></center><label class="item item-input"><input type="text" ng-model="data.subject" name="subject" placeholder="Subject"></label><label class="item item-input"><textarea name="review" ng-model="data.review" placeholder="Comments"></textarea></label></div>',
		 buttons: [
		 { text: 'Cancel' },
		 {
                  text: '<b>Ok</b>',
                  type: 'button-balanced',
                  onTap: function(e) {
                    if ($scope.data.review!="") {
						
						} else {
                      return $scope.data;
                    }
                  }
                }
			]
		 });
	

   alertPopup.then(function(res) {
	  $scope.data.customerid = localStorage.getItem("holidayCustomerId");
              webservices.submitEventReviews($scope.data,$scope.eventid).success(function (response) {
                   //console.clear();
				   $window.location.reload(true);
				   //console.log(response); 
					
                 
                  })
              
                          
            });

  
  
}

});

app.controller('PlaceDetailsCtrl',function($scope,$state,$http,webservices,myconfig,$ionicPopup,$window){
  console.clear();
        
       $scope.placeid = $state.params.id;
		$scope.data={};
       //console.log("details id is: "+$scope.eventid);
       $scope.userBookingDetails = {};
       $scope.reviewsdata = {};
       $scope.imagepathurl = myconfig.imagepathurl;
		 
      $scope.errorStatus=false;
        webservices.getPlaceDetailsOnPlaceId($scope.placeid).success(function(data) {
        //console.log("Inside ResortDetails controller : "+data[0].bannerimage); 
            $scope.userBookingDetails = data;
        });
		
		webservices.getPlaceReviews($scope.placeid).success(function(reviewsdata) {
          //console.clear();
          //console.log(reviewsdata); 
          
		  if(!reviewsdata[0].packageid){
			$scope.noreviews=true;
			$scope.reviews=false;
			$scope.eventreviews = reviewsdata;
		  }else{
			  $scope.noreviews=false;
			  $scope.reviews=true;
			  $scope.eventreviews = reviewsdata;
			  $scope.rating=[];
			  for(i=0;i<=reviewsdata.pricereview;i++){
				  $scope.rating[i];
			  }
		  }
        });
		$scope.submitresortreview = function(){

	  var alertPopup = $ionicPopup.alert({
		 title: 'Submit Review', scope: $scope,
		 template: '<div class="list"><center><rating name="rating" ng-model="data.rating" max="5"></rating></center><label class="item item-input"><input type="text" ng-model="data.subject" name="subject" placeholder="Subject"></label><label class="item item-input"><textarea name="review" ng-model="data.review" placeholder="Comments"></textarea></label></div>',
		 buttons: [
		 { text: 'Cancel' },
		 {
                  text: '<b>Ok</b>',
                  type: 'button-balanced',
                  onTap: function(e) {
                    if ($scope.data.review!="") {
						
						} else {
                      return $scope.data;
                    }
                  }
                }
			]
		 });
	

   alertPopup.then(function(res) {
	  $scope.data.customerid = localStorage.getItem("holidayCustomerId");
              webservices.submitPlaceReviews($scope.data,$scope.placeid).success(function (response) {
                   //console.clear();
				   $window.location.reload(true);
				   //console.log(response); 
					 
                 
                  })
              
                         
            });

			
 
  
}
});



app.controller('ResortSearchCtrl',function($scope,$state,$http,webservices,myconfig){
  console.clear();

  $scope.search={};

  $scope.searchresult=[];
        
       $scope.searchtype = $state.params.searchtype;

      // console.log("search type is: "+$scope.searchtype);

      $scope.resortsData={};
      $scope.imagepathurl = myconfig.imagepathurl;
    
     webservices.getResorts().success(function(data) { 
          $scope.resortsData = data;
          console.log(data);
      });


     $scope.onSearchChange = function(){

        webservices.getResortsBasedOnSearchCriteria($scope.search.name).success(function(data) {
            $scope.searchresult=data;
            //console.log("hellos this is test"+$scope.search.name);
            console.log($scope.searchresult);
        });
    
      }





       $scope.bookThisResort = function(resortid){
          alert("clicked resort id is: "+resortid);
       }


});



app.controller('EventSearchCtrl',function($scope,$state,$http,webservices,myconfig){
  console.clear();

   $scope.search={};

        $scope.searchresult=[];
        
        
       $scope.searchtype = $state.params.searchtype;

       //console.log("search type is: "+$scope.searchtype);


        $scope.eventsData={};
        $scope.imagepathurl = myconfig.imagepathurl;
        //alert("these are events");
         webservices.getEvents().success(function(data) { 
          console.clear();
            $scope.eventsData = data;
            console.log($scope.eventsData);
        });


       $scope.bookThisEvent = function(eventid){
          alert("clicked event id is: "+eventid);
       }

       $scope.onSearchChange = function(){

        console.log("date is: "+$scope.search.date);
        webservices.getEventsBasedOnSearchCriteria($scope.search.name,$scope.search.date).success(function(data) {
        $scope.searchresult=data; 
            //console.log("hellos this is test"+$scope.search.name);
            console.log($scope.searchresult);
        });    
}



});


app.controller('PlaceSearchCtrl',function($scope,$state,$http,webservices,myconfig){
  console.clear();

   $scope.search={};

        $scope.searchresult=[];
        
        
       $scope.searchtype = $state.params.searchtype;

       //console.log("search type is: "+$scope.searchtype);

        $scope.placesData={};
        $scope.imagepathurl = myconfig.imagepathurl;
        //alert("these are events");
         webservices.getPlaces().success(function(data) { 
            $scope.placesData = data;
        });

       $scope.bookThisPlace = function(placeid){
          alert("clicked place id is: "+placeid);
       }

        $scope.onSearchChange = function(){

        webservices.getPlacesBasedOnSearchCriteria($scope.search.name).success(function(data) {
            $scope.searchresult=data;
            //console.log("hellos this is test"+$scope.search.name);
            console.log($scope.searchresult);
        });
    
      }


});

// Controllers End //

// factory -- webservices start //

app.factory('webservices', function($http,myconfig){


  return {

    getResorts: function(){
      return $http.get(myconfig.webservicesurl+'/resortpull.php')
        .success(function(data, status, headers,config){
          console.log('data success');
          console.log("Data Length: "+data.length+"\n"); // for browser console
          console.log("Data Is: "+data[0].resortid); // for browser console
          //return data; // for UI
        })
        .error(function(data, status, headers,config){
          console.log('data error');
        })


    },//getresorts end

    getEventsBasedOnSearchCriteria: function(searchkeyword,searchdate)
    {

      var url = myconfig.webservicesurl+'/getEventsBasedOnSearchCriteria.php';
      return $http.post(url, {search:searchkeyword,searchdate:searchdate})
      
    },

    getResortsBasedOnSearchCriteria: function(searchkeyword)
    {

      var url = myconfig.webservicesurl+'/getResortsBasedOnSearchCriteria.php';
      return $http.post(url, {search:searchkeyword})
      
    },//

    getPlacesBasedOnSearchCriteria: function(searchkeyword)
    {

      var url = myconfig.webservicesurl+'/getPlacesBasedOnSearchCriteria.php';
      return $http.post(url, {search:searchkeyword})
      
    },



    getEvents: function(){
      return $http.get(myconfig.webservicesurl+'/eventpull.php')
        .success(function(data, status, headers,config){
          console.log('data success');
          console.log("Data Length: "+data.length+"\n"); // for browser console
          console.log("Data Is: "+data[0].resortid); // for browser console
          //return data; // for UI
        })
        .error(function(data, status, headers,config){
          console.log('data error');
        })


    },//getEvents end

    getPlaces: function(){
      return $http.get(myconfig.webservicesurl+'/placepull.php')
        .success(function(data, status, headers,config){
          console.log('data success');
          console.log("Data Length: "+data.length+"\n"); // for browser console
          console.log("Data Is: "+data[0].resortid); // for browser console
          //return data; // for UI
        })
        .error(function(data, status, headers,config){
          console.log('data error');
        })



    },//getPlaces end   

    getResortsBasedOnResortId: function(resortid){
      var url = myconfig.webservicesurl+'/resortIdDetails.php?resortid='+resortid;
      console.log("url is: "+url);
      return $http.get(url)
        .success(function(data, status, headers,config){
          console.log('data success');
          console.log("Data Length: "+data.length+"\n"); // for browser console
          console.log("Data Is: "+data[0].resortid); // for browser console
          //return data; // for UI
        })
        .error(function(data, status, headers,config){
          console.log('data error');
        })


    },//getResortsBasedOnResortId end    

    getPackagesBasedOnResortId: function(resortid){
      var url = myconfig.webservicesurl+'/resortIdPackages.php?resortid='+resortid;
      console.log("url is: "+url);
      return $http.get(url)
        .success(function(data, status, headers,config){
          //console.log('data success');
          //console.log("Data Length: "+data.length+"\n"); // for browser console
          //console.log("Data Is: "+data[0].bannerimage); // for browser console
          //return data; // for UI
        })
        .error(function(data, status, headers,config){
          console.log('data error');
        })
    
  


    },//getPackagesBasedOnPackageId Start
  

  getPlaceDetailsOnPlaceId: function(placeid){
      var url = myconfig.webservicesurl+'/placedetails.php?placeid='+placeid;
      console.log("url is: "+url);
     console.log("Place ID is: "+placeid); 
    return $http.get(url)
        .success(function(data, status, headers,config){
          console.log('data success');
          console.log("Data Length: "+data.length+"\n"); // for browser console
          console.log("Data Is: "+data[0].bannerimage); // for browser console
          //return data; // for UI
        })
        .error(function(data, status, headers,config){
          console.log('data error');
        })
  },
  
  getPackagesBasedOnEventId: function(eventid){
      var url = myconfig.webservicesurl+'/eventIdPackages.php?eventid='+eventid;
      console.log("url is: "+url);
     console.log("Event ID is: "+eventid); 
    return $http.get(url)
        .success(function(data, status, headers,config){
          //console.log('data success');
          //console.log("Data Length: "+data.length+"\n"); // for browser console
          console.log("Data Is: "+data[0].bannerimage); // for browser console
          //return data; // for UI
        })
        .error(function(data, status, headers,config){
          console.log('data error');
        })
  },
  getEventReviews: function(eventid){
      var url = myconfig.webservicesurl+'/getEventReviews.php?eventid='+eventid;
      console.log("url is: "+url);
     console.log("Event ID is: "+eventid); 
    return $http.get(url)
        .success(function(reviewsdata, status, headers,config){
          //console.log('data success');
          //console.log("Data Length: "+data.length+"\n"); // for browser console
          console.log("Data Is: "+reviewsdata[0].bannerimage); // for browser console
          //return data; // for UI
        })
        .error(function(reviewsdata, status, headers,config){
          console.log('data error');
        })
  },
  getResortReviews: function(resortid){
      var url = myconfig.webservicesurl+'/getResortReviews.php?eventid='+resortid;
      console.log("url is: "+url);
     console.log("Resort ID is: "+resortid); 
    return $http.get(url)
        .success(function(reviewsdata, status, headers,config){
          //console.log('data success');
          //console.log("Data Length: "+data.length+"\n"); // for browser console
          console.log("Data Is: "+reviewsdata[0].bannerimage); // for browser console
          //return data; // for UI
        })
        .error(function(reviewsdata, status, headers,config){
          console.log('data error');
        })
  },
	getPlaceReviews: function(resortid){
      var url = myconfig.webservicesurl+'/getPlaceReviews.php?placeid='+resortid;
      console.log("url is: "+url);
     console.log("Resort ID is: "+resortid); 
    return $http.get(url)
        .success(function(reviewsdata, status, headers,config){
          //console.log('data success');
          //console.log("Data Length: "+data.length+"\n"); // for browser console
          console.log("Data Is: "+reviewsdata[0].bannerimage); // for browser console
          //return data; // for UI
        })
        .error(function(reviewsdata, status, headers,config){
          console.log('data error');
        })
  },
  
   getPackagesBasedOnPackageId: function(packageid){
      var url = myconfig.webservicesurl+'/getPackages.php?packageid='+packageid;
      console.log("url is: "+url);
      return $http.get(url)
        .success(function(data, status, headers,config){
          console.log('data success');
          console.log("Data Length: "+data.length+"\n"); // for browser console
          console.log("Data Is: "+data[0].bannerimage); // for browser console
          //return data; // for UI
        })
        .error(function(data, status, headers,config){
          console.log('data error');
        })


    },//getPackagesBasedOnPackageId end    

  getEventPackagesBasedOnPackageId: function(packageid){
      var url = myconfig.webservicesurl+'/getEventPackages.php?packageid='+packageid;
      console.log("url is: "+url);
      return $http.get(url)
        .success(function(data, status, headers,config){
          console.log('data success');
          console.log("Data Length: "+data.length+"\n"); // for browser console
          console.log("Data Is: "+data[0].bannerimage); // for browser console
          //return data; // for UI
        })
        .error(function(data, status, headers,config){
          console.log('data error');
        })


    },


    checkIfAllQtyAreZero: function(userChoosen){
       //console.log(userChoosen);
       var count = 0;
        angular.forEach(userChoosen, function(item){
                   
                   //console.log('inside factory'+item.adultqty);
                   if (item.adultqty!=0 && item.childqty!=0) {
                      //alert("Please book atleast one ticket");
                      count++;
                   } 
                   
                  
                   
               });

      

    },//checkIfAllQtyAreZero end    

    submitResortReviews: function(data,resortid){

      var url = myconfig.webservicesurl+'/submitResortReviews.php';
      return $http.post(url, { obj:data,resortid:resortid })
      
    },
	submitEventReviews: function(data,eventid){

      var url = myconfig.webservicesurl+'/submitEventReviews.php';
      return $http.post(url, { obj:data,eventid:eventid })
      
    },
	submitPlaceReviews: function(data,placeid){
	var url = myconfig.webservicesurl+'/submitPlaceReviews.php';
    return $http.post(url, { obj:data,placeid:placeid })
      
    },
	sendUserSelectedOptionsToServer: function(userSelections,kidsmealqty,dateofvisit){

      var url = myconfig.webservicesurl+'/multiCheckOutUserSelections.php';
      return $http.post(url, { obj:userSelections,kidsmealqty:kidsmealqty,dateofvisit:dateofvisit })
      
    },//sendUserSelectedOptionsToServer end     

    sendUserSelectedOptionsToServerResortBooking: function(userSelections,dateofvisit){

      var url = myconfig.webservicesurl+'/singleCheckOutUserSelectionsResortBooking.php';
      return $http.post(url, { obj:userSelections,dateofvisit:dateofvisit })
      
    },//sendUserSelectedOptionsToServerResortBooking end  

    sendUserLoginAsGuest: function(c){

      var url = myconfig.webservicesurl+'/loginAsGuest.php';
      return $http.post(url, { obj:c })
      
    },//sendUserSelectedOptionsToServer end    

    saveUserSelectedSessionAndUserSelectionsAndUserTotals: function($userdetails,o,usertotals,userselectedoptions){

      var url = myconfig.webservicesurl+'/saveGuestCheckOutDetails.php';
      return $http.post(url, { userdetails:$userdetails, o:o, usertotals:usertotals, userselectedoptions:userselectedoptions })
      
    },//saveUserSelectedSessionAndUserSelectionsAndUserTotals($scope.o, $scope.usertotals,   $scope.userselectedoptions )

    

    calculateEventsSingleCheckoutUserSelectedOptions: function(userChoosen,dateofvisit){

      var url = myconfig.webservicesurl+'/calculateEventsCheckoutUserOptions.php';
      return $http.post(url, { userselectedoptions: userChoosen,dateofvisit:dateofvisit })
      
    },


     saveUserSelectedSessionAndUserSelectionsAndUserTotalsEvents: function(userdetails,o,usertotals,userselectedoptions){

      var url = myconfig.webservicesurl+'/saveGuestCheckOutEventDetails.php';
      return $http.post(url, { userdetails:userdetails, o:o, usertotals:usertotals, userselectedoptions:userselectedoptions })
      
    },//saveUserSelectedSessionAndUserSelectionsAndUserTotals($scope.o, $scope.usertotals,   $scope.userselectedoptions )

    

    saveUserSelectedDataResortSingleCheckOut: function(userdetails,o,usertotals,userselectedoptions){

      var url = myconfig.webservicesurl+'/saveGuestCheckOutSingleResortCheckOut.php';
      return $http.post(url, { userdetails:userdetails, o:o, usertotals:usertotals, userselectedoptions:userselectedoptions })
      
    },

    getPackagesBasedOnResortIdToShowPrice: function(packageid){
	
      var url = myconfig.webservicesurl+'/getPackagesBasedOnResortIdToShowPrice.php';
	  
      return $http.post(url, { packageid:packageid })
	  //console.log("url is ");
      
    },
    
    getUserDetailsWithTicketNumber: function(ticketnumber){

      var url = myconfig.webservicesurl+'/getUserDetailsWithTicketNumber.php';
      return $http.post(url, { ticketnumber:ticketnumber })
      
    },

    getPackagesForZoo: function(resortid){
      var url = myconfig.webservicesurl+'/getPackagesForZoo.php';
      return $http.post(url, { resortid:resortid })

    },


  }


});

// factory -- webservices end //


// (Amar) Controllers And Web Services End //


// (Raju) Controllers And Web Services Start //

app.controller('MenuCtrl', function($scope, $window, $state) {
  
  if(localStorage.getItem("holidayCustomerEmail") !== null && localStorage.getItem("holidayCustomerEmail") !== "")
  {
    
    $scope.withsession = true;
    $scope.withoutsession = false;
    $scope.show = true;
    $scope.name = localStorage.getItem("holidayCustomerName");

  }else{
    $scope.withsession = false;
    $scope.withoutsession = true;
    $scope.show = true;
  }

  $scope.logout = function(){
    localStorage.setItem("holidayCustomerEmail", '');
     $window.location.reload(true);  
	 };

});

app.controller('LoginCtrl', function($scope, $http, $state,$window, process) {
  $scope.errormessages = false;
  $scope.messages = false;
  $scope.data = {};
  $scope.responselogin;
  $scope.responseotp;
  $scope.responsecustomername;
  $scope.responsemobile;
  $scope.responseid;
  $scope.submit = function(){

    process.logincheck($scope.data.username,$scope.data.password).success(function (response) 
    {
      console.log($scope.data.username,$scope.data.password);  
      console.log(response);  
      $scope.responselogin=response.statusone;
      $scope.responseotp=response.convertedpassword;
      $scope.responsecustomername = response.customername;
      $scope.responsemobile = response.mobile;
      $scope.responseid = response.customerid;
      console.log($scope.responselogin); 
      console.log($scope.responsecustomername);
      console.log($scope.responsemobile); 
      if($scope.responselogin)
      {
        localStorage.setItem("holidayCustomerEmail", $scope.data.username);
        localStorage.setItem("holidayCustomerName", $scope.responsecustomername);
        localStorage.setItem("holidayCustomerMobile", $scope.responsemobile);
        localStorage.setItem("holidayCustomerId", $scope.responseid);
		$window.location.reload(true);
        $state.go('sidemenu.home');
		
      }else{
        console.log($scope.responseotp);  
        $scope.errormessages = true;
        $state.go('sidemenu.login');
      }
    })
  };
});

app.controller('ResortSearchCtrl1', function($scope,$state,$http,webservices,myconfig) {
   $scope.search={};

  $scope.searchresult=[];
   
   $scope.onSearchChange = function(){

        webservices.getResortsBasedOnSearchCriteria($scope.search.name).success(function(data) {
            $scope.searchresult=data;
            //console.log("hellos this is test"+$scope.search.name);
            console.log($scope.searchresult);
        });
    
      }

       $scope.bookThisResort = function(resortid){
          alert("clicked resort id is: "+resortid);
       }

});


app.controller('ForgotpasswordCtrl', function($scope, $http, $state, process) {
  $scope.errormessages = false;
  $scope.enableotp = false;
  $scope.hideform = true;
  $scope.otperror=false;
  $scope.data = {};
  $scope.forgotpasswordresponse;
  $scope.responsephone;
  $scope.otpresponse;
  $scope.submit = function(){
    process.forgotpassword($scope.data.email).success(function (response) 
    {
      console.log(response);  
      console.log(response.statusone);  
      console.log(response.mobile);  
      
      $scope.forgotpasswordresponse = response.statusone;
      $scope.responsephone = response.mobile;

      console.log($scope.forgotpasswordresponse);  
      if($scope.forgotpasswordresponse)
      {
        $scope.enableotp = true;
        $scope.hideform = false;

        process.sendotp($scope.responsephone).success(function (response) {
          console.log(response);  
          $scope.otpresponse=response.otp;
        })

      }else{
        $scope.errormessages = true;
        $state.go('sidemenu.forgotpassword');
      }
    })
  };

  $scope.pwdotpsubmit = function(){

    console.log("formotp : "+$scope.data.otp);
    console.log("generated otp : "+$scope.otpresponse);
    
    if($scope.data.otp==$scope.otpresponse)
    {
      //console.log("OTP Success");
      process.sendpassword($scope.data.email,$scope.responsephone).success(function (response) {
       console.log(response);  
      })

      $state.go('sidemenu.login');
    }else{
      //console.log("OTP Wrong");
      $scope.otperror=true;
      $state.go('sidemenu.forgotpassword');
    }
  };
});


app.controller('RegisterCtrl', function($scope, $http, $state, process) {
  $scope.errormessages = false;
  $scope.messages = false;
  $scope.enableotp = false;
  $scope.hideform = true;
  $scope.otperror=false;
  $scope.data = {};
  $scope.emailresponse;
  $scope.otpresponse;
  
  $scope.submit = function(){
    process.checkemail($scope.data.email,$scope.data.mobile).success(function (response) {
     console.log(response);  
     $scope.emailresponse=response.statusone;
     console.log($scope.emailresponse);
      if($scope.emailresponse)
      {
        $scope.errormessages=true;
        $state.go('sidemenu.register');
      }else{
        $scope.enableotp = true;
        $scope.hideform = false;

        process.sendotp($scope.data.mobile).success(function (response) {
         console.log(response);  
         $scope.otpresponse=response.otp;
        })
      }
    })
  };

  $scope.otpsubmit = function(){

    //console.log("formotp :"+$scope.data.otp);
    //console.log("generated otp"+$scope.otpresponse);
    if($scope.data.otp==$scope.otpresponse)
    {
      console.log("OTP Success");
      process.insertregister($scope.data.username,$scope.data.email,$scope.data.mobile,$scope.data.password).success(function (response) {
       console.log(response);  
       //$scope.otpresponse=response.otp;
      })
      $state.go('sidemenu.home');
    }else{
      $scope.otperror=true;
      $state.go('sidemenu.register');
    }
  };


});



app.controller('MyaccountCtrl', function($scope, $http, $state, process) {
  
  $scope.data = {};
  $scope.userresponse;
  $scope.usernameresponse;
  $scope.useremailresponse;
  $scope.usernumberresponse;
  $scope.updateuserdatawithpassword;
  $scope.successmsg = false;
  $scope.errormsg = false;
  
  if(localStorage.getItem("holidayCustomerEmail") !== null && localStorage.getItem("holidayCustomerEmail") !== ""){
    
    process.getuserdata(localStorage.getItem("holidayCustomerEmail")).success(function (response) {
      //console.log(response);
      $scope.userresponse=response.statusone;
      $scope.usernameresponse=response.username;
      $scope.useremailresponse=response.useremail;
      $scope.usernumberresponse=response.usermobile;  
      console.log($scope.userresponse);
      console.log($scope.usernameresponse);
      console.log($scope.useremailresponse);
      console.log($scope.usernumberresponse);
      $scope.data = response;
    })
  }else{
    $state.go('sidemenu.login');
  }

  $scope.submit = function(){
    if($scope.data.filter)
    {
      if($scope.data.password==$scope.data.confirmpassword){
        console.log("update name,email,mobile with password");
        process.updateuserdatawithpassword($scope.data.username,$scope.data.useremail,$scope.data.usermobile,$scope.data.password).success(function (response) {
          console.log(response.statusone);  
          $scope.updateuserdatawithpassword=response.statusone;
          if($scope.updateuserdatawithpassword)
          {
            $scope.successmsg = true;
            $state.go('sidemenu.myaccount');
          }else{
            $scope.errormsg = true;
            $state.go('sidemenu.myaccount');
          }
        })
      }else{
        alert("Password & Confirm Password Doesn't Match");
      }
    }else{
      console.log("update name,email,mobile");
      process.updateuserdatawithoutpassword($scope.data.username,$scope.data.useremail,$scope.data.usermobile).success(function (response) {
        console.log(response.statusone);  
        $scope.updateuserdatawithpassword=response.statusone;
        if($scope.updateuserdatawithpassword)
        {
          $scope.successmsg = true;
          $state.go('sidemenu.myaccount');
        }else{
          $scope.errormsg = true;
          $state.go('sidemenu.myaccount');
        }
      })
    }
  };
});


app.controller('MyordersCtrl', function($scope, $http, $state, process) {
  $scope.data = {};
  $scope.hidesummary = true;
  $scope.errormsg = false;
  if(localStorage.getItem("holidayCustomerEmail") !== null && localStorage.getItem("holidayCustomerEmail") !== "")
  {
    process.getuserordersdata(localStorage.getItem("holidayCustomerEmail")).success(function (response) 
    {
      $scope.data=response;
      console.log($scope.data);
      
    })
  }else{
    $scope.hidesummary = false;
    $scope.errormsg = true;
    $state.go('sidemenu.myorders');
  }
});

app.controller('SummaryCtrl', function($scope, $ionicPopup, $http, $state, process) {
  $scope.showAlert = function() {
    var alertPopup = $ionicPopup.alert({
      title: 'Tax Charges',
      templateUrl: 'templates/taxes.html'
    });

    alertPopup.then(function(res) {
      console.log('Tax Popup Clicked');
    });
  };

  $scope.tckno = $state.params.ticketnumber;
  console.log($scope.tckno); 
  $scope.data = {};
  
  process.getorderdetails($scope.tckno).success(function (response) 
  {
    $scope.data=response;
    console.log($scope.data);
    console.log($scope.data.adultstickets);
  })
  
});


app.controller('MapCtrl', function($scope, $ionicLoading, $compile) {

  function initialize() 
  {
    var myLatlng = new google.maps.LatLng(17.351002, 78.447850);
    var mapOptions = {
      center: myLatlng,
      zoom: 14,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    }

    var map = new google.maps.Map(document.getElementById("map"),
        mapOptions);
    //Marker + infowindow 

    var contentString = "<div><p>place</p><br><p>address</p></div>";
        var compiled = $compile(contentString)($scope);

        var infowindow = new google.maps.InfoWindow({
          content: compiled[0]
        });

    var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Uluru (Ayers Rock)'
    })

    google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map,marker);
    })

    $scope.map = map;
  }
  google.maps.event.addDomListener(window, 'load', initialize);
  ionic.Platform.ready(initialize); 
  $scope.clickTest = function() {
    alert('Example of infowindow with ng-click')
  };
});


// factory -- process start //

app.factory('process', function($http,myconfig){

  return {

    checkemail: function(email,phone)
    {
      var url = myconfig.webservicesurl+'/checkemail.php';
      return $http.post(url, {email:email,phone:phone})
    },

    sendotp: function(phone)
    {
      var url = myconfig.webservicesurl+'/sendotp.php';
      return $http.post(url, {phone:phone})
    },

    insertregister: function(username,email,phone,password)
    {
      var url = myconfig.webservicesurl+'/registerprocessing.php';
      return $http.post(url, {username:username,email:email,phone:phone,password:password})
    },

    logincheck: function(username,password)
    {
      var url = myconfig.webservicesurl+'/loginprocessing.php';
	  console.log(url);
      return $http.post(url, {username:username,password:password})
    },

    forgotpassword: function(email)
    {
      var url = myconfig.webservicesurl+'/forgotpassword.php';
      return $http.post(url, {email:email})
    },

    sendpassword: function(email,phone)
    {
      var url = myconfig.webservicesurl+'/sendpassword.php';
      return $http.post(url, {email:email,phone:phone})
    },

    getuserdata: function(email)
    {
      var url = myconfig.webservicesurl+'/getuserdata.php';
      return $http.post(url, {email:email})
    },

    getuserordersdata: function(email)
    {
      var url = myconfig.webservicesurl+'/getuserordersdata.php';
      return $http.post(url, {email:email})
    },

    updateuserdatawithpassword: function(username,email,mobile,password)
    {
      var url = myconfig.webservicesurl+'/updateuserdatawithpassword.php';
      return $http.post(url, {username:username, email:email, mobile:mobile, password:password})
    },

    updateuserdatawithoutpassword: function(username,email,mobile)
    {
      var url = myconfig.webservicesurl+'/updateuserdatawithoutpassword.php';
      return $http.post(url, {username:username, email:email, mobile:mobile})
    },

    getorderdetails: function(ticketnumber)
    {
      var url = myconfig.webservicesurl+'/getorderdetails.php';
      return $http.post(url, {ticketnumber:ticketnumber})
    },

    getslidersdata: function()
    {
      return $http.get(myconfig.webservicesurl+'/getslidersdata.php')
      .success(function(data, status, headers,config){
        console.log('data success');
        console.log("Data Length: "+data.length+"\n"); // for browser console
        console.log("Data Is: "+data[0].image); // for browser console
        //return data; // for UI
      })
      .error(function(data, status, headers,config){
        console.log('data error');
      })
    }
  }

});
(function() {
  angular.module('ionic.rating', []).constant('ratingConfig', {
    max: 5,
    stateOn: null,
    stateOff: null
  }).controller('RatingController', function($scope, $attrs, ratingConfig) {
    var ngModelCtrl;
    ngModelCtrl = {
      $setViewValue: angular.noop
    };
    this.init = function(ngModelCtrl_) {
      var max, ratingStates;
      ngModelCtrl = ngModelCtrl_;
      ngModelCtrl.$render = this.render;
      this.stateOn = angular.isDefined($attrs.stateOn) ? $scope.$parent.$eval($attrs.stateOn) : ratingConfig.stateOn;
      this.stateOff = angular.isDefined($attrs.stateOff) ? $scope.$parent.$eval($attrs.stateOff) : ratingConfig.stateOff;
      max = angular.isDefined($attrs.max) ? $scope.$parent.$eval($attrs.max) : ratingConfig.max;
      ratingStates = angular.isDefined($attrs.ratingStates) ? $scope.$parent.$eval($attrs.ratingStates) : new Array(max);
      return $scope.range = this.buildTemplateObjects(ratingStates);
    };
    this.buildTemplateObjects = function(states) {
      var i, j, len, ref;
      ref = states.length;
      for (j = 0, len = ref.length; j < len; j++) {
        i = ref[j];
        states[i] = angular.extend({
          index: 1
        }, {
          stateOn: this.stateOn,
          stateOff: this.stateOff
        }, states[i]);
      }
      return states;
    };
    $scope.rate = function(value) {
      if (!$scope.readonly && value >= 0 && value <= $scope.range.length) {
        ngModelCtrl.$setViewValue(value);
        return ngModelCtrl.$render();
      }
    };
    $scope.reset = function() {
      $scope.value = ngModelCtrl.$viewValue;
      return $scope.onLeave();
    };
    $scope.enter = function(value) {
      if (!$scope.readonly) {
        $scope.value = value;
      }
      return $scope.onHover({
        value: value
      });
    };
    $scope.onKeydown = function(evt) {
      if (/(37|38|39|40)/.test(evt.which)) {
        evt.preventDefault();
        evt.stopPropagation();
        return $scope.rate($scope.value + (evt.which === 38 || evt.which === 39 ? {
          1: -1
        } : void 0));
      }
    };
    this.render = function() {
      return $scope.value = ngModelCtrl.$viewValue;
    };
    return this;
  }).directive('rating', function() {
    return {
      restrict: 'EA',
      require: ['rating', 'ngModel'],
      scope: {
        readonly: '=?',
        onHover: '&',
        onLeave: '&'
      },
      controller: 'RatingController',
      template: '<ul class="rating" ng-mouseleave="reset()" ng-keydown="onKeydown($event)">' + '<li ng-repeat="r in range track by $index" ng-click="rate($index + 1)"><i class="icon" ng-class="$index < value && (r.stateOn || \'ion-ios-star\') || (r.stateOff || \'ion-ios-star-outline\')"></i></li>' + '</ul>',
      replace: true,
      link: function(scope, element, attrs, ctrls) {
        var ngModelCtrl, ratingCtrl;
        ratingCtrl = ctrls[0];
        ngModelCtrl = ctrls[1];
        if (ngModelCtrl) {
          return ratingCtrl.init(ngModelCtrl);
        }
      }
    };
  });

}).call(this);

// factory -- process end //

// (Raju) Controllers And Web Services End //