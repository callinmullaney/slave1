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
          <img id="logo" src="/profiles/slave1/assets/images/logo_slave1.png" alt="<?php print $site_name ?>" />
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

  <div class="powered">Powered by MSE-6 Series <img src="/profiles/slave1/themes/mse6/assets/images/logo_mse6.png" alt="MSE-6 Series" /></div>

  <?php print $page_bottom; ?>

<canvas id="processing"></canvas>

<script type="application/processing">
int fc, num = 300, edge = 0;
ArrayList ballCollection;
boolean save = false;
 
void setup() {
  size(2560, 1440);
  background(32,32,32);
  ballCollection = new ArrayList();
  createStuff();
}
 
void draw() {
  background(32,32,32);
  for (int i=0; i<ballCollection.size(); i++) {
    Ball mb = (Ball) ballCollection.get(i);
    mb.run();
  }
}
 
void keyPressed() {
  fc = frameCount;
  save = true;
}
 
void createStuff() {
  ballCollection.clear();
  for (int i=0; i<num; i++) {
    PVector org = new PVector(random(edge, width-edge), random(edge, height-edge));
    float radius = random(10, 80);
    PVector loc = new PVector(org.x+radius, org.y);
    float offSet = random(TWO_PI);
    int dir = 1;
    float r = random(1);
    if (r>.5) dir =-1;
    Ball myBall = new Ball(org, loc, radius, dir, offSet);
    ballCollection.add(myBall);
  }
}
 
 
class Ball {
 
  PVector org, loc;
  float sz = 10;
  float theta, radius, offSet;
  int s, dir, d = 120;
 
  Ball(PVector _org, PVector _loc, float _radius, int _dir, float _offSet) {
    org = _org;
    loc = _loc;
    radius = _radius;
    dir = _dir;
    offSet = _offSet;
  }
 
  void run() {
    display();
    move();
    lineBetween();
  }
 
  void move() {
    loc.x = org.x + sin(theta+offSet)*radius;
    loc.y = org.y + cos(theta+offSet)*radius;
    theta += (0.075/3*dir);
  }
 
  void lineBetween() {
    for (int i=0; i<ballCollection.size(); i++) {
      Ball other = (Ball) ballCollection.get(i);
      float distance = loc.dist(other.loc);
      if (distance >0 && distance < d) {
        stroke(80);
        line(loc.x, loc.y, other.loc.x, other.loc.y);
      }
    }
  }
 
  void display() {
    noStroke();
    for (int i=0; i<5; i++) {
      fill(80,80,80);
      ellipse(loc.x, loc.y, sz, sz);
    }
  }
}
</script>

  </body>
</html>
