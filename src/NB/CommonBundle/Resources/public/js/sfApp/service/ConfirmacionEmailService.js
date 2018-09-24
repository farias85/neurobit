/* 
 * File: ConfirmacionEmailService.js
 * User: ucifarias@gmail.com
 * Date: 7-abril-2018
 * Time: 10:35:27
 */

sfApp.service('ConfirmacionEmailService',
  ['ApiService',
    function (ApiService) {

      this.create = (body) => {
        const url = Routing.generate('api_confirmacion_email_create', {'_locale': _locale_});
        return ApiService.post(url, body)
          .then(response => {
            return response.data;
          })
          .catch(err => console.log(err));
      };

    }
  ]
);