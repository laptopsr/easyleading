<?php
class treeview {

	private $files;
	private $folder;
	
	function __construct( $path ) {
		
		$files = array();	
		
		if( file_exists( $path)) {

			if( $path[ strlen( $path ) - 1 ] ==  '/' )
				$this->folder = $path;
			else
				$this->folder = $path . '/';
			
			$this->dir = opendir( $path );
			while(( $file = readdir( $this->dir ) ) != false )
				$this->files[] = $file;
			closedir( $this->dir );
		}
	}

	function create_tree( ) {
			
		if( count( $this->files ) > 2 ) { /* First 2 entries are . and ..  -skip them */
			natcasesort( $this->files );
			$list = '<ul class="filetree" style="display: none;">';
			// Group folders first
			foreach( $this->files as $file ) {
				if( file_exists( $this->folder . $file ) && $file != '.' && $file != '..' && is_dir( $this->folder . $file )) {
					$list .= '
					<li class="folder collapsed">
					 <i class="fa fa-trash-o link poistaKansio btn btn-purple pull-right" pois="'. htmlentities( $this->folder . $file ) .'" aria-hidden="true"></i>
					 <a href="#" rel="' . htmlentities( $this->folder . $file ) . '/">' . htmlentities( $file ) . '</a>
					</li>';
				}
			}
			// Group all files
			foreach( $this->files as $file ) {
				if( file_exists( $this->folder . $file ) && $file != '.' && $file != '..' && !is_dir( $this->folder . $file )) {
					$ext = preg_replace('/^.*\./', '', $file);
					$list .= '
					<li class="file ext_' . $ext . '">
					 <i class="fa fa-trash-o link poista btn btn-purple pull-right" pois="' . htmlentities( $this->folder . $file ) . '" aria-hidden="true"></i>
					 <a href="../../' . htmlentities( $this->folder . $file ) . '" rel="' . htmlentities( $this->folder . $file ) . '">' . htmlentities( $file ) . '</a>
					</li>';
				}
			}
			$list .= '</ul>';	
			return $list;
		}
	}
}

$path = urldecode( $_REQUEST['dir'] );
$tree = new treeview( $path );
echo $tree->create_tree();
?>
