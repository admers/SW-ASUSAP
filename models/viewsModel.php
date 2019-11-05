<?php
	class viewsModel{
		public function getViewsModel($views){
			$WhiteList=["dashboard","newaasociat","gconsumo","erecibo","crecibo","rservicio","aservicio","ASupdate","vercorte"];
			if(in_array($views, $WhiteList)){
				if(is_file("./views/modules/".$views."-view.php")){
					$contents="./views/modules/".$views."-view.php";
				}else{
					$contents="login";
				}
			}elseif($views=="login"){
				$contents="login";
			}elseif($views=="index"){
				$contents="login";
			}else{
				$contents="404";
			}
			return $contents;
		}
	}