<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    $this->data['session_step1'] = $this->session->userdata('rapide_1');
    $this->data['session_step2'] = $this->session->userdata('rapide_2');
    $this->data['session_step3'] = $this->session->userdata('rapide_3');
    $this->data['session_step4'] = $this->session->userdata('rapide_4');
    $this->data['session_step5'] = $this->session->userdata('rapide_5');
    $this->data['session_step6'] = $this->session->userdata('rapide_6');
    
    $this->data['session_step2_result'] = $this->session->userdata('rapide_2_results');
	$this->data['session_step3_result'] = $this->session->userdata('rapide_3_results');
    $this->data['session_step5_result'] = $this->session->userdata('rapide_5_results');
    
    $selectCommune = explode('##', $this->data['session_step2']['subCommunes']);
	$this->data['id_commune'] = $selectCommune[0];
	$this->data['nom_commune'] = $selectCommune[1];
	
	$this->data['commune'] = $this->communes_model->get_by_id($this->data['id_commune']);
	$this->data['quartier'] = $this->quartiers_model->get_by_id($this->data['session_step1']['TYPE_QUA']);
	
	$this->data['ipe'] = $this->transports_model->ipe_by_commune($this->data['nom_commune']);
	
	$this->data['values'] = array();
	
	$this->data['values']['ameliorationsActives'] = array();
	foreach($this->data['session_step6'] as $type => $array){
		
		foreach($array as $key => $element){
			
			$this->data['values']['ameliorationsActives'][$element] = true;
			
		}
		
	}
	
	// TEC	
	$this->data['values']['tec']['new']['auto'] = $this->data['session_step2']['slider_voiture'] - (10/100 * $this->data['session_step2']['slider_voiture']);
	$this->data['values']['tec']['new']['bus'] = $this->data['session_step2']['slider_bus'] + (10/100 * $this->data['session_step2']['slider_voiture']);
	
	$this->data['values']['tec']['new']['train'] = $this->data['session_step2']['slider_train'];
	$this->data['values']['tec']['new']['conso'] = ($this->data['values']['tec']['new']['auto'] * 0.6) + ($this->data['values']['tec']['new']['bus'] * 0.4) + ($this->data['values']['tec']['new']['train'] * 0.15);
	
	$this->data['values']['tec']['old']['conso'] = $this->data['session_step2_result']['values']['conso_annuelle']['total'];
	
	if($this->data['values']['tec']['old']['conso'] != 0){
		$this->data['values']['tec']['value'] = ($this->data['values']['tec']['old']['conso'] - $this->data['values']['tec']['new']['conso'])/$this->data['values']['tec']['old']['conso'] * 100;
	} else {
		$this->data['values']['tec']['value'] = 0;
	}
	
	// ACTIF
	$this->data['values']['actifs']['new']['auto'] = $this->data['session_step2']['slider_voiture'] - (10/100 * $this->data['session_step2']['slider_voiture']);
	$this->data['values']['actifs']['new']['bus'] = $this->data['session_step2']['slider_bus'];
	$this->data['values']['actifs']['new']['train'] = $this->data['session_step2']['slider_train'];
	$this->data['values']['actifs']['new']['conso'] = ($this->data['values']['actifs']['new']['auto'] * 0.6) + ($this->data['values']['actifs']['new']['bus'] * 0.4) + ($this->data['values']['actifs']['new']['train'] * 0.15);
	
	$this->data['values']['actifs']['old']['conso'] = $this->data['session_step2_result']['values']['conso_annuelle']['total'];
	
	if($this->data['values']['actifs']['old']['conso'] != 0){
		$this->data['values']['actifs']['value'] = ($this->data['values']['actifs']['old']['conso'] - $this->data['values']['actifs']['new']['conso'])/$this->data['values']['actifs']['old']['conso'] * 100;
	} else {
		$this->data['values']['actifs']['value'] = 0;
	}
	
	// Amelioration vitrages
	
	//$this->data['values']['logement']['vitrages'] LOG_GAB_MIT_OR_D_M_T_VI_VE_TH
	
	if(@$this->data['values']['ameliorationsActives']['ameliorer-vos-vitrages']){
	
	
	if(($this->data['session_step3']['VI'] == 1 || $this->data['session_step3']['VI'] == 2) || ($this->data['session_step3']['VI'] == 3 && ($this->data['session_step3']['VE'] == 2 || $this->data['session_step3']['VE'] == 3))){
		
		if($this->data['session_step3']['VI'] == 1 || $this->data['session_step3']['VI'] == 2){
		
			$this->data['values']['logement']['vitrages']['new_code'] = $this->data['session_step3']['LOG']. '_' . 
		 		$this->data['session_step3']['GAB'] . '_' . 
		 		$this->data['session_step3']['MIT'] . '_' . 
		 		$this->data['session_step3']['OR'] . '_' . 
		 		$this->data['session_step3']['D'] . '_' . 
		 		$this->data['session_step3']['M']. '_' . 
		 		$this->data['session_step3']['T']. '_' . 
		 		'3' . '_' . 
		 		$this->data['session_step3']['VE']. '_' . 
		 		$this->data['session_step3']['TH'];
		
		}
		
		if($this->data['session_step3']['VI'] == 4){
		
			$this->data['values']['logement']['vitrages']['new_code'] = $this->data['session_step3']['LOG']. '_' . 
		 		$this->data['session_step3']['GAB'] . '_' . 
		 		$this->data['session_step3']['MIT'] . '_' . 
		 		$this->data['session_step3']['OR'] . '_' . 
		 		$this->data['session_step3']['D'] . '_' . 
		 		$this->data['session_step3']['M']. '_' . 
		 		$this->data['session_step3']['T']. '_' . 
		 		'4' . '_' . 
		 		$this->data['session_step3']['VE']. '_' . 
		 		$this->data['session_step3']['TH'];
		
		}
		
		if($this->data['session_step3']['VI'] == 1){
			$this->data['values']['logement']['vitrages']['VIT'] = 'simple vitrage';
			$this->data['values']['logement']['vitrages']['VIT+'] = 'double vitrage performant (+/- 1.1 W/m²°C)';
		}
		
		if($this->data['session_step3']['VI'] == 2){
			$this->data['values']['logement']['vitrages']['VIT'] = 'double vitrage ancien';
			$this->data['values']['logement']['vitrages']['VIT+'] = 'double vitrage performant (+/- 1.1 W/m²°C)';
		}
		
		if($this->data['session_step3']['VI'] == 3){
			$this->data['values']['logement']['vitrages']['VIT'] = 'double vitrage performant';
			$this->data['values']['logement']['vitrages']['VIT+'] = 'triple vitrage (+/- 0.6 W/m²°C) ';
		}
		
		$this->data['values']['logement']['vitrages']['new'] = get_result_by_code($this->data['values']['logement']['vitrages']['new_code'], 'rapide', $this->data['session_step3']);
		
		$this->data['values']['logement']['vitrages']['WATT'] = $this->data['session_step3_result']['Conso_Ch'] - $this->data['values']['logement']['vitrages']['new']['Conso_Ch'];
		
		$this->data['values']['logement']['vitrages']['%'] = 100 * ($this->data['session_step3_result']['Conso_Ch'] - $this->data['values']['logement']['vitrages']['new']['Conso_Ch']) / $this->data['session_step3_result']['Conso_Ch'];
		
	}
	
	}
	
	if(@$this->data['values']['ameliorationsActives']['ameliorer-isolation-toiture']){
	
	// Toiture
	$this->data['values']['logement']['toiture']['status'] = false;
	
	if(($this->data['session_step3']['M'] == 'a' || $this->data['session_step3']['M'] == 'i') && $this->data['session_step3']['T'] == 'a'){
		
		$this->data['values']['logement']['toiture']['ISOTOIT'] = '16';
		$this->data['values']['logement']['toiture']['T'] = 'f';
		$this->data['values']['logement']['toiture']['status'] = true;
	}
	
	if(($this->data['session_step3']['M'] == 'b' || $this->data['session_step3']['M'] == 'j') && $this->data['session_step3']['T'] == 'b'){
		
		$this->data['values']['logement']['toiture']['ISOTOIT'] = '16';
		$this->data['values']['logement']['toiture']['T'] = 'f';
		$this->data['values']['logement']['toiture']['status'] = true;
		
	}
	
	if(($this->data['session_step3']['M'] == 'c' || $this->data['session_step3']['M'] == 'k') && $this->data['session_step3']['T'] == 'c'){
		
		$this->data['values']['logement']['toiture']['ISOTOIT'] = '16';
		$this->data['values']['logement']['toiture']['T'] = 'f';
		$this->data['values']['logement']['toiture']['status'] = true;
		
	}
	
	if(($this->data['session_step3']['M'] == 'd' || $this->data['session_step3']['M'] == 'l') && $this->data['session_step3']['T'] == 'd'){
		
		$this->data['values']['logement']['toiture']['ISOTOIT'] = '20';
		$this->data['values']['logement']['toiture']['T'] = 'g';
		$this->data['values']['logement']['toiture']['status'] = true;
		
	}
	
	if(($this->data['session_step3']['M'] == 'e' || $this->data['session_step3']['M'] == 'm') && $this->data['session_step3']['T'] == 'e'){
		
		$this->data['values']['logement']['toiture']['ISOTOIT'] = '30';
		$this->data['values']['logement']['toiture']['T'] = 'i';
		$this->data['values']['logement']['toiture']['status'] = true;
		
	}
	
	if(($this->data['session_step3']['M'] == 'f' || $this->data['session_step3']['M'] == 'n') && $this->data['session_step3']['T'] == 'g'){
		
		$this->data['values']['logement']['toiture']['ISOTOIT'] = '30';
		$this->data['values']['logement']['toiture']['T'] = 'i';
		$this->data['values']['logement']['toiture']['status'] = true;
		
	}
	
	if(($this->data['session_step3']['M'] == 'g' || $this->data['session_step3']['M'] == 'o') && $this->data['session_step3']['T'] == 'h'){
		
		$this->data['values']['logement']['toiture']['ISOTOIT'] = '35';
		$this->data['values']['logement']['toiture']['T'] = 'j';
		$this->data['values']['logement']['toiture']['status'] = true;
		
	}
	
	if(($this->data['session_step3']['M'] == 'h' || $this->data['session_step3']['M'] == 'p') && $this->data['session_step3']['T'] == 'i'){
		
		$this->data['values']['logement']['toiture']['ISOTOIT'] = '35';
		$this->data['values']['logement']['toiture']['T'] = 'j';
		$this->data['values']['logement']['toiture']['status'] = true;
		
	}
	
	if($this->data['values']['logement']['toiture']['status']){
	
		$this->data['values']['logement']['toiture']['new_code'] = $this->data['session_step3']['LOG']. '_' . 
		 	$this->data['session_step3']['GAB'] . '_' . 
		 	$this->data['session_step3']['MIT'] . '_' . 
		 	$this->data['session_step3']['OR'] . '_' . 
		 	$this->data['session_step3']['D'] . '_' . 
		 	$this->data['session_step3']['M'] . '_' . 
		 	$this->data['values']['logement']['toiture']['T'] . '_' . 
		 	$this->data['session_step3']['VI'] . '_' . 
		 	$this->data['session_step3']['VE'] . '_' . 
		 	$this->data['session_step3']['TH'];
		
		$this->data['values']['logement']['toiture']['new'] = get_result_by_code($this->data['values']['logement']['toiture']['new_code'], 'rapide', $this->data['session_step3']);
		
		$this->data['values']['logement']['toiture']['WATT'] = $this->data['session_step3_result']['Conso_Ch'] - $this->data['values']['logement']['toiture']['new']['Conso_Ch'];
		
		$this->data['values']['logement']['toiture']['%'] = 100 * ($this->data['session_step3_result']['Conso_Ch'] - $this->data['values']['logement']['toiture']['new']['Conso_Ch']) / $this->data['session_step3_result']['Conso_Ch'];
		
	}
	
	}
	
	if(@$this->data['values']['ameliorationsActives']['renover-enveloppe-logement']){
	
	// RENOVER ENVELOPPE
	
	if(($this->data['session_step3']['M'] == 'a' || $this->data['session_step3']['M'] == 'i') && $this->data['session_step3']['T'] == 'a'){
		
		if($this->data['session_step3']['M'] == 'a'){
			$this->data['values']['logement']['enveloppe']['M'] = 'b';
		}
		
		if($this->data['session_step3']['M'] == 'i'){
			$this->data['values']['logement']['enveloppe']['M'] = 'j';
		}
		
		$this->data['values']['logement']['enveloppe']['ISOMUR'] = '3';
		$this->data['values']['logement']['enveloppe']['T'] = 'b';
		$this->data['values']['logement']['enveloppe']['status'] = true;
		
	}
	
	if(($this->data['session_step3']['M'] == 'a' || $this->data['session_step3']['M'] == 'i') && $this->data['session_step3']['T'] == 'f'){
		
		if($this->data['session_step3']['M'] == 'a'){
			$this->data['values']['logement']['enveloppe']['M'] = 'b';
		}
		
		if($this->data['session_step3']['M'] == 'i'){
			$this->data['values']['logement']['enveloppe']['M'] = 'j';
		}
		
		$this->data['values']['logement']['enveloppe']['ISOMUR'] = '3';
		$this->data['values']['logement']['enveloppe']['T'] = 'f';
		$this->data['values']['logement']['enveloppe']['status'] = true;
	}
	
	if(($this->data['session_step3']['M'] == 'b' || $this->data['session_step3']['M'] == 'j') && $this->data['session_step3']['T'] == 'b'){
		
		if($this->data['session_step3']['M'] == 'b'){
			$this->data['values']['logement']['enveloppe']['M'] = 'c';
		}
		
		if($this->data['session_step3']['M'] == 'j'){
			$this->data['values']['logement']['enveloppe']['M'] = 'k';
		}
		
		$this->data['values']['logement']['enveloppe']['ISOMUR'] = '6';
		$this->data['values']['logement']['enveloppe']['T'] = 'c';
		$this->data['values']['logement']['enveloppe']['status'] = true;
		
	}
	
	if(($this->data['session_step3']['M'] == 'b' || $this->data['session_step3']['M'] == 'j') && $this->data['session_step3']['T'] == 'f'){
		
		if($this->data['session_step3']['M'] == 'b'){
			$this->data['values']['logement']['enveloppe']['M'] = 'c';
		}
		
		if($this->data['session_step3']['M'] == 'j'){
			$this->data['values']['logement']['enveloppe']['M'] = 'k';
		}
		
		$this->data['values']['logement']['enveloppe']['ISOMUR'] = '6';
		$this->data['values']['logement']['enveloppe']['T'] = 'f';
		$this->data['values']['logement']['enveloppe']['status'] = true;
		
	}
	
	if(($this->data['session_step3']['M'] == 'd' || $this->data['session_step3']['M'] == 'l') && $this->data['session_step3']['T'] == 'd'){
		
		if($this->data['session_step3']['M'] == 'd'){
			$this->data['values']['logement']['enveloppe']['M'] = 'e';
		}
		
		if($this->data['session_step3']['M'] == 'l'){
			$this->data['values']['logement']['enveloppe']['M'] = 'm';
		}
		
		$this->data['values']['logement']['enveloppe']['ISOMUR'] = '15';
		$this->data['values']['logement']['enveloppe']['T'] = 'e';
		$this->data['values']['logement']['enveloppe']['status'] = true;
		
	}
	
	if(($this->data['session_step3']['M'] == 'd' || $this->data['session_step3']['M'] == 'l') && $this->data['session_step3']['T'] == 'g'){
		
		if($this->data['session_step3']['M'] == 'd'){
			$this->data['values']['logement']['enveloppe']['M'] = 'e';
		}
		
		if($this->data['session_step3']['M'] == 'l'){
			$this->data['values']['logement']['enveloppe']['M'] = 'm';
		}
		
		$this->data['values']['logement']['enveloppe']['ISOMUR'] = '15';
		$this->data['values']['logement']['enveloppe']['T'] = 'i';
		$this->data['values']['logement']['enveloppe']['status'] = true;
		
	}
	
	if(($this->data['session_step3']['M'] == 'e' || $this->data['session_step3']['M'] == 'm') && $this->data['session_step3']['T'] == 'e'){
		
		if($this->data['session_step3']['M'] == 'e'){
			$this->data['values']['logement']['enveloppe']['M'] = 'f';
		}
		
		if($this->data['session_step3']['M'] == 'm'){
			$this->data['values']['logement']['enveloppe']['M'] = 'n';
		}
		
		$this->data['values']['logement']['enveloppe']['ISOMUR'] = '20';
		$this->data['values']['logement']['enveloppe']['T'] = 'g';
		$this->data['values']['logement']['enveloppe']['status'] = true;
		
	}
	
	if(($this->data['session_step3']['M'] == 'e' || $this->data['session_step3']['M'] == 'm') && $this->data['session_step3']['T'] == 'i'){
		
		if($this->data['session_step3']['M'] == 'e'){
			$this->data['values']['logement']['enveloppe']['M'] = 'f';
		}
		
		if($this->data['session_step3']['M'] == 'm'){
			$this->data['values']['logement']['enveloppe']['M'] = 'n';
		}
		
		$this->data['values']['logement']['enveloppe']['ISOMUR'] = '20';
		$this->data['values']['logement']['enveloppe']['T'] = 'i';
		$this->data['values']['logement']['enveloppe']['status'] = true;
		
	}
	
	if(($this->data['session_step3']['M'] == 'f' || $this->data['session_step3']['M'] == 'n') && $this->data['session_step3']['T'] == 'g'){
		
		if($this->data['session_step3']['M'] == 'f'){
			$this->data['values']['logement']['enveloppe']['M'] = 'g';
		}
		
		if($this->data['session_step3']['M'] == 'n'){
			$this->data['values']['logement']['enveloppe']['M'] = 'o';
		}
		
		$this->data['values']['logement']['enveloppe']['ISOMUR'] = '25';
		$this->data['values']['logement']['enveloppe']['T'] = 'h';
		$this->data['values']['logement']['enveloppe']['status'] = true;
		
	}
	
	if(($this->data['session_step3']['M'] == 'f' || $this->data['session_step3']['M'] == 'n') && $this->data['session_step3']['T'] == 'i'){
		
		if($this->data['session_step3']['M'] == 'f'){
			$this->data['values']['logement']['enveloppe']['M'] = 'g';
		}
		
		if($this->data['session_step3']['M'] == 'n'){
			$this->data['values']['logement']['enveloppe']['M'] = 'o';
		}
		
		$this->data['values']['logement']['enveloppe']['ISOMUR'] = '25';
		$this->data['values']['logement']['enveloppe']['T'] = 'j';
		$this->data['values']['logement']['enveloppe']['status'] = true;
		
	}
	
	if(($this->data['session_step3']['M'] == 'g' || $this->data['session_step3']['M'] == 'o') && $this->data['session_step3']['T'] == 'h'){
		
		if($this->data['session_step3']['M'] == 'g'){
			$this->data['values']['logement']['enveloppe']['M'] = 'h';
		}
		
		if($this->data['session_step3']['M'] == 'o'){
			$this->data['values']['logement']['enveloppe']['M'] = 'p';
		}
		
		$this->data['values']['logement']['enveloppe']['ISOMUR'] = '30';
		$this->data['values']['logement']['enveloppe']['T'] = 'h';
		$this->data['values']['logement']['enveloppe']['status'] = true;
		
	}
	
	if(($this->data['session_step3']['M'] == 'g' || $this->data['session_step3']['M'] == 'o') && $this->data['session_step3']['T'] == 'j'){
		
		if($this->data['session_step3']['M'] == 'g'){
			$this->data['values']['logement']['enveloppe']['M'] = 'h';
		}
		
		if($this->data['session_step3']['M'] == 'o'){
			$this->data['values']['logement']['enveloppe']['M'] = 'p';
		}
		
		$this->data['values']['logement']['enveloppe']['ISOMUR'] = '30';
		$this->data['values']['logement']['enveloppe']['T'] = 'j';
		$this->data['values']['logement']['enveloppe']['status'] = true;
		
	}
	
	if($this->data['values']['logement']['enveloppe']['status']){
	
		$this->data['values']['logement']['enveloppe']['new_code'] = $this->data['session_step3']['LOG']. '_' . 
		 	$this->data['session_step3']['GAB'] . '_' . 
		 	$this->data['session_step3']['MIT'] . '_' . 
		 	$this->data['session_step3']['OR'] . '_' . 
		 	$this->data['session_step3']['D'] . '_' . 
		 	$this->data['values']['logement']['enveloppe']['M'] . '_' . 
		 	$this->data['values']['logement']['enveloppe']['T'] . '_' . 
		 	$this->data['session_step3']['VI'] . '_' . 
		 	$this->data['session_step3']['VE'] . '_' . 
		 	$this->data['session_step3']['TH'];
		
		$this->data['values']['logement']['enveloppe']['new'] = get_result_by_code($this->data['values']['logement']['enveloppe']['new_code'], 'rapide', $this->data['session_step3']);
		
		$this->data['values']['logement']['enveloppe']['WATT'] = $this->data['session_step3_result']['Conso_Ch'] - $this->data['values']['logement']['enveloppe']['new']['Conso_Ch'];
		
		$this->data['values']['logement']['enveloppe']['%'] = 100 * ($this->data['session_step3_result']['Conso_Ch'] - $this->data['values']['logement']['enveloppe']['new']['Conso_Ch']) / $this->data['session_step3_result']['Conso_Ch'];
				

		foreach($this->data['session_step3_result']['comparaisons'] as $key => $comparaison){
	    	$this->data['values']['logement']['enveloppe']['graph']['params'][$key] = $comparaison['value'];
	    }
	    
	    $this->data['values']['logement']['enveloppe']['graph']['params']['SHn'] = $this->data['session_step3_result']['bdd_systems']->SHn;
	    
	    $this->data['values']['logement']['enveloppe']['graph']['url'] = base_url().'pchart/get/rapide/chartE_step3/'.urlencode(serialize($this->data['values']['logement']['enveloppe']['graph']['params']));
	}
	
	}
	
	
	if(@$this->data['values']['ameliorationsActives']['favoriser-bonne-gestion-temperatures']){
	    // Temperatures
	    $this->data['values']['logement']['temperature'][0]['code'] = $this->data['session_step3']['LOG']. '_' . 
		 	$this->data['session_step3']['GAB'] . '_' . 
		 	$this->data['session_step3']['MIT'] . '_' . 
		 	$this->data['session_step3']['OR'] . '_' . 
		 	$this->data['session_step3']['D'] . '_' . 
		 	$this->data['session_step3']['M'] . '_' . 
		 	$this->data['session_step3']['T'] . '_' . 
		 	$this->data['session_step3']['VI'] . '_' . 
		 	$this->data['session_step3']['VE'] . '_' . 
		 	'2';
	    
	    $this->data['values']['logement']['temperature'][0]['new'] = get_result_by_code($this->data['values']['logement']['temperature'][0]['code'], 'rapide', $this->data['session_step3']);
	    
	    
	    $this->data['values']['logement']['temperature'][1]['code'] = $this->data['session_step3']['LOG']. '_' . 
		 	$this->data['session_step3']['GAB'] . '_' . 
		 	$this->data['session_step3']['MIT'] . '_' . 
		 	$this->data['session_step3']['OR'] . '_' . 
		 	$this->data['session_step3']['D'] . '_' . 
		 	$this->data['session_step3']['M'] . '_' . 
		 	$this->data['session_step3']['T'] . '_' . 
		 	$this->data['session_step3']['VI'] . '_' . 
		 	$this->data['session_step3']['VE'] . '_' . 
		 	'1';
	    
	    $this->data['values']['logement']['temperature'][1]['new'] = get_result_by_code($this->data['values']['logement']['temperature'][1]['code'], 'rapide', $this->data['session_step3']);
	    
	    
	    $this->data['values']['logement']['temperature'][2]['code'] = $this->data['session_step3']['LOG']. '_' . 
		 	$this->data['session_step3']['GAB'] . '_' . 
		 	$this->data['session_step3']['MIT'] . '_' . 
		 	$this->data['session_step3']['OR'] . '_' . 
		 	$this->data['session_step3']['D'] . '_' . 
		 	$this->data['session_step3']['M'] . '_' . 
		 	$this->data['session_step3']['T'] . '_' . 
		 	$this->data['session_step3']['VI'] . '_' . 
		 	$this->data['session_step3']['VE'] . '_' . 
		 	'3';
	    
	    $this->data['values']['logement']['temperature'][2]['new'] = get_result_by_code($this->data['values']['logement']['temperature'][2]['code'], 'rapide', $this->data['session_step3']);
	    
	    $this->data['values']['logement']['temperature']['graph']['params'] = array(
	    	
	    	'T20' => $this->data['values']['logement']['temperature'][0]['new']['Conso_Ch'],
	    	'T18' => $this->data['values']['logement']['temperature'][1]['new']['Conso_Ch'],
	    	'T2016' => $this->data['values']['logement']['temperature'][2]['new']['Conso_Ch'],
	    	
	    );
	    
	    $this->data['values']['logement']['temperature']['graph']['url'] = base_url().'pchart/get/rapide/chartB_step6/'.urlencode(serialize($this->data['values']['logement']['temperature']['graph']['params']));
	
	}
	
	if(@$this->data['values']['ameliorationsActives']['installer-panneau-photovoltaiques']){
	
	// Panneaux photovoltaïques
	$this->data['values']['er']['pann_photovoltatiques']['Esol'] = 1000 * 1 * 15 * 0.11 * $this->data['session_step2_result']['quartier']->Ft;
	$this->data['values']['er']['pann_photovoltatiques']['%'] = $this->data['values']['er']['pann_photovoltatiques']['Esol'] / ($this->data['session_step3_result']['Conso_Elec'] * $this->data['session_step3']['S']);
	
	}
	
	// Panneaux thermiques
	$this->data['values']['er']['pann_thermiques']['Cth'] = 1000 * 1 * 15 * 0.11 * $this->data['session_step2_result']['quartier']->Ft;
	$this->data['values']['er']['pann_thermiques']['%'] = $this->data['values']['er']['pann_thermiques']['Cth'] / ($this->data['session_step3_result']['Conso_Ecs'] * $this->data['session_step3']['S']);
	
	// Micro-Cogénération
	$this->data['values']['er']['microcogeneration']['Echp'] = $this->data['session_step3_result']['Conso_Ch'] * $this->data['session_step3']['S'] * 0.0493 / $this->data['session_step3_result']['bdd_systems']->SHn;
	$this->data['values']['er']['microcogeneration']['%'] = ($this->data['values']['er']['microcogeneration']['Echp'] / ($this->data['session_step3_result']['Conso_Elec'] * $this->data['session_step3']['S'])) * 100;
	
	
	
//	$this->session->set_userdata('rapide_6_results', $this->data['values']);