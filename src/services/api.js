import axios from 'axios';

const api = axios.create({
  baseURL: 'https://cidadaniaeseguranca.free.beeceptor.com'
});

/*api.interceptors.request.use(async function (request) {
  if (!['/login', '/users/register'].includes(request.url)) {
    try {
      const token = await AsyncStorage.getItem('token')
      request.headers.Authorization = Bearer ${token};
    } catch (e) {
      console.log('Erro ao ler o token')
      console.log(e)
    }
  }

  return request;
}, function (error) {
  return Promise.reject(error);
});
*/

export default api;