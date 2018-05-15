<div id="data-<?=$data['id']?>">
<?php 
    $products = $data['products'];

    if(count($products )>0):
    foreach($products as $p):?>
    <li class="item col-lg-4 col-md-4 col-sm-6 col-xs-6 " style="height:330px">
    <div class="product-item">
        <div class="item-inner">
        <div class="product-thumbnail">
        <?if($p->promotion_price !=0):?>
            <div class="icon-sale-label sale-left">Sale</div>
            <?endif?>
            <?if($p->new ==1):?>
            <div class="icon-new-label new-right">New</div>
            <?endif?>
            <div class="pr-img-area">
            <a title="Ipsums Dolors Untra" href="<?=$p->url?>-<?=$p->id?>.html">
                <figure>
                <img class="first-img" src="public/images/products/<?=$p->image?>" alt="">
                <img class="hover-img" src="public/images/products/<?=$p->image?>" alt="">
                </figure>
            </a>
            <button type="button" class="add-to-cart-mt">
                <i class="fa fa-shopping-cart"></i>
                <span> Add to Cart</span>
            </button>
            </div>

        </div>
        <div class="item-info">
            <div class="info-inner">
            <div class="item-title">
                <a title="<?=$p->name?>" href="<?=$p->url?>-<?=$p->id?>.html"><?=$p->name?></a>
            </div>
            <div class="item-content">

                <div class="item-price">
                <div class="price-box">
                <? if($p->promotion_price ==0):?>
                    <span class="regular-price">
                        <span class="price"><?=number_format($p->price)?> vnd</span>
                    </span>
                    <? else:?>
                    <p class="special-price">
                        <span class="price-label">Special Price</span>
                        <span class="price"><?=number_format($p->promotion_price)?> vnd</span>
                    </p>
                    <br>
                    <p class="old-price">
                        <span class="price-label">Regular Price:</span>
                        <span class="price"> <?=number_format($p->price)?> vnd</span>
                    </p>
                    <? endif?>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
    </li>
    <?php endforeach;
    else:
    echo "<h2>Sản phẩm đang được cập nhật</h2>";
    endif;
    ?>
</div>