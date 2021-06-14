let overlay = document.getElementById('overlay');
let avatarBox = document.getElementById('avatarBox');
let previewImageTag = document.getElementById('preview');
let avatarImageTag = document.getElementById('avatar');

let pfpdata;
let username;

document.querySelector('#avatarUpload').addEventListener('click', openDialogue);
document.querySelector('#image-input').addEventListener('change', previewImage);
document.querySelector('#upload').addEventListener('click', uploadImage);

function openDialogue(){
    overlay.classList.toggle('active', true);
    avatarBox.classList.toggle('active', true);
}

function closeDialogue(){
    overlay.classList.toggle('active', false);
    avatarBox.classList.toggle('active', false);
}

function previewImage(){
    let reader = new FileReader();
    reader.onload = function () {
        previewImageTag.src = reader.result;
        pfpdata = reader.result;
    }

    reader.readAsDataURL(this.files[0]);
}

async function uploadImage(){
    if(pfpdata){
        let path = getApiUrl();

        closeDialogue();
        await fetch(path, {
            method: 'PATCH',
            body: JSON.stringify({
                avatar: pfpdata
            }),
            headers: {
                'Content-type': 'application/json; charset=UTF-8'
            }
        })
            .then(response => updateImage(response));
    }
}

function updateImage(response){
    if(response.status == 200){
        response.json().then(data => {
            avatarImageTag.src = data.path + "#" + new Date().getTime();
        });
    }
}

function getApiUrl(){
    let currentPath = window.location.href;
    let apiPath = currentPath.substr(0, currentPath.indexOf('profile'))
    username = currentPath.substr(currentPath.lastIndexOf('/'));
    return apiPath + 'api/users' + username;
}