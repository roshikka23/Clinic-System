function showServiceDetails(serviceId) {
    fetch('service_details.php?id=' + serviceId)
        .then(response => response.json())
        .then(data => {
            document.getElementById('modalServiceName').innerText = data.service_name;
            document.getElementById('modalServiceDescription').innerText = data.service_description;
            document.getElementById('modalServicePrice').innerText = 'Price: $' + data.service_price;
            $('#serviceModal').modal('show');
        })
        .catch(error => console.error('Error:', error));
}
