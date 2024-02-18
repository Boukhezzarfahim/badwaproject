var map = L.map('map').setView([36.792487488996954, 3.0480712946607555], 12);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors'
}).addTo(map);

var addresses = [
    { location: [36.733333, 2.950071], title: '27 rue semrouni ouled fayet-Alger' },
  
    // Ajoutez autant d'adresses que nécessaire
];

addresses.forEach(function (address) {
    L.marker(address.location).addTo(map)
        .bindPopup(address.title);
});



