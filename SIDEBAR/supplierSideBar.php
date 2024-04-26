<article id="sidebar">
    <section id="sidebarSec">
        <div id="captioned-gallery">
            <figure class="slider">
                <?php
                // newest fisrt
                    $getProductImages = $conn->prepare("SELECT * FROM inventory.supplierProduct  ORDER BY supplierProduct.productDate DESC");
                    $getProductImages->execute();
                    $getProductImages->rowCount();
                    foreach ($getProductImages->fetchAll(PDO::FETCH_ASSOC) as $supplierProductImage) {
                        echo "
                            <figure>
                                <div class='bg-image hover-overlay' data-mdb-ripple-init id='' data-mdb-ripple-color='light'>
                                "?>
                                    <img src="<?php echo $supplierProductImage['productImagePath']; ?>" alt="<?php echo $supplierProductImage['productImage']; ?>" class="img-fluid"/>
                                    <figcaption><?php echo $supplierProductImage['productName']; ?> @ksh <?php echo $supplierProductImage['productSellingPrice']; ?></figcaption>
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
        <div id="captioned-gallery">
            <figure class="supplierSecondSlider">
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