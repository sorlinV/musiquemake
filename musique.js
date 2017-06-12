let add = document.querySelector("#add");
let notes = ['_', '0', 'do4', 'do5', 'do#4', 'do#5', 'fa4', 'fa#4', 'la3', 'la4', 'la#4', 'la3', 'la4', 'la#3', 'la#4', 'mi4', 'mi5', 're4', 're5', 're#4', 're#5', 'si3', 'si4', 'sol4', 'sol#4'];
let id = -1;
add.addEventListener("click", function() {
    let select = document.createElement("select");
    for (let i = 0; i < notes.length; i++) {
        let option = document.createElement("option");
        option.value = notes[i];
        option.textContent = notes[i];
        select.appendChild(option);
    }
    select.name = "id" + id++;
    document.querySelector("#notes").appendChild(select);
});

let audio = document.querySelector("#audio");

function sound(note) {
    return function() {
        if (note !== "_" && note !== "0") {
            audio.src = "sound/" + note + ".mp3";
            audio.play();
        } else if (note === "_") {
            audio.play();
        } else if (note === "0") {
            audio.pause();
        }
    }
}

let play = document.querySelector("#play");
let time_sound = 200;
play.addEventListener("click", function() {
    let notes = document.querySelectorAll("select");
    for (let i = 0; i < notes.length; i++) {
        let note = notes[i].options[notes[i].selectedIndex].value;
    }
    setTimeout(sound("0"), (i + 1) * time_sound);
});

let saveds = document.querySelectorAll(".saved");
for (let i = 0; i < saveds.length; i++) {
    saveds[i].addEventListener("click", function() {
        let value = saveds[i].parentNode.children[0].value.split("/");
        for (let i = 0; i < value.length; i++) {
            setTimeout(sound(value[i]), i * time_sound);
        }
        setTimeout(sound("0"), (i + 1) * time_sound);
    });
}