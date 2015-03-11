<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language ?>" lang="<?php print $language->language ?>" dir="<?php print $language->dir ?>">
  <head>
    <title><?php print $head_title; ?></title>
    <?php print $head; ?>
    <link href="http://fonts.googleapis.com/css?family=Lato:400,300,300italic,700,400italic,700italic" rel="stylesheet" type="text/css">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <?php print $styles; ?>
    <?php print $scripts; ?>
  </head>
  <body class="<?php print $classes; ?>">

  <?php print $page_top; ?>

  <div id="branding">
    <?php if ($title): ?><h1 class="page-title"><?php print $title; ?></h1><?php endif; ?>
  </div>

  <div id="page"> 

    <?php if ($sidebar_first): ?>
      <div id="sidebar-first" class="sidebar">
          <img id="logo" src="<?php print drupal_get_path('theme', 'mse6') . '/assets/images/logo_slave1.png' ?>" alt="<?php print $site_name ?>" />
        <?php print $sidebar_first ?>
      </div>
    <?php endif; ?>

    <div id="content" class="clearfix">
      <?php if ($messages): ?>
        <div id="console"><?php print $messages; ?></div>
      <?php endif; ?>
      <?php if ($help): ?>
        <div id="help">
          <?php print $help; ?>
        </div>
      <?php endif; ?>
      <?php print $content; ?>
    </div>

  </div>

  <div class="powered">Powered by MSE-6 Series <img src="<?php print drupal_get_path('theme', 'mse6') . '/assets/images/logo_mse6.png' ?>" alt="MSE-6 Series" /></div>

  <?php print $page_bottom; ?>

<canvas id="processing"></canvas>

<script type="application/processing">
// Starfield Simulation
//
// A simple star field animation based on the information from
// http://freespace.virgin.net/hugo.elias/graphics/x_stars.htm.
 
class Star
{
  float x;
  float y;
  float z;
  float velocity;
  float star_size;
   
  float screen_x;
  float screen_y;
  float screen_diameter;
   
  float old_screen_x;
  float old_screen_y;
   
   
  // Constructor 
  Star()
  {   
    randomizePosition(true);
  }
   
  void randomizePosition(boolean randomizeZ)
  {
    x = random(-width * 2, width * 2);
    y = random(-height * 2, height * 2);
     
    if(randomizeZ)
      z = random(100, 1000);
    else
      z = 1000;
       
    velocity = 3; 
    star_size = random(2, 10);
  }
   
  void update()
  {
     
    if(mousePressed)
      z -= velocity * 4;
    else
      z -= velocity;
     
    screen_x = x / z * 100 + width/2;
    screen_y = y / z * 100 + height/2;
    screen_diameter = star_size / z * 100;
     
    if(screen_x < 0 || screen_x > width || screen_y < 0 || screen_y > height || z < 1)
    {
      randomizePosition(false);
    }
  }
   
  void display()
  {
    float star_color = 255 - z * 255 / 1000;
    fill(star_color);
    ellipse(screen_x, screen_y, screen_diameter, screen_diameter);  
  }
}
 
final int NumStars = 2000;
 
Star[] stars;
 
void setup()
{
  size(2560, 1440);
  background(0);
  noStroke();
  smooth();
  colorMode(HSB);
  textSize(32);
  frameRate(60);
   
  // create stars 
  stars = new Star[NumStars];
   
  for(int index = 0; index < NumStars; index++)
  {
    stars[index] = new Star();
  }
}
 
 
void draw()
{
  background(0);
   
  // display framerate
  fill(255, 255, 255);
   
  for(int index = 0; index < NumStars; index++)
  {
    stars[index].update();
    stars[index].display();
  } 
}
</script>

  </body>
</html>
