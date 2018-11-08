/**
 * Created by Felipe on 09/02/2018.
 */

let nbApp = angular.module('NB',
    [
        'ngResource',
        'ngRoute',
        'ngCookies',
        'ngAnimate',
        'chart.js',
        'ngSanitize',
        'ui.multiselect',
        'ngFileUpload',
        'pascalprecht.translate',
        'LocalStorageModule',
        'growlNotifications',
        'mgo-angular-wizard',
    ], function ($interpolateProvider) {
        $interpolateProvider.startSymbol('{|');
        return $interpolateProvider.endSymbol('|}');
    }
).run(
    ['$rootScope', '$cookieStore', '$location', '$translate', '$window',
        function ($rootScope, $cookieStore, $location, $translate, $window) {
            const {
                nbAsset, nbHost, nbBaseUrl, nbMaxFileSize, nbMaxVideoFileSize,
            } = $window.nbConfig;

            $rootScope.ASSET_URL = nbAsset.split('common')[0];
            $rootScope.UPLOADS_URL = `${nbAsset.split('bundles')[0]}uploads/`;
            $rootScope.HOST_URL = nbHost;
            $rootScope.BASE_URL = nbBaseUrl;
            $rootScope.MB = 1048576; //1MB -> 1048576 bytes
            $rootScope.MAX_FILE_SIZE = $rootScope.MB * nbMaxFileSize;
            $rootScope.MAX_VIDEO_FILE_SIZE = $rootScope.MB * nbMaxVideoFileSize;

        }
    ]
);

