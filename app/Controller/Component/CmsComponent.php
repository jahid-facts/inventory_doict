<?php
class CmsComponent extends Component {
	public $role_id_id;
	public function initialize(Controller $controller) {
		define ( "MAXFILESIZE", 20000000000 );
	
	}
	
	public function uploadFile($fileCtrl, $imgName, $cat, $oldFile = null) {
		$dir_path = $this->getUploadDir ( $cat );
		$name = $imgName . "." . $this->getFileExtension ( $fileCtrl );
		
		if ($imgName && $fileCtrl ['tmp_name']) {
			if ($oldFile) {
				if (fileExistsInPath ( $dir_path . $oldFile )) {
					unlink ( $dir_path . $oldFile );
				}
			}
			
			move_uploaded_file ( $fileCtrl ['tmp_name'], $dir_path . $name );
			
			return $name;
		} else {
			die ( "File size has exceeded the limit. Maximum: " . MAXFILESIZE . " bytes can be allowed." );
		}
	}
	
	
	public function uploadImage($fileCtrl, $imgName, $cat = '', $h = '', $w = '') {
		if ($imgName && $fileCtrl ['tmp_name'] && $fileCtrl ['size'] < MAXFILESIZE) {
			$name = $this->getUploadDir ( $cat ) . $imgName . ".png";
			if (file_exists ( $name )) {
				unlink ( $name );
			}
			return $this->fixImageDimension ( $fileCtrl ['tmp_name'], $name, IMAGETYPE_PNG, $h, $w );
		} else {
			return "File size has exceeded the limit. Maximum: " . MAXFILESIZE . " bytes can be allowed.";
		}
	}
	
	private function fixImageDimension($fileCtrl, $path, $cat, $h, $w) {
		if ($h && $w) {
			$new_w = $w;
			$new_h = $h;
		} else {
			list ( $width, $height ) = getimagesize ( $fileCtrl );
				
			if ($h && empty ( $w )) {
				$new_w = $width * ($h / $height);
				$new_h = $h;
			} elseif ($w && empty ( $h )) {
				$new_w = $w;
				$new_h = $height * ($w / $width);
			} else {
				$new_w = $width;
				$new_h = $height;
			}
		}
	
		return $this->smartResize ( $fileCtrl, $path, $cat, $new_w, $new_h );
	}
	
	
	private function smartResize($fileCtrl, $newFile, $outType, $width, $height) {
		if ($height < 1 || $width < 1) {
			return "Height or Width required";
		}
		
		# Setting defaults and meta
		$info = getimagesize ( $fileCtrl );
		
		# Loading image to memory according to type
		switch ($info [2]) {
			case IMAGETYPE_GIF :
				$image = imagecreatefromgif ( $fileCtrl );
				$image_resized = imagecreate ( $width, $height );
				break;
			case IMAGETYPE_JPEG :
				$image = imagecreatefromjpeg ( $fileCtrl );
				$image_resized = imagecreatetruecolor ( $width, $height );
				break;
			case IMAGETYPE_PNG :
				$image = imagecreatefrompng ( $fileCtrl );
				$image_resized = imagecreatetruecolor ( $width, $height );
				break;
			default :
				$image = imagecreatefromwbmp ( $fileCtrl );
				$image_resized = imagecreatetruecolor ( $width, $height );
				return false;
		}
		
		imagealphablending ( $image_resized, false );
		imagesavealpha ( $image_resized, true );
		$transparent = imagecolorallocatealpha ( $image_resized, 255, 255, 255, 127 );
		imagefilledrectangle ( $image_resized, 0, 0, $width, $height, $transparent );
		imagecopyresampled ( $image_resized, $image, 0, 0, 0, 0, $width, $height, $info [0], $info [1] );
		
		# Writing image
		switch ($outType) {
			case IMAGETYPE_GIF :
				imagegif ( $image_resized, $newFile );
				break;
			case IMAGETYPE_JPEG :
				imagejpeg ( $image_resized, $newFile );
				break;
			case IMAGETYPE_PNG :
				imagepng ( $image_resized, $newFile );
				break;
			default :
				imagewbmp ( $image_resized, $newFile );
				break;
		}
		
		return "Image Uploaded Successfully";
	}
	
	public function getUploadDir($cat = '') {
		$sub_dir = WWW_ROOT . "img" . DS . "upload" . DS;
		
		if ($cat == 'l') {
			$path = $sub_dir . "large" . DS;
		} elseif ($cat == 's') {
			$path = $sub_dir . "small" . DS;
		}elseif ($cat == 'logo') {
			$path = $sub_dir . "logo" . DS;
		}elseif ($cat == 'u') {
			$path = $sub_dir . "user" . DS;
		} elseif ($cat == 'logob') {
			$path = $sub_dir . "logob" . DS;
		}elseif ($cat == 'logobc') {
			$path = $sub_dir . "logobc" . DS;
		}elseif ($cat == 'lod') {
			$path = $sub_dir . "lod" . DS;
		} elseif ($cat == 'p') {
			$path = $sub_dir . "product" . DS;
		}elseif ($cat == 'cv') {
			$path = $sub_dir . "resume" . DS;
		}elseif ($cat == 'u') {
			$path = $sub_dir . "user" . DS;
		}elseif ($cat == 'damage') {
			$path = $sub_dir . "damage" . DS;
		}else {
			$path = WWW_ROOT . "img" . DS;
		}
		
		return $path;
	}
	
