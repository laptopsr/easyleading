<?php

 $path = Yii::app()->basePath."/../";
 $nextPath = "uploaded/tiedostot/yritys_".Yii::app()->getModule('user')->user()->profile->getAttribute('yid');
 if (!file_exists($path . $nextPath)) {
 	mkdir($path . $nextPath, 0777, true);
 }
 chmod($path . $nextPath, 755);
?>

<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="#">Pääkansio</a></li>
  <li role="presentation"><a href="#">Lataa tiedosto</a></li>
  <li role="presentation"><a href="#">Muu</a></li>
</ul>


<?php
echo '<pre>';

  function showTree($folder, $space) {
    /* Получаем полный список файлов и каталогов внутри $folder */
    $files = scandir($folder);
    foreach($files as $file) {
      /* Отбрасываем текущий и родительский каталог */
      if (($file == '.') || ($file == '..')) continue;
      $f0 = $folder.'/'.$file; //Получаем полный путь к файлу
      /* Если это директория */
      if (is_dir($f0)) {
        /* Выводим, делая заданный отступ, название директории */
        echo '<i class="fa fa-folder-open" aria-hidden="true"></i> '.$space.$file."<br />";
        /* С помощью рекурсии выводим содержимое полученной директории */
        showTree($f0, $space.'&nbsp;&nbsp;');
      }
      /* Если это файл, то просто выводим название файла */
      else {
	echo $space.'<a href="../../'.$folder.'/'.$file.'"><i class="fa fa-file" aria-hidden="true"></i> '.$file.'</a><br />';
      }
    }
  }
  /* Запускаем функцию для текущего каталога */
  showTree($nextPath, "");

echo '</pre>';
?>
