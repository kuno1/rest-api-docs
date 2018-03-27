/*!
 * API Controller
 */
import axios from 'axios';


/*global RadVars: false*/

class WpApi {

  constructor(){
    this.nonce = RadVars.nonce;
    this.route = RadVars.route;
  }

  api(headers = {}){
    let real_headers = {
      'Content-Type': 'application/json',
      'X-Requested-With': 'XMLHttpRequest',
      'X-WP-Nonce': this.nonce
    };
    if(Object.keys(headers).length){
      real_headers = Object.assign(real_headers, headers);
    }
    return axios.create({
      baseURL: this.route,
      headers: real_headers,
      responseType: 'json'
    });
  }
}

export default new WpApi();
