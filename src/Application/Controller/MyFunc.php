<?php
namespace Application\Controller;

class MyFunc
{private $errorcodetoutf=0;
private $errormyecho=0;
private $errornumtoutf=0;
private function codeToUtf8($code) {
    $code = (int) $code;
 
    if ($code < 0) {
        $errorcodetoutf=1;
    }
    # 0-------
    elseif ($code <= 0x7F) {
        return chr($code);
    }
    # 110----- 10------
    elseif ($code <= 0x7FF) {
        return chr($code >> 6 | 0xC0)
            . chr($code & 0x3F | 0x80)
        ;
    }
    # 1110---- 10------ 10------
    elseif ($code <= 0xFFFF) {
        return chr($code >> 12 | 0xE0)
            . chr($code >> 6 & 0x3F | 0x80)
            . chr($code & 0x3F | 0x80)
        ;
    }
    # 11110--- 10------ 10------ 10------
    elseif ($code <= 0x1FFFFF) {
        return chr($code >> 18 | 0xF0)
            . chr($code >> 12 & 0x3F | 0x80)
            . chr($code >> 6 & 0x3F | 0x80)
            . chr($code & 0x3F | 0x80)
        ;
    }
    # 111110-- 10------ 10------ 10------ 10------
    elseif ($code <= 0x3FFFFFF) {
        return chr($code >> 24 | 0xF8)
            . chr($code >> 18 & 0x3F | 0x80)
            . chr($code >> 12 & 0x3F | 0x80)
            . chr($code >> 6 & 0x3F | 0x80)
            . chr($code & 0x3F | 0x80)
        ;
    }
    # 1111110- 10------ 10------ 10------ 10------ 10------
    elseif ($code <= 0x7FFFFFFF) {
        return chr($code >> 30 | 0xFC)
            . chr($code >> 24 & 0x3F | 0x80)
            . chr($code >> 18 & 0x3F | 0x80)
            . chr($code >> 12 & 0x3F | 0x80)
            . chr($code >> 6 & 0x3F | 0x80)
            . chr($code & 0x3F | 0x80)
        ;
    }
    else {
         $errorcodetoutf=2;
    }
}

//return string where all character embedded in div tag
 private function myechoforme($str)
   {$res="";


		$nametemp=$str."#0";
		$nametemp=substr($nametemp,1);
		$j=strpos($nametemp,"#");
	

		while ($j>0)
		{$bool=false;
		$code=substr($nametemp,0,$j);
		$code=intval($code);
	 if ($code==32) $res=$res."&nbsp;";
		else
		$res="<span class=\"myecho\">".$res.$this->codeToUtf8($code)."<span class=\"myecho\">";
		if ($this->errorcodetoutf>0) $this->errormyecho=1;
			
		
		$nametemp=substr($nametemp,$j+1);
		
		$j=strpos($nametemp,"#");
		}
	

	 return $res;
	 
	 
 }
 //convert string type #12456#234#72...to string where all character embedded in span tag
 public function myecho($str)
 {$br="#13#10";
 
 $res="";
 $temp=$str;
 
 if (strpos($temp,$br)===0) $temp=substr($temp,6);
 $p=strpos($temp,$br);
 
 
 while ($p>0)
 {
 $temp1=substr($temp,0,$p);
 $temp=substr($temp,$p+6);

 $res.=$this->myechoforme($temp1)	; 
  $p=strpos($temp,$br);
$res=$res."<br>";

 }
 $res.=$this->myechoforme($temp,$num)	; 
 
 return $res;
 }
 
 private  function ordutf8($string, &$offset) {
    $code = ord(substr($string, $offset,1)); 
    if ($code >= 128) {        //otherwise 0xxxxxxx
        if ($code < 224) $bytesnumber = 2;                //110xxxxx
        else if ($code < 240) $bytesnumber = 3;        //1110xxxx
        else if ($code < 248) $bytesnumber = 4;    //11110xxx
        $codetemp = $code - 192 - ($bytesnumber > 2 ? 32 : 0) - ($bytesnumber > 3 ? 16 : 0);
        for ($i = 2; $i <= $bytesnumber; $i++) {
            $offset ++;
            $code2 = ord(substr($string, $offset, 1)) - 128;        //10xxxxxx
            $codetemp = $codetemp*64 + $code2;
        }
        $code = $codetemp;
    }
    $offset += 1;
    if ($offset >= strlen($string)) $offset = -1;
    return $code;
}
//return string type of #12456#234#72... parametr of function must be utf8 string; 
public function utfstrtonumstr($str)
{$stemp=$str;
	 
	  $res="";
	  $offset= 0;
	  while ($offset >= 0) {
	      $tempres=$this->ordutf8($stemp, $offset);
   $res= $res."#".$tempres;
	  }

return $res;
}

//convert string type of #12456#234#72 to utf8 string;
private function numstrtoutfstr($str)
{$res="";
 $imyecho=0;
		$nametemp=$str."#0";
		$nametemp=substr($nametemp,1);
		$j=strpos($nametemp,"#");
	

		while ($j>0)
		{$bool=false;
		$code=substr($nametemp,0,$j);
		$code=intval($code);
	
		
		$res=$res.$this->codeToUtf8($code);
		if ($this->errorcodetoutf>0) $this->errornumtoutf=1;
			$imyecho+=1;
	
		
		$nametemp=substr($nametemp,$j+1);
		
		$j=strpos($nametemp,"#");
		}
	 
	 return $res;
	 
	
	
}


}

?>