<!DOCTYPE html>
<html>
    <head>
        <title>Customer Invoice</title>
        <link rel="stylesheet" href="{{asset('public/frontend/css/admin_style.css')}}">
        
        <style type="text/css">
            
            .content-wrapper{
               background: #FFF;
            }
            .invoice-header {
               background: #f7f7f7;
               padding: 10px 20px 10px 20px;
               border-bottom: 1px solid gray;
            }
            
            .invoice-right-top h3 {
                padding-right: 20px;
                margin-top: 20px;
                color: #ec5d01;
                font-size: 55px!important;
                font-family: serif;
            }
            .invoice-left-top {
                border-left: 4px solid #ec5d00;
                padding-left: 20px;
                padding-top: 20px;
            }
            thead {
                background: #ec5d01;
                color: #FFF;
                text-align: center;
            }
            tbody {
                text-align: center;
            }

            .authority h5 {
                margin-top: -10px;
                color: #ec5d01;
                /*text-align: center;*/
            }
            .thanks h4 {
                color: #ec5d01;
                font-size: 25px;
                font-weight: normal;
                font-family: serif;
                margin-top: 20px;
            }
            .site-address p {
                  line-height: 6px;
                  font-weight: 300;
              }
        </style>
    </head>

    <body>
        <div class="content-wrapper">
            <div class="invoice-header">
                <div class="float-left site-logo">
                    <img src="{{ asset('public/frontend') }}/images/logo/logo.png" alt="">
                </div>
                <div class="float-right site-address">
                    <h3>FurnishFuniture</h3>
                    <p><strong>Mobile No : </strong>01723344556</p>
                    <p><strong>Email : </strong>laraveldevelopment2@gmail.com</p>
                    <p><strong>Address : </strong>Uttara sectore-12, Dhaka: 1230</p>
                </div>
                <div class="clearfix"></div>
            </div>
            
            <div class="invoice-description">
            <div class="invoice-left-top float-left">
              <h6>Invoice to</h6>
               <h3>{{ $orders->name }}</h3>
               <div class="address">
                <p>
                  <strong>Address: </strong>
                  {{ $orders->shipping->address }}
                </p>
                 <p>Phone: {{ $orders->shipping->mobile }}</p>
                 <p>Email: <a href="mailto:{{ $orders->shipping->email }}">{{ $orders->shipping->email }}</a></p>
               </div>
            </div>
                
            <div class="invoice-right-top float-right">
              <h3>Invoice #{{ $orders->id }}</h3>
               <p>
                 {{ date('d M Y',strtotime($orders->created_at)) }}
               </p>
            </div>
             <div class="clearfix"></div>
            </div>
                
           <div class="">
            <h3>Order Details</h3>
            <table class="table table-bordered table-stripe">
              <thead>
                <tr>
                  <th>Image</th>
                  <th>Product</th>
                  <th>Color</th>
                  <th>Size</th>
                  <th>Qty</th>
                  <th>Price</th>
                  <th>Total</th>
                </tr>
              </thead>
              <tbody>
                
                @foreach($orders->order_details as $detail)
                <tr>
                  <td>
                      <img src="{{ asset('images/products/'.$detail->product->image) }}" alt="">
                    
                  </td>
                  <td>{{ $detail->product->name }}</td>
                  <td>{{ $detail->color->name }} </td>
                  <td>{{ $detail->size->name }}</td>
                  <td>{{ $detail->quantity }}</td>
                  <td>${{ $detail->product->price }}</td>
                  <td>
                    @php
                    $total = $detail->quantity * $detail->product->price;
                    @endphp
                    $<?php echo number_format($total, 2); ?>
                  </td>

                </tr>
                
                
                @endforeach
                
                <tr style="text-align: center;">
                    <td colspan="6" style="text-align: right;"><strong>Grand Total = </strong></td>
                    <td><strong>$<?php echo number_format($orders->order_total, 2); ?> /-</strong></td>
                </tr>
              </tbody>
            </table>
        
            
         
            
          <div class="thanks mt-3">
            <h4>Thank you for your business !!</h4>
          </div>

          <div class="authority float-right mt-5">
            <p>-----------------------------------</p>
            <h5>Authority Signature:</h5>
          </div>
          <div class="clearfix"></div>
           </div>
        </div>
          
    </body>
</html>

