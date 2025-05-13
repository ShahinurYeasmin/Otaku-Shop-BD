<?php include('partials-front/menu.php'); ?>

    <!-- search Section Starts Here -->
    <section class="item-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>item-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for products.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- search Section Ends Here -->



    <!-- Menu Section Starts Here -->
    <section class="item-menu">
        <div class="container">
            <h2 class="text-center">All Products</h2>
            <?php 
                //Display Items that are Active
                $sql = "SELECT * FROM tbl_item WHERE active='Yes'";

                //Execute the Query
                $res=mysqli_query($conn, $sql);

                //Count Rows
                $count = mysqli_num_rows($res);

                //CHeck whether the Items are availalable or not
                if($count>0)
                {
                    //Item Available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //Get the Values
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];
                        ?>
                        
                        <div class="menu-box">
                            <div class="menu-img">
                                <?php 
                                    //CHeck whether image available or not
                                    if($image_name=="")
                                    {
                                        //Image not Available
                                        echo "<div class='error'>Image not Available.</div>";
                                    }
                                    else
                                    {
                                        //Image Available
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/item/<?php echo $image_name; ?>" alt="Item" class="img-responsive img-curve">
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
                    //Item not Available
                    echo "<div class='error'>Item not found.</div>";
                }
            ?>
 


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!--  Menu Section End -->

    <?php include('partials-front/footer.php'); ?>