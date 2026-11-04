
// ==========================================
// SAFE AID - COMPLETE JAVASCRIPT
// ==========================================


// 1. LOCATION DATA - ALL 64 DISTRICTS

const locationData = {

    Dhaka: {
        Dhaka: ["Dhanmondi", "Mirpur", "Uttara", "Gulshan", "Mohammadpur"],
        Gazipur: ["Gazipur Sadar", "Tongi", "Kaliakair"],
        Narayanganj: ["Narayanganj Sadar", "Fatullah", "Sonargaon"],
        Tangail: ["Tangail Sadar", "Mirzapur", "Kalihati"],
        Narsingdi: [],
        Munshiganj: [],
        Manikganj: [],
        Kishoreganj: [],
        Faridpur: [],
        Gopalganj: [],
        Madaripur: [],
        Rajbari: [],
        Shariatpur: []
    },

    Chattogram: {
        Chattogram: ["Agrabad", "Panchlaish", "Kotwali", "Pahartali"],
        Coxsbazar: ["Cox's Bazar Sadar", "Teknaf", "Ukhia"],
        Chandanaish: ["Gachbaria", "Dohazari"],
        Sitakunda: ["Sitakunda Sadar", "Kumira"],
        Rangamati: [],
        Bandarban: [],
        Khagrachhari: [],
        Feni: [],
        Lakshmipur: [],
        Noakhali: [],
        Cumilla: [],
        Chandpur: [],
        Brahmanbaria: []
    },

    Rajshahi: {
        Rajshahi: [],
        Bogura: [],
        Joypurhat: [],
        Naogaon: [],
        Natore: [],
        Chapainawabganj: [],
        Pabna: [],
        Sirajganj: []
    },

    Khulna: {
        Khulna: [],
        Bagerhat: [],
        Chuadanga: [],
        Jashore: [],
        Jhenaidah: [],
        Kushtia: [],
        Magura: [],
        Meherpur: [],
        Narail: [],
        Satkhira: []
    },

    Barishal: {
        Barishal: [],
        Barguna: [],
        Bhola: [],
        Jhalokati: [],
        Patuakhali: [],
        Pirojpur: []
    },

    Sylhet: {
        Sylhet: [],
        Habiganj: [],
        Moulvibazar: [],
        Sunamganj: []
    },

    Rangpur: {
        Rangpur: [],
        Dinajpur: [],
        Gaibandha: [],
        Kurigram: [],
        Lalmonirhat: [],
        Nilphamari: [],
        Panchagarh: [],
        Thakurgaon: []
    },

    Mymensingh: {
        Mymensingh: [],
        Jamalpur: [],
        Netrokona: [],
        Sherpur: []
    }

};


// 2. DROPDOWN ELEMENTS

const division = document.getElementById("division");
const district = document.getElementById("district");
const area = document.getElementById("area");


// 3. MAP INITIALIZATION

const mapElement = document.getElementById("accidentMap");

let accidentMap = null;
let locationMarker = null;

if (mapElement && typeof L !== "undefined") {

    accidentMap = L.map("accidentMap");

    L.tileLayer(
        "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
        {
            attribution: "&copy; OpenStreetMap contributors"
        }
    ).addTo(accidentMap);

    // Show full Bangladesh

    accidentMap.fitBounds([
        [20.55, 88.0],
        [26.65, 92.7]
    ]);

}


// 4. LOCATION GEOCODING

async function zoomToLocation(place) {

    if (!accidentMap || !place) return;

    const query = encodeURIComponent(place + ", Bangladesh");

    try {

        const response = await fetch(
            "https://photon.komoot.io/api/?q=" +
            query + "&limit=1"
        );

        if (!response.ok) {
            throw new Error("Location search failed");
        }

        const data = await response.json();

        if (data.features && data.features.length > 0) {

            const coordinates = data.features[0].geometry.coordinates;

            const longitude = coordinates[0];
            const latitude = coordinates[1];
const zoomLevel = place.split(",").length === 1 ? 8 :
                  place.split(",").length === 2 ? 10 : 13;

            accidentMap.flyTo(
                [latitude, longitude],
                zoomLevel,
                { duration: 1.5 }
            );

            if (locationMarker) {
                accidentMap.removeLayer(locationMarker);
            }

            locationMarker = L.marker([latitude, longitude])
                .addTo(accidentMap)
                .bindPopup("<b>" + place + "</b>")
                .openPopup();

        } else {

            alert("Location not found. Please try another location.");

        }

    } catch (error) {

        console.error("Map error:", error);

        alert("Unable to load location. Please try again.");

    }

}


