let page = window.location.href;

const button = document.getElementById('nexus');

const div = document.createElement('div');

div.innerHTML = '<button id="nexus">Free PANDA\'s</button>';

document.body.appendChild(div);

div.style.position = 'fixed';

div.style.height = '50px';

div.style.width = '100px';

div.style.bottom = '10px';

div.style.right = '10px';

div.addEventListener('click', async () => {
    await fetch('http://localhost:8000/api/extension-web', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ link: page })
    })
        .then((res) => res.json())
        .then((data) => {
            console.log(data);
            window.open("http://localhost:5173/new-post/"+data.extensionWeb.id, '_blank');
        });
});
