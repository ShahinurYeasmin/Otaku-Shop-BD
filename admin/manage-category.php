<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Category</h1>
        <br/> <br/>
        <?php 
        
                    if(isset($_SESSION['add'])) // for adding the category: " add-category.php "
                    {
                        echo $_SESSION['add'];
                        unset($_SESSION['add']);
                    }

                    if(isset($_SESSION['upload'])) // for uploading image in the category " add-category.php " 
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['remove']))  // for removing category image " delete-category.php "
                    {
                        echo $_SESSION['remove'];
                        unset($_SESSION['remove']);
                    }

                    if(isset($_SESSION['delete']))  // for deleting category " delete-category.php "
                    {
                        echo $_SESSION['delete'];
                        unset($_SESSION['delete']);
                    }

                    if(isset($_SESSION['no-category-found']))  // " update-category.php "
                    {
                        echo $_SESSION['no-category-found'];
                        unset($_SESSION['no-category-found']);
                    }

                    if(isset($_SESSION['update']))  // for updating category " update-category.php "
                    {
                        echo $_SESSION['update'];
                        unset($_SESSION['update']);
                    }

                    if(isset($_SESSION['upload']))  
                    {
                        echo $_SESSION['upload'];
                        unset($_SESSION['upload']);
                    }

                    if(isset($_SESSION['failed-remove']))
                    {
                        echo $_SESSION['failed-remove'];
                        unset($_SESSION['failed-remove']);
                    }
        
                ?>
        <br/><br/>

                <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

                <br/>
                <br/><br/>

                <table class="tbl-full">
                    <tr>
                        <th>Serial No.</th>
                        <th>Title</th>
                        <th>Image</th>
                        <th>Featured</th>
                        <th>Active</th>
                        <th>Actions</th>
                    </tr>

                    <?php 

                        //Query to Get all CAtegories from Database
                        $sql = "SELECT * FROM tbl_category";

                        //Execute Query
                        $res = mysqli_query($conn, $sql);

                        //Count Rows
                        $count = mysqli_num_rows($res);

                        //Create Serial Number Variable and assign value as 1
                        $sn=1;

                        //Check whether we have data in database or not
                        if($count>0)
                        {
                            //get the data and display
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $id = $row['id'];
                                $title = $row['title'];
                                $image_name = $row['image_name'];
                                $featured = $row['featured'];
                                $active = $row['active'];

                                ?>

                                    <tr>
                                        <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $title; ?></td>

                                        <td>

                                            <?php  
                                                //Chcek whether image name is available or not
                                                if($image_name!="")
                                                {
                                                    //Display the Image
                                                    ?>
                                                    
                                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px" >
                                                    
                                                    <?php
                                                }
                                                else
                                                {
                                                    //Display the MEssage
                                                    echo "<div class='error'>Image not Added.</div>";
                                                }
                                            ?>

                                        </td>

                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                                        </td>
                                    </tr>

                                <?php

                            }
                        }
                        else
                        {
                            //WE do not have data
                            //Display the message inside table
                            ?>

                            <tr>
                                <td colspan="6"><div class="error">No Category Added.</div></td>
                            </tr>

                            <?php
                        }
                    
                    ?>

                    

                    
                </table>
    </div>
    
</div>

<?php include('partials/footer.php'); ?>