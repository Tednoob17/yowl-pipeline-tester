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

localStorage.setItem('page', page);

div.addEventListener('click', () => {
    window.open('http://localhost:5173/posts/create/true', '_blank');
});