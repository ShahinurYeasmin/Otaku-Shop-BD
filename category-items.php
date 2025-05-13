    <?php include('partials-front/menu.php'); ?>

    <?php 
        //Check whether id is passed or not
        if(isset($_GET['category_id']))
        {
            //Category id is set and get the id
            $category_id = $_GET['category_id'];
            // Get the CAtegory Title Based on Category ID
            $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Get the value from Database
            $row = mysqli_fetch_assoc($res);
            //Get the TItle
            $category_title = $row['title'];
        }
        else
        {
            //Category not passed
            //Redirect to Home page
            header('location:'.SITEURL);
        }
    ?>


    <!--  search Section Start -->
    <section class="item-search text-center">
        <div class="container">
        </div>
    </section>
    <!--  search Section End -->



    <!-- Menu Section Starts Here -->
    <section class="item-menu">
        <div class="container">
            <h2 class="text-center"><?php echo $category_title; ?></h2>

            <?php 
            
                //Create SQL Query to Get items based on Selected Category
                $sql2 = "SELECT * FROM tbl_item WHERE category_id=$category_id";

                //Execute the Query
                $res2 = mysqli_query($conn, $sql2);

                //Count the Rows
                $count2 = mysqli_num_rows($res2);

                //Check whether item is available or not
                if($count2>0)
                {
                    //Item is Available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];
                        ?>
                        
                        <div class="menu-box">
                            <div class="menu-img">
                                <?php 
                                    if($image_name=="")
                                    {
                                        //Image not Available
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/item/<?php echo $image_name; ?>" alt="Item Image" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                
                            </div>

                            <div class="menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="price">$<?php echo $price; ?></p>
                                <p class="detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?item_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php
                    }
                }
                else
                {
                    //Item not available
                    echo "<div class='error'>Item not Available.</div>";
                }
            
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!--  Menu Section End -->

    <?php include('partials-front/footer.php'); ?>