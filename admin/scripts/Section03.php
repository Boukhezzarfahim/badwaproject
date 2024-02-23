<?php

class Section03 {

    private $conn;
    private $sectionTable = 'section03';

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function validate($image, $description) {
        $error = false;
        $errMsg = null;
        $imageErr = '';
        $descriptionErr = '';

        // ... (other validations)

        if (!empty($image) && !empty($_POST['id'])) {
            $imageErr = "Image is required";
            $error = true;
        }

        // ... (other validations)

        $errorInfo = [
            "error" => $error,
            "errMsg" => [
                "image" => $imageErr,
                "description" => $descriptionErr
            ]
        ];

        return $errorInfo;
    }
    public function uploadImage($id = null) {
        $error = false;
        $imageErr = '';
        $uploadTo = "public/images/section03/";
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
    
                    // Redimensionner l'image (ajuster selon vos besoins)
                    list($width, $height) = getimagesize($tempPath);
                    $newWidth = 920;
                    $newHeight = 950;
    
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
    


    public function create($title, $image, $description, $position) {
        $validate = $this->validate($image, $description);
        $success = false;

        if (!$validate['error']) {
            $uploadImage = $this->uploadImage();

            if (!$uploadImage['error']) {
                $query = "INSERT INTO " . $this->sectionTable . " (title, image, description, position, updated_at) VALUES (?, ?, ?, ?, NOW())";
                $stmt = $this->conn->prepare($query);

                $stmt->bind_param("sssi", $title, $uploadImage['image'], $description, $position);

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

        $query = "SELECT id, title, image, description, position, updated_at FROM ";
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

        $query = "SELECT id, title, image, description, position, updated_at FROM ";
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

    public function updateById($id, $title, $image, $description, $position) {
        $validate = $this->validate($image, $description);
        $success = false;
        $uploadImage = $this->uploadImage($id);

        if (!$validate['error']) {
            // ... (rest of the code)

            // Vérifiez si une nouvelle image est fournie
            if (!empty($image) && !$uploadImage['error']) {
                // Si la nouvelle image est valide, mettez à jour la base de données
                $query = "UPDATE " . $this->sectionTable . " SET title = ?, image = ?, description = ?, position = ? WHERE id = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("sssii", $title, $uploadImage['image'], $description, $position, $id);
            } else {
                // Si aucune nouvelle image n'est fournie ou si l'upload de l'image a échoué, mettez à jour le texte uniquement
                $query = "UPDATE " . $this->sectionTable . " SET title = ?, description = ?, position = ? WHERE id = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("ssii", $title, $description, $position, $id);
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
        $uploadTo = __DIR__ . "/../public/images/section03/";  
        $filePath = $uploadTo . $imageName;

        if (file_exists($filePath)) {
            if (unlink($filePath)) {
                return true;
            } else {
                return false;
            }
        } else {
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

            $this->deleteImageFile($data['image']);

            return true;
        } else {
            $stmt->close();
            return false;
        }
    }

    public function deleteImageFileOnDelete($id) {
        $data = $this->getById($id);

        if (!empty($data['image'])) {
            $uploadTo = "public/images/section03/";

            $filePath = $uploadTo . $data['image'];

            if (file_exists($filePath)) {
                if (unlink($filePath)) {
                    echo "File deleted successfully.<br>";
                } else {
                    echo "Error deleting file.<br>";
                }
            } else {
                echo "File does not exist.<br>";
            }
        }
    }
}
?>
