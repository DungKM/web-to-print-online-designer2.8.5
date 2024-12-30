// custom.js
document.getElementById('nbdesigner_flaticon_api_key').addEventListener('input', function () {
    const apiKey = this.value;

    fetch('proxy-api.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ api_key: apiKey }),
    })
        .then((response) => response.json())
        .then((data) => console.log(data))
        .catch((error) => console.error('Error:', error));
});
