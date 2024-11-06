<table class="table table-bordered">
  <thead>
    <th width="5%" align="right">#</th>
    <th colspan="2">Product</th>
    <th width="10%">Price</th>
    <th width="15%">Order Date</th>
    <th width="10%">Ref #</th>
    <th width="20%">Status</th>
  </thead>
  <tbody>
  <?php $cnt=1; ?>
  @foreach($orders as $order)
    <tr>
      <td align="right"><?php echo $cnt; ?></td>
      <td width="10%"><img src="storage/products/{{ $order->img_dir.env("APP_VERSION") }}" class="img-responsive" /></td>
      <td width="30%">{{ $order->value }}<br>{{ $order->product_options }}</td>
      <td>R{{ $order->price }}</td>
      <td>{{ date("d F Y",strtotime($order->dt_successful)) }}</td>
      <td>{{ $order->pf_payment_id }}</td>
      <td>
          {{ $order->status_name }}
      </td>
    </tr>
    <?php $cnt++; ?>
  @endforeach
  </tbody>
</table>
