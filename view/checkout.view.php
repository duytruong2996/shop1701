
<!-- Main Container -->
<section class="main-container col2-right-layout">
  <div class="main container">
    <div class="row">
        <?php
        if(isset($_SESSION['message_error'])):
        ?>
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-danger">
                <?=$_SESSION['message_error'];
                unset($_SESSION['message_error']);
                ?>
            </div>
        </div>
        <?php
        endif
        ?>
        <?php
        if(isset($_SESSION['message_success'])):
        ?>
        <div class="col-md-6 col-md-offset-3">
            <div class="alert alert-success">
                <?=$_SESSION['message_success'];
                unset($_SESSION['message_success']);?>
            </div>
        </div>
        <?php
        endif
        ?>
    </div>
    <div class="row">
      <div class="col-main col-sm-12 col-xs-12">
        <div class="page-content checkout-page"><div class="page-title">
          <h2>Checkout</h2>
        </div>
            <div class="box-border">
                <form action="checkout.php" method="POST">
                <ul>
                    <li class="row">
                        <div class="col-sm-6">
                            <label for="first_name" class="required">Họ tên</label>
                            <input type="text" class="input form-control" name="fullname" id="first_name" placeholder="Họ tên">
                        </div><!--/ [col] -->
                        <div class="col-sm-6">
                            <label class="required">Giới tính</label>
                                <select class="input form-control" name="gender">
                                    <option value="Nam">Nam</option>
                                    <option value="Nữ">Nữ</option>
                                    <option value="Khác">Khác</option>
                                </select>
                        </div><!--/ [col] -->
                    </li><!--/ .row -->
                    <li class="row">
                        <div class="col-sm-6">
                            <label for="email_address" class="required">Email</label>
                            <input type="text" class="input form-control" name="email" id="email_address">
                        </div><!--/ [col] -->
                        <div class="col-xs-6">
                            <label for="address" class="required">Địa chỉ</label>
                            <input type="text" class="input form-control" name="address" id="address">
                        </div><!--/ [col] -->
                    </li><!--/ .row -->

                    <li class="row">

                        <div class="col-sm-6">
                            
                            <label for="phone" class="required">Điện thoại</label>
                            <input class="input form-control" type="text" name="phone" id="phone">

                        </div><!--/ [col] -->

                        <div class="col-sm-6">
                            <label class="required">Hình thức thanh toán</label>
                                <select class="input form-control" name="payment_method">
                                    <option value="COD">COD</option>
                                    <option value="nhận tại cửa hàng">Nhận tại của hàng</option>
                                </select>
                        </div><!--/ [col] -->
                    </li><!--/ .row -->

                    <li class="row">

                        <div class="col-sm-12">
                            <label for="note" class="required">Ghi chú</label>
                            <textarea class="input form-control" name="note" id="note" rows="5"></textarea>
                        </div><!--/ [col] -->
                    </li><!--/ .row -->
                    <li>
                        <button type="submit" name="btnCheckout" class="button"><i class="fa fa-angle-double-right"></i>&nbsp; <span>Đặt hàng</span></button>
                    </li>
                </ul>
                </form>
            </div>
        </div>
      </div>
      
    </div>
  </div>
  </section>
  <!-- Main Container End -->