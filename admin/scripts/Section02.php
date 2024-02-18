<?php
class Section {

    private $conn;
    private $sectionTable = 'image';
    

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function validate($firstName) {

        $error = false;
        $errMsg = null;
        $firstNameErr = '';

          
        if(empty($firstName)) {
            $firstNameErr = "First Name is required";
            $error = true;
        } 

        $errorInfo = [
            "error" => $error,
            "errMsg" => [
                "firstName" => $firstNameErr
            ]
        ];
        
        return $errorInfo;
    }
    



    public function uploadProfileImage($id= null) {
  
            $error = false;
            $thumbnailErr ='';
            $profileImageErr = '';
            $uploadTo = "public/images/section02/"; 
            $allowFileType = array('jpg','png','jpeg');
            $fileName = $_FILES['profileImage']['name'];

            if(empty($fileName) && null !== $id) {

                $get = $this->getById($id);
                if(isset($get['profileImage'])) {
                    $fileName = $get['profileImage'];
                }
           
            } else {
            
            $tempPath = $_FILES["profileImage"]["tmp_name"];
        
            $basename = basename($fileName);
            $originalPath = $uploadTo.$basename; 
            $fileType = pathinfo($originalPath, PATHINFO_EXTENSION); 
         
            if(!empty($fileName)){ 
               if(in_array($fileType, $allowFileType)){ 

                 if(!move_uploaded_file($tempPath, $originalPath)){ 
                    $thumbnailErr = 'Profile Not uploaded ! try again';
                    $error = true;
                }
             }else{  
                $thumbnailErr = 'Profile type is not allowed'; 
                $error = true;
             }
           } else {
                 $thumbnailErr = 'Profile is required'; 
                $error = true;
           }  
         }
        $thumbnailInfo = [
            "error" => $error, 
            "profileImageErr" => $thumbnailErr, 
            "profileImage" => $fileName
        ];

        return  $thumbnailInfo;
    }
 
    

        public function get() {

        $data = [];
    
        $query = "SELECT id,firstName,profileImage FROM ";
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
    
        $query = "SELECT id , firstName , profileImage FROM ";
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

    public function updateById($id,$firstName) {
        $validate = $this->validate($firstName);
        $success = false;
        
        
        if (!$validate['error']) {
            $uploadProfileImage = $this->uploadProfileImage($id);
           
            if (!$uploadProfileImage['error']) {
            // Replace 'content' with the correct table name for admin profiles
                $query = "UPDATE " . $this->sectionTable . " SET firstName = ?, profileImage = ? WHERE id = ?";
                $stmt = $this->conn->prepare($query);
                $stmt->bind_param("sss",$firstName,$uploadProfileImage['profileImage'], $id);
            
                if ($stmt->execute()) {
                    $success = true;
                    
                } 
           }
        }
        
        $data = [
            'success' => $success,
            'errMsg' => $validate['errMsg'],
            'uploadProfileImage' => $uploadProfileImage['profileImageErr'] ?? 'Unable to upload profile due to other fields facing errors',
        ];

        
        return $data;
    }
    
    

    
}



?>
