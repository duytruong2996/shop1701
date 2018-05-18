<?php 
$cart = $data['cart'];

?>
<!-- Main Container -->
<section class="main-container col1-layout">
    <div class="main container">
      <div class="col-main">
        <div class="cart">
          
          <div class="page-content page-order"><div class="page-title">
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
                    <?php $total=0; foreach($cart->items as $c):?>
                    <tr>
                      <td class="cart_product"><a href="#"><img src="public/images/products/<?=$c['item']->image?>" alt="Product"></a></td>
                      <td class="cart_description"><p class="product-name"><a href="#"><?=$c['item']->name?></a></p>
                       
                      <td class="price">
                          <?php if($c['item']->promotion_price !=0):?>
                          <span>
                            <?=number_format($c['item']->promotion_price)?>
                          </span>
                          <br>
                          <del><?=number_format($c['item']->price)?></del>
                          <?php else:?>
                          <span>
                            <?=number_format($c['item']->price)?>
                          </span>
                          <?php endif?>
                      </td>
                      <td class="qty"><input class="form-control input-sm" type="text" value="<?=$c['qty']?>"></td>
                      <td class="price"><span>
                        <?php if($c['item']->promotion_price !=0):?>
                        <?=number_format($c['item']->promotion_price * $c['qty'])?></span>
                        <?php else :?>
                        <?=number_format($c['price'])?></span>
                        <?php endif?>
                      </td>
                      <td class="action"><a href="#"><i class="icon-close"></i></a></td>
                    </tr>
                    
                    <?php endforeach?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <td colspan="2" rowspan="2"></td>
                      <td colspan="3">Giá gốc</td>
                      <td colspan="2"><?=number_format($cart->totalPrice)?></td>
                    </tr>
                    <tr>
                      <td colspan="3"><strong>Tổng tiền thanh toán</strong></td>
                      <td colspan="2"><strong>
                          <?=number_format($cart->promtPrice)?>
                      </strong></td>
                    </tr>
                  </tfoot>
                </table>
              </div>
              <div class="cart_navigation"> <a class="continue-btn" href="#"><i class="fa fa-arrow-left"> </i>&nbsp; Continue shopping</a> <a class="checkout-btn" href="#"><i class="fa fa-check"></i> Proceed to checkout</a> </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>