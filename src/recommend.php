<?php

class Recommend {

    
    public function similarityDistance($preferences, $person1, $person2)
    {
		$mean1=0;
		$mean2=0;
		$j=1;
		foreach ($preferences[$person1] as $ke=>$val){
		$mean1+=$val;
		$j++;
		} 
		$mean1/=$j;
		$j=1;
        foreach ($preferences[$person2] as $ke=>$val){
		$mean2+=$val;
		$j++;
		}
		$mean2/=$j;
	//	$count= count($preferences[$person1])>=count($preferences[$person2])? count($preferences[$person2]): count($preferences[$person1]);
		$nume=0;
		$r12=0;
		$r22=0;
		foreach($preferences[$person1] as $ke=>$val){
		$r2=0;
		foreach($preferences[$person2] as $key=>$value){
		if($key== $ke){
		$r2=$value;
		break;
		}
		}
		$r2-=$mean2;
		$r1=$val- $mean1;
		$r12+=pow($r1,2);
		$r22+=pow($r2,2);
		$nume+=($r1 * $r2 );
		}
		$res= sqrt($r12 * $r22);
		return $res;
        /*$similar = array();
        $sum = 0;
    
        foreach($preferences[$person1] as $key=>$value)
        {
            if(array_key_exists($key, $preferences[$person2]))
                $similar[$key] = 1;
        }
        
        if(count($similar) == 0)
            return 0;
        
        foreach($preferences[$person1] as $key=>$value)
        {
            if(array_key_exists($key, $preferences[$person2]))
                $sum = $sum + pow($value - $preferences[$person2][$key], 2);
        }
        
        return  1/(1 + sqrt($sum));    */ 
    }
    
    
    public function matchItems($preferences, $person)
    {
        $score = array();
        
            foreach($preferences as $otherPerson=>$values)
            {
                if($otherPerson !== $person)
                {
                    $sim = $this->similarityDistance($preferences, $person, $otherPerson);
                    
                    if($sim > 0)
                        $score[$otherPerson] = $sim;
                }
            }
        
        array_multisort($score, SORT_DESC);
        return $score;
    
    }
    
    
    public function transformPreferences($preferences)
    {
        $result = array();
        
        foreach($preferences as $otherPerson => $values)
        {
            foreach($values as $key => $value)
            {
                $result[$key][$otherPerson] = $value;
            }
        }
        
        return $result;
    }
    
    
    public function getRecommendations($preferences, $person)
    {
        $total = array();
        $simSums = array();
        $ranks = array();
        $sim = 0;
        
        foreach($preferences as $otherPerson=>$values)
        {
            if($otherPerson != $person)
            {
                $sim = $this->similarityDistance($preferences, $person, $otherPerson);
            }
            
            if($sim > 0)
            {
                foreach($preferences[$otherPerson] as $key=>$value)
                {
                    if(!array_key_exists($key, $preferences[$person]))
                    {
                        if(!array_key_exists($key, $total)) {
                            $total[$key] = 0;
                        }
                        $total[$key] += $preferences[$otherPerson][$key] * $sim;
                        
                        if(!array_key_exists($key, $simSums)) {
                            $simSums[$key] = 0;
                        }
                        $simSums[$key] += $sim;
                    }
                }
                
            }
        }

        foreach($total as $key=>$value)
        {
            $ranks[$key] = $value / $simSums[$key];
        }
        
    array_multisort($ranks, SORT_DESC);
	return $ranks;
	$total=0;
	$modProd=array();
	include('config.php');
	$j=0;
	$tot= count($ranks);
	foreach ($ranks as $key=>$value){
	$res=mysqli_query($con, "SELECT price from book WHERE isbn='$key'");
	if(mysqli_num_rows($res)>0) {
	while($row=mysqli_fetch_array($res, MYSQLI_NUM));
	$total += $row[0];
	}
	}
	if($tot==0)
	return $ranks;
	$avg= $total / $tot;
	$low= $avg - 200;
	$high= $avg + 200;
	$res=mysqli_query($con, "SELECT isbn from book WHERE price between $low and $high");
	if(mysqli_num_rows($res)>0) {
	while($row=mysqli_fetch_array($res)){
	$red=$row['isbn'];
	foreach ($ranks as $key=>$value){
	if($red == $key){
	$modProd[$j] = $key;
	$j=$j+1;
	break;
	}
	}}
	}
	foreach ($modProd as $ke=>$val)
	$modProd[$val]= $ke;	
    return $modProd;
        
    }
   
}

?>