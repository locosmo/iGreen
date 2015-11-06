<?php 

	//Настройки поля YaMa
	$center = '48.31343,25.919505';
	$zoom = '8';

?>
<script src="http://api-maps.yandex.ru/2.0/?load=package.full&lang=ru-RU" type="text/javascript"></script>
 
    <script type="text/javascript">
 
	var myMap, myPlacemark, coords;
 
	ymaps.ready(init);
 
        function init () {
 
            myMap = new ymaps.Map('YMapsID', {
                    center: [<?php echo $center; ?>], 
                    zoom: <?php echo $zoom; ?>,
					behaviors: ['default', 'scrollZoom']
                });	
 
			var SearchControl = new ymaps.control.SearchControl({noPlacemark:true});	
 
			 myMap.controls
				.add(SearchControl)
                .add('zoomControl')
                .add('typeSelector')
                .add('mapTools');
 
			coords = [<?php echo $center; ?>];
 
			myPlacemark = new ymaps.Placemark([<?php echo $center; ?>],{}, {preset: "twirl#redIcon", draggable: true});	
 
			myMap.geoObjects.add(myPlacemark);
			savecoordinats();			
 
			myPlacemark.events.add("dragend", function (e) {			
			coords = this.geometry.getCoordinates();
			savecoordinats();
			}, myPlacemark);
 
			myMap.events.add('click', function (e) {        
            coords = e.get('coordPosition');
			savecoordinats();
			});	
 
	SearchControl.events.add("resultselect", function (e) {
		coords = SearchControl.getResultsArray()[0].geometry.getCoordinates();
		savecoordinats();
	});
 
	myMap.events.add('boundschange', function (event) {
    if (event.get('newZoom') != event.get('oldZoom')) {		
        savecoordinats();
    }
	  if (event.get('newCenter') != event.get('oldCenter')) {		
        savecoordinats();
    }
 
	});
 
    }
 
	function savecoordinats (){	
		var new_coords = [coords[0].toFixed(4), coords[1].toFixed(4)];	
		myPlacemark.getOverlay().getData().geometry.setCoordinates(new_coords);
		document.getElementById('yama').value = new_coords;
	}
 
    </script>
 
<div id="YMapsID" style="width:100%;height:400px;"></div>

<?php echo html_input('hidden', $field->element_name, $value, array('id'=>$field->id)); ?>