
function confirmAdminProfileDelete(id) {
    // Show a confirmation dialog
    if (confirm("Êtes-vous sûr de vouloir supprimer cet admin?")) {
        // User confirmed, proceed with deletion
        deleteAdminProfile(id);
    }
}

function deleteAdminProfile(id) {
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "scripts/ajax/AdminProfile.php", true); 
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
    xhr.send("adminId=" + id);
}

