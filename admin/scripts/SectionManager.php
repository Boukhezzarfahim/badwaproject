<?php
class SectionManager {

    private $conn;
    private $sectionTable = 'section01';
    

    public function __construct($conn) {
        $this->conn = $conn;
    }
public function validate($image, $texte) {
    $error = false;
    $errMsg = null;
    $imageErr = '';
    $texteErr = '';

    // ... (autres validations)

    if (!empty($image) && !empty($_POST['id'])) {
        $imageErr = "Image is required";
        $error = true;
    }

    // ... (autres validations)

    $errorInfo = [
        "error" => $error,
        "errMsg" => [
            "image" => $imageErr,
            "texte" => $texteErr
        ]
    ];

    return $errorInfo;
}


    public function uploadImage($id = null) {
        $error = false;
        $imageErr = '';
        $uploadTo = "public/images/section01/"; 
        $allowFileTypes = array('jpg', 'png', 'jpeg');
        $fileName = $_FILES['image']['name'];
    
        // Vérifier et créer le répertoire de destination
        if (!file_exists($uploadTo)) {
            mkdir($uploadTo, 0777, true);
            chmod($uploadTo, 0777);
        }
    
        // ... (le reste du code)
    
        if (empty($fileName) && null !== $id) {
            $get = $this->getById($id);
            if (isset($get['image'])) {
                $fileName = $get['image'];
            }
        } else {
            $tempPath = $_FILES["image"]["tmp_name"];
            $originalFileName = basename($fileName);
            $fileType = pathinfo($originalFileName, PATHINFO_EXTENSION);
    
            if (!empty($originalFileName)) {
                if (in_array($fileType, $allowFileTypes)) {
                    // Renommer l'image pour éviter les collisions
                    $hashedName = md5(time() . $originalFileName);
                    $newFileName = $hashedName . '.' . $fileType;
                    $originalPath = $uploadTo . $newFileName;
    
                    // Redimensionner l'image
                    list($width, $height) = getimagesize($tempPath);
                    $newWidth = 1400;
                    $newHeight = 900;
    
                    $imageResized = imagecreatetruecolor($newWidth, $newHeight);
    
                    // Utilisez imagecreatefromstring pour créer une image à partir du contenu du fichier
                    $imageSource = imagecreatefromstring(file_get_contents($tempPath));
    
                    imagecopyresampled($imageResized, $imageSource, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
    
                    // Enregistrer l'image redimensionnée avec le nouveau nom
                    imagejpeg($imageResized, $originalPath);
    
                    imagedestroy($imageResized);
                    imagedestroy($imageSource);
                } else {
                    $imageErr = 'Image type is not allowed';
                    $error = true;
                }
            } else {
                $imageErr = 'Image is required';
                $error = true;
            }
        }
    
        $imageInfo = [
            "error" => $error, 
            "imageErr" => $imageErr, 
            "image" => $newFileName ?? $fileName
        ];
    
        return  $imageInfo;
    }
    


    public function create($image, $texte) {
        $validate = $this->validate($image, $texte);
        $success = false;

        if (!$validate['error']) {
            $uploadImage = $this->uploadImage();

            if (!$uploadImage['error']) {
                $query = "INSERT INTO " . $this->sectionTable . " (image, texte, updated_at) VALUES (?, ?, NOW())";
                $stmt = $this->conn->prepare($query);

                $stmt->bind_param("ss", $uploadImage['image'], $texte);

                if ($stmt->execute()) {
                    $success = true;
                    $stmt->close();
                }
            }
        }

        $data = [
            'errMsg' => $validate['errMsg'],
            'uploadImage' => $uploadImage['imageErr'] ?? 'Unable to upload image due to other fields facing errors',
            'success' => $success
        ];

        return $data;
    }

    public function get() {
        $data = [];
    
        $query = "SELECT id, image, texte, updated_at FROM ";
        $query .= $this->sectionTable;

        $result = $this->conn->query($query);
        
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            $result->free();
        }
    
        return $data;
    }

    public function getById($id) {
        $data = [];
    
        $query = "SELECT id, image, texte, updated_at FROM ";
        $query .= $this->sectionTable;
        $query .= " WHERE id = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
       
        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $data = $result->fetch_assoc();
            $stmt->close();
        } 

        return $data;
    }
    public function updateById($id, $image, $texte) {
        $validate = $this->validate($image, $texte);
        $success = false;
        $uploadImage = $this->uploadImage($id);
    
        if (!$validate['error']) {
            // ... (le reste du code)
    
            // Vérifiez si une nouvelle image est fournie
            if (!empty($image) && !$uploadImage['error']) {
                // Si la nouvelle image est valide, mettez à jour la base de données
                $query = "UPDATE " . $this->sectionTable . " SET image = ?, texte = ? WHERE id = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("ssi", $uploadImage['image'], $texte, $id);
            } else {
                // Si aucune nouvelle image n'est fournie ou si l'upload de l'image a échoué, mettez à jour le texte uniquement
                $query = "UPDATE " . $this->sectionTable . " SET texte = ? WHERE id = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("si", $texte, $id);
            }
    
            // Exécuter la requête
            if ($stmt->execute()) {
                $success = true;
            }
    
            // Fermer la requête
            $stmt->close();
        }
    
        $data = [
            'success' => $success,
            'errMsg' => $validate['errMsg'],
            'uploadImage' => $uploadImage['imageErr'] ?? 'Unable to upload image due to other fields facing errors',
        ];
    
        return $data;
    }
    
    public function deleteImageFile($imageName) {
        $uploadTo = __DIR__ . "/../public/images/section01/";  // Assurez-vous que c'est le bon chemin
        $filePath = $uploadTo . $imageName;
    
        // Vérifiez si le fichier existe avant de le supprimer
        if (file_exists($filePath)) {
            if (unlink($filePath)) {
                return true;
            } else {
                // Gestion des erreurs si la suppression échoue
                return false;
            }
        } else {
            // Le fichier n'existe pas
            return false;
        }
    }
    
    
    
    
    

    public function deleteById($id) {
        $data = $this->getById($id);
    
        $query = "DELETE FROM " . $this->sectionTable . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $id);
    
        if ($stmt->execute()) {
            $stmt->close();
    
            // Supprimer l'image du dossier après avoir supprimé l'entrée de la base de données
            $this->deleteImageFile($data['image']);
    
            return true;
        } else {
            $stmt->close();
            return false;
        }
    }
    
}
?>
