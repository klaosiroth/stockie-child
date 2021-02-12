// global canvas data 
let canvas  = document.getElementById( "js_snow" );
let context = canvas.getContext( "2d" );
let width   = window.innerWidth  || 0; 
let height  = window.innerHeight || 0; 
let total   = 300; 
let flakes  = []; 

// update dimentions 
function resize( e ) {
  width  = window.innerWidth || 0; 
  height = window.innerHeight || 0; 
  canvas.width  = width; 
  canvas.height = height; 
  canvas.style.width  = width + 'px';
  canvas.style.height = height + 'px';
}; 

// make new flakes 
function create() {
  for( var i = 0; i < total; ++i ) {
    flakes.push( new Flake() );  
  }
}; 

// main animation loop 
function loop() {
  requestAnimationFrame( loop ); 
  context.clearRect( 0, 0, width, height ); 

  for( var i = 0; i < flakes.length; ++i ) {
    flakes[ i ].update(); 
    flakes[ i ].draw(); 
  }
};

// get rand int between min/max 
function rand( min, max, round ) {
  if( round ) {
    return Math.floor( Math.random() * ( max - min + 1 ) ) + min; 
  }
  return Math.random() * ( max - min ) + min;
};

// snow flake object 
const Flake = (function() {
  const FlakeFactory = function() {
    this.x = 0;
    this.y = 0;
    this.factor = 0;
    this.count = 0;
    this.speed = 5; 
    this.size = 10;
    this.wind = 2; 
    this.init(); 
  };

  FlakeFactory.prototype = {
    constructor: FlakeFactory, 
    
    init: function() {
      this.x = rand( 0, width, true ) - ( this.wind * 200 );
      this.y = rand( -height, -10, true );
      this.factor = rand( 0.2, 1.0 );
      this.count = rand( 0, 1000, true );
      // this.speed = this.speed * this.factor;
    }, 
      
    update: function() { 
      this.x += this.wind + Math.cos( this.count / 20 ); 
      this.y += this.factor * ( Math.sin( this.count / 100 ) + this.speed ); 

      if( this.y > height ) {
        this.init(); 
      }
      this.count++; 
    }, 
      
    draw: function() {
      var size = this.size * this.factor; 
      var grad = context.createRadialGradient( this.x, this.y, 0, this.x, this.y, size );
      
      if ( this.factor > .9 ) { // blury
        size = this.size * ( this.factor * 6 ); 
        grad = context.createRadialGradient( this.x, this.y, 0, this.x, this.y, size );
        grad.addColorStop( 0, 'rgba( 250, 250, 255, .1 )' );
        grad.addColorStop( .5, 'rgba( 250, 250, 255, .05 )' );
        grad.addColorStop( 1, 'rgba( 250, 250, 255, 0 )' );
      } 
      else if ( this.factor > .8 ) { // blury
        size = this.size * ( this.factor * 2 ); 
        grad = context.createRadialGradient( this.x, this.y, 0, this.x, this.y, size );
        grad.addColorStop( 0, 'rgba( 250, 250, 255, .2 )' );
        grad.addColorStop( .6, 'rgba( 250, 250, 255, .08 )' );
        grad.addColorStop( 1, 'rgba( 250, 250, 255, 0 )' );
      }  
      else { // sharp 
        grad.addColorStop( 0, 'rgba( 250, 250, 255, 1 )' );
        grad.addColorStop( .5, 'rgba( 250, 250, 255, .8 )' );
        grad.addColorStop( 1, 'rgba( 250, 250, 255, 0 )' );
      }
    
      context.beginPath();
      context.fillStyle = grad;
      context.arc( this.x, this.y, size, 0, 2 * Math.PI, false );
      context.fill();
      context.closePath();
    },
      
  }; 
  return FlakeFactory; 
})();

// init 
context.imageSmoothingEnabled = true; 
context.globalCompositeOperation = "lighten"; 
window.addEventListener( "resize", resize );  
resize(); 
create(); 
loop();
