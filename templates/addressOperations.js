
function deleteAddress(id) {  //delete selected address from DB via AJAX
    var xhttp = new XMLHttpRequest();
    var param = "id=" + id + "&action=deleteAddress";
    xhttp.open("POST", "ajax.php", true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {
            setTimeout(function(){window.location.reload();}, 1000);
            document.getElementById("delconfirm").innerHTML = "Address deleted!";
        }
    };
    xhttp.send(param);
}
function editAddress(id) {  //edit selected address (up to DB) via AJAX
    var xhttp = new XMLHttpRequest();
    var param = "id=" + id + "&action=editAddress";
    xhttp.open("POST", "ajax.php", true);
    xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhttp.onreadystatechange = function() {
        if (xhttp.readyState == 4 && xhttp.status == 200) {

            document.getElementById("editAddressTitle").style.display = "block";
            document.getElementById("newCityLabel").style.display = "inline-block";
            document.getElementById("newStreetLabel").style.display = "inline-block";
            document.getElementById("newZipcodeLabel").style.display = "inline-block";
            
            document.getElementById("newCity").setAttribute("type", "text");
            document.getElementById("newStreet").setAttribute("type", "text");
            document.getElementById("newZipcode").setAttribute("type", "number");
            document.getElementById("editAddress").setAttribute("type", "submit");
            document.getElementById("hideEditAddress").setAttribute("type", "submit");
            
            var currentAddress = JSON.parse(xhttp.responseText);
            document.getElementById('newCity').focus();
            
            document.getElementById("hiddenAddressId").value = currentAddress.address_id;
            document.getElementById("newCity").value = currentAddress.city;
            document.getElementById("newStreet").value = currentAddress.street;
            document.getElementById("newZipcode").value = currentAddress.zipcode;
        }
    };
    xhttp.send(param);
}
var nevermind = document.getElementById("hideEditAddress");
nevermind.addEventListener("click", hideEditAddress);

function hideEditAddress() {  //hide address edit form onclick
    document.getElementById("editAddressTitle").style.display = "none";
    document.getElementById("newCityLabel").style.display = "none";
    document.getElementById("newStreetLabel").style.display = "none";
    document.getElementById("newZipcodeLabel").style.display = "none";
    
    document.getElementById("newCity").setAttribute("type", "hidden");
    document.getElementById("newStreet").setAttribute("type", "hidden");
    document.getElementById("newZipcode").setAttribute("type", "hidden");
    document.getElementById("editAddress").setAttribute("type", "hidden");
    document.getElementById("hideEditAddress").setAttribute("type", "hidden");
}