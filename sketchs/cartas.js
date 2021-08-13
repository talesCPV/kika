//Wf3v6kR3ChBQOKPQMDEwbD6tHlT6kba9L5u3RD7C Twilio

const screen = [1200,800];
//const email = "talescd@gmail.com";
const email = "anacristina.mo@hotmail.com";
let title = "Teste";
let file = "frases.txt";
let aluno = "Fulano de Tal"

let text_size = 25;
let text_height = 30;
let cards;
let back;

let index = -1;

let frases = [];
let selecionadas = [];
let fonts = [];


const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);

aluno = urlParams.get('aluno');

if(urlParams.get('title') == "criterios"){
  title = "Jogo dos Critérios";
  file = "criterios.txt";
}else if(urlParams.get('title') == "ocupacional"){
  title = "Realidade Ocupacional";
  file = "ocupacional.txt";
}else if(urlParams.get('title') == "medica"){
  title = "Residência Médica";
  file = "medica.txt";
}

//const product = urlParams.get('title')

//const urlParams = new URLSearchParams(queryString);

//  alert(urlParams.get());


class Cards {
  constructor(){
    this.x = 250;
    this.y = 200;
    this.h = 400;
    this.w = this.h*0.64;
    this.corner = 5;
    this.text_height = text_height;
    this.text_size = text_size;
    this.color = [238,234,207];
    this.text_color = [0,0,0];
    this.text = "";
  }
}

Cards.prototype.type = function(TXT){

  let my_txt = TXT.split(" ");
  let new_line = "";
  let new_text = "";
  let border = 25;
  let count_lines = 1;
  textSize(this.text_size);

  function fill_blank(N,W){
    
    while(textWidth(N) < W-border){
      N = " "+N+" ";
    }
    return N
  }

  for(let i=0; i<my_txt.length; i++){

    let last_let = new_line.substring(new_line.length-1,new_line.length);

    if(textWidth(new_line + my_txt[i]) < this.w-border && last_let != '"' ){
      new_line += " "+ my_txt[i];
    }else{
      new_text += fill_blank(new_line,this.w)+"\n";
      count_lines ++;
      new_line = " "+my_txt[i];

    }

  }
  new_text += fill_blank(new_line,this.w);
  
  let upperlines = ((this.h / this.text_height) - count_lines)/2;

   for ( let i=0; i < upperlines; i++){
    new_text = "\n"+new_text;
   }

   if(upperlines <= 1){
     this.text_size --;
     cards.type(TXT);
   }else{
    this.text = new_text;
  }


}

Cards.prototype.show_text = function(){

  fill(this.text_color);
  textSize(this.text_size);
  textFont(fonts[0]);    
  text(this.text, this.x, this.y);  

}


function preload() {
    config = loadJSON('config.json');
    fonts[0] = loadFont('./assets/YuseiMagic-Regular.ttf'); 
    fonts[1] = loadFont('./assets/AttractionPersonalUse-Rx16.ttf');  
    frases = loadStrings('./assets/'+file);
    back = loadImage('assets/back.png');
}

function setup() {
    createCanvas(screen[0], screen[1]);
    frameRate(6)
    cards = new Cards();
    change_card(1);

    btnLike = createButton('Gostei');
    btnLike.position(600, 630);
    btnLike.mousePressed(add_item);
    btnLike.size(100);
    
    textFont(fonts[1]);
    textAlign(10, 10);
    textLeading(cards.text_height); // altura da quebra de linha
    stroke(255);
}

function draw() {

    background(9,76,48);
    fill(255);
    
    textSize(50); // tamanho da fonte
    text(title, 350, 100);

    show_cards();

}

function mousePressed() { // once only on click

  let my_X = cards.x;
  let my_Y = cards.y;

  if(mouseX >= my_X && mouseX <= my_X+cards.w && mouseY >= my_Y && mouseY <= my_Y + cards.h){    
    change_card(1);
  }

  my_X += 2 * cards.x;

  if(mouseX >= my_X && mouseX <= my_X+cards.w && mouseY >= my_Y && mouseY <= my_Y + cards.h && index > 0){    
    change_card(-1);
  }

}


function show_cards(){

  let spaces = 10;
  let x = cards.x - (spaces*10);

  stroke(0);
  for(let i=0; i<spaces; i++){
    rect(x,cards.y,cards.w,cards.h,cards.corner);
    x+=10;
  }


  fill(cards.color);
  rect(x,cards.y,cards.w,cards.h,cards.corner);

  cards.show_text();

  if(index > 0){

    translate(x + 2*cards.x,cards.y);

    fill(150);

    image(back,0,0,cards.w,cards.h);  
    
  }

}


function change_card(N){

  index += N;
  cards.text_size = text_size;
  cards.type(frases[index]);

  if(index > frases.length){
    index = 0;
  }

}

function add_item(){

  if(!selecionadas.includes(index)){
    selecionadas.push(index);

    let lista = document.querySelector("#lista");

    let row = document.createElement("tr");

    row.setAttribute("id", index);
    row.setAttribute("class", "l_row");

    let item = document.createElement("td");
    item.innerHTML = frases[index];

    let del = document.createElement("td");
    del.innerHTML = "<button class='btnDel' onclick='btnDel_click("+index+")'  >Remover</button>";

    row.appendChild(item);
    row.appendChild(del);

    lista.appendChild(row);
  }

}

function btnDel_click(N){
//  alert(this)
  console.log(frases[N]);

  let element = document.getElementById(N); // will return element
//  let element = document.querySelector('"#'+N+'"');
  element.parentNode.removeChild(element); // will remove the element from DOM

  const i = selecionadas.indexOf(N);

  if (i > -1) {
    selecionadas.splice(i, 1);
  }

}

function sendEmail(){

  let body = "";

  for(let i=0; i<selecionadas.length;i++){
    body += frases[selecionadas[i]] + "\n" ;
  }

  const data = new URLSearchParams();
  data.append('body', body);
  data.append('cli',aluno);
  data.append('assunto',title +" - "+aluno);
  data.append('email',email);

  const myRequest = new Request('sendEmail.php',
      {
          method: 'POST',
          body: data
      })

  fetch(myRequest)
    .then(function(response){

      response.text().then(function (text) {
        console.log(text) ;
      });

  })

}

function btnSend(){
  sendEmail();
}