// 5. DIVISION CHANGE

function fillDistricts() {

    district.innerHTML =
        '<option value="">Select District</option>';

    area.innerHTML =
        '<option value="">Select Area</option>';

    const selectedDivision = division.value;

    if (locationData[selectedDivision]) {

        Object.keys(locationData[selectedDivision]).forEach(name => {

            const option = document.createElement("option");

            option.value = name;
            option.textContent = name;

            district.appendChild(option);

        });

        zoomToLocation(selectedDivision);

    } else if (!selectedDivision) {

        if (accidentMap) {
            accidentMap.flyToBounds([
                [20.55, 88.0],
                [26.65, 92.7]
            ]);
        }

        if (locationMarker) {
            accidentMap.removeLayer(locationMarker);
            locationMarker = null;
        }

    }

}


// 6. DISTRICT CHANGE

function fillAreas() {

    area.innerHTML =
        '<option value="">Select Area</option>';

    const selectedDivision = division.value;
    const selectedDistrict = district.value;

    if (
        locationData[selectedDivision] &&
        locationData[selectedDivision][selectedDistrict]
    ) {

        locationData[selectedDivision][selectedDistrict].forEach(name => {

            const option = document.createElement("option");

            option.value = name;
            option.textContent = name;

            area.appendChild(option);

        });

        zoomToLocation(selectedDistrict + ", " + selectedDivision);

    }

}


// 7. AREA CHANGE

function zoomSelectedArea() {

    const selectedArea = area.value;
    const selectedDistrict = district.value;
    const selectedDivision = division.value;

    if (selectedArea) {

        zoomToLocation(
            selectedArea + ", " +
            selectedDistrict + ", " +
            selectedDivision
        );

    }

}

if (division) {
    division.addEventListener("change", fillDistricts);
}

if (district) {
    district.addEventListener("change", fillAreas);
}

if (area) {
    area.addEventListener("change", zoomSelectedArea);
}


// 8. DEMO ACCIDENT DATA

const accidents = [

    {
        title: "Road Accident",
        division: "Chattogram",
        district: "Chattogram",
        area: "Agrabad",
        status: "Demo Report"
    },

    {
        title: "Traffic Accident",
        division: "Chattogram",
        district: "Chattogram",
        area: "Panchlaish",
        status: "Demo Report"
    },

    {
        title: "Road Accident",
        division: "Chattogram",
        district: "Coxsbazar",
        area: "Teknaf",
        status: "Demo Report"
    },

    {
        title: "Road Accident",
        division: "Dhaka",
        district: "Dhaka",
        area: "Mirpur",
        status: "Demo Report"
    }

];


// 9. ACCIDENT MARKERS

const accidentLocations = [

    {
        name: "Agrabad",
        lat: 22.3265,
        lng: 91.8123
    },

    {
        name: "Panchlaish",
        lat: 22.3596,
        lng: 91.8225
    },

    {
        name: "Teknaf",
        lat: 20.8667,
        lng: 92.2985
    },

    {
        name: "Mirpur",
        lat: 23.8067,
        lng: 90.3687
    }

];

if (accidentMap) {

    accidentLocations.forEach(location => {

        L.marker([location.lat, location.lng])
            .addTo(accidentMap)
            .bindPopup(
                "<b>Demo Accident Location</b><br>" +
                location.name
            );

    });

}


// 10. ACCIDENT SEARCH

const searchButton =
    document.getElementById("searchAccidents");

const searchMessage =
    document.getElementById("searchMessage");

const searchResults =
    document.getElementById("searchResults");

