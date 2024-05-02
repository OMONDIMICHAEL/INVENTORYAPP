<article id="rightbar">
    <section id="rightbarSec">
        <div id="captioned-gallery">
            <figure class="rightBarSlider">
                <?php
                    $getProductImagesAsc = $conn->prepare("SELECT * FROM inventory.supplierProduct");
                    $getProductImagesAsc->execute();
                    $getProductImagesAsc->rowCount();
                    foreach ($getProductImagesAsc->fetchAll(PDO::FETCH_ASSOC) as $supplierProductImageAsc) {
                        echo "
                            <figure>
                                "?>
                                <a href="supplierProductDetails.php?productId=<?php echo $supplierProductImageAsc['productId'];?>">
                                    <img src="<?php echo $supplierProductImageAsc['productImagePath']; ?>" alt="<?php echo $supplierProductImageAsc['productImage']; ?>" class="img-fluid"/>
                                    <figcaption><?php echo $supplierProductImageAsc['productName']; ?> @ksh <?php echo $supplierProductImageAsc['productSellingPrice']; ?></figcaption>
                                </a>
                                <?php echo "
                            </figure>
                        ";
                    }
                ?>
            </figure>
        </div>
        <div id="captioned-gallery">
            <figure class="rightBarSecondSlider">
                <?php
                // newest fisrt
                    $getProductImagesDesc = $conn->prepare("SELECT * FROM inventory.supplierProduct  ORDER BY supplierProduct.productDate DESC");
                    $getProductImagesDesc->execute();
                    $getProductImagesDesc->rowCount();
                    foreach ($getProductImagesDesc->fetchAll(PDO::FETCH_ASSOC) as $supplierProductImageDesc) {
                        echo "
                            <figure>
                                "?>
                                <a href="supplierProductDetails.php?productId=<?php echo $supplierProductImageDesc['productId'];?>">
                                    <img src="<?php echo $supplierProductImageDesc['productImagePath']; ?>" alt="<?php echo $supplierProductImageDesc['productImage']; ?>" class="img-fluid"/>
                                    <figcaption><?php echo $supplierProductImageDesc['productName']; ?> @ksh <?php echo $supplierProductImageDesc['productSellingPrice']; ?></figcaption>
                                </a>
                                <?php echo "
                            </figure>
                        ";
                    }
                ?>
            </figure>
        </div>
    </section>
</article>