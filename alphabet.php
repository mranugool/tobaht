<?php 
header('Content-Type: text/html; charset=utf-8');

	/**
	 * Price .
	 * input 	1000.00
	 * return 	หนึ่งพันบาท  / one thousand baht 
	 *
    */
    
class alphabet 
{
    public function toTHBaht($number)
    {
        if (!preg_match('/^([0-9]+)(\.[0-9]{0,4}){0,1}$/', $number=str_replace(',', '', $number), $m)) {
            return 'This is not Currency Format !';
        }
        $m[2]=count($m)==3? intval(('0'.$m[2])*100 + 0.5) : 0;
        $st = $this->cv($m[2]);
        return $this->cv($m[1]) . 'บาท' . $st . ($st>''? 'สตางค์' : '');
    }

    public function cv($num)
    {
        $th_num = array('', array('หนึ่ง', 'เอ็ด'), array('สอง', 'ยี่'),'สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
        $th_digit = array('','สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');
        $ln=strlen($num);
        $t='';
        for ($i=$ln; $i>0;$i--) {
            $x=$i-1;
            $n = substr($num, $ln-$i, 1);
            $digit=$x % 6;
            if ($n!=0) {
                if ($n==1) {
                    $t .= $digit==1? '' : $th_num[1][$digit==0? ($t? 1 : 0) : 0];
                } elseif ($n==2) {
                    $t .= $th_num[2][$digit==1? 1 : 0];
                } else {
                    $t.= $th_num[$n];
                }
                $t.= $th_digit[($digit==0 && $x>0 ? 6 : $digit)];
            } else {
                $t .= $th_digit[ $digit==0 && $x>0 ? 6 : 0 ];
            }
        }
        return $t;
    }

    public function toENBaht($number)
    {
        $number = str_replace(",", "", $number); //ลบลูกน้ำ
        $number = str_replace(" ", "", $number); //ลบเว้นวรรค
        $number = str_replace("Baht", "", $number); //ลบหน่วย
        $number = explode(".", $number); //แบ่ง string
        $txtnum1 = array('','one','two','three','four','five','six','seven','eight','nine');
        $txtnum2 = array('ten','eleven','twelve','thirteen','fourteen','fifteen','sixteen','seventeen','eighteen','nineteen');
        $txtnum3 = array('','','twenty','thirty','fourty','fifty','sixty','seventy','eighty','ninty');
        $txt = array('','','hundred','thousand','','hundred','million','','hundred','billion','','hundred','trillion','','hundred'); //ร้อยล้านล้าน
        $strlen = strlen($number[0]);
        $convert = '';
        $check = 0;
        for ($i=0;$i<$strlen;$i++) {
            $n = substr($number[0], $i, 1); //(string,ตำแหน่ง 0=แรก+นับจากหน้า -นับจากหลัง,นับไปเท่าไร)
            if ($n!=0) {
                if ($i==($strlen-3) or $i==($strlen-6) or $i==($strlen-9) or $i==($strlen-12) or $i==($strlen-15)) {
                    if ($n>0 and $n<10) {
                        $convert .= $txtnum1[$n];
                        if ($i!=($strlen-1)) {
                            $convert .= " ";
                        }
                    }
                } elseif ($i==($strlen-2) or $i==($strlen-5) or $i==($strlen-8) or $i==($strlen-11) or $i==($strlen-14)) {
                    $next = substr($number[0], $i, 2);
                    if ($n == 1) {
                        $check = 10;
                        if ($next   == 10) {
                            $convert .= $txtnum2[0]." " ;
                        }
                        if ($next   == 11) {
                            $convert .= $txtnum2[1]." " ;
                        }
                        if ($next   == 12) {
                            $convert .= $txtnum2[2]." " ;
                        }
                        if ($next   == 13) {
                            $convert .= $txtnum2[3]." " ;
                        }
                        if ($next   == 14) {
                            $convert .= $txtnum2[4]." " ;
                        }
                        if ($next   == 15) {
                            $convert .= $txtnum2[5]." " ;
                        }
                        if ($next   == 16) {
                            $convert .= $txtnum2[6]." " ;
                        }
                        if ($next   == 17) {
                            $convert .= $txtnum2[7]." " ;
                        }
                        if ($next   == 18) {
                            $convert .= $txtnum2[8]." " ;
                        }
                        if ($next   == 19) {
                            $convert .= $txtnum2[9]." " ;
                        }
                    } else {
                        $check = 0;
                        if ($next >= 20 and $next <= 29) {
                            $convert .= $txtnum3[$n];
                        }
                        if ($next >= 30 and $next <= 39) {
                            $convert .= $txtnum3[$n];
                        }
                        if ($next >= 40 and $next <= 49) {
                            $convert .= $txtnum3[$n];
                        }
                        if ($next >= 50 and $next <= 59) {
                            $convert .= $txtnum3[$n];
                        }
                        if ($next >= 60 and $next <= 69) {
                            $convert .= $txtnum3[$n];
                        }
                        if ($next >= 70 and $next <= 79) {
                            $convert .= $txtnum3[$n];
                        }
                        if ($next >= 80 and $next <= 89) {
                            $convert .= $txtnum3[$n];
                        }
                        if ($next >= 90 and $next <= 99) {
                            $convert .= $txtnum3[$n];
                        }
                    }
                } elseif ($n>0 and $n<10) {
                    if ($check != 10) {
                        $convert .= $txtnum1[$n];
                        if ($i!=($strlen-1)) {
                            $convert .= " ";
                        }
                        $check = 0;
                    }
                }
                if ($i!=($strlen-2) or $i!=($strlen-1)) {
                    $convert .= $txt[$strlen-$i-1]." ";
                }
            } elseif ($i==($strlen-4) or $i==($strlen-7) or $i==($strlen-10) or $i==($strlen-13)) {
                $convert .= $txt[$strlen-$i-1]." ";
            }
        }
        $convert = str_replace(" million thousand ", " million ", $convert);
        $convert = str_replace(" billion million ", " billion ", $convert);
        $convert = str_replace(" trillion billion ", " billion ", $convert);
        $convert .= ' and ';
        $strlen = strlen($number[1]);
        $check = 0;
        for ($i=0;$i<$strlen;$i++) {
            $n = substr($number[1], $i, 1);
            if ($n!=0) {
                if ($i==($strlen-2) and $n != 0) {
                    $next = substr($number[1], $i, 2);
                    if ($n == 1) {
                        $check = 10;
                        if ($next   == 10) {
                            $convert .= $txtnum2[0]." " ;
                        }
                        if ($next   == 11) {
                            $convert .= $txtnum2[1]." " ;
                        }
                        if ($next   == 12) {
                            $convert .= $txtnum2[2]." " ;
                        }
                        if ($next   == 13) {
                            $convert .= $txtnum2[3]." " ;
                        }
                        if ($next   == 14) {
                            $convert .= $txtnum2[4]." " ;
                        }
                        if ($next   == 15) {
                            $convert .= $txtnum2[5]." " ;
                        }
                        if ($next   == 16) {
                            $convert .= $txtnum2[6]." " ;
                        }
                        if ($next   == 17) {
                            $convert .= $txtnum2[7]." " ;
                        }
                        if ($next   == 18) {
                            $convert .= $txtnum2[8]." " ;
                        }
                        if ($next   == 19) {
                            $convert .= $txtnum2[9]." " ;
                        }
                    } else {
                        $check = 0;
                        if ($next >= 20 and $next <= 29) {
                            $convert .= $txtnum3[$n];
                        }
                        if ($next >= 30 and $next <= 39) {
                            $convert .= $txtnum3[$n];
                        }
                        if ($next >= 40 and $next <= 49) {
                            $convert .= $txtnum3[$n];
                        }
                        if ($next >= 50 and $next <= 59) {
                            $convert .= $txtnum3[$n];
                        }
                        if ($next >= 60 and $next <= 69) {
                            $convert .= $txtnum3[$n];
                        }
                        if ($next >= 70 and $next <= 79) {
                            $convert .= $txtnum3[$n];
                        }
                        if ($next >= 80 and $next <= 89) {
                            $convert .= $txtnum3[$n];
                        }
                        if ($next >= 90 and $next <= 99) {
                            $convert .= $txtnum3[$n];
                        }
                    }
                } elseif ($n>0 and $n<10) {
                    if ($check != 10) {
                        $convert .= " ";
                        $convert .= $txtnum1[$n];
                        $check = 0;
                    }
                }
            }
        }
        $convert .= " satang";
        if ($number[1][0] == 0 and $number[1][1]==0) {
            $convert = str_replace("satang", "", $convert);
            $convert = str_replace(" and ", " baht ", $convert);
        }
        return $convert;
    }
}

$alphabet = new alphabet();

echo $alphabet->toTHBaht('1000.00');

?>