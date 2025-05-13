<?php 
    include('../config/constants.php');

    //Check whether the id and image_name value is set or not
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        //Get the Value and Delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //Remove the physical image file is available
        if($image_name != "")
        {
            //Image is Available. So remove it
            $path = "../images/category/".$image_name;
            //REmove the Image
            $remove = unlink($path);

            //IF failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                //Set the SEssion Message
                $_SESSION['remove'] = "<div class='error'>Failed to Remove Category Image.</div>";
                //REdirect to Manage Category page
                header('location:'.SITEURL.'admin/manage-category.php');
                die();
            }
        }

        //Delete Data from Database
        //SQL Query to Delete Data from Database
        $sql = "DELETE FROM tbl_category WHERE id=$id";

        //Execute the Query
        $res = mysqli_query($conn, $sql);

        //Check whether the data is delete from database or not
        if($res==true)
        {
            //Set Success MEssage and REdirect
            $_SESSION['delete'] = "<div class='success'>Category Deleted Successfully.</div>";
            //Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            //Set Fail MEssage and Redirecs
            $_SESSION['delete'] = "<div class='error'>Failed to Delete Category.</div>";
            //Redirect to Manage Category
            header('location:'.SITEURL.'admin/manage-category.php');
        }

 

    }
    else
    {
        //redirect to Manage Category Page
        header('location:'.SITEURL.'admin/manage-category.php');
    }
?>