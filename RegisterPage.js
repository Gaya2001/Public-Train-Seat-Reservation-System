
//JavaScript code to handle radio button changes
const localRadio = document.getElementById("Local");
const touristRadio = document.getElementById("tourist");
const myid1 = document.getElementById("myid1");
const myid2 = document.getElementById("myid2");

localRadio.addEventListener("change", () => {
    if (localRadio.checked) {
        myid1.style.display = "block";
        myid2.style.display = "none";
    }
});

touristRadio.addEventListener("change", () => {
    if (touristRadio.checked) {
        myid1.style.display = "none";
        myid2.style.display = "block";
    }
});