<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Ninya</title>
    <link rel="stylesheet" href="{{asset('css/pdfstyle.css')}}" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="https://spyeat.com/uploads/afb8e9433f370e2129c24dd8a3b9cb857f7ab81b.png"  height="200px" width="200px">
      </div>
      <div id="company">
          <h2 class="name">Spyeat</h2>
        <div>A-606,Sumeru Heights, K S Khancho</div>
        <div>College Road, Nadiad - 387001</div>
        <div>GUJARAT</div>
        <div><a href="mailto:zycotechsolutions@gmail.com">zycotechsolutions@gmail.com</a></div>
      </div>
      </div>
    </header>
    <main>
      <div id="details" class="clearfix">
        <div id="client">
          <div class="to">INVOICE TO:</div>
          <h2 class="name">{{@$order->deliveryuser->name}}</h2>
          <div class="address">{{@$order->deliveryuser->room_number}}</div>
          <div class="email"><a href="#">{{@$order->deliveryuser->phonenumber}}</a></div>
        </div>
        <div id="invoice">
          <h1>INVOICE #{{$order->id}}</h1>
          <div class="date">Date of Invoice: {{$order->created_at}}</div>
          <!-- <div class="date">Due Date: {{$order->created_at}}</div> -->
        </div>
      </div>
      <div>
      Hi {{$order->user->name}},
        Your order number {{$order->id}} from {{$order->shop->name}} is 
        @if($order->status=='RECEIVED')
          confirmed
        @elseif($order->status=='PROCESSING')
         Processed
        @elseif($order->status=='PICKEDUP')
        PickedUp
        @elseif($order->status=='COMPLETED')
         Delivered
        @endif
        successfully
      </div>
      <div id="thanks">Thank you!</div>
      <!-- <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
      </div> -->
    </main>
    <footer>
      
    </footer>
  </body>
</html>