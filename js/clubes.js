$("#modalInfo").on("show.bs.modal", function (event) {
  const button = $(event.relatedTarget);
  const nome = button.data("nome");
  const cidade = button.data("cidade");

  const modal = $(this);
  modal.find(".modal-title").text(nome);

  const modalBody = modal.find(".modal-body")[0]; // Get the raw DOM element
  modalBody.innerHTML = ""; // Clear previous content

  const clubImage = `<div id="photosContainer"></div>`;
  const notmyguilt = `<p><b>Imagem Gerada pelo API através do nome do Clube</b></p>`;
  const cityText = `<p><strong>Cidade:</strong> ${cidade} </p>`;
  const temp = `<div id="meteoContainer"></div>`;

  modalBody.innerHTML += notmyguilt;
  modalBody.innerHTML += clubImage;
  modalBody.innerHTML += cityText;
  modalBody.innerHTML += temp;

  // Call the API functions
  requestMeteoApi(cidade);
  requestFlickrApi(nome);
});

function requestMeteoApi(cityValue) {
  $.ajax({
    url: "https://api.openweathermap.org/data/2.5/weather",
    data: {
      q: cityValue,
      appid: "09d5c10574177367ef50322886321bb9",
      units: "metric",
      lang: "pt",
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
  const requestOptions = {
    method: "GET", // *GET, POST, PUT, DELETE, etc.
  };

  const requestBody = {
    method: "flickr.photos.search",
    api_key: "acb0d07ce4123dfe53f12727f137b9a1",
    extras: "url_l",
    per_page: 1,
    text: nome,
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
