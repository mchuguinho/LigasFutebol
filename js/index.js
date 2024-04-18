//Limpa os dados do LocalStorage para não causar problemas quando voltar atrás
localStorage.clear();

// Load JSON data from leagues.json
fetch("js/leagues.json")
  .then((response) => response.json())
  .then((data) => {
    const leaguesContainer = document.getElementById("leagues");
    // Generate HTML for league cards
    data.leagues.forEach((league) => {
      // Create league card HTML
      const leagueCardHTML = `
          <div class="col-md-3">
            <div class="card">
              <img src="${league.image}" class="card-img-top" alt="${league.name}">
              <div class="card-body">
                <h3 class="card-title">${league.name}</h3>
                <p class="card-text">Clique no botão abaixo para ver os clubes que estão nesta liga!</p>
                <a class="btn btn-dark btn-card" onclick="showTeams('${league.name}')" href="clubes.html" role="button" >Ver clubes</a>
              </div>
            </div>
          </div>
        `;
      // Append league card HTML to container
      leaguesContainer.innerHTML += leagueCardHTML;
    });
  })
  .catch((error) => console.error("Error loading JSON:", error));

function showTeams(nome) {
  const nomeLiga = nome;
  
  localStorage.setItem("liga", nomeLiga);
}