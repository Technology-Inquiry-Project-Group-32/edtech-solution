async function doPost(url, data) {
    let response = await fetch(url, {
        method: "POST",
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
    });
    return await response.json();
}
async function doPut(url, data) {
    let response = await fetch(url, {
        method: "PUT",
        headers: {'Content-Type': 'application/json'},
        body: JSON.stringify(data)
    });
    return await response.json();
}
async function doGet(url, data) {
    if(!data){
        let response = await fetch(`${url}`, {
            method: "GET",
            headers: {'Content-Type': 'application/json'}
        })
        return await response.json();
    }
    queryString = new URLSearchParams(data). toString();
    let response = await fetch(`${url}?${queryString}`, {
        method: "GET",
        headers: {'Content-Type': 'application/json'}
    });
    return await response.json();
}
async function doDelete(url) {
    queryString = new URLSearchParams(data). toString();
    let response = await fetch(`${url}?${queryString}`, {
        method: "DELETE",
        headers: {'Content-Type': 'application/json'}
    });
    return await response.json();
}