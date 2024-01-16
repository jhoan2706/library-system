import axios from 'axios';

export function checkIsLibrarian() {
    return axios.get('/api/user/role')
        .then(response => response.data === 'librarian')
        .catch(error => {
            console.error('Error fetching user role:', error);
            return false;
        });
}
