<?php
// Extract unique brands and shuffle products
$brand = array_map(function ($pro) {
    return $pro['item_brand'];
}, $product_shuffle);
$unique = array_unique($brand);
sort($unique);
shuffle($product_shuffle);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['special_price_submit'])) {
        $Cart->addToCart($_POST['user_id'], $_POST['item_id']);
    }
}

// Get items in cart
$in_cart = $Cart->getCartId($product->getData('cart'));
?>

<section id="special-price">
    <div class="container"><br>
        <h4 class="font-rubik font-size-20">Silahkan Login untuk Membeli Produk Kopi</h4>

        <div class="grid">
            <?php array_map(function ($item) use ($in_cart) { ?>
                <div class="grid-item border <?= $item['item_brand'] ?? "Brand"; ?>">
                    <div class="item py-2" style="width: 200px;">
                        <div class="product font-rale">
                            <a href="<?= sprintf('%s?item_id=%s', 'product.php', $item['item_id']); ?>">
                                <img src="<?= $item['item_image'] ?? "./assets/products/13.png"; ?>" alt="product1" class="img-fluid">
                            </a>
                            <div class="text-center">
                                <h6><?= $item['item_name'] ?? "Unknown"; ?></h6>
                                <div class="rating text-warning font-size-12">
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="fas fa-star"></i></span>
                                    <span><i class="far fa-star"></i></span>
                                </div>
                                <div class="price py-2">
                                    <span>Rp.<?= $item['item_price'] ?? 0 ?></span>
                                </div>
                                <form method="post">
                                    <input type="hidden" name="item_id" value="<?= $item['item_id'] ?? '1'; ?>">
                                    <input type="hidden" name="user_id" value="1">
                                    <?php if (in_array($item['item_id'], $in_cart ?? [])) { ?>
                                        <button type="submit" disabled class="btn btn-success font-size-12">Di Keranjang</button>
                                    <?php } else { ?>
                                        <button type="submit" name="special_price_submit" class="btn btn-warning font-size-12">Masukan Keranjang</button>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }, $product_shuffle); ?>
        </div>
    </div>
</section>
<!-- !Special Price -->
