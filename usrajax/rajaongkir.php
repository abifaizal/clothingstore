<?php 
	session_start();
	include "../koneksi.php";
	if(@$_GET['page']=='kabkota') {
		$id_prov = @mysqli_real_escape_string($conn, $_GET['id_prov']);

		$curl = curl_init();

	  curl_setopt_array($curl, array(
	    CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=&province=".$id_prov,
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

	  echo json_encode($array_city);
	}
	else if(@$_GET['page']=='biaya_ongkir') {
		$id_kota = @mysqli_real_escape_string($conn, $_GET['id_kota']);
		$berat = @mysqli_real_escape_string($conn, $_GET['berat']);
		$jasa = @mysqli_real_escape_string($conn, $_GET['jasa']);

		$curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "origin=177&destination=$id_kota&weight=$berat&courier=$jasa",
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
    
    echo json_encode($array_cost);
	}
?>