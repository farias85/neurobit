/* 
 * File: PssService.js
 * User: ucifarias@gmail.com
 * Date: 29-jun-2018
 * Time: 17:25:48
 */

sfApp.service('PssService',
  ['ApiService',
    function (ApiService) {

      this.find = (body) => {
        const url = Routing.generate('api_pss_find', {'_locale': _locale_});
        return ApiService.post(url, body)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };

      this.create = (body) => {
        const url = Routing.generate('api_pss_create', {'_locale': _locale_});
        return ApiService.post(url, body)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };
    }
  ]
);
