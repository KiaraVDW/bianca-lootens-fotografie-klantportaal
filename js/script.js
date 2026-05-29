function toggleMenu() {
    var nav = document.getElementById("main-nav");
    nav.classList.toggle("open");
}

function countCharacters() {
    var textarea = document.getElementById("comment");
    var counter = document.getElementById("char-counter");

    if (textarea && counter) {
        counter.innerHTML = textarea.value.length + " / 300 tekens";
    }
}

function updatePrice() {
    var packageSelect = document.getElementById("package_type");
    var output = document.getElementById("price-estimate");
    var price = "Kies eerst een formule";

    if (!packageSelect || !output) {
        return;
    }

    var packageType = packageSelect.value;

    if (packageType == "Fotoshoot studio") {
        price = "€140";
    } else if (packageType == "Fotoshoot op locatie") {
        price = "€140 + eventueel €0,45/km";
    } else if (packageType == "Groei-abonnement") {
        price = "€550";
    } else if (packageType == "Huwelijk of event") {
        price = "op aanvraag";
    } else if (packageType == "Concert of bandreportage") {
        price = "op aanvraag";
    }

    output.innerHTML = price;
}
