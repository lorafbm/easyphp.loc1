/**
 * Функция-параметр необходима для того, чтобы отыскать все элементы “markers” в XML.
 * Для каждого маркера мы восстанавливаем значения адреса и координат,
 * а затем мы передаем эти значения функции creatMarker, которая помещает маркеры на карту.
 */


GDownloadUrl("phpsqlajax_genxml.php", function(data) {
    var xml = GXml.parse(data);
    var markers = xml.documentElement.getElementsByTagName("marker");
    for (var i = 0; i < markers.length; i++) {
        var address = markers[i].getAttribute("address_form");
        var point = new GLatLng(parseFloat(markers[i].getAttribute("lat")),
            parseFloat(markers[i].getAttribute("lng")));
        var marker = createMarker(point, address);
        map.addOverlay(marker);
    }
});

function createMarker(point, address) {
    var marker = new GMarker(point);
    var html ='<div style="width: 250px;"><b>' + address+'</b>'</div>';
    GEvent.addListener(marker, 'click', function() {
        marker.openInfoWindowHtml(html);
    });
    return marker;
}