if (searchButton) {

    searchButton.addEventListener("click", function () {

        const selectedDivision = division.value;
        const selectedDistrict = district.value;
        const selectedArea = area.value;

        searchResults.innerHTML = "";

        if (!selectedDivision || !selectedDistrict || !selectedArea) {

            searchMessage.textContent =
                "Please select Division, District and Area.";

            return;

        }

        const foundAccidents = accidents.filter(accident => {

            return (
                accident.division === selectedDivision &&
                accident.district === selectedDistrict &&
                accident.area === selectedArea
            );

        });

        if (foundAccidents.length === 0) {

            searchMessage.textContent =
                "No demo accident reports found in this area.";

            return;

        }

        searchMessage.textContent =
            foundAccidents.length + " demo report(s) found.";

        foundAccidents.forEach(accident => {

            const card = document.createElement("div");

            card.className = "accident-result";

            const heading = document.createElement("h3");
            heading.textContent = accident.title;

            const location = document.createElement("p");
            location.textContent =
                accident.district + ", " + accident.area;

            const status = document.createElement("p");
            status.textContent = accident.status;

            card.appendChild(heading);
            card.appendChild(location);
            card.appendChild(status);

            searchResults.appendChild(card);

        });

    });

}


// 11. MISSING PERSON SEARCH

const missingSearch =
    document.getElementById("missingSearch");

if (missingSearch) {

    missingSearch.addEventListener("submit", function (event) {

        event.preventDefault();

        const name = document.getElementById("missingName")?.value.trim();
        const age = document.getElementById("missingAge")?.value.trim();
        const location = document.getElementById("missingLocation")?.value.trim();

        const message = document.getElementById("missingMessage");

        if (!name || !age || !location) {

            message.textContent = "Please fill in all fields.";
            return;

        }

        message.textContent =
            "Search submitted. No live missing-person database is connected yet.";

    });

}


// 12. HOSPITAL SEARCH

const hospitalSearch =
    document.getElementById("hospitalSearch");

const hospitals = [

    {
        name: "Chittagong Medical College Hospital",
        location: "Chattogram"
    },

    {
        name: "Evercare Hospital Chattogram",
        location: "Chattogram"
    },

    {
        name: "Dhaka Medical College Hospital",
        location: "Dhaka"
    },

    {
        name: "National Institute of Cardiovascular Diseases",
        location: "Dhaka"
    }

];

if (hospitalSearch) {

    hospitalSearch.addEventListener("submit", function (event) {

        event.preventDefault();

        const searchValue =
            document.getElementById("searchHospital")?.value.trim().toLowerCase();

        const hospitalResults =
            document.getElementById("hospitalResults");

        hospitalResults.innerHTML = "";

        if (!searchValue) {

            hospitalResults.textContent =
                "Please enter a hospital name or location.";

            return;

        }

        const foundHospitals = hospitals.filter(hospital => {

            return (
                hospital.name.toLowerCase().includes(searchValue) ||
                hospital.location.toLowerCase().includes(searchValue)
            );

        });

        if (foundHospitals.length === 0) {

            hospitalResults.textContent = "No demo hospital found.";
            return;

        }

        foundHospitals.forEach(hospital => {

            const card = document.createElement("div");

            card.className = "hospital-result";

            const heading = document.createElement("h3");
            heading.textContent = hospital.name;

            const location = document.createElement("p");
            location.textContent = hospital.location;

            card.appendChild(heading);
            card.appendChild(location);

            hospitalResults.appendChild(card);

        });

    });

}


// 13. SUBSCRIPTION FORM VALIDATION

const subscribeForm =
    document.querySelector(".subscribe-form");

if (subscribeForm) {

    subscribeForm.addEventListener("submit", function (event) {

        const email =
            document.getElementById("subscriber_email");

        const selectedArea =
            document.getElementById("subscriber_area");

        if (
            !email ||
            !email.value.trim() ||
            !selectedArea ||
            !selectedArea.value
        ) {

            event.preventDefault();

            alert("Please enter your email and select an area.");

        }

    });

}


// ==========================================
// END OF SAFE AID JAVASCRIPT
// ==========================================
