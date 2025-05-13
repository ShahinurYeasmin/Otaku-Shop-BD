    <?php include('partials-front/menu.php'); ?>

    <!-- search Section Starts Here -->
    <section class="item-search text-center">
        <div class="container">
            <?php 

                //Get the Search Keyword
                $search = mysqli_real_escape_string($conn, $_POST['search']);        
            ?>

        </div>
    </section>
    <!-- search Section Ends Here -->



    <!-- Menu Section Starts Here -->
    <section class="item-menu">
        <div class="container">
            <h2 class="text-center">Items on Your Search <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>



            <?php 

                //SQL Query to Get items based on search keyword
                $sql = "SELECT * FROM tbl_item WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //Execute the Query
                $res = mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //Check whether item available of not
                if($count>0)
                {
                    //item Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the details
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>

                        <div class="menu-box">
                            <div class="menu-img">
                                <?php 
                                    // Check whether image name is available or not
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
                    //Item Not Available
                    echo "<div class='error'>Sorry, item not found</div>";
                    
                }
            
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!--  Menu Section End -->


    <?php include('partials-front/footer.php'); ?>