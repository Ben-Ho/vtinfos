import axios from 'axios';

export default axios.create({
    timeout: 30000,
    headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json',
        'Authorization': '',
        'X-Requested-With': 'XMLHttpRequest'
    }
});
