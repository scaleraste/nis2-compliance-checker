import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


  document.getElementById('close-button').addEventListener('click', function() {
	  document.getElementById('info-bar').style.display = 'none';
  });