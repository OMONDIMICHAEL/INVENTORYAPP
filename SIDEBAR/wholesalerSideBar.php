<article id="sidebar">
    <section id="sidebarSec">
        <div id="captioned-gallery">
            <figure class="slider">
                <?php
                    $getProductImagesDesc = $conn->prepare("SELECT * FROM inventory.supplierProduct ORDER BY supplierProduct.productDate DESC");
                    $getProductImagesDesc->execute();
                    $getProductImagesDesc->rowCount();
                    foreach ($getProductImagesDesc->fetchAll(PDO::FETCH_ASSOC) as $supplierProductImageDesc) {
                        echo "
                            <figure>
                                "?>
                                <a href="wholesalerProductToOrder.php?productId=<?php echo $supplierProductImageDesc['productId'];?>">
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
        <div id="captioned-gallery">
            <figure class="wholesalerSecondSlider">
                <?php
                // newest fisrt
                    $getProductImagesAsc = $conn->prepare("SELECT * FROM inventory.supplierProduct  ORDER BY supplierProduct.productDate ASC");
                    $getProductImagesAsc->execute();
                    $getProductImagesAsc->rowCount();
                    foreach ($getProductImagesAsc->fetchAll(PDO::FETCH_ASSOC) as $supplierProductImageAsc) {
                        echo "
                            <figure>
                                <div class='bg-image hover-overlay' data-mdb-ripple-init id='' data-mdb-ripple-color='light'>
                                "?>
                                    <img src="<?php echo $supplierProductImageAsc['productImagePath']; ?>" alt="<?php echo $supplierProductImageAsc['productImage']; ?>" class="img-fluid"/>
                                    <figcaption><?php echo $supplierProductImageAsc['productName']; ?> @ksh <?php echo $supplierProductImageAsc['productSellingPrice']; ?></figcaption>
                                <?php echo "
                                    <a href='#!'>
                                        <div class='mask' style='background-color: rgba(251, 251, 251, 0.15);'></div>
                                    </a>
                                </div>
                            </figure>
                        ";
                    }
                ?>
            </figure>
        </div>
    </section>
</article>