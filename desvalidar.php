<?php
$desocupar=$_POST['idvuelta'];
echo $desocupar;

	$mesas = simplexml_load_file("mesas.xml");
                foreach ($mesas as $mesa) {
                    if ($mesa['id']==$desocupar) {
                        if ($mesa['estado']=="ocupado") {
                            $mesa['estado']="libre";

                            $mesas->asXML("mesas.xml");
                            header("location: index.php");
                        }
                        else {
                            echo "entre al else";

                        }
                    }
            }
?>