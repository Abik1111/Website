function LengthConverter() {
    var select1 = document.getElementById("Selectbox1");
    var select11 = select1.options[select1.selectedIndex].value;
    console.log(select11);
    var select2 = document.getElementById("Selectbox2");
    var select22 = select2.options[select2.selectedIndex].value;
    console.log(select22);
    var area = document.getElementById("inputLength").value;
    console.log(area);
    if (select11 == "Ana" && select22 == "Ropani") {
        document.getElementById("outputMeters").textContent =
            area / 16;
    } else if (select11 == "Ropani" && select22 == "Ana") {
        document.getElementById("outputMeters").textContent =
            area * 16;
    } else if (select11 == "Ana" && select22 == "Katha") {
        document.getElementById("outputMeters").textContent =
            area / 10.6501;
    } else if (select11 == "Katha" && select22 == "Ana") {
        document.getElementById("outputMeters").textContent =
            area * 10.6501;
    } else if (select11 == "Ana" && select22 == "Dhur") {
        document.getElementById("outputMeters").textContent =
            area * 1.87791;
    } else if (select11 == "Dhur" && select22 == "Ana") {
        document.getElementById("outputMeters").textContent =
            area / 1.87791;
    } else if (select11 == "Ana" && select22 == "Dam") {
        document.getElementById("outputMeters").textContent =
            area * 16.00046;
    } else if (select11 == "Dam" && select22 == "Ana") {
        document.getElementById("outputMeters").textContent =
            area / 16.00046;
    } else if (select11 == "Ana" && select22 == "Paisa") {
        document.getElementById("outputMeters").textContent =
            area * 4.0012;
    } else if (select11 == "Paisa" && select22 == "Ana") {
        document.getElementById("outputMeters").textContent =
            area / 4.0012;
    } else if (select11 == "Ana" && select22 == "Square Foot") {
        document.getElementById("outputMeters").textContent =
            area * 342.25;
    } else if (select11 == "Square Foot" && select22 == "Ana") {
        document.getElementById("outputMeters").textContent =
            area / 342.25;
    } else if (
        select11 == "Ana" &&
        select22 == "Square Meter"
    ) {
        document.getElementById("outputMeters").textContent =
            area * 31.7961;
    } else if (
        select11 == "Square Meter" &&
        select22 == "Ana"
    ) {
        document.getElementById("outputMeters").textContent =
            area / 31.7961;
    } else if (
        select11 == "Square Foot" &&
        select22 == "Square Meter"
    ) {
        document.getElementById("outputMeters").textContent =
            area * 0.092903;
    } else if (
        select11 == "Square Meter" &&
        select22 == "Square Foot"
    ) {
        document.getElementById("outputMeters").textContent =
            area / 0.092903;
    } else if (
        select11 == "Square Foot" &&
        select22 == "Ropani"
    ) {
        document.getElementById("outputMeters").textContent =
            area / 5476;
    } else if (
        select11 == "Ropani" &&
        select22 == "Square Foot"
    ) {
        document.getElementById("outputMeters").textContent =
            area * 5476;
    } else if (
        select11 == "Square Foot" &&
        select22 == "Katha"
    ) {
        document.getElementById("outputMeters").textContent =
            area / 342.25;
    } else if (
        select11 == "Katha" &&
        select22 == "Square Foot"
    ) {
        document.getElementById("outputMeters").textContent =
            area * 342.25;
    } else if (
        select11 == "Square Foot" &&
        select22 == "Dhur"
    ) {
        document.getElementById("outputMeters").textContent =
            area / 182.25;
    } else if (
        select11 == "Dhur" &&
        select22 == "Square Foot"
    ) {
        document.getElementById("outputMeters").textContent =
            area * 182.25;
    } else if (select11 == "Square Foot" && select22 == "Dam") {
        document.getElementById("outputMeters").textContent =
            area / 21.39;
    } else if (select11 == "Dam" && select22 == "Square Foot") {
        document.getElementById("outputMeters").textContent =
            area * 21.39;
    } else if (
        select11 == "Square Foot" &&
        select22 == "Paisa"
    ) {
        document.getElementById("outputMeters").textContent =
            area / 85.56;
    } else if (
        select11 == "Paisa" &&
        select22 == "Square Foot"
    ) {
        document.getElementById("outputMeters").textContent =
            area * 85.56;
    } else if (
        select11 == "Square Meter" &&
        select22 == "Ropani"
    ) {
        document.getElementById("outputMeters").textContent =
            area / 508.73754;
    } else if (
        select11 == "Ropani" &&
        select22 == "Square Meter"
    ) {
        document.getElementById("outputMeters").textContent =
            area * 508.73754;
    } else if (
        select11 == "Square Meter" &&
        select22 == "Katha"
    ) {
        document.getElementById("outputMeters").textContent =
            area / 338.63191;
    } else if (
        select11 == "Katha" &&
        select22 == "Square Meter"
    ) {
        document.getElementById("outputMeters").textContent =
            area * 338.63191;
    } else if (
        select11 == "Square Meter" &&
        select22 == "Dhur"
    ) {
        document.getElementById("outputMeters").textContent =
            area / 16.9316;
    } else if (
        select11 == "Dhur" &&
        select22 == "Square Meter"
    ) {
        document.getElementById("outputMeters").textContent =
            area * 16.9316;
    } else if (
        select11 == "Square Meter" &&
        select22 == "Dam"
    ) {
        document.getElementById("outputMeters").textContent =
            area / 1.9872;
    } else if (
        select11 == "Dam" &&
        select22 == "Square Meter"
    ) {
        document.getElementById("outputMeters").textContent =
            area * 1.9872;
    } else if (
        select11 == "Square Meter" &&
        select22 == "Paisa"
    ) {
        document.getElementById("outputMeters").textContent =
            area / 7.948;
    } else if (
        select11 == "Paisa" &&
        select22 == "Square Meter"
    ) {
        document.getElementById("outputMeters").textContent =
            area * 7.948;
    } else if (select11 == "Ropani" && select22 == "Katha") {
        document.getElementById("outputMeters").textContent =
            area * 1.502332;
    } else if (select11 == "Katha" && select22 == "Ropani") {
        document.getElementById("outputMeters").textContent =
            area / 1.502332;
    } else if (select11 == "Ropani" && select22 == "Dhur") {
        document.getElementById("outputMeters").textContent =
            area * 30.04664;
    } else if (select11 == "Dhur" && select22 == "Ropani") {
        document.getElementById("outputMeters").textContent =
            area / 30.04664;
    } else if (select11 == "Ropani" && select22 == "Dam") {
        document.getElementById("outputMeters").textContent =
            area * 256.0075;
    } else if (select11 == "Dam" && select22 == "Ropani") {
        document.getElementById("outputMeters").textContent =
            area / 256.0075;
    } else if (select11 == "Ropani" && select22 == "Paisa") {
        document.getElementById("outputMeters").textContent =
            area * 64.00187;
    } else if (select11 == "Paisa" && select22 == "Ropani") {
        document.getElementById("outputMeters").textContent =
            area / 64.00187;
    } else if (select11 == "Katha" && select22 == "Dhur") {
        document.getElementById("outputMeters").textContent =
            area * 20;
    } else if (select11 == "Dhur" && select22 == "Katha") {
        document.getElementById("outputMeters").textContent =
            area / 20;
    } else if (select11 == "Katha" && select22 == "Dam") {
        document.getElementById("outputMeters").textContent =
            area * 170.4067;
    } else if (select11 == "Dam" && select22 == "Katha") {
        document.getElementById("outputMeters").textContent =
            area / 170.4067;
    } else if (select11 == "Katha" && select22 == "Paisa") {
        document.getElementById("outputMeters").textContent =
            area * 42.6017;
    } else if (select11 == "Paisa" && select22 == "Katha") {
        document.getElementById("outputMeters").textContent =
            area / 42.6017;
    } else if (select11 == "Dhur" && select22 == "Dam") {
        document.getElementById("outputMeters").textContent =
            area * 8.5203;
    } else if (select11 == "Dam" && select22 == "Dhur") {
        document.getElementById("outputMeters").textContent =
            area / 8.5203;
    } else if (select11 == "Dhur" && select22 == "Paisa") {
        document.getElementById("outputMeters").textContent =
            area * 2.13008;
    } else if (select11 == "Paisa" && select22 == "Dhur") {
        document.getElementById("outputMeters").textContent =
            area / 2.13008;
    } else if (select11 == "Dam" && select22 == "Paisa") {
        document.getElementById("outputMeters").textContent =
            area * 0.25;
    } else if (select11 == "Paisa" && select22 == "Dam") {
        document.getElementById("outputMeters").textContent =
            area / 0.25;
    } else {
        document.getElementById(
            "outputMeters"
        ).textContent = area;
    }
}

document.addEventListener("DOMContentLoaded", function (event) {
    document
        .querySelector("#inputLength")
        .addEventListener("keyup", function (event) {
            console.log(this);
            LengthConverter();
        });
    document
    .querySelector("#Selectbox1")
    .addEventListener("click", function (event) {
        console.log(this);
        LengthConverter();
    });
    document
    .querySelector("#Selectbox2")
    .addEventListener("click", function (event) {
        console.log(this);
        LengthConverter();
    });
});