<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dashboard
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <!-- <li><a href="./"><i class="fa fa-dashboard"></i> Dashboard</a></li> -->
    <!-- <li><a href="#"></a></li> -->
    <li class="active">Dashboard</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
  <!-- Default box -->
  <?php 
    // $array_prov = array();
    // $array_prov = rajaongkir_provinsi();
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=&province=23",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "key: 73f69249ba117e6902674578252fa15f"
      ),
    ));

    $array_city = array();
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    $result = json_decode($response, true);
    if(count($result['rajaongkir']['results'])>1) {
      foreach ($result['rajaongkir']['results'] as $key => $value) {
        $array_city[] = array(
          'id' => $value['city_id'],
          'type' => $value['type'],
          'name' => $value['city_name'],
          'kode_pos' => $value['postal_code']
        );
      }
    }

    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "origin=177&destination=213&weight=350&courier=jne",
      CURLOPT_HTTPHEADER => array(
        "content-type: application/x-www-form-urlencoded",
        "key: 73f69249ba117e6902674578252fa15f"
      ),
    ));

    $array_cost = array();
    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    $result = json_decode($response, true);
    // if(count($result['rajaongkir']['results'])>1) 
    foreach ($result['rajaongkir']['results'] as $key => $value) {
      foreach ($value['costs'] as $key => $value) {
        $array_cost[] = array(
          'service' => $value['service'],
          'description' => $value['description'],
          'cost' => $value['cost'][0]['value'],
          'etd' => $value['cost'][0]['etd']
        );
      }
    }
    
    print_r($array_cost);
    // print_r($array_city);
    // $count = mysqli_num_rows($data);
   ?>
  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Title</h3>
    </div>
    <div class="box-body">
      Start creating your amazing application!
      <select name="" id="" style="">
        <?php 
          for($i = 0; $i < count($array_city); $i++) {
        ?>
            <option value="<?php echo $array_city[$i]['id']; ?>"><?php echo $array_city[$i]['name']; ?> (<?php echo $array_city[$i]['type']; ?>)</option>
        <?php } ?>
      </select>
    </div>
    <!-- /.box-body -->
    <div class="box-footer">
      Footer
    </div>
    <!-- /.box-footer-->
  </div>
  <!-- /.box -->

</section>
<!-- /.content -->