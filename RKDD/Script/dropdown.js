var items = document.getElementsByClassName('item');

// filtra opcijas
$('select').on('change', function() {
  // izveleties filtresanas opcijas
  var radius = $('#filter1').val();
  var width = $('#filter2').val();
  var height = $('#filter3').val();
  var speed = $('#filter4').val();
  var screws = $('#filter5').val();
  var distance = $('#filter6').val();

  // filret produktus pec izveletajime kriterijiem
  for (var i = 0; i < items.length; i++) {
    if (
      (radius == 'all' || items[i].getAttribute('data-radius') == radius) &&
      (width == 'all' || items[i].getAttribute('data-width') == width) &&
      (height == 'all' || items[i].getAttribute('data-height') == height) &&
      (speed == 'all' || items[i].getAttribute('data-speed') == speed) &&
      (screws == 'all' || items[i].getAttribute('data-screws') == screws) &&
      (distance == 'all' || items[i].getAttribute('data-distance') == distance)
    ) {
      // parada produktu
      items[i].style.display = 'block';
    } else {
      // paslepj produktu
      items[i].style.display = 'none';
    }
  }
});