<?php echo'<?xml version="1.0" encoding="UTF-8" ?>' ?>
<?php /* $lastMod =  date("Y-m-d")."T".date("H:i:s")."+00:00";*/?>

<urlset       xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
              xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
              xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
                http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">

    <url>
        <loc><?php echo $this->base_url;?></loc>
        <priority>1.0</priority>
    </url>

    <url>
        <loc><?php echo $this->base_url;?>gallery</loc>
		<priority>0.90</priority>
    </url>
     <url>
        <loc><?php echo $this->base_url;?>biography</loc>
		<priority>0.90</priority>
    </url>
     <url>
        <loc><?php echo $this->base_url;?>exhibitions</loc>
		<priority>0.90</priority>
    </url>  	
     <url>
        <loc><?php echo $this->base_url;?>links</loc>
		<priority>0.90</priority>
    </url>       
    <?php foreach($urlslist as $url) { ?>
    <url>
        <loc><?php echo $this->base_url.$url['link']?></loc>
        <priority><?php echo $url['priority']?></priority>
		<?php if(isset($url['changefreq'])){?>
		<changefreq><?php echo $url['changefreq']?></changefreq>
		<?php } ?>
    </url>
    <?php } ?>
 
</urlset>