document.getElementById("header").innerHTML = localStorage.getItem("liga")
  ? `Clubes da <b>${localStorage.getItem("liga")}</b>`
  : "Sem liga selecionada";
// Load JSON data from leagues.json
fetch("js/leagues.json")
  .then((response) => response.json())
  .then((data) => {
    const clubsContainer = document.getElementById("clubs");

    // Generate HTML for league cards
    data.leagues
      .find((league) => league.name === localStorage.getItem("liga"))
      ?.teams?.forEach((team) => {
        // Create league card HTML
        const clubData = JSON.stringify(team);
        console.log(team);
        console.log(clubData);
        const teamCardHTML = `
          <div class="col-md-3">
            <div class="card">
              <img src="${team.image}" class="card-img-top" alt="${team.name}">
              <div class="card-body">
                <h3 class="card-title">${team.name}</h3>
                <p class="card-text">Clique no botão abaixo para ver mais detalhes sobre este clube!</p>
                <button class="btn btn-dark btn-card" data-club='${clubData}' onclick='requestMeteoApi("${team.city}");requestFlickrApi("${team.name}")' data-toggle="modal" data-target="#modalInfo">Ver mais detalhes</button>
              </div>
            </div>
          </div>
        `;
        // Append league card HTML to container
        clubsContainer.innerHTML += teamCardHTML;
      });
  })
  .catch((error) => console.error("Error loading JSON:", error));

$("#modalInfo").on("show.bs.modal", function (event) {
  const button = $(event.relatedTarget);
  const club = button.data("club");

  const modal = $(this);
  modal.find(".modal-title").text(club.name);

  const modalBody = modal.find(".modal-body")[0]; // Get the raw DOM element

  modalBody.innerHTML = ""; // Clear previous content

  const clubImage = `<div id="photosContainer"></div>`;
  const notmyguilt = `<p><b>Imagem Gerada pelo API através do nome do Clube</b></p>`;
  const foundationText = `<div><b>Data de Fundação:</b> ${club.foundation}</div>`;
  const cityText = `<p><strong>Cidade:</strong> ${club.city}</p>`;
  const temp = `<div id="meteoContainer"></div>`

  modalBody.innerHTML += notmyguilt;
  modalBody.innerHTML += clubImage;
  modalBody.innerHTML += foundationText;
  modalBody.innerHTML += cityText;
  modalBody.innerHTML += temp;
});


function requestMeteoApi(nome) {
  const cityValue = nome;

  $.ajax({
    url: "https://api.openweathermap.org/data/2.5/weather",
    data: {
      q: cityValue,
      appid: "09d5c10574177367ef50322886321bb9",
      units: "metric",
      lang: "EN",
    },
    method: "GET",
    success: function (response) {
      console.log(response);
      const temperature = response.main.temp;
      $("#meteoContainer").html(
        "A temperatura em " +
        cityValue +
        " é de: " +
        temperature +
        " ºC e " +
        (temperature * 1.8 + 32) +
        " ºF !!"
      );
    },
  });
}

function requestFlickrApi(nome) {
  const nomeC = nome;

  console.log(nomeC);

  const requestOptions = {
    method: "GET", // *GET, POST, PUT, DELETE, etc.
  };

  const requestBody = {
    method: "flickr.photos.search",
    api_key: "acb0d07ce4123dfe53f12727f137b9a1",
    extras: "url_l",
    per_page: 1,
    text: nomeC,
    format: "json",
    nojsoncallback: 1,
  };

  const urlParams = new URLSearchParams(requestBody).toString();

  fetch("https://www.flickr.com/services/rest/?" + urlParams, requestOptions)
    .then((result) => result.json())
    .then((response) => {
      console.log(response);
      const divContainer = document.getElementById("photosContainer");
      divContainer.innerHTML = "";

      const photos = response.photos.photo;
      photos.forEach((photo) => {
        divContainer.innerHTML =
          divContainer.innerHTML +
          '<img src="' +
          photo.url_l +
          '" class="img-fluid">';
      });
    });
}
