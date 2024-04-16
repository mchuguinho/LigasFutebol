function requestMeteoApi() {
    const cityValue = $('#inputMeteoID').val();

    $.ajax({
        url: 'https://api.openweathermap.org/data/2.5/weather',
        data: {
            q: cityValue,
            appid: 'a9e49b305a5d14cc0790dbf507251ca1',
            units: 'metric',
            lang: 'EN'
        },
        method: 'GET',
        success: function (response) {
            console.log(response);
            const temperature = response.main.temp;
            $('#meteoContainer').html('A temperatura em ' + response.name + ' é de: ' + temperature);
        }
    });
}