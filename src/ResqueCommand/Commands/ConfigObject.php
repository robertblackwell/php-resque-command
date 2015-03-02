<?php
namespace WhiteacornControl\Commands;
/*
** A config object for pushing whiteacorn content from the local to the remote server using rsync
**
** This thing is undergoing some major changes
*/
class ConfigObject
{
    static $remote;
    static $local;
    
    function __construct()
    {

    }
    // function __construct($project_abrev, $trip, $slug)
    // {
    //     $this->do_it($project_abrev, $trip, $slug);
    // }
    
    function do_it($server, $project_abrev, $trip, $slug)
    {
		/**
		* The name of the path under which all site directories sit
		*/
        $remote_root = array(
			'godaddy'=>'html',
            'webfaction'=>'webapps',
        );

        $this->local_home = getenv('HOME');
        $this->local_root = "/Users/rob/Sites";
        $this->remote_root = $remote_root[$server];
        $this->trip = $trip;

        /*
        ** these are abbreviations for "projects" or modes - these are the folders containing the site
		** on the server - note the same for ALL servers
        */
        self::$remote = array(
            "dev"=>"test_whiteacorn",
            "prod"=>"whiteacorn",
        );
        /*
        ** Sames as above except on the local system
        */
        self::$local = array(
            "prod" => "whiteacorn",
            "dev"=>"test_whiteacorn",
        );
    
        if( array_key_exists($project_abrev, self::$remote) ) 
            $this->remote_project = self::$remote[$project_abrev];
        else
            throw new \Exception("Project abbreviation [$project_abbrev] not know for remote");
    
        if( array_key_exists($project_abrev, self::$local) ) 
            $this->local_project = self::$local[$project_abrev];
        else
            throw new \Exception("Project abbreviation [$project_abbrev] not know not know for local");

       
        $this->remote_prefix = preg_replace("[^/]", "", $this->remote_root."/".$this->remote_project);
        $this->local_prefix = $this->local_root."/".$this->local_project;
        
        $this->remote_htaccess = $this->remote_prefix."/.htaccess";
        $this->local_htaccess = $this->local_prefix."/.htaccess";

        $this->remote_content_dir = $this->remote_prefix."/data/".$this->trip."/content/";
        $this->local_content_dir = $this->local_prefix."/data/".$this->trip."/content/";

        $this->local_php = $this->local_prefix."/php";
        $this->remote_php = $this->remote_prefix."/php";

        $this->remote_item = $this->remote_prefix."/data/".$this->trip."/content/".$slug;
        $this->local_item = $this->local_prefix."/data/".$this->trip."/content/".$slug;
        $this->remote_content = $this->remote_item."/content.php";
        $this->local_content = $this->local_item."/content.php";

        $this->remote_galleries = $this->remote_prefix."/data/".$this->trip."/photos/galleries";
        $this->local_galleries =  $this->local_prefix."/data/".$this->trip."/photos/galleries";
        $this->remote_gallery = $this->remote_galleries."/".$slug;
        $this->local_gallery = $this->local_galleries."/".$slug;
        
        $this->remote_album = $this->remote_prefix."/data/".$this->trip."/photos/galleries";
        $this->local_album =  $this->local_prefix."/data/".$this->trip."/photos/galleries";
        $this->remote_album = $this->remote_galleries."/".$slug;
        $this->local_album = $this->local_galleries."/".$slug;
        
        $this->remote_banners = $this->remote_prefix."/data/".$this->trip."/banners";
        $this->local_banners =  $this->local_prefix."/data/".$this->trip."/banners";

        $this->remote_banner = $this->remote_banners."/".$slug;
        $this->local_banner =  $this->local_banners."/".$slug;

        
        $this->remote_editorial = $this->remote_prefix."/data/".$this->trip."/editorial";
        $this->local_editorial =  $this->local_prefix."/data/".$this->trip."/editorial";

        $this->remote_banner = $this->remote_banners."/".$slug;
        $this->local_banner =  $this->local_banners."/".$slug;

        $this->remote_skin = $this->remote_prefix."/skins/".$this->trip;
        $this->local_skin =  $this->local_prefix."/skins/".$this->trip;
        $this->remote_nina_rob = $this->remote_skin."/images/nina-rob/".$slug;
        $this->local_nina_rob = $this->local_skin."/images/nina-rob/".$slug;
 
        $this->remote_template = $this->remote_skin."/php_templates/".$slug;
        $this->local_template = $this->local_skin."/php_templates/".$slug;
        
    }
    /**
	* Gets a path to a source for a database entity
	*/
    function getSourceForOneEntity($server, $entity, $project_abrev, $trip, $slug)
    {
        $this->do_it($server, $project_abrev, $trip, $slug);
        return $this->getSourceFor($entity);
    }
    
    /**
	* Gets a path to the destination for a database entity
	*/
    function getDestinationForOneEntity($server, $entity, $project_abrev, $trip, $slug)
    {
        $this->do_it($server, $project_abrev, $trip, $slug);
        return $this->getDestinationFor($entity);
    }
	
    function getSourceForAssetType($assetType, $project_abrev)
    {
        $this->do_it($project_abrev, "trip", "slug");
        $name = "local_$assetType";
		if(!isset($this->$name))
			throw new Exception("name: $name does not exists");
        return $this->$name;
    }
    function getDestinationForAssetType($assetType, $project_abrev)
    {
        $this->do_it($project_abrev, "trip", "slug");
        $name = "remote_$assetType";
		if(!isset($this->$name))
			throw new Exception("name: $name does not exists");
        return $this->$name;
    }
    /**
    * $entity is a String that represents the different types of things that can be "pushed"
    *
    * Possible values are:
    *
    *   content_dir  
    *   item
    *   content
    *   galleries
    *   gallery
    *   album
    *   skin
    *   banners
    *   banner
    *   skin
    *   nina_rob
    *   template
    *
    */
    function getSourceFor($entity)
    {
        $name = "local_$entity";
		if(!isset($this->$name)){
			var_dump($this);
			throw new \Exception("name: $name does not exists");
        }
		return $this->$name;
    }
    function getDestinationFor($entity)
    {
        $name = "remote_$entity";
		if(!isset($this->$name))
			throw new Exception("name: $name does not exists");
        return $this->$name;
    }

}
?>