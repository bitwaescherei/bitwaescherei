var markerFeature = new ol.Feature({
	geometry: new ol.geom.Point(ol.proj.fromLonLat([8.520364, 47.387064]))
});

markerFeature.setStyle(new ol.style.Style({
	image: new ol.style.Circle({
		radius: 9,
		fill: new ol.style.Fill({ color: '#2dd4bf' }),
		stroke: new ol.style.Stroke({
			color: '#581c87',
			width: 3
		})
	})
}));

var markerLayer = new ol.layer.Vector({
	source: new ol.source.Vector({
		features: [markerFeature]
	})
});

var map = new ol.Map({
	target: 'bitwMap',
	layers: [
		new ol.layer.Tile({
			source: new ol.source.OSM()
		}),
		markerLayer
	],
	view: new ol.View({
		center: ol.proj.fromLonLat([8.520364, 47.387064]),
		zoom: 16
	})
});


const modals = document.querySelectorAll('[data-modal]');

modals.forEach(function (trigger) {
	trigger.addEventListener('click', function (event) {
		event.preventDefault();
		const modal = document.getElementById(trigger.dataset.modal);
		modal.classList.add('open');
		const exits = modal.querySelectorAll('.modal-exit');
		exits.forEach(function (exit) {
			exit.addEventListener('click', function (event) {
				event.preventDefault();
				modal.classList.remove('open');
			});
		});
	});
});

document.addEventListener('DOMContentLoaded', function () {
	var lightbox = new SimpleLightbox('#gallery a', { /* options */});
});
