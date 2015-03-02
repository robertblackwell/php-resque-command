<?php
namespace WhiteacornControl\Commands;
/*
** A config object for updating site assets from the local to a remote server using rsync
*/
class AssetConfigObject
{

	const htaccessAssetType="htaccess";
	const phpCodeAssetType="php";


    static $remote;
    static $local;
    
    function __construct($sys_mode, $server){

		$valid_servers = array("godaddy","webfaction");
		$valid_modes = array("prod","dev");
		
		if( !in_array($server, $valid_servers) )
			throw new \Exception("invalid server: $server ");
		if( !in_array($sys_mode, $valid_modes) )
			throw new \Exception(" invalid project abrev : $sys_mode");
		
		
		$local_roots = array(
			"dev"=>"Sites/test_whiteacorn/live",
			"prod"=>"Sites/whiteacorn/live"
		);
		
		$remote_root = array(
			"godaddy"=>array(
				'prod'=>"html/whiteacorn/live",
		        'dev'=>"html/test_whiteacorn/live",
			),
		    'webfaction'=>array(
		    	'prod'=>'webapps/ooa_prod',
				'dev'=>'webapps/ooa_php',
		    ),
		);
		
        $this->local_home = getenv('HOME');
        $this->remote_root = $remote_root[$server][$sys_mode];

        //$this->local_root = "/Users/rob/Sites";
        $this->remote_prefix = preg_replace("[^/]", "", $this->remote_root);
        $this->local_prefix = $this->local_home."/".$local_roots[$sys_mode];

		$this->remote_data = $this->remote_prefix."/data";
		$this->local_data = $this->local_prefix."/data";   
		/*
		* Php code
		*/     
		$this->remote_php = $this->remote_prefix."/php";
		$this->local_php = $this->local_prefix."/php";
		/*
		* httaccess
		*/     
		$this->remote_htaccess = $this->remote_prefix."/servers/".$server."/.htaccess";
		$this->local_htaccess = $this->local_prefix."/servers/".$server."/.htaccess";
        /*
		* Content Items
		*/
		//         $this->remote_item = $this->remote_data.$this->trip."/content/".$slug;
		//         $this->local_item = $this->local_data.$this->trip."/content/".$slug;
		//         $this->remote_content = $this->remote_item."/content.php";
		//         $this->local_content = $this->local_item."/content.php";
		// /*
		// * Photo galleries
		// */
		//         $this->remote_galleries = $this->remote_data.$this->trip."/photos/galleries";
		//         $this->local_galleries =  $this->local_data.$this->trip."/photos/galleries";
		//         $this->remote_gallery = $this->remote_galleries."/".$slug;
		//         $this->local_gallery = $this->local_galleries."/".$slug;
		//         /*
		// * Photo albums
		// */
		//         $this->remote_album = $this->remote_data.$this->trip."/photos/galleries";
		//         $this->local_album =  $this->local_data.$this->trip."/photos/galleries";
		//         $this->remote_album = $this->remote_galleries."/".$slug;
		//         $this->local_album = $this->local_galleries."/".$slug;
		//         /*
		// * Banner photos
		// */
		//         $this->remote_banners = $this->remote_data.$this->trip."/banners";
		//         $this->local_banners =  $this->local_data.$this->trip."/banners";
		// 
		//         $this->remote_banner = $this->remote_banners."/".$slug;
		//         $this->local_banner =  $this->local_banners."/".$slug;
		// /*
		// * Skin based nina-rob phtots
		// */
		//         $this->remote_skin = $this->remote_prefix."/live/skins/".$this->trip;
		//         $this->local_skin =  $this->local_prefix."/live/skins/".$this->trip;
		//         $this->remote_nina_rob = $this->remote_skin."/images/nina-rob/".$slug;
		//         $this->local_nina_rob = $this->local_skin."/images/nina-rob/".$slug;
		//  
		//         $this->remote_template = $this->remote_skin."/php_templates/".$slug;
		//         $this->local_template = $this->local_skin."/php_templates/".$slug;
        
    }
    function getSourceForAssetType($entity)
    {
        $name = "local_$entity";
        return $this->$name;
    }
    function getDestinationForAssetType($entity)
    {
        $name = "remote_$entity";
        return $this->$name;
    }}
?>