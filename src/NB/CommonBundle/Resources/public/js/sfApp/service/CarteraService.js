/* 
 * File: PssService.js
 * User: ucifarias@gmail.com
 * Date: 29-jun-2018
 * Time: 17:25:48
 */

sfApp.service('CarteraService',
  ['ApiService',
    function (ApiService) {

      this.financialState = (body) => {
        const url = Routing.generate('api_cartera_financial_state', {'_locale': _locale_});
        return ApiService.post(url, body)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };
    }
  ]
);
