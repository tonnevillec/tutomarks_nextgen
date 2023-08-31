function getTutos(){
    return fetch('api/links', {
        headers: {
            'Accept': 'application/json',
        }
    }).then(r => r.json())
}

function get(endpoint){
    return fetch('api/' + endpoint, {
        headers: {
            'Accept': 'application/json',
        }
    }).then(r => r.json())
}

export default {
    getTutos,
    get
}