var app = angular.module('starter.controllers', ['ngSanitize','ionic.rating','angular-datepicker']);

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

        $state.go('sidemenu.response');   
        
             
      }else{
        //alert("no ticket number");
       //window.localStorage.setItem("ticketnumber", 'a');
        
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
  $scope.ticketnumber = window.localStorage.getItem("ticketnumber");
  //console.log("ticketnumber is: "+ticketnumber);
  //alert("ticketnumber is: "+$scope.ticketnumber);
  $scope.userData = {};
  $scope.res = {};
  $scope.res.success=false;
  $scope.res.failed=false;

   webservices.getUserDetailsWithTicketNumber($scope.ticketnumber).success(function (response) {
        console.clear();
        console.log(response);
        //alert(response);
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

app.controller('HomeCtrl',function($scope,$ionicSlideBoxDelegate,$state,myconfig,process,$ionicLoading,$ionicNavBarDelegate){
  $scope.data = {};
   //$ionicNavBarDelegate.showBackButton(false);
  $scope.imagepathurl = myconfig.imagepathurl;
  $ionicLoading.show({
      template: "Please Wait."
   });
  process.getslidersdata().success(function (response) 
  {
    console.log(response);
    $scope.data = response;
	$ionicLoading.hide();
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
  
  $scope.repeatDone = function() {
	  $ionicSlideBoxDelegate.update();
	  //$ionicSlideBoxDelegate.slide($scope.week.length - 1, 1);
	};
	
	

 

});


app.controller('TestCtrl',function($scope,$state,$http,webservices,myconfig,$ionicPopup,$sce){
  console.clear();
  $scope.usr = [];
  $scope.usr.urlToSend = $sce.trustAsResourceUrl($state.params.url);

  console.log('url is: '+$scope.usr.urlToSend);

});

app.controller('CheckOutOptionEventCtrl',function($scope,$state,$http,webservices,myconfig,$ionicPopup,$window,$ionicLoading){
  console.clear();

  $scope.c={};
  $scope.o=[];
  $scope.c.proceedguest=true;
  $scope.c.otpview=false;
  $scope.usertotals = $state.params.usertotals;
  $scope.userselectedoptions = $state.params.userselectedoptions;
  
  if(localStorage.getItem("holidayCustomerEmail") !== null && localStorage.getItem("holidayCustomerEmail") !== ""){
    $ionicLoading.show({
      template: "Loading..."
   });
    $scope.c.email = localStorage.getItem("holidayCustomerEmail");
    $scope.c.name = localStorage.getItem("holidayCustomerName");
    $scope.c.mobile = localStorage.getItem("holidayCustomerMobile");
    $scope.c.customerid = localStorage.getItem("holidayCustomerId");
    
    
    webservices.saveUserSelectedSessionAndUserSelectionsAndUserTotalsEventsWithLogin($scope.c,$scope.usertotals, $scope.userselectedoptions ).success(function (response) {
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
                                   ////alert("extracted information"+tkt[1]);
                                   window.localStorage.setItem("ticketnumber", tkt[1]);
                                   $ionicLoading.hide();
                                   window.location.href="index.html";

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
          $ionicLoading.show({
            template: 'Loading .....'
          });
          //OTP matches
          
          $scope.c.customerid=$scope.o.customerid;
         webservices.saveUserSelectedSessionAndUserSelectionsAndUserTotalsEvents($scope.c, $scope.usertotals, $scope.userselectedoptions ).success(function (response) {
                  //console.clear();
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
                                   ////alert("extracted information"+tkt[1]);
                                   window.localStorage.setItem("ticketnumber", tkt[1]);
                                   $ionicLoading.hide();
                                   window.location.href="index.html";

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


app.controller('checkOutOptionResortsCtrl',function($scope,$state,$http,webservices,myconfig,$ionicPopup,$window,$ionicLoading){
  console.clear();
 
      
 

  $scope.c={};
  $scope.o=[];
  $scope.c.proceedguest=true;
  $scope.c.otpview=false;
  $scope.usertotals = $state.params.usertotals;
  $scope.userselectedoptions = $state.params.userselectedoptions;
  $scope.dateofvisit = $state.params.dateofvisit;

 

  if(localStorage.getItem("holidayCustomerEmail") !== null && localStorage.getItem("holidayCustomerEmail") !== ""){
    
    $ionicLoading.show({
      template: "Loading..."
    });
    
    $scope.c.email = localStorage.getItem("holidayCustomerEmail");
    $scope.c.name = localStorage.getItem("holidayCustomerName");
    $scope.c.mobile = localStorage.getItem("holidayCustomerMobile");
    $scope.c.customerid = localStorage.getItem("holidayCustomerId");

    
    
    
    webservices.saveUserSelectedSessionAndUserSelectionsAndUserTotalsResortsWithLogin($scope.c,$scope.usertotals, $scope.userselectedoptions ).success(function (response) {
        //console.clear();
        console.log(response);
        var paymenturl = myconfig.webservicesurl+"/confirmevents.php?data="+encodeURIComponent(JSON.stringify(response));
        var finalurl = myconfig.webservicesurl+"/test.php";
                  var responseurl = myconfig.webservicesurl+"/responsemulticheckout.php";
                      try {
                               ref = window.open(paymenturl,'_self','location=no,clearcache=yes'); //encode is needed if you want to send a variable with your link if not you can use ref = window.open(url,'_blank','location=no');
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
                                   $ionicLoading.hide();
                                   window.location.href="index.html";

                                   
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
            
            $ionicLoading.show({
            template: 'Loading .....'
          });
          
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
                                   $ionicLoading.hide();
                                   window.location.href="index.html";

                                   
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


app.controller('checkOutOptionCtrl',function($scope,$state,$http,webservices,myconfig,$ionicPopup,$window,$ionicLoading){
  console.clear();
  $scope.c={};
  $scope.o=[];
  $scope.c.proceedguest=true;
  $scope.c.otpview=false;
  $scope.usertotals = $state.params.usertotals;
  $scope.usertotals.dateofvisit = $state.params.dateofvisit;
  $scope.userselectedoptions = $state.params.userselectedoptions;

  console.log($scope.usertotals);
  
  if(localStorage.getItem("holidayCustomerEmail") !== null && localStorage.getItem("holidayCustomerEmail") !== ""){
    $ionicLoading.show({
      template: "Loading..."
    });
    $scope.c.email = localStorage.getItem("holidayCustomerEmail");
    $scope.c.name = localStorage.getItem("holidayCustomerName");
    $scope.c.mobile = localStorage.getItem("holidayCustomerMobile");
    $scope.c.customerid = localStorage.getItem("holidayCustomerId");
    
    
    webservices.saveUserSelectedSessionAndUserSelectionsAndUserTotalsMultiCheckOutWithLogin($scope.c, $scope.usertotals, $scope.userselectedoptions ).success(function (response) {
        //console.clear();
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
                                   ////alert("extracted information"+tkt[1]);
                                   window.localStorage.setItem("ticketnumber", tkt[1]);
                                   $ionicLoading.hide();
                                   window.location.href="index.html";

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
                  //console.clear();
                  $scope.o=response;
                  console.log($scope.o); 
                  $scope.c.proceedguest=true;
                  $scope.c.otpview=true;

                  });

       }//end of submit

       $scope.checkotp = function(c){

        if (c.otp==$scope.o.otp) {
          $ionicLoading.show({
            template: 'Loading .....'
         });
          //OTP matches
         webservices.saveUserSelectedSessionAndUserSelectionsAndUserTotals($scope.c,$scope.o, $scope.usertotals,   $scope.userselectedoptions ).success(function (response) {
                  //console.clear();
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
                                   ////alert("extracted information"+tkt[1]);
                                   window.localStorage.setItem("ticketnumber", tkt[1]);
                                   $ionicLoading.hide();
                                   window.location.href="index.html";

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

    if ($scope.calculatedData.total==0 || $scope.calculatedData.total<0 || $scope.calculatedData.total==null) {
      var alertPopup = $ionicPopup.alert({
             title: 'Alert',
             template: 'Please go back and book atleast one ticket'
           });

           alertPopup.then(function(res) {
             console.log('Thank you for not eating my delicious ice cream cone');
           });


    }else{
      $state.go('sidemenu.checkoutoptionresorts',{usertotals:$scope.calculatedData,userselectedoptions:$scope.userChoosen,dateofvisit:$scope.dateofvisit});
    }
  }

$scope.taxBreakUp = function(){

  var alertPopup = $ionicPopup.alert({
     title: 'Tax Break Up',
     template: '<div class="row"><div class="col col-50 tax-col">Internet Handling Charges:</div> <div class="col col-50 text-right tax-col"style="float:right">Rs.' +$scope.calculatedData.internetcharges+
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
  $scope.kidsmealprice;
  webservices.checkIfKidsMealPriceIsZeroOrNot($scope.userChoosen[0].packageid).success(function (response) {
                   //console.log(response.kidsmealprice); 

                   $scope.kidsmealprice = response.kidsmealprice;
                   //alert($scope.kidsmealprice);
                   if ($scope.kidsmealprice!=0) {
                               popup();
                              }else{
                               $scope.data.kidsmealqty=0;
                               webservices.sendUserSelectedOptionsToServer($scope.userChoosen,$scope.data.kidsmealqty,$scope.dateofvisit).success(function (response) {
                               console.log(response); 

                               $scope.calculatedData=response;
                               
                                })

                              }
                   
                    })


  //popup();
  $scope.data={};
  $scope.data.kidsmealqty=0;
  $scope.calculatedData={};
  $scope.dateofvisit = $state.params.dateofvisit;

  console.log($scope.userChoosen[0].packageid);

  $scope.submit= function(){
    console.log($scope.calculatedData); 
    console.log($scope.userChoosen); 
    if ($scope.calculatedData.total==0 || $scope.calculatedData.total==null || $scope.calculatedData.total<0) {
             var alertPopup = $ionicPopup.alert({
             title: 'Alert',
             template: 'Please go back and book atleast one ticket'
           });

           alertPopup.then(function(res) {
             console.log('Thank you for not eating my delicious ice cream cone');
           });
    }else{
   
    $state.go('sidemenu.checkoutoption',{ dateofvisit:$scope.dateofvisit, usertotals:$scope.calculatedData,userselectedoptions:$scope.userChoosen});
  }
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
                   
                    })
                          
            });


        }//end of popup function

  });

app.controller('MultiCheckOutCtrl',function($scope,$state,$http,webservices,myconfig,$ionicPopup,$ionicLoading){
      console.clear();

        // increment for + button //
       $ionicLoading.show({
		  template: "Please Wait."
	   });
        $scope.increment = function(){
          $scope.userBookingDetails[$index].mobileadultqty+=1;

        }//end of increment

       // increment for + button //

        // decrement for - button //
       
        $scope.decrement = function(){
          $scope.userBookingDetails.mobileadultqty-=1;
          if($scope.userBookingDetails.mobileadultqty<0)
          {
            $scope.userBookingDetails.mobileadultqty=0;
          }

        }//end of decrement

       // decrement for - button //

       // cincrement for + button //
       
        $scope.cincrement = function(){
          $scope.userBookingDetails.mobilechildqty+=1;

        }//end of increment

       // cincrement for + button //

        // cdecrement for - button //
       
        $scope.cdecrement = function(){
          $scope.userBookingDetails.mobilechildqty-=1;
          if($scope.userBookingDetails.mobilechildqty<0)
          {
            $scope.userBookingDetails.mobilechildqty=0;
          }

        }//end of cdecrement

       // cdecrement for - button //

      //alert("hello");
      var daysToDisable = [1];
      $( ".datepicker" ).datepicker(
        {dateFormat: "dd-mm-yy", minDate: 0,beforeShowDay: disableSpecificWeekDays}
        );

      function disableSpecificWeekDays(date) {
                var day = date.getDay();
                for (i = 0; i < daysToDisable.length; i++) {
                    if ($.inArray(day, daysToDisable) != -1) {
                        return [false];
                    }
                }
                return [true];
            }


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
			$ionicLoading.hide();
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

                   //alert("this is: "+item.mobileadultqty);
                   

                    if ((item.mobileadultqty==0 && item.mobilechildqty==0)  || (item.mobileadultqty==null && item.mobilechildqty==null) || (item.mobileadultqty==null && item.mobilechildqty==0) || (item.mobileadultqty==0 && item.mobilechildqty==null)) {
                      //alert("Please book atleast one ticket");
                      $scope.count++;
                   } 

               });
          //alert($scope.count);
          //alert($scope.userBookingDetails.length);
      			  
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

  if ($scope.calculatedUserData.total==0 || $scope.calculatedUserData.total==null || $scope.calculatedUserData.total<0) {
    // statement
    var alertPopup = $ionicPopup.alert({
             title: 'Alert',
             template: 'Please go back and book atleast one ticket'
           });

           alertPopup.then(function(res) {
             console.log('Thank you for not eating my delicious ice cream cone');
           });
  }else{

     $state.go('sidemenu.checkoutoptionevents',{ usertotals: $scope.calculatedUserData , userselectedoptions: $scope.userChoosen });
}
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
			     console.log(data);
			
			$scope.maxdate = data[0].todate;
      $scope.maxdate = $scope.maxdate.split("-").reverse().join("-");
			$scope.mindate = data[0].fromdate;
      $scope.mindate = $scope.mindate.split("-").reverse().join("-");
      var todayDate = new Date(); //Today Date
       var dateOne = new Date(data[0].fromdate);
       var mindate = new Date();
       //alert("Today date is :"+todayDate);
       //alert("dateOne date is :"+dateOne);
       if (todayDate>dateOne) {
        //alert("today date is greater than");
        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!

        var yyyy = today.getFullYear();
        if(dd<10){
            dd='0'+dd
        } 
        if(mm<10){
            mm='0'+mm
        } 
        var today = dd+'-'+mm+'-'+yyyy;

        mindate = today;
        //alert("mindate today greater than"+mindate);
    $( ".datepicker" ).datepicker({dateFormat: "dd-mm-yy", minDate: today, maxDate: $scope.maxdate});
       }else{
        //alert("today date is less than");
        mindate=$scope.mindate;
        //alert($scope.mindate);
        //alert($scope.maxdate);
    $( ".datepicker" ).datepicker({dateFormat: "dd-mm-yy", minDate: $scope.mindate, maxDate: $scope.maxdate});
       }

    
        });
		
       $scope.proceed  = function(){
          $scope.count = 0;
          $scope.userChoosen = [];
          console.log($scope.userBookingDetails[0].childprice);
          angular.forEach($scope.userBookingDetails, function(item){
                   
                   $scope.userChoosen.push({
                    packageid:item.packageid,
                    adultqty:item.mobileadultqty,
                    childqty:item.mobilechildqty
                   });

                   if ((item.mobileadultqty==0 && item.mobilechildqty==0) || (item.mobileadultqty==null)) {
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



                   }else if($scope.userBookingDetails[0].childprice==0 && $scope.userBookingDetails[0].mobileadultqty==0){
                    

                    var alertPopup = $ionicPopup.alert({
                         title: 'Alert!',
                         template: 'Please book atleast one adult ticket'
                       });

                       alertPopup.then(function(res) {
                        $scope.userBookingDetails[0].mobilechildqty=0;
                         console.log('Thank you for not eating my delicious ice cream cone');
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
$( ".datepicker" ).datepicker({dateFormat: "dd-mm-yy", minDate: 0});
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

                   if ((item.mobileadultqty==0 && item.mobilechildqty==0) || item.mobileadultqty==null) {
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



                   }else if($scope.userBookingDetails[0].childprice==0 && $scope.userBookingDetails[0].mobileadultqty==0){
                   

                    var alertPopup = $ionicPopup.alert({
                         title: 'Alert!',
                         template: 'Please book atleast one adult ticket'
                       });

                       alertPopup.then(function(res) {
                         $scope.userBookingDetails[0].mobilechildqty=0;
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



app.controller('ResortDetailsCtrl',function($window,$scope,$state,$http,webservices,myconfig,$ionicPopup,$ionicLoading){
  console.clear();
  $scope.errormessages=false;
        $scope.date = new Date();
       $scope.resortid = $state.params.id;
		$scope.data={};
	   $ionicLoading.show({
      template: "Please Wait."
   });
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
          $scope.eventreviews = reviewsdata;
		  $ionicLoading.hide();
		  if(reviewsdata=="no reviews"){
			$scope.noreviews=true;
			$scope.reviews=false;
			
		  }else{
			  $scope.noreviews=false;
			  $scope.reviews=true;
			 
			 
		  }
        });
    if($scope.resortid!=1){
  $scope.resortsSingleCheckout = function(myresortid){
        //console.log("Resort id is: "+myresortid);
        $state.go('sidemenu.singlecheckout', {"packageid": myresortid});
       }
	   $scope.showmap = function(latitude,longitude){
		 //alert(latitude+","+longitude);
        //console.log("Resort id is: "+myresortid);
        $state.go('sidemenu.map', {"latitude": latitude,"longitude": longitude});
       }
    }
	$scope.submitresortreview = function(){


    
	  var alertPopup = $ionicPopup.alert({
		 title: 'Submit Review', scope: $scope,
		 template: '<div class="list"><center><rating name="rating" ng-model="data.rating" max="5"></rating></center><label class="item item-input"><input type="text" ng-model="data.subject" name="subject" placeholder="Subject"></label><label class="item item-input"><textarea name="review" ng-model="data.review" placeholder="Comments"></textarea></label><div ng-show="errormessages"><p>Please Fill Rating, Subject & Review</p></div></div>',
		 buttons: [
		 { 
      text: 'Cancel',
       onTap: function(e) {

           // e.preventDefault() will stop the popup from closing when tapped.

           //e.preventDefault();

        } 
     },
		 {
        text: '<b>Ok</b>',
        type: 'button-balanced',
        onTap: function(e) {
            if(!$scope.data.rating){
              $scope.errormessages=true;
              e.preventDefault(); 
            }else if(!$scope.data.review){
              $scope.errormessages=true;  
              e.preventDefault();   
            }else if(!$scope.data.subject){
              $scope.errormessages=true;  
               e.preventDefault();
            }else {
              
               //return $scope.data;
               $scope.data.customerid = localStorage.getItem("holidayCustomerId");
                webservices.submitResortReviews($scope.data,$scope.resortid).success(function (response) {
                console.clear();
                console.log(response); 
                $window.location.reload();
                 
                }) 

            }
          
        }
      }
			]
		 });
  }

});

app.controller('ZooCtrl',function($scope,$state,$http,$window,webservices,myconfig,$ionicPopup,$ionicLoading){
  //console.clear();
$ionicLoading.show({
      template: "Please Wait."
   });
  $scope.repeater = function (range) {
    var arr = []; 
    for (var i = 0; i < range; i++) {
        arr.push(i);
    }
    return arr;
}

        $scope.errormessages=false;
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
			$ionicLoading.hide();
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
		 template: '<div class="list"><center><rating name="rating" ng-model="data.rating" max="5"></rating></center><label class="item item-input"><input type="text" ng-model="data.subject" name="subject" placeholder="Subject"></label><label class="item item-input"><textarea name="review" ng-model="data.review" placeholder="Comments"></textarea></label><div ng-show="errormessages"><p>Please Fill Rating, Subject & Review</p></div></div>',
		 buttons: [
		 { 
        text: 'Cancel',
        type: 'button-default',

        onTap: function(e) {

           // e.preventDefault() will stop the popup from closing when tapped.

           //e.preventDefault();

        } 
     },
		 {
                  text: '<b>Ok</b>',
                  type: 'button-balanced',
                  onTap: function(e) {
                    if(!$scope.data.rating){
                      $scope.errormessages=true;
                      e.preventDefault(); 
                    }else if(!$scope.data.review){
                      $scope.errormessages=true;  
                      e.preventDefault();
                    }else if(!$scope.data.subject){
                      $scope.errormessages=true;  
                       e.preventDefault();
                    } else {
                      
                       $scope.data.customerid = localStorage.getItem("holidayCustomerId");
              webservices.submitResortReviews($scope.data,$scope.resortid).success(function (response) {
                   console.clear();
           console.log(response); 
          $window.location.reload(true);
                 
                  })

                    }
                  }
                }
			]
		 });
	


  
  
}
	   

});

app.controller('EventDetailsCtrl',function($scope,$state,$http,$window,webservices,myconfig,$ionicPopup){
        
        console.clear();
        $scope.errormessages=false;
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
          console.log(reviewsdata); 
          $scope.eventreviews = reviewsdata;
		  if(reviewsdata=="no reviews"){
			$scope.noreviews=true;
			$scope.reviews=false;
			
		  }else{
			  $scope.noreviews=false;
			  $scope.reviews=true;
			  
		  }
        });

       $scope.resortsSingleCheckout = function(myresortid){
        //console.log("Resort id is: "+myresortid);
        $state.go('singlecheckout', {"packageid": myresortid});
       }
       $scope.submitresortreview = function(){

	  var alertPopup = $ionicPopup.alert({
		 title: 'Submit Review', scope: $scope,
		 template: '<div class="list"><center><rating name="rating" ng-model="data.rating" max="5"></rating></center><label class="item item-input"><input type="text" ng-model="data.subject" name="subject" placeholder="Subject"></label><label class="item item-input"><textarea name="review" ng-model="data.review" placeholder="Comments"></textarea></label><div ng-show="errormessages"><p>Please Fill Rating, Subject & Review</p></div></div>',
		 buttons: [
		 { 
        text: 'Cancel',
        
        onTap: function(e) {

           // e.preventDefault() will stop the popup from closing when tapped.

           //e.preventDefault();

        }  
     },
		 {
                  text: '<b>Ok</b>',
                  type: 'button-balanced',
                  onTap: function(e) {
                  
                  if(!$scope.data.rating){
                    $scope.errormessages=true;
                    e.preventDefault(); 
                  }else if(!$scope.data.review){ 
                    $scope.errormessages=true;  
                    e.preventDefault();
                  }else if(!$scope.data.subject){
                    $scope.errormessages=true;  
                     e.preventDefault();
                  } else {
                    
                      $scope.data.customerid = localStorage.getItem("holidayCustomerId");
                      webservices.submitEventReviews($scope.data,$scope.eventid).success(function (response) {
                      //console.clear();
                      $window.location.reload(true);
                      console.log(response); 
          
                 
                  })

                  }

                   
                  }
                }
			]
		 });
}

});

app.controller('PlaceDetailsCtrl',function($scope,$state,$http,webservices,myconfig,$ionicPopup,$window){
  console.clear();
      $scope.errormessages=false;
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
            console.log(data);
        });
		
		webservices.getPlaceReviews($scope.placeid).success(function(reviewsdata) {
          //console.clear();
          //console.log(reviewsdata); 
          $scope.eventreviews = reviewsdata;
		  if(reviewsdata=="no reviews"){
			$scope.noreviews=true;
			$scope.reviews=false;
			
		  }else{
			  $scope.noreviews=false;
			  $scope.reviews=true;
			  
			  $scope.rating=[];
			  
		  }
        });
		$scope.submitresortreview = function(){

	  var alertPopup = $ionicPopup.alert({
		 title: 'Submit Review', scope: $scope,
		 template: '<div class="list"><center><rating name="rating" ng-model="data.rating" max="5"></rating></center><label class="item item-input"><input type="text" ng-model="data.subject" name="subject" placeholder="Subject"></label><label class="item item-input"><textarea name="review" ng-model="data.review" placeholder="Comments"></textarea></label><div ng-show="errormessages"><p>Please Fill Rating, Subject & Review</p></div></div>',
		 buttons: [
		 { 
         text: 'Cancel',
          type: 'button-default',

      onTap: function(e) {

         // e.preventDefault() will stop the popup from closing when tapped.

         //e.preventDefault();

      }  
     },
		 {
                  text: '<b>Ok</b>',
                  type: 'button-balanced',
                  onTap: function(e) {
                     
                      if(!$scope.data.rating){
                        $scope.errormessages=true;
                        e.preventDefault(); 
                      }else if(!$scope.data.review){
                        $scope.errormessages=true;  
                        e.preventDefault();
                      }else if(!$scope.data.subject){
                        $scope.errormessages=true;  
                         e.preventDefault();
                      } else {
                        
                          $scope.data.customerid = localStorage.getItem("holidayCustomerId");
              webservices.submitPlaceReviews($scope.data,$scope.placeid).success(function (response) {
                   //console.clear();
           $window.location.reload(true);
           //console.log(response); 
           
                 
                  })

                      }

                  }
                }
			]
		 });
	

   alertPopup.then(function(res) {
	 
              
                         
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
   $( ".datepicker" ).datepicker({dateFormat: "dd-mm-yy", minDate: 0});

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


app.controller('SearchCtrl',function($scope,$state,$http,webservices,myconfig){
  console.clear();
  $scope.search={};
  $scope.search.eventionlist=false;
  $scope.search.resortionlist=false;
  $scope.search.placesionlist=false;

        $scope.searchresult=[];
        
        
       $scope.searchtype = $state.params.searchtype;

       //console.log("search type is: "+$scope.searchtype);
  
  $scope.oneventssearch = function(eventname){
    $scope.search.eventionlist=true;
  $scope.search.resortionlist=false;
  $scope.search.placesionlist=false;

    console.log(eventname);

     webservices.getEventNamesBasedOnSearchKeyword(eventname).success(function(data) {
            $scope.searchresult=data;
            //console.log("hellos this is test"+$scope.search.name);
            console.log($scope.searchresult);
        });

  }


  $scope.onResortSearch = function(resortname){
    console.log(resortname);
    $scope.search.eventionlist=false;
  $scope.search.resortionlist=true;
  $scope.search.placesionlist=false;

     webservices.getResortNamesBasedOnSearchKeyword(resortname).success(function(data) {
            $scope.searchresult=data;
            //console.log("hellos this is test"+$scope.search.name);
            console.log($scope.searchresult);
        });

  }

   

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
          $scope.search.eventionlist=false;
  $scope.search.resortionlist=false;
  $scope.search.placesionlist=true;

        webservices.getPlacesBasedOnSearchCriteria($scope.search.name).success(function(data) {
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
       $scope.type = $state.params.type;

       //console.log("search type is: "+$scope.searchtype);

        $scope.placesData={};
        $scope.imagepathurl = myconfig.imagepathurl;
        //alert("these are events");
       
         webservices.getPlaces($scope.type).success(function(data) { 
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

    getResortNamesBasedOnSearchKeyword: function(resortname)
    {

      var url = myconfig.webservicesurl+'/getResortNamesBasedOnSearchKeyword.php';
      return $http.post(url, {search:resortname})
      
    },//getOrdersBasedOnTicketNumber($state.params.ticketnumber) getEventNamesBasedOnSearchKeyword(eventname)



    getEventNamesBasedOnSearchKeyword: function(eventname)
    {

      var url = myconfig.webservicesurl+'/getEventNamesBasedOnSearchKeyword.php';
      return $http.post(url, {search:eventname})
      
    },//getOrdersBasedOnTicketNumber($state.params.ticketnumber) getEventNamesBasedOnSearchKeyword(eventname)


    getPlacesBasedOnSearchCriteria: function(searchkeyword)
    {

      var url = myconfig.webservicesurl+'/getPlacesBasedOnSearchCriteria.php';
      return $http.post(url, {search:searchkeyword})
      
    },//getOrdersBasedOnTicketNumber($state.params.ticketnumber) getEventNamesBasedOnSearchKeyword(eventname)

    getOrdersBasedOnTicketNumber: function(ticketnumber){

      var url = myconfig.webservicesurl+'/getOrdersBasedOnTicketNumber.php';
      return $http.post(url, {ticketnumber:ticketnumber})


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

    getPlaces: function(type){
      return $http.get(myconfig.webservicesurl+'/placepull.php?type='+type)
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
          
        })
        .error(function(reviewsdata, status, headers,config){
          console.log('data error');
        })
  },
  getResortReviews: function(resortid){
      var url = myconfig.webservicesurl+'/getResortReviews.php?resortid='+resortid;
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
	getPlaceReviews: function(placeid){
      var url = myconfig.webservicesurl+'/getPlaceReviews.php?placeid='+placeid;
      console.log("url is: "+url);
     
    return $http.get(url)
        .success(function(reviewsdata, status, headers,config){
          
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

    checkIfKidsMealPriceIsZeroOrNot: function(packageid){

      var url = myconfig.webservicesurl+'/checkIfKidsMealPriceIsZeroOrNot.php';
      return $http.post(url, { packageid:packageid })
      
    },//sendUserSelectedOptionsToServer end 


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


    saveUserSelectedSessionAndUserSelectionsAndUserTotalsMultiCheckOutWithLogin: function($userdetails,usertotals,userselectedoptions){

      var url = myconfig.webservicesurl+'/saveMultiChecktOutWithLogin.php';
      return $http.post(url, { userdetails:$userdetails, usertotals:usertotals, userselectedoptions:userselectedoptions })
      
    },//saveUserSelectedSessionAndUserSelectionsAndUserTotals($scope.o, $scope.usertotals,   $scope.userselectedoptions )

    
 

    saveUserSelectedSessionAndUserSelectionsAndUserTotals: function($userdetails,o,usertotals,userselectedoptions){

      var url = myconfig.webservicesurl+'/saveGuestCheckOutDetails.php';
      return $http.post(url, { userdetails:$userdetails, o:o, usertotals:usertotals, userselectedoptions:userselectedoptions })
      
    },//saveUserSelectedSessionAndUserSelectionsAndUserTotals($scope.o, $scope.usertotals,   $scope.userselectedoptions )

    

    calculateEventsSingleCheckoutUserSelectedOptions: function(userChoosen,dateofvisit){

      var url = myconfig.webservicesurl+'/calculateEventsCheckoutUserOptions.php';
      return $http.post(url, { userselectedoptions: userChoosen,dateofvisit:dateofvisit })
      
    },

    saveUserSelectedSessionAndUserSelectionsAndUserTotalsResortsWithLogin: function(userdetails,usertotals,userselectedoptions){

      //console.log("inside factory method\n");
      //console.log(o);
      var url = myconfig.webservicesurl+'/saveLoggedInSelectionsResortBooking.php';
      return $http.post(url, { userdetails:userdetails,usertotals:usertotals, userselectedoptions:userselectedoptions })
      
    },//saveUserSelectedSessionAndUserSelectionsAndUserTotalsResortsWithLogin($scope.o, $scope.usertotals,   $scope.userselectedoptions )

    
    saveUserSelectedSessionAndUserSelectionsAndUserTotalsEventsWithLogin: function(userdetails,usertotals,userselectedoptions){

      //console.log("inside factory method\n");
      //console.log(o);
      var url = myconfig.webservicesurl+'/saveGuestCheckOutEventDetailsWithLogin.php';
      return $http.post(url, { userdetails:userdetails,usertotals:usertotals, userselectedoptions:userselectedoptions })
      
    },//saveUserSelectedSessionAndUserSelectionsAndUserTotalsEventsWithLogin($scope.o, $scope.usertotals,   $scope.userselectedoptions )

    

     saveUserSelectedSessionAndUserSelectionsAndUserTotalsEvents: function(userdetails,usertotals,userselectedoptions){

      //console.log("inside factory method\n");
      //console.log(o);
      var url = myconfig.webservicesurl+'/saveGuestCheckOutEventDetails.php';
      return $http.post(url, { userdetails:userdetails,usertotals:usertotals, userselectedoptions:userselectedoptions })
      
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
		    //$window.location.reload(true);
        window.location.href="index.html";
		
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
       var alertPopup = $ionicPopup.alert({
             title: 'Alert',
             template: 'Thank you for Registering with us'
           });

           alertPopup.then(function(res) {
             $state.go('sidemenu.login');
           });



       
      })
      
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
  $scope.BookingData = {};
  $scope.hidesummary = true;
  $scope.errormsg = false;
  var holidayCustomerEmail = localStorage.getItem("holidayCustomerEmail");
  if(localStorage.getItem("holidayCustomerEmail") !== null && localStorage.getItem("holidayCustomerEmail") !== "")
  {
    //alert(holidayCustomerEmail);
    process.getuserordersdata(holidayCustomerEmail).success(function (response) 
    {
    //alert(holidayCustomerEmail);
      $scope.BookingData=response;
       console.log(response);
       //console.log("Data Length: "+$scope.BookingData.length+"\n");
      
    })
  }else{
    $scope.hidesummary = false;
    $scope.errormsg = true;
    $state.go('sidemenu.myorders');
  }
});

app.controller('SummaryCtrl', function($scope, $ionicPopup, $http, $state, process) {

  $scope.tckno = $state.params.ticketnumber;
  //console.log($scope.tckno); 
  $scope.data = {};
  
  process.getorderdetails($scope.tckno).success(function (response) 
  {
    $scope.data = response[0];
  $scope.kidsmealprice = response[0].noofkidsmeal * response[0].kidsmealprice;
   console.log(response);
  //$scope.taxes = response[0].internetcharges + response[0].krishkalyancess + response[0].servicetax + response[0].swachhbharath; 
    //console.log($scope.data.adultstickets);
  })
  
});



app.controller('OrderSummaryCtrl', function($scope, $http, $state, process,webservices) {
  console.clear();
  
  console.log("Ticket number is: "+$state.params.ticketnumber);
  
  $scope.orders = [];

  webservices.getOrdersBasedOnTicketNumber($state.params.ticketnumber).success(function(data) {
            $scope.orders=data;
            //console.log("hellos this is test"+$scope.search.name);
            console.log(data);
        });

});







app.controller('MapCtrl', function($scope, $state, $ionicLoading, $compile,$window) {
  console.clear();
 $scope.latitude = $state.params.latitude;
 $scope.longitude = $state.params.longitude;
 
 //$scope.map = {};
  function initialize() 
  {
    alert("inside initialize");
    var myLatlng = new google.maps.LatLng($scope.latitude, $scope.longitude);
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
  //$window.location.reload();
 
  
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