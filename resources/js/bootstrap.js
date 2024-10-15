import axios from 'axios';
import 'trix';
import 'trix/dist/trix.css';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
