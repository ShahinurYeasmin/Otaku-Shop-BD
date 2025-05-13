<?php 
    //Include COnstants Page
    include('../config/constants.php');

    if(isset($_GET['id']) AND isset($_GET['image_name'])) 
    {
        //Get ID and Image Name
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the Image if Available
        //CHeck whether the image is available or not and Delete only if available
        if($image_name != "")
        {
            // IT has image and need to remove from folder
            //Get the Image Path
            $path = "../images/item/".$image_name;

            //Rrmove Image File from Folder
            $remove = unlink($path);

            //Check whether the image is removed or not
            if($remove==false)
            {
                //Failed to Remove image
                $_SESSION['upload'] = "<div class='error'>Failed to Remove Image File.</div>";
                //Redirect to Manage item
                header('location:'.SITEURL.'admin/manage-item.php');
                //Stop the Process of Deleting 
                die();
            }

        }

        //Delete Item from Database
        $sql = "DELETE FROM tbl_item WHERE id=$id";
        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //CHeck whether the query executed or not and set the session message
        //Redirect to Manage Item with Session Message
        if($res==true)
        {
            //Item Deleted
            $_SESSION['delete'] = "<div class='success'>Item Deleted Successfully.</div>";
            header('location:'.SITEURL.'admin/manage-item.php');
        }
        else
        {
            //Failed to Delete item
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Item.</div>";
            header('location:'.SITEURL.'admin/manage-item.php');
        }

        

    }
    else
    {
        //Redirect to Manage Item Page
        $_SESSION['unauthorize'] = "<div class='error'>Unauthorized Access.</div>";
        header('location:'.SITEURL.'admin/manage-item.php');
    }

?>