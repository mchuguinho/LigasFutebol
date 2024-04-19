
fetch("js/leagues.json")
  .then((response) => response.json())
  .then((data) => {
    const leaguesContainer = document.getElementById("leagues");
    // Generate HTML for league cards
    data.leagues.forEach((league) => {
      // Create league card HTML

        const ligastabela = `
        <tr>
        <th class="align-middle">${league.id}</th>
        <td class="align-middle"><img id="imagemAdmin"class="img-fluid logocircular" src="${league.image}"></td>
        <td class="align-middle">${league.name}</td>
        <td class="align-middle"><button type="button" class="btn btn-dark btn-outline-light" data-bs-toggle="modal" data-bs-target="#modalV2" data-bs-whatever="${league.name}">Editar</button></td>
        <td class="align-middle"><a class="btn btn-dark btn-outline-light" onclick="showAlertEliminado()" role="button">Eliminar</a></td>
        </tr>
        `

      // Append league card HTML to container
      document.getElementById("leagues").innerHTML+= ligastabela;
    });
  })
  .catch((error) => console.error("Error loading JSON:", error));

  function showAlertEliminado() {
    alert("Secção selecionada foi eliminada!");
}