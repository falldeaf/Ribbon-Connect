
float highest = 0.0;

void setup()  
{  
	size(window.innerWidth,window.innerHeight);
  //size(200, 200);  
  background(0);  
  smooth();
  strokeWeight(4);  
  stroke(100, 100, 100);  
  frameRate(60);
}  

void draw()   
{  
  // Call the variableEllipse() method and send it the  
  // parameters for the current mouse position  
  // and the previous mouse position  
  variableEllipse(mouseX, mouseY, pmouseX, pmouseY);  
}  
  
// The simple method variableEllipse() was created specifically   
// for this program. It calculates the speed of the mouse  
// and draws a small ellipse if the mouse is moving slowly  
// and draws a large ellipse if the mouse is moving quickly   
  
void variableEllipse(int x, int y, int px, int py)   
{  
  float speed = abs(x-px) + abs(y-py);
  if (speed > highest) highest = speed;
  
  float ratio = speed * .1;
  
  fill(ratio, ratio, ratio, speed);  
  ellipse(x, y, ratio, ratio );  

  fill(0, 0, 0);
  rect(5, 5, 100, 100);
  fill(0, 102, 153);
  text(speed, 15, 30, 70, 70);
  text(highest, 15, 60, 70, 70); 
}  