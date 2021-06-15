document.getElementById("gameForm").onsubmit = validate;

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

    //Check title
    let title = document.getElementById("title").value;
    if (title === "")
    {
        document.getElementById("err-title").style.display = "inline";
        isValid = false;
    }

    //Check description
    let description = document.getElementById("description").value;
    if (description === "")
    {
        document.getElementById("err-description").style.display = "inline";
        isValid = false;
    }

    //Check genre
    let genre = document.getElementById("genre").value;
    if (genre === "")
    {
        document.getElementById("err-genre").style.display = "inline";
        isValid = false;
    }

    //Check platform
    let platforms = document.getElementsByName("platforms[]");
    let checked = 0;
    for(let i=0; i<platforms.length; i++)
    {
        if (platforms[i].checked)
        {
            checked++;
        }
    }
    if (checked === 0)
    {
        document.getElementById("err-platform").style.display = "inline";
        isValid = false;
    }

    return isValid;
}