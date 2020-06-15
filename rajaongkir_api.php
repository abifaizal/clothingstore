<?php 
	function rajaongkir_provinsi() {
		$array_prov = array();
		$curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.rajaongkir.com/starter/province?id=",
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

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);
    $result = json_decode($response, true);

    if(count($result['rajaongkir']['results'])>1) {
      foreach ($result['rajaongkir']['results'] as $key => $value) {
        $array_prov[] = array(
          'id' => $value['province_id'],
          'name' => $value['province']
        );
      }
    }

    return $array_prov;
  }

  function rajaongkir_kabkota() {
		$array_city = array();
		$curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://api.rajaongkir.com/starter/city?id=&province=1",
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

    return $array_city;
  }
 ?>