	public function getFileExtension($file_name) {
		return end ( explode ( ".", strtolower ( $file_name ['name'] ) ) );
	}
	
	/*public function generateMenus($id = 0, $lang = null) {
		//$view = new View ( 'menu' );
		//$html = $view->loadHelper ( 'Html' );
		$i = 0;
		$str = null;
		$url = null;
		
		$menus = ClassRegistry::init ( 'Menu' )->find ( 'all', array ('conditions' => array ('Menu.parent_id' => $id) ) );
		foreach ( $menus as $menu ) {
			$isMnChildExist = $this->isMnChildExist ( $menu ['Menu'] ['id'] );
			if ($isMnChildExist) {
				$subMenu = $this->generateMenus ( $menu ['Menu'] ['id'] );
			} else {
				$subMenu = "";
				$isMnChildExist = "";
			}
			
			if ($id == 0 && $i == 0) {
				$cls = 'current first';
			} else {
				$cls = '';
			}
			if (isset ( $menu ['Menu'] ['content_id'] )) {
				$url = $html->link ( $menu ['Menu'] ['name'.$lang], array ('controller' => 'pages', 'action' => 'details', $menu ['Menu'] ['content_id'] ) );
			} else {
				$menu_uri = explode ( '/', $menu ['Menu'] ['url'] );
				$menu_uri [2] = sizeof ( $menu_uri ) > 2 ? $menu_uri [2] : "";
				$url = $html->link ( $menu ['Menu'] ['name'.$lang], array ('controller' => $menu_uri [0], 'action' => $menu_uri [1] ) );
			}
			$str .= "<li class='$cls'>$url $subMenu</li>";
			$i ++;
		}
		if ($str) {
			if ($id == 0) {
				$ul = '<ul class="sf-menu">';
			} else {
				$ul = '<ul>';
			}
			return $ul . $str . "</ul>";
		}
	}
	
	private function isMnChildExist($id) {
		$menus_child = ClassRegistry::init ( 'Menu' )->find ( 'first', array ('conditions' => array ('parent_id' => $id ) ) );
		if (isset ( $menus_child ['Menu'] ['id'] ) > 0) {
			return true;
		} else {
			return false;
		}
	}*/

	public function unzip($fileCtl, $tLocation) {
		
		$zipObj = new ZipArchive ();
		$files = $zipObj->open ( $fileCtl );
		if ($files == TRUE) {
			$zipObj->extractTo ( $tLocation );
			$zipObj->close ();
		}
	}
	
	public function generateMenus($id = 0, $role_id = null) {
		$view = new View();
		$html = $view->loadHelper('Html');
		$str = null;
		$url = null;
		$li_first = null;
		$li_last = null;
		
		 $menus = ClassRegistry::init('Menu')->query('SELECT 
            Menue.id, Menue.name, Menue.url,Menue.content_id, Content.slug,
            Content.id FROM menus AS Menue 
            LEFT JOIN contents AS Content ON ( Menue.content_id = Content.id )
            WHERE Menue.parent_id =' .  $id . '');
        
		$i = 0;
		//pr($menus);
		foreach ( $menus as $menu ) {
			
			$i ++;
			$isExist = $this->isChildExist ( $menu ['Menue'] ['id'] );
			if ($isExist) {
				$subMenu = $this->generateMenus ( $menu ['Menue'] ['id'] );
			} else {
				$subMenu = "";
			}
			
			if (isset ( $menu ['Menu'] ['content_id'] )) {
				$url = $html->link ( $menu ['Menue'] ['name'], array ('controller' => 'contents', 'action' => 'detail', $menu ['Content'] ['slug'] ) );
			} else {
				$url = $html->link ( $menu ['Menue'] ['name'], array ('controller' => 'pages', 'action' => $menu ['Menue'] ['url'] ) );
			}
		  if ($i <= 7) {
				$li_first .= "<li>$url $subMenu</li>";
			} else {
				$li_last .= "<li>$url $subMenu</li>";
			}
			
		}
		//$str .= "<li><a href='#'>Gallery</a>" . $this->generateCatMenus () . "</li>";
	
			if ($id == 0) {
				$ul = '<ul  id="menu-main" class="sf-menu">' . $li_first . $str . $li_last . '</ul>';
			} else {
				$ul = '<ul>' . $li_first . $li_last . '</ul>';
			}
			
			return $ul;
		
	}
	
	private function isChildExist($id) {
		$menus_child = ClassRegistry::init ('Menu')->find ( 'first', array ('conditions' => array ('Menu.parent_id' => $id ) ) );
		if (isset ( $menus_child['Menu'] ['id'] ) > 0) {
			return true;
		} else {
			return false;
		}
	}
}