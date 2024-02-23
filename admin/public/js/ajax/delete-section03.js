
function confirmSectionDelete03(id) {
    // Show a confirmation dialog
    if (confirm("Êtes-vous sûr de vouloir supprimer ce produit ?")) {
        // User confirmed, proceed with deletion
        deleteSection03(id);
    }
}

function deleteSection03(id) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "scripts/ajax/section03.php", true); 
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var response = xhr.responseText;
                
                if (response) {
                    location.reload(true);
                   
                } else {
                    alert("Error deleting content: " + response);
                }
            }
        }
    };
    xhr.send("id=" + id);
}