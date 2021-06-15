let overlay = document.getElementById('overlay');
let addGameBox = document.getElementById('addGameBox');

let focusId;

document.querySelector('#upload').addEventListener('click', sendData);

async function openDialogue(id){
    overlay.classList.toggle('active', true);
    addGameBox.classList.toggle('active', true);
    focusId = id;

    let path = getApiUrl(id);

    await fetch(path, {
        method: 'GET',
        headers: {
            'Content-type': 'application/json; charset=UTF-8'
        }
    })
        .then(response => response.json())
        .then(json => updateDialogueBox(json));
}

function updateDialogueBox(json){
    document.getElementById('gameTitle').textContent = json.gameName;

    //update platforms
    let platformSelect = document.getElementById('platform');
    platformSelect.innerHTML= "";
    for (let platform of json.platforms) {
        let option = document.createElement('option');
        option.setAttribute('value', platform.gamePlatformId);
        option.textContent = platform.platformName;
        platformSelect.appendChild(option);
    }
}

function closeDialogue(){
    overlay.classList.toggle('active', false);
    addGameBox.classList.toggle('active', false);
    focusId = -1;
}

async function sendData(){
    console.log('Sending');
    let path = getPostUrl();

    closeDialogue();
    await fetch(path, {
        method: 'POST',
        body: JSON.stringify({
            gamePlatformId: document.getElementById('platform').value,
            userId: currentUserId,
            statusId: document.getElementById('status').value
        }),
        headers: {
            'Content-type': 'application/json; charset=UTF-8'
        }
    })
        .then(response => response.json())
        .then(json => console.log(json));
}

function updateImage(response){
    if(response.status == 200){
        response.json().then(data => {
            avatarImageTag.src = data.path + "#" + new Date().getTime();
        });
    }
}

function getApiUrl(id){
    let currentPath = window.location.href;
    let apiPath = currentPath.substr(0, currentPath.indexOf('profile'))
    return apiPath + 'api/games/' + id;
}

function getPostUrl(){
    let currentPath = window.location.href;
    let apiPath = currentPath.substr(0, currentPath.indexOf('profile'))
    return apiPath + 'api/users/' + currentUsername + '/list';
}