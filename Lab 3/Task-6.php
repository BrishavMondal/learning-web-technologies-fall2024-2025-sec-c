<?php
    
    $array=[1,2,3,4,5,6,7,8,9,10];

    echo" The array is =[";

    for($i=0;$i<10;$i++)
    {
        
            echo"$array[$i],";

    }
     echo"]:<br><br>";

    for($i=0;$i<10;$i++)
    {
        if($array[$i]==7){
            echo"$array[$i] Found in array index $i <br>";

        }
    }
?>