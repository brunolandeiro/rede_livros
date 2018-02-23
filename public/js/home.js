function mudaEstante(form, estante_antes, estante_depois){
    document.getElementById(estante_antes).value = estante_depois
    document.getElementById(form).submit();
}

function openCity(evt, cityName, color) {
    var i, x, tablinks;
    x = document.getElementsByClassName("city");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablink");
    blue = document.getElementById("blue");
    green = document.getElementById("green");
    red = document.getElementById("red");
    if(color == "blue"){
        blue.className = blue.className.replace(" w3-border-white", " w3-border-blue");
        green.className = green.className.replace(" w3-border-green", " w3-border-white");
        red.className = red.className.replace(" w3-border-red", " w3-border-white");
    }
    if(color == "green"){
        blue.className = blue.className.replace(" w3-border-blue", " w3-border-white");
        green.className = green.className.replace(" w3-border-white", " w3-border-green");
        red.className = red.className.replace(" w3-border-red", " w3-border-white");
    }
    if(color == "red"){
        blue.className = blue.className.replace(" w3-border-blue", " w3-border-white");
        green.className = green.className.replace(" w3-border-green", " w3-border-white");
        red.className = red.className.replace(" w3-border-white", " w3-border-red");
    }

    document.getElementById(cityName).style.display = "block";
    //evt.currentTarget.firstElementChild.className += color;
}


$("document").ready(function(){
    // Preview da img
    $("#img_perfil").change(function() {
        readURL(this);
    });

    function readURL(input) {

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
});
