const dropdownButton = document.getElementById("dropdown-button");
const dropdownMenu = document.getElementById("dropdown-menu");
const dropdownSelectedOption = document.getElementById("dropdown-selected-option");
const caret = document.getElementById("caret");
caret.style.transform ='rotate(0deg)'

function toggleCaret(){
    caret.style.transform =='rotate(0deg)'? caret.style.transform ='rotate(180deg)':caret.style.transform ='rotate(0deg)';
}

dropdownButton.addEventListener("click", function (event) {
    event.stopPropagation();
    toggleCaret();
    dropdownMenu.classList.toggle("hidden");
    dropdownButton.setAttribute("aria-expanded", dropdownMenu.classList.contains("hidden") ? "false" : "true");
});

// Dismiss dropdown when clicking outside of it
document.addEventListener("click", function (event) {
    if (!dropdownMenu.contains(event.target)) {
        dropdownMenu.classList.add("hidden");
        dropdownButton.setAttribute("aria-expanded", "false");
        caret.style.transform = 'rotate(0deg)';
    }
});
