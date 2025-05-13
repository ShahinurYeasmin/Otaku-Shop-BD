<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Items</h1>
        <br />
        <br />

        <a href="<?php echo SITEURL; ?>admin/add-item.php" class="btn-primary">Add Items</a>

        <br />
        <br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if(isset($_SESSION['unauthorize']))
        {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }

        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        ?>

        <table class="tbl-full">
            <tr>

                <th>Serial No.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>

            </tr>

            <?php
            //Create a SQL Query to Get all the Items
            $sql = "SELECT * FROM tbl_item";

            //Execute the qUery
            $res = mysqli_query($conn, $sql);

            //Count Rows to check whether we have Items or not
            $count = mysqli_num_rows($res);

            //Create Serial Number Variable and Set Default Value as 1
            $sn = 1;

            if ($count > 0) {
                //We have item in Database
                //Get the Items from Database and Display
                while ($row = mysqli_fetch_assoc($res)) {
                    //get the values from individual columns
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>

                    <tr>
                        <td><?php echo $sn++; ?>. </td>
                        <td><?php echo $title; ?></td>
                        <td>$<?php echo $price; ?></td>
                        <td>
                            <?php
                            //CHeck whether we have image or not
                            if ($image_name == "") {
                                //WE do not have image, DIslpay Error Message
                                echo "<div class='error'>Image not Added.</div>";
                            } else {
                                //WE Have Image, Display Image
                            ?>
                                <img src="<?php echo SITEURL; ?>images/item/<?php echo $image_name; ?>" width="100px">
                            <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>
                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-item.php?id=<?php echo $id; ?>" class="btn-secondary">Update Item</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-item.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Item</a>
                        </td>
                    </tr>

            <?php
                }
            } else {
                //Item not Added in Database
                echo "<tr> <td colspan='7' class='error'> Item not Added Yet. </td> </tr>";
            }

            ?>

        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>