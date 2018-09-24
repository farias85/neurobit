/* 
 * File: EmpresaService.js
 * User: ucifarias@gmail.com
 * Date: 19-mar-2018
 * Time: 17:25:48
 */

sfApp.service('EmpresaService',
  ['ApiService',
    function (ApiService) {

      this.checkEmail = (email) => {
        const url = Routing.generate('api_empresa_email_exist', {'email': email, '_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data.exist;
          })
          .catch(err => console.error(err));
      };

      this.removeCuidador = (empresa, id) => {
        const url = Routing.generate('api_empresa_eliminar_cuidador', {'empresa': empresa, 'id': id, '_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => {
            console.log(err);
          });
      };

      this.nuevoFavorito = (empresa, id) => {
        const url = Routing.generate('api_empresa_nuevo_cuidador_favorito', {'empresa': empresa, 'id': id, '_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => {
            console.log(err);
          });
      };

      this.eliminarFavorito = (empresa, id) => {
        const url = Routing.generate('api_empresa_eliminar_cuidador_favorito', {'empresa': empresa, 'id': id, '_locale': _locale_});
        return ApiService.get(url)
          .then(response => {
            return response.data;
          })
          .catch(err => {
            console.log(err);
          });
      };

      this.changePassword = (body) => {
        const url = Routing.generate('api_empresa_change_password', {'_locale': _locale_});
        return ApiService.post(url, body)
          .then(response => {
            return response.data;
          })
          .catch(err => console.error(err));
      };
    }
  ]
);
