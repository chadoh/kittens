<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr">
    <head>
        <title>
            <?php
            function getExtension($file)
            {
                $pos = strrpos($file, '.');
                if (!$pos)
                {
                    return 'Unknown Filetype';
                }
                $str = substr($file, $pos);
                return $str;
            }
            
            function capitalizeWords($string)
            {
                $string = explode(' ', $string);
                foreach ($string as $key)
                {
                    $string[$key] = ucfirst($string[$key]);
                }
                return implode(' ', $string);
            }
            $title = "the Roaring Kittens";
            echo $title;
            ?>
        </title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="MSSmartTagsPreventParsing" content="true" />
        <link rel="stylesheet" type="text/css" href="http://chad-oh.com/styles/all.css"/>
    </head>
    <body>
        <div style="height:429px;" id="header">
            <img src="http://chad-oh.com/kittens/Gazebo.jpg" title="the Roaring Kittens, Day Two" alt="the Roaring Kittens play in a gazebo on the HUB lawn" />
        </div>
        <div id="content">
            <!--begin content-->
            <div style="width:480px;" id="main">
                <!--begin main-->
                <div id="dir">
                    <a href="../"><img src="http://chad-oh.com/images/icons/specialfolder.png" border="0"/>Up A Level</a>
                </div>
                <?php
                $directory = str_replace("%20", " ", $_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI']);
                
                $dir_results = array ();
                $dir_results_presentable = array ();
                
                $file_results = array ();
                $file_results_presentable = array ();
                
                $handler = opendir($directory);
                while ($file = readdir($handler))
                {
                    if (substr($file, 0, 1) != ".")
                    {
                        if (is_dir("$directory/$file"))
                        {
                            $dir_results[] = $file;
                            $dir_results_presentable[] = capitalizeWords($file);
                        } elseif ($file != "index.php")
                        {
                            $file_results[] = $file;
                            $file_results_presentable[] = capitalizeWords($file);
                        }
                    }
                }
                closedir($handler);
                
                array_multisort($dir_results_presentable, $dir_results);
                array_multisort($file_results_presentable, $file_results);
                
                for ($i = 0; $i < sizeof($dir_results); $i++)
                {
                    echo "<div id='dir'><a href='".$dir_results[$i]."'><img src='http://chad-oh.com/images/icons/folder.png' border='0'/>".$dir_results_presentable[$i]."</a></div>";
                }
                
                if (sizeof($dir_results) > 0)
                {
                    echo "<div id='divider'><img src='http://chad-oh.com/images/divider2.png' /></div>";
                }
                
                for ($i = 0; $i < sizeof($file_results); $i++)
                {
                    echo "<div id='file'><a href='".$file_results[$i]."'>";
                    $img = "/images/icons/filetypeicons/".substr(getExtension($file_results[$i]), 1).".png";
                    if (file_exists($_SERVER['DOCUMENT_ROOT'].$img))
                    {
                        echo "<img src='".$img."' border='0'/>";
                    } else
                    {
                        echo "<img src='http://chad-oh.com/images/icons/filetypeicons/blankdocument.png' border='0' />";
                    }
                
                    echo $file_results_presentable[$i]."</a></div>";
                }
                
                if (sizeof($file_results) > 0)
                {
                    echo "<div id='divider'><img src='http://chad-oh.com/images/divider1.png' /></div>";
                }
                ?>
            </div><!--end main-->
			<!-- Begin #sidebar -->
			<div id="sidebar">
			    <div id="sidebar2">
			    	<div id="twtr-profile-widget"></div>
						<script src="http://widgets.twimg.com/j/1/widget.js"></script>
						<link href="http://widgets.twimg.com/j/1/widget.css" type="text/css" rel="stylesheet">
						<script>
						new TWTR.Widget({
						  profile: true,
						  id: 'twtr-profile-widget',
						  loop: true,
						  width: 220,
						  height: 300,
						  theme: {
						    shell: {
						      background: '#e0b620',
						      color: '#9c2a0b'
						    },
						    tweets: {
						      background: '#faf6e6',
						      color: '#9c2a0b',
						      links: '#2e9d76'
						    }
						  }
						}).render().setProfile('roaringkittens').start();
						</script>
					<!-- Facebook Badge START -->
					<div style="width:120px;clear:both;margin:20px auto;" id="facebookbadge">
						<a href="http://www.facebook.com/pages/The-Roaring-Kittens/75332394828" title="The Roaring Kittens" target="_TOP">
							<img src="http://badge.facebook.com/badge/75332394828.2916.628047998.png" width="120" height="231" style="border: 0px;" />
						</a>
					</div>
					<!-- Facebook Badge END -->
				</div>
		    </div>
		    <!-- End #sidebar -->
        </div><!--end content-->
		<!-- Begin #footer -->
<div id="footer">
    <hr/>
    <p>
        We are a group of traveling minstrels who want to see you smile.
    </p>
</div>
<!-- End #footer -->
        <!--?php
        include($_SERVER['DOCUMENT_ROOT'] . "/scripts/visittracker/insertvisit.php");
        ?-->
    </body>
</html>