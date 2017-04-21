<?php

class numerical2letters{

	public function toBaht( $number ){

		if(!preg_match( '/^([0-9]+)(\.[0-9]{0,4}){0,1}$/' , $number=str_replace(',', '', $number), $m ))

		return 'This is not currency format';

		$m[2]=count($m)==3? intval(('0'.$m[2])*100 + 0.5) : 0;
		$st = $this->cv( $m[2]);

		return $this->cv( $m[1]) . 'บาท' . $st . ($st>''? 'สตางค์' : ''); 

	}

	private function cv( $num ){

		$th_num = array('', array('หนึ่ง', 'เอ็ด'), array('สอง', 'ยี่'),'สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ'); 
		$th_digit = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน'); 
		$ln=strlen($num);

		$t='';

		for($i=$ln; $i>0;$i--){

			$x=$i-1;
			$n = substr($num, $ln-$i,1);
			$digit=$x % 6; 
			if($n!=0){ 

				if( $n==1 ){ $t .= $digit==1? '' : $th_num[1][$digit==0? ($t? 1 : 0) : 0]; }
				elseif( $n==2 ){  $t .= $th_num[2][$digit==1? 1 : 0]; } 
				else{ $t.= $th_num[$n]; } 
				$t.= $th_digit[($digit==0 && $x>0 ? 6 : $digit )]; 

			}else{

				$t .= $th_digit[ $digit==0 && $x>0 ? 6 : 0 ]; 

			}

		}

		return $t; 

	}

}
?>