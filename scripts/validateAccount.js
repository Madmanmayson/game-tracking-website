document.getElementById("accountForm").onsubmit = validate;

function validate()
{
    //Create flag variable
    let isValid = true;

    //Clear all error messages
    let errors = document.getElementsByClassName("jsErr");
    for(let i=0; i<errors.length; i++)
    {
        errors[i].style.display = "none";
    }

    //Check username
    let username = document.getElementById("username").value;
    let usernameRegex = new RegExp('[A-Za-z0-9_-]{4,32}');
    if (!usernameRegex.test(username))
    {
        document.getElementById("err-username").style.display = "inline";
        isValid = false;
    }

    //Check password
    let password = document.getElementById("password").value;
    let passwordRegex = new RegExp('[A-Za-z0-9]{6,}');
    if (!passwordRegex.test(password))
    {
        document.getElementById("err-password").style.display = "inline";
        isValid = false;
    }

    //Check email
    let email = document.getElementById("email").value;
    let emailRegex = new RegExp('[a-z0-9!#$%&\'*+/=?^_`{|}~-]+(?:\\.[a-z0-9!#$%&\'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?');
    if (!emailRegex.test(email))
    {
        document.getElementById("err-email").style.display = "inline";
        isValid = false;
    }

    return isValid;
}