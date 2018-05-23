<?php 
$cart = $data['cart'];

?>
<!-- Main Container -->
<section class="main-container col1-layout">
    <div class="main container">
      <div class="col-main">
        <div class="cart">
          
          <div class="page-content page-order">
            <?php if($cart->totalQty != 0):?>
            <div class="page-title">
              <h2>Giỏ hàng của bạn</h2>
            </div>
            <div class="order-detail-content">
              <div class="table-responsive">
                <table class="table table-bordered cart_summary">
                  <thead>
                    <tr>
                      <th class="cart_product">Product</th>
                      <th>Description</th>
                      <th>Unit price</th>
                      <th>Qty</th>
                      <th>Total</th>
                      <th  class="action"><i class="fa fa-trash-o"></i></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $total = 0;
                    foreach ($cart->items as $c) : ?>
                    <tr id="cart-row-<?=$c['item']->id?>">
                      <td class="cart_product"><a href="#"><img src="public/images/products/<?= $c['item']->image ?>" alt="Product"></a></td>
                      <td class="cart_description"><p class="product-name"><a href="#"><?= $c['item']->name ?></a></p>
                       
                      <td class="price">
                          <?php if ($c['item']->promotion_price != 0) : ?>
                          <span>
                            <?= number_format($c['item']->promotion_price) ?>
                          </span>
                          <br>
                          <del><?= number_format($c['item']->price) ?></del>
                          <?php else : ?>
                          <span>
                            <?= number_format($c['item']->price) ?>
                          </span>
                          <?php endif ?>
                      </td>
                      <td class="qty">
                        <input class="form-control input-sm" type="text" value="<?= $c['qty'] ?>" id-product="<?=$c['item']->id?>">
                      </td>
                      <td class="price">
                        <span class="show-price-<?=$c['item']->id?>">
                        <?php if ($c['item']->promotion_price != 0) : ?>
                        <?= number_format($c['item']->promotion_price * $c['qty']) ?></span>
                        <?php else : ?>
                        <?= number_format($c['price']) ?></span>
                        <?php endif ?>
                      </td>
                      <td class="action">
                        <a class="delete-cart" id-product="<?=$c['item']->id?>"><i class="icon-close"></i></a>
                      </td>
                    </tr>
                    
                    <?php endforeach ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="2" rowspan="2"></td>
                      <td colspan="3">Giá gốc</td>
                      <td colspan="2" id="totalPrice"><?= number_format($cart->totalPrice) ?></td>
                    </tr>
                    <tr>
                      <td colspan="3"><strong>Tổng tiền thanh toán</strong></td>
                      <td colspan="2"><strong id="promtPrice">
                          <?= number_format($cart->promtPrice) ?>
                      </strong></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div class="cart_navigation"> <a class="continue-btn" href="./"><i class="fa fa-arrow-left"> </i>&nbsp; Về trang chủ</a> <a class="checkout-btn" href="checkout.php"><i class="fa fa-check"></i> Đặt hàng</a> </div>
            </div>
            <?php else :?>
            <div class="page-title">
              <h2 class="text-center">Giỏ hàng rỗng</h2>
              <div  class="text-center">
                <a href="./">
                  <button class="btn btn-primary">Về trang chủ</button>
                </a>
              </div>
            </div>
            <?php endif?>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- jquery js -->
  <script type="text/javascript" src="public/js/jquery.min.js"></script>
<script>
  $(document).ready(function(){
    
    $('.input-sm').keyup(function(){
        var qty = $(this).val()
        var id = $(this).attr('id-product')
        //console.log(qty, id)
      setTimeout(function(){
        $.ajax({
          url: "cart.php",
          type: "POST",
          data:{
            quantity: qty,
            idProduct: id,
            action : "update"
          },
          dataType: "JSON",
          success:function(res){
            $('.show-price-'+id).text(res.discountPrice)
            $('#totalPrice').html(res.totalPrice)
            $('#promtPrice').html(res.promtPrice)
            

            //$('.show-price-'+id).text(res.discountPrice.toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"))
            //res = JSON.parse(res)
          },
          error:function(){
            console.log('err')
          }
        })
      },2000)
    })

    $('.delete-cart').click(function(){
      var id = $(this).attr('id-product')
      $.ajax({
          url: "cart.php",
          type: "POST",
          data:{
            idProduct: id,
            action : "delete"
          },
          dataType: "JSON",
          success:function(res){
            $('#totalPrice').html(res.totalPrice)
            $('#promtPrice').html(res.promtPrice)
            $('#cart-row-'+id).hide(500)
          },
          error:function(){
            console.log('err')
          }
      })
    })
  })
</script>