// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
// 'starter.controllers' is found in controllers.js
var app = angular.module('starter', ['ionic', 'starter.controllers']);



app.run(function($ionicPlatform) {
  $ionicPlatform.ready(function(initialize) {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs)
    if (window.cordova && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
      cordova.plugins.Keyboard.disableScroll(true);

    }
    if (window.StatusBar) {
      // org.apache.cordova.statusbar required
      StatusBar.styleDefault();
    }
  });
});

app.config(function($stateProvider, $urlRouterProvider) {
  $stateProvider

  .state('sidemenu', {
    url: '/sidemenu',
    abstract: true,
    templateUrl: 'templates/menu.html',
    controller: 'MenuCtrl'
  })

  .state('sidemenu.register', {
    url: '/register',
    views: {
      'menuContent': {
        templateUrl: 'templates/register.html',
        controller: 'RegisterCtrl'
      }
    }
  })

  .state('sidemenu.test', {
    url: '/test',
    views: {
      'menuContent': {
        templateUrl: 'templates/test.html',
        controller: 'TestCtrl'
      }
    },params:{
      url:null
    }
  })

  .state('sidemenu.login', {
    url: '/login',
    views: {
      'menuContent': {
        templateUrl: 'templates/login.html',
        controller: 'LoginCtrl'
      }
    }
  })
  
  .state('sidemenu.resortsearch', {
    url: '/resortsearch',
    views: {
      'menuContent': {
        templateUrl: 'templates/resortsearch.html',
        controller: 'ResortSearchCtrl1'
      }
    }
  }) 
  .state('sidemenu.eventsearch', {
    url: '/eventsearch',
    views: {
      'menuContent': {
        templateUrl: 'templates/eventsearch.html',
        controller: 'EventSearchCtrl'
      }
    }
  })  
  .state('sidemenu.search', {
    url: '/search',
    views: {
      'menuContent': {
        templateUrl: 'templates/search.html',
        controller: 'SearchCtrl'
      }
    }
  })
  
  .state('sidemenu.forgotpassword', {
    url: '/forgotpassword',
    views: {
      'menuContent': {
        templateUrl: 'templates/forgotpassword.html',
        controller: 'ForgotpasswordCtrl'
      }
    }
  })

  .state('sidemenu.myaccount', {
    url: '/myaccount',
    views: {
      'menuContent': {
        templateUrl: 'templates/myaccount.html',
        controller: 'MyaccountCtrl'
      }
    }
  })

  .state('sidemenu.myorders', {
    url: '/myorders',
    views: {
      'menuContent': {
        templateUrl: 'templates/myorders.html',
        controller: 'MyordersCtrl'
      }
    }
  })


  .state('sidemenu.ordersummary', {
    url: '/ordersummary/:ticketnumber',
    views: {
      'menuContent': {
        templateUrl: 'templates/ordersummary.html',
        controller: 'SummaryCtrl'
      }
    }
  })


  .state('sidemenu.map', {
    url: '/map/:latitude/:longitude',
    views: {
      'menuContent': {
        templateUrl: 'templates/map.html',
        controller: 'MapCtrl'
      }
    }
  })

  .state('sidemenu.filters', {
    url: '/filters',
    views: {
      'menuContent': {
        templateUrl: 'templates/filters.html',
        controller: 'MyordersCtrl'
      }
    }
  })
    

  .state('sidemenu.home', {
    url: '/home',
    views: {
      'menuContent': {
        templateUrl: 'templates/home.html',
        controller: 'HomeCtrl'
      }
    }
  })

  .state('sidemenu.resortsearchresults', {
    url: '/resortsearchresults/:searchtype',
    views: {
      'menuContent': {
        templateUrl: 'templates/resortsearchresults.html',
        controller: 'ResortSearchCtrl'
      }
    }
  })

  .state('sidemenu.resortdetails', {
    url: '/resortdetails/:id',
    views: {
      'menuContent': {
        templateUrl: 'templates/resortdetails.html',
        controller: 'ResortDetailsCtrl'
      }
    }
  })

  .state('sidemenu.eventsearchresults', {
    url: '/eventsearchresults/:searchtype',
    views: {
      'menuContent': {
        templateUrl: 'templates/eventsearchresults.html',
        controller: 'EventSearchCtrl'
      }
    }
  })

  .state('sidemenu.eventdetails', {
    url: '/eventdetails/:id',
    views: {
      'menuContent': {
        templateUrl: 'templates/eventdetails.html',
        controller: 'EventDetailsCtrl'
      }
    }
  })

  .state('sidemenu.placesearchresults', {
    url: '/placesearchresults/:searchtype/:type',
    views: {
      'menuContent': {
        templateUrl: 'templates/placesearchresults.html',
        controller: 'PlaceSearchCtrl'
      }
    }
  })

  .state('sidemenu.placedetails', {
    url: '/placedetails/:id',
    views: {
      'menuContent': {
        templateUrl: 'templates/placedetails.html',
        controller: 'PlaceDetailsCtrl'
      }
    }
  })

  .state('sidemenu.zoo', {
    url: '/zoo/:id',
    views: {
      'menuContent': {
        templateUrl: 'templates/zoo.html',
        controller:'ZooCtrl'
      }
    }
  })

 
  .state('sidemenu.singlecheckout', {
      url: '/singlecheckout/:packageid',
      views: {
      'menuContent': {
      templateUrl: 'templates/resortsinglecheckout.html',
      controller:'ResortSingleCheckOutCtrl'
         }
    }
    })

  .state('sidemenu.singlebookingresort', {
      url: '/singlebookingresort',
      views: {
      'menuContent': {      
        templateUrl: 'templates/singlebookingresort.html',
        controller:'SingleBookingResortCtrl'
          }
    },
      params: {
       obj: null,
       dateofvisit:null
     }
    })

  .state('sidemenu.checkoutoptionresorts', {
      url: '/checkoutoptionresorts',
      views: {
      'menuContent': {
      templateUrl: 'templates/checkoutoptionresorts.html',
      controller:'checkOutOptionResortsCtrl'
           }
    },
    params: {
       usertotals: null,
       userselectedoptions:null,
       dateofvisit:null
     }
      
    })


  .state('sidemenu.checkoutoption', {
      url: '/checkoutoption',
       views: {
      'menuContent': {
        templateUrl: 'templates/checkoutoption.html',
        controller:'checkOutOptionCtrl'
       }
    },
      params: {
       dateofvisit: null,
       usertotals: null,
       userselectedoptions:null
     },
      
    })

  .state('sidemenu.eventsinglecheckout', {
    url: '/eventsinglecheckout/:packageid',
    views: {
      'menuContent': {
        templateUrl: 'templates/eventsinglecheckout.html',
        controller:'EventSingleCheckOutCtrl'
      }
    }
  })

  .state('sidemenu.multicheckout', {
    url: '/multicheckout',
    views: {
      'menuContent': {
        templateUrl: 'templates/multicheckout.html',
        controller:'MultiCheckOutCtrl'
      }
    },
      params: {
       resortid:null
     }
  })


  .state('sidemenu.multibooking', {
      url: '/multibooking',
      views: {
      'menuContent': {
      templateUrl: 'templates/multibooking.html',
      controller:'MultiBookingCtrl'
  }
    },
      params: {
       obj: null,
       dateofvisit:null
     }
      
    })


  .state('sidemenu.singlebooking', {
      url: '/singlebooking',
      views: {
        'menuContent': {
        templateUrl: 'templates/singlebooking.html',
        controller:'SingleBookingCtrl'

      }
    },
  params: {
          useroptions: null,
          dateofvisit: null
        }
   
    })


  .state('sidemenu.checkoutoptionevents', {
      url: '/checkoutoptionevents',
      views: {
          'menuContent': {
          templateUrl: 'templates/checkoutoptionevents.html',
          controller:'CheckOutOptionEventCtrl'
            }
      },
      params: {
       usertotals: null,
       userselectedoptions:null,
       dateofvisit:null
     }

    })
  
  .state('sidemenu.response', {
      url: '/response',
      views: {
          'menuContent': {
          templateUrl: 'templates/response.html',
          controller:'ResponseCtrl'
         
            }
      }
      

    })


  // if none of the above states are matched, use this as the fallback
  $urlRouterProvider.otherwise('/sidemenu/home');
});




