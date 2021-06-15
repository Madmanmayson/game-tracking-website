let template = document.querySelector('#gameTemplate');

let gameList = document.getElementById('gameList');

document.addEventListener("DOMContentLoaded", function(){
    getGameListData();
});

async function getGameListData(){
    let path = getApiDataUrl();
    console.log(path);

    await fetch(path, {
        method: 'GET',
        headers: {
            'Content-type': 'application/json; charset=UTF-8'
        }
    })
        .then(response => response.json())
        .then(json => populateList(json));
}

function populateList(json){
    for (let gameData of json) {
        let clone = template.content.cloneNode(true);
        clone.querySelector('#gameId').id=gameData.gamePlatformId;
        clone.querySelector('#title').textContent=gameData.gameName;
        clone.querySelector('#description').textContent=gameData.description;
        clone.querySelector('#platform').textContent=gameData.platformName;
        clone.querySelector('#status').textContent=gameData.statusName;

        gameList.appendChild(clone);
    }
}


function getApiDataUrl(){
    let currentPath = window.location.href;
    let apiPath = currentPath.substr(0, currentPath.indexOf('profile'))
    username = currentPath.substr(currentPath.lastIndexOf('/'));
    return apiPath + 'api/users' + username + '/list';
}