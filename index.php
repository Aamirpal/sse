<?php

ob_implicit_flush(true);
ob_end_flush();

for ($i=0; $i<5; $i++) {
   echo $i.'<br>';
   sleep(1);
}