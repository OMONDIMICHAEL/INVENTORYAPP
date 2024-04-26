<article id="rightbar">
    <section id="rightbarSec">
        <div id="captioned-gallery">
            <figure class="rightBarSlider">
                <?php
                    $getProductImages = $conn->prepare("SELECT * FROM inventory.supplierProduct");
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
            <figure class="rightBarSecondSlider">
                <?php
                // newest fisrt
                    $getProductImagesDesc = $conn->prepare("SELECT * FROM inventory.supplierProduct  ORDER BY supplierProduct.productDate DESC");
                    $getProductImagesDesc->execute();
                    $getProductImagesDesc->rowCount();
                    foreach ($getProductImagesDesc->fetchAll(PDO::FETCH_ASSOC) as $supplierProductImageDesc) {
                        echo "
                            <figure>
                                <div class='bg-image hover-overlay' data-mdb-ripple-init id='' data-mdb-ripple-color='light'>
                                "?>
                                    <img src="<?php echo $supplierProductImageDesc['productImagePath']; ?>" alt="<?php echo $supplierProductImageDesc['productImage']; ?>" class="img-fluid"/>
                                    <figcaption><?php echo $supplierProductImageDesc['productName']; ?> @ksh <?php echo $supplierProductImageDesc['productSellingPrice']; ?></figcaption